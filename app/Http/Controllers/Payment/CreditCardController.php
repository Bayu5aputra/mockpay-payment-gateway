<?php

declare(strict_types=1);

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreditCardController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Display credit card payment form
     * GET /payment/credit-card/{transaction_id}
     */
    public function form($transactionId)
    {
        $transaction = $this->transactionService->getByTransactionId($transactionId);

        if (!$transaction) {
            abort(404, 'Transaction not found');
        }

        if ($transaction->payment_method !== 'credit_card') {
            abort(400, 'Invalid payment method');
        }

        $creditCard = $transaction->creditCard;

        return view('payment.credit-card.form', compact('transaction', 'creditCard'));
    }

    /**
     * Process credit card payment
     * POST /payment/credit-card/{transaction_id}/process
     */
    public function process(Request $request, $transactionId)
    {
        $validator = Validator::make($request->all(), [
            'card_number' => 'required|string|size:16',
            'card_holder' => 'required|string|max:255',
            'expiry_month' => 'required|numeric|min:1|max:12',
            'expiry_year' => 'required|numeric|min:' . date('Y'),
            'cvv' => 'required|string|size:3',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $transaction = $this->transactionService->getByTransactionId($transactionId);

            if (!$transaction) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaction not found'
                ], 404);
            }

            // Check if transaction is still pending
            if ($transaction->status !== 'pending') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaction is not in pending status'
                ], 400);
            }

            // Check if transaction is expired
            if ($transaction->isExpired()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaction has expired'
                ], 400);
            }

            // Simulate card validation
            $cardNumber = $request->card_number;

            // Test cards for simulation
            $testCards = [
                '4111111111111111' => 'success', // Visa success
                '5555555555554444' => 'success', // Mastercard success
                '4000000000000002' => 'failed',  // Card declined
                '4000000000000069' => 'failed',  // Expired card
                '4000000000000127' => 'failed',  // Incorrect CVV
            ];

            $result = $testCards[$cardNumber] ?? 'success'; // Default success for other cards

            if ($result === 'failed') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Card payment failed. Please try another card.',
                    'requires_3ds' => false,
                ], 400);
            }

            // Check if 3DS required (cards ending with 0000)
            if (substr($cardNumber, -4) === '0000') {
                $creditCard = $transaction->creditCard;

                return response()->json([
                    'status' => 'requires_action',
                    'message' => '3D Secure authentication required',
                    'requires_3ds' => true,
                    'redirect_url' => url('/payment/credit-card/' . $transactionId . '/3ds'),
                ]);
            }

            // Update credit card details
            $creditCard = $transaction->creditCard;
            $creditCard->update([
                'masked_number' => '****-****-****-' . substr($cardNumber, -4),
                'card_type' => $this->getCardType($cardNumber),
                'bank' => $this->getBankName($cardNumber),
            ]);

            // Record guest payment attempt only
            $this->transactionService->recordPaymentAttempt(
                $transaction,
                $transaction->user_id,
                'guest_credit_card',
                [
                    'card_last4' => substr($cardNumber, -4),
                    'card_type' => $this->getCardType($cardNumber),
                    'requires_3ds' => false,
                ]
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Payment attempt recorded. Awaiting tenant manual override.',
                'data' => [
                    'transaction_id' => $transaction->transaction_id,
                    'order_id' => $transaction->order_id,
                    'amount' => $transaction->amount,
                    'status' => $transaction->fresh()->status,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to process payment: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display 3D Secure page
     * GET /payment/credit-card/{transaction_id}/3ds
     */
    public function threeDSecure($transactionId)
    {
        $transaction = $this->transactionService->getByTransactionId($transactionId);

        if (!$transaction) {
            abort(404, 'Transaction not found');
        }

        return view('payment.credit-card.3ds', compact('transaction'));
    }

    /**
     * Process 3D Secure authentication
     * POST /payment/credit-card/{transaction_id}/3ds/authenticate
     */
    public function authenticate3DS(Request $request, $transactionId)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|string|size:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $transaction = $this->transactionService->getByTransactionId($transactionId);

            if (!$transaction) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaction not found'
                ], 404);
            }

            // Simulate OTP validation
            // In test mode, accept '112233' as valid OTP
            if ($request->otp !== '112233') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid OTP code'
                ], 400);
            }

            // Record guest payment attempt only
            $this->transactionService->recordPaymentAttempt(
                $transaction,
                $transaction->user_id,
                'guest_credit_card_3ds',
                [
                    'otp' => $request->otp,
                    'requires_3ds' => true,
                ]
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Payment attempt recorded. Awaiting tenant manual override.',
                'data' => [
                    'transaction_id' => $transaction->transaction_id,
                    'order_id' => $transaction->order_id,
                    'amount' => $transaction->amount,
                    'status' => $transaction->fresh()->status,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to authenticate: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get card type from card number
     */
    private function getCardType($cardNumber)
    {
        $firstDigit = substr($cardNumber, 0, 1);
        $firstTwoDigits = substr($cardNumber, 0, 2);

        if ($firstDigit == '4') {
            return 'Visa';
        } elseif (in_array($firstTwoDigits, ['51', '52', '53', '54', '55'])) {
            return 'Mastercard';
        } elseif (in_array($firstTwoDigits, ['34', '37'])) {
            return 'American Express';
        } elseif ($firstTwoDigits == '35') {
            return 'JCB';
        }

        return 'Unknown';
    }

    /**
     * Get bank name (simplified)
     */
    private function getBankName($cardNumber)
    {
        // In real application, this would use BIN database
        return 'Bank Demo';
    }
}
