<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\PaymentChannel;
use App\Models\VirtualAccount;
use App\Models\Ewallet;
use App\Models\QrisPayment;
use App\Models\CreditCard;
use App\Models\RetailPayment;
use App\Events\TransactionCreated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentService
{
    protected $webhookService;
    protected $signatureService;

    public function __construct(
        WebhookService $webhookService,
        SignatureService $signatureService
    ) {
        $this->webhookService = $webhookService;
        $this->signatureService = $signatureService;
    }

    /**
     * Create a new payment transaction
     */
    public function createPayment(array $data, $merchantId)
    {
        DB::beginTransaction();

        try {
            // Find payment channel
            $paymentChannel = PaymentChannel::where('code', $data['payment_method'])
                ->where('is_active', true)
                ->firstOrFail();

            // Validate amount
            if ($data['amount'] < $paymentChannel->min_amount || $data['amount'] > $paymentChannel->max_amount) {
                throw new \Exception("Amount must be between {$paymentChannel->min_amount} and {$paymentChannel->max_amount}");
            }

            // Calculate fee
            $fee = $this->calculateFee($data['amount'], $paymentChannel);
            $totalAmount = $data['amount'] + $fee;

            // Create transaction
            $transaction = Transaction::create([
                'merchant_id' => $merchantId,
                'payment_channel_id' => $paymentChannel->id,
                'transaction_id' => $this->generateTransactionId(),
                'order_id' => $data['order_id'],
                'amount' => $data['amount'],
                'fee' => $fee,
                'total_amount' => $totalAmount,
                'currency' => $data['currency'] ?? 'IDR',
                'status' => 'pending',
                'payment_type' => $paymentChannel->type,
                'payment_method' => $data['payment_method'],
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'customer_phone' => $data['customer_phone'] ?? null,
                'description' => $data['description'] ?? null,
                'items' => $data['items'] ?? null,
                'metadata' => $data['metadata'] ?? null,
                'callback_url' => $data['callback_url'] ?? null,
                'expired_at' => now()->addHours(24),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            // Create payment detail based on payment type
            $this->createPaymentDetail($transaction, $paymentChannel);

            DB::commit();

            // Dispatch event
            event(new TransactionCreated($transaction));

            return $transaction->fresh()->load(['paymentChannel', 'paymentDetail']);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Calculate payment fee
     */
    protected function calculateFee($amount, PaymentChannel $channel)
    {
        $percentageFee = ($amount * $channel->fee_merchant_percentage) / 100;
        return $percentageFee + $channel->fee_merchant_fixed;
    }

    /**
     * Generate unique transaction ID
     */
    protected function generateTransactionId(): string
    {
        $date = date('Ymd');
        $random = strtoupper(Str::random(5));
        $transactionId = "TRX-{$date}-{$random}";

        // Ensure uniqueness
        while (Transaction::where('transaction_id', $transactionId)->exists()) {
            $random = strtoupper(Str::random(5));
            $transactionId = "TRX-{$date}-{$random}";
        }

        return $transactionId;
    }

    /**
     * Create payment detail based on payment type
     */
    protected function createPaymentDetail(Transaction $transaction, PaymentChannel $channel)
    {
        switch ($channel->type) {
            case 'bank_transfer':
                $this->createVirtualAccount($transaction, $channel);
                break;
            case 'ewallet':
                $this->createEwallet($transaction, $channel);
                break;
            case 'card':
                $this->createCreditCard($transaction);
                break;
            case 'qris':
                $this->createQris($transaction);
                break;
            case 'retail':
                $this->createRetail($transaction, $channel);
                break;
        }
    }

    /**
     * Create Virtual Account detail
     */
    protected function createVirtualAccount(Transaction $transaction, PaymentChannel $channel)
    {
        $bankCode = explode('_', $channel->code)[0]; // e.g., bca_va -> bca

        $va = VirtualAccount::create([
            'transaction_id' => $transaction->id,
            'bank_code' => $bankCode,
            'va_number' => VirtualAccountService::generateVANumber($bankCode, $transaction->id),
            'amount' => $transaction->amount,
            'is_open_amount' => false,
            'is_single_use' => true,
            'is_closed' => false,
            'instructions' => $this->getVAInstructions($bankCode),
            'expired_at' => $transaction->expired_at,
        ]);

        return $va;
    }

    /**
     * Create E-wallet detail
     */
    protected function createEwallet(Transaction $transaction, PaymentChannel $channel)
    {
        $provider = str_replace('_', '', $channel->code); // gopay, ovo, dana, etc

        $ewallet = Ewallet::create([
            'transaction_id' => $transaction->id,
            'provider' => $provider,
            'account_phone' => null,
            'deeplink_url' => $this->generateDeeplink($provider, $transaction),
            'qr_string' => null,
            'qr_image_url' => null,
            'callback_url' => $transaction->callback_url,
            'reference_id' => 'REF-' . $transaction->transaction_id,
            'is_paid' => false,
        ]);

        return $ewallet;
    }

    /**
     * Create Credit Card detail
     */
    protected function createCreditCard(Transaction $transaction)
    {
        // This will be updated when card details are submitted
        $card = CreditCard::create([
            'transaction_id' => $transaction->id,
            'card_token' => null,
            'masked_card' => null,
            'card_type' => null,
            'card_category' => null,
            'bank' => null,
            'authentication_type' => '3ds',
            'authentication_url' => route('payment.3ds', $transaction->transaction_id),
            'is_authenticated' => false,
            'installment_term' => 0,
            'installment_rate' => 0,
            'save_card' => false,
        ]);

        return $card;
    }

    /**
     * Create QRIS detail
     */
    protected function createQris(Transaction $transaction)
    {
        $qris = QrisPayment::create([
            'transaction_id' => $transaction->id,
            'qr_string' => $this->generateQRISString($transaction),
            'qr_image_url' => route('payment.qris.image', $transaction->transaction_id),
            'acquirer' => 'MOCKPAY',
            'nmid' => QrisPayment::generateNMID(),
            'terminal_id' => 'MOCK' . str_pad($transaction->id, 6, '0', STR_PAD_LEFT),
            'expired_at' => $transaction->expired_at,
        ]);

        return $qris;
    }

    /**
     * Create Retail Payment detail
     */
    protected function createRetail(Transaction $transaction, PaymentChannel $channel)
    {
        $storeType = str_replace('_', '', $channel->code); // alfamart, indomaret, etc

        $retail = RetailPayment::create([
            'transaction_id' => $transaction->id,
            'store_type' => $storeType,
            'payment_code' => RetailPayment::generatePaymentCode($storeType, $transaction->id),
            'barcode_string' => 'MOCK' . str_pad($transaction->id, 12, '0', STR_PAD_LEFT),
            'barcode_image_url' => route('payment.retail.barcode', $transaction->transaction_id),
            'store_name' => ucfirst($storeType),
            'message' => "Show this code to the cashier at {$storeType}",
            'expired_at' => $transaction->expired_at,
        ]);

        return $retail;
    }

    /**
     * Get VA instructions based on bank
     */
    protected function getVAInstructions($bankCode): array
    {
        $instructions = [
            'bca' => [
                'ATM' => [
                    '1. Insert your BCA card',
                    '2. Enter your PIN',
                    '3. Select "Other Transaction"',
                    '4. Select "Transfer"',
                    '5. Select "To BCA Virtual Account"',
                    '6. Enter the VA number',
                    '7. Confirm the payment details',
                ],
                'Mobile Banking' => [
                    '1. Login to BCA Mobile',
                    '2. Select "m-BCA"',
                    '3. Select "m-Transfer"',
                    '4. Select "BCA Virtual Account"',
                    '5. Enter the VA number',
                    '6. Confirm the payment',
                ],
            ],
            'mandiri' => [
                'ATM' => [
                    '1. Insert your Mandiri card',
                    '2. Enter your PIN',
                    '3. Select "Pay/Buy"',
                    '4. Select "Others"',
                    '5. Select "Multi Payment"',
                    '6. Enter company code: 88888',
                    '7. Enter the VA number',
                    '8. Confirm the payment',
                ],
            ],
            // Add more banks as needed
        ];

        return $instructions[$bankCode] ?? [];
    }

    /**
     * Generate deeplink URL for e-wallet
     */
    protected function generateDeeplink($provider, Transaction $transaction): string
    {
        $baseUrls = [
            'gopay' => 'gojek://gopay/merchanttransfer',
            'ovo' => 'ovo://payment',
            'dana' => 'dana://qr',
            'shopeepay' => 'shopeepay://payment',
            'linkaja' => 'linkaja://payment',
        ];

        $baseUrl = $baseUrls[$provider] ?? '#';
        $params = http_build_query([
            'amount' => $transaction->amount,
            'ref' => $transaction->transaction_id,
        ]);

        return $baseUrl . '?' . $params;
    }

    /**
     * Generate QRIS string
     */
    protected function generateQRISString(Transaction $transaction): string
    {
        // QRIS EMV format (simplified)
        $nmid = 'ID' . str_pad($transaction->id, 16, '0', STR_PAD_LEFT);
        $amount = number_format($transaction->amount, 2, '', '');

        return sprintf(
            "00020101021126%s0014MOCKPAY0215%s03035025204%s5303%s5405%s5802ID5913%s6304%s",
            strlen('MOCKPAY') + 4,
            $transaction->transaction_id,
            'UMI',
            '5411', // MCC
            '360', // Currency IDR
            $amount,
            $transaction->merchant->company_name ?? 'MOCKPAY',
            strtoupper(substr(md5($transaction->transaction_id), 0, 4))
        );
    }

    /**
     * Update transaction status
     */
    public function updateTransactionStatus(Transaction $transaction, string $status, array $additionalData = [])
    {
        DB::beginTransaction();

        try {
            $updates = ['status' => $status];

            switch ($status) {
                case 'settlement':
                    $updates['paid_at'] = now();
                    $updates['settled_at'] = now();
                    break;
                case 'cancel':
                    $updates['cancelled_at'] = now();
                    break;
                case 'expire':
                    // Already expired
                    break;
            }

            $transaction->update(array_merge($updates, $additionalData));

            // Send webhook
            $this->webhookService->sendWebhook($transaction);

            DB::commit();

            return $transaction->fresh();

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
