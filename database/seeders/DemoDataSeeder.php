<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ClientApiKey;
use App\Models\CreditCard;
use App\Models\Ewallet;
use App\Models\Merchant;
use App\Models\PaymentAttempt;
use App\Models\QrisPayment;
use App\Models\RetailPayment;
use App\Models\Transaction;
use App\Models\TransactionOverride;
use App\Models\UpgradeRequest;
use App\Models\User;
use App\Models\VirtualAccount;
use App\Models\WebhookLog;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DemoDataSeeder extends Seeder
{
    /**
     * Seed comprehensive demo data for testing all features.
     */
    public function run(): void
    {
        $this->command->info('🚀 Starting comprehensive demo data seeding...');

        // ========================================
        // 1. PLATFORM ADMIN (Merchant)
        // ========================================
        $merchant = Merchant::firstOrCreate(
            ['email' => 'admin@mockpay.test'],
            [
                'name' => 'MockPay Admin',
                'password' => Hash::make('password'),
                'company_name' => 'MockPay Platform',
                'company_address' => 'Jl. Teknologi No. 1, Jakarta Selatan',
                'phone' => '+6281234567890',
                'business_type' => 'ecommerce',
                'status' => 'active',
                'balance' => 0,
                'email_verified_at' => now(),
            ]
        );
        $this->command->info("✓ Platform Admin: admin@mockpay.test / password");

        // ========================================
        // 2. TENANTS (Users/Clients)
        // ========================================
        
        // Tenant 1: Free Plan with transactions
        $tenant1 = User::firstOrCreate(
            ['email' => 'tenant@mockpay.test'],
            [
                'name' => 'Demo Tenant',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'plan' => 'free',
                'webhook_url' => 'https://webhook.site/demo-tenant',
                'webhook_secret' => Str::random(32),
                'webhook_events' => ['payment.success', 'payment.failed', 'payment.expired', 'refund.created'],
            ]
        );
        $this->command->info("✓ Tenant (Free): tenant@mockpay.test / password");

        // Tenant 2: Pro Plan
        $tenant2 = User::firstOrCreate(
            ['email' => 'pro@mockpay.test'],
            [
                'name' => 'Pro Tenant',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'plan' => 'pro',
                'plan_ends_at' => now()->addMonths(6),
                'webhook_url' => 'https://webhook.site/pro-tenant',
                'webhook_secret' => Str::random(32),
                'webhook_events' => ['payment.success', 'payment.failed', 'payment.expired', 'refund.created'],
            ]
        );
        $this->command->info("✓ Tenant (Pro): pro@mockpay.test / password");

        // ========================================
        // 3. API KEYS for Tenants
        // ========================================
        $this->createApiKeys($tenant1);
        $this->createApiKeys($tenant2);
        $this->command->info("✓ API Keys created for all tenants");

        // ========================================
        // 4. TRANSACTIONS with Various Statuses
        // ========================================
        $this->createTransactions($tenant1);
        $this->command->info("✓ Transactions created with various statuses and payment methods");

        // ========================================
        // 5. UPGRADE REQUESTS
        // ========================================
        $this->createUpgradeRequests($tenant1, $merchant);
        $this->command->info("✓ Upgrade requests created");

        // ========================================
        // SUMMARY
        // ========================================
        $this->command->newLine();
        $this->command->info('📋 DEMO ACCOUNTS SUMMARY:');
        $this->command->table(
            ['Role', 'Email', 'Password', 'Notes'],
            [
                ['Platform Admin', 'admin@mockpay.test', 'password', 'Can manage upgrade requests'],
                ['Tenant (Free)', 'tenant@mockpay.test', 'password', 'Has transactions, API keys, webhooks'],
                ['Tenant (Pro)', 'pro@mockpay.test', 'password', 'Pro plan with extended features'],
            ]
        );

        $this->command->info('✅ Demo data seeding completed!');
    }

    private function createApiKeys(User $user): void
    {
        // Sandbox key
        ClientApiKey::firstOrCreate(
            ['user_id' => $user->id, 'environment' => 'sandbox'],
            [
                'key_name' => 'Sandbox API Key',
                'api_key' => 'mpk_test_' . Str::random(32),
                'is_active' => true,
            ]
        );

        // Production key
        ClientApiKey::firstOrCreate(
            ['user_id' => $user->id, 'environment' => 'production'],
            [
                'key_name' => 'Production API Key',
                'api_key' => 'mpk_prod_' . Str::random(32),
                'is_active' => true,
            ]
        );
    }

    private function createTransactions(User $user): void
    {
        $statuses = ['pending', 'settlement', 'failed', 'expired', 'cancelled', 'refunded', 'partial_refund'];
        $paymentMethods = ['bank_transfer', 'ewallet', 'qris', 'retail', 'credit_card'];

        $transactionCount = 0;

        foreach ($paymentMethods as $method) {
            foreach ($statuses as $status) {
                try {
                    $transaction = $this->createTransaction($user, $method, $status, $transactionCount);
                    $transactionCount++;

                    // Create payment details based on method
                    $this->createPaymentDetail($transaction, $method);

                    // Create webhook logs
                    $this->createWebhookLogs($transaction, $user);

                    // Create override history for non-pending transactions
                    if ($status !== 'pending') {
                        $this->createOverrideHistory($transaction, $user, $status);
                    }

                    // Create payment attempts
                    $this->createPaymentAttempts($transaction, $user);
                } catch (\Exception $e) {
                    $this->command->error("Error creating transaction: " . $e->getMessage());
                }
            }
        }
    }

    private function createTransaction(User $user, string $method, string $status, int $index): Transaction
    {
        $baseAmount = rand(50000, 500000);
        $fee = (int) ($baseAmount * 0.029);
        $createdAt = now()->subDays(rand(1, 30))->subHours(rand(1, 23));

        $data = [
            'user_id' => $user->id,
            'transaction_id' => 'TRX-' . strtoupper(Str::random(12)),
            'order_id' => 'ORD-' . date('Ymd') . '-' . str_pad((string) ($index + 1), 4, '0', STR_PAD_LEFT),
            'amount' => $baseAmount,
            'fee' => $fee,
            'total_amount' => $baseAmount + $fee,
            'currency' => 'IDR',
            'status' => $status,
            'payment_method' => $method,
            'payment_channel' => $this->getPaymentChannel($method),
            'customer_name' => 'Customer ' . ($index + 1),
            'customer_email' => 'customer' . ($index + 1) . '@example.com',
            'customer_phone' => '+6281' . rand(10000000, 99999999),
            'description' => 'Test transaction for ' . $method . ' - ' . $status,
            'metadata' => [
                'product_id' => 'PROD-' . rand(1000, 9999),
                'product_name' => 'Sample Product',
                'quantity' => rand(1, 5),
            ],
            'callback_url' => 'https://example.com/callback',
            'expired_at' => $createdAt->copy()->addHours(24),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];

        // Set timestamp based on status
        if ($status === 'settlement') {
            $data['paid_at'] = $createdAt->copy()->addMinutes(rand(5, 60));
            $data['settled_at'] = $createdAt->copy()->addMinutes(rand(61, 120));
        } elseif ($status === 'failed') {
            $data['failure_reason'] = 'Payment failed - insufficient funds simulation';
        } elseif ($status === 'expired') {
            // expired_at already set above
        } elseif ($status === 'cancelled') {
            $data['cancelled_at'] = $createdAt->copy()->addMinutes(rand(10, 60));
        } elseif (in_array($status, ['refunded', 'partial_refund'])) {
            $data['paid_at'] = $createdAt->copy()->addMinutes(rand(5, 60));
            $data['settled_at'] = $createdAt->copy()->addMinutes(rand(61, 120));
            $data['refunded_at'] = $createdAt->copy()->addDays(rand(1, 3));
            $data['refund_amount'] = $status === 'partial_refund' ? (int) ($baseAmount * 0.5) : $baseAmount;
        }

        return Transaction::create($data);
    }

    private function getPaymentChannel(string $method): string
    {
        return match ($method) {
            'bank_transfer' => collect(['bca_va', 'bni_va', 'bri_va', 'mandiri_va', 'permata_va'])->random(),
            'ewallet' => collect(['gopay', 'ovo', 'dana', 'shopeepay', 'linkaja'])->random(),
            'qris' => 'qris',
            'retail' => collect(['indomaret', 'alfamart'])->random(),
            'credit_card' => 'credit_card',
            default => $method,
        };
    }

    private function createPaymentDetail(Transaction $transaction, string $method): void
    {
        match ($method) {
            'bank_transfer' => VirtualAccount::create([
                'transaction_id' => $transaction->id,
                'bank_code' => strtoupper(explode('_', $transaction->payment_channel)[0]),
                'va_number' => '8' . str_pad((string) $transaction->id, 15, (string) rand(0, 9), STR_PAD_LEFT),
                'amount' => $transaction->amount,
                'expired_at' => $transaction->expired_at,
                'instructions' => [
                    'ATM' => ['Masukkan kartu ATM', 'Pilih Transfer', 'Masukkan nomor VA'],
                    'Mobile' => ['Login ke app', 'Pilih Transfer VA', 'Masukkan nomor VA'],
                ],
            ]),
            'ewallet' => Ewallet::create([
                'transaction_id' => $transaction->id,
                'provider' => $transaction->payment_channel,
                'deeplink_url' => 'https://' . $transaction->payment_channel . '.example.com/pay/' . $transaction->transaction_id,
                'qr_url' => 'https://api.mockpay.test/qr/' . $transaction->transaction_id,
                'expired_at' => $transaction->expired_at,
            ]),
            'qris' => QrisPayment::create([
                'transaction_id' => $transaction->id,
                'qr_string' => '00020101021226670016COM.MOCKPAY.WWW0118' . $transaction->transaction_id,
                'expired_at' => $transaction->expired_at,
            ]),
            'retail' => RetailPayment::create([
                'transaction_id' => $transaction->id,
                'store_type' => $transaction->payment_channel,
                'payment_code' => strtoupper(Str::random(3)) . rand(100000000000, 999999999999),
                'expired_at' => $transaction->expired_at,
            ]),
            'credit_card' => CreditCard::create([
                'transaction_id' => $transaction->id,
                'card_type' => collect(['visa', 'mastercard', 'jcb'])->random(),
                'masked_card' => '************' . rand(1000, 9999),
                'bank' => collect(['BCA', 'Mandiri', 'BNI', 'CIMB'])->random(),
                'approval_code' => strtoupper(Str::random(6)),
            ]),
            default => null,
        };
    }

    private function createWebhookLogs(Transaction $transaction, User $user): void
    {
        $events = ['payment.created'];

        if ($transaction->status === 'settlement') {
            $events[] = 'payment.success';
        } elseif ($transaction->status === 'failed') {
            $events[] = 'payment.failed';
        } elseif ($transaction->status === 'expired') {
            $events[] = 'payment.expired';
        } elseif (in_array($transaction->status, ['refunded', 'partial_refund'])) {
            $events[] = 'payment.success';
            $events[] = 'refund.created';
        }

        foreach ($events as $event) {
            WebhookLog::create([
                'user_id' => $user->id,
                'transaction_id' => $transaction->id,
                'event' => $event,
                'webhook_url' => $user->webhook_url ?? 'https://webhook.site/mock',
                'payload' => [
                    'event' => $event,
                    'transaction_id' => $transaction->transaction_id,
                    'status' => $transaction->status,
                    'amount' => $transaction->amount,
                ],
                'status' => collect(['success', 'success', 'success', 'failed'])->random(),
                'response_code' => 200,
                'response_body' => '{"status":"ok"}',
                'attempt_count' => rand(1, 3),
                'sent_at' => $transaction->created_at->copy()->addSeconds(rand(1, 30)),
            ]);
        }
    }

    private function createOverrideHistory(Transaction $transaction, User $user, string $newStatus): void
    {
        $previousStatus = 'pending';

        if (in_array($newStatus, ['refunded', 'partial_refund'])) {
            TransactionOverride::create([
                'transaction_id' => $transaction->id,
                'user_id' => $user->id,
                'previous_status' => 'pending',
                'new_status' => 'settlement',
                'reason' => 'Payment confirmed by tenant',
                'created_at' => $transaction->paid_at ?? now(),
            ]);
            $previousStatus = 'settlement';
        }

        TransactionOverride::create([
            'transaction_id' => $transaction->id,
            'user_id' => $user->id,
            'previous_status' => $previousStatus,
            'new_status' => $newStatus,
            'reason' => $this->getOverrideReason($newStatus),
            'created_at' => now(),
        ]);
    }

    private function getOverrideReason(string $status): string
    {
        return match ($status) {
            'settlement' => 'Payment confirmed by tenant',
            'failed' => 'Payment rejected - insufficient funds simulation',
            'expired' => 'Payment expired after 24 hours',
            'cancelled' => 'Customer cancelled the order',
            'refunded' => 'Full refund requested by customer',
            'partial_refund' => 'Partial refund - partial order return',
            default => 'Status changed by tenant',
        };
    }

    private function createPaymentAttempts(Transaction $transaction, User $user): void
    {
        $attemptCount = rand(1, 3);

        for ($i = 0; $i < $attemptCount; $i++) {
            PaymentAttempt::create([
                'transaction_id' => $transaction->id,
                'user_id' => $user->id,
                'source' => collect(['hosted_page', 'api', 'simulator'])->random(),
                'payload' => [
                    'attempt_number' => $i + 1,
                    'payment_method' => $transaction->payment_method,
                ],
                'created_at' => $transaction->created_at->copy()->addMinutes($i * 5),
            ]);
        }
    }

    private function createUpgradeRequests(User $user, Merchant $merchant): void
    {
        // Pending upgrade request
        UpgradeRequest::create([
            'user_id' => $user->id,
            'plan' => 'pro',
            'requested_price' => 99000,
            'base_price' => 99000,
            'tax_rate' => 0,
            'tax_amount' => 0,
            'admin_fee' => 0,
            'total_amount' => 99000,
            'currency' => 'IDR',
            'status' => 'pending',
            'notes' => 'Upgrade request via bank transfer BCA',
            'created_at' => now()->subDays(2),
        ]);

        // Approved upgrade request
        UpgradeRequest::create([
            'user_id' => $user->id,
            'plan' => 'pro',
            'requested_price' => 99000,
            'base_price' => 99000,
            'tax_rate' => 0,
            'tax_amount' => 0,
            'admin_fee' => 0,
            'total_amount' => 99000,
            'currency' => 'IDR',
            'status' => 'approved',
            'invoice_number' => 'INV-MP-' . date('Ymd') . '-ID-0000000001',
            'approved_at' => now()->subDays(10),
            'approved_by_merchant_id' => $merchant->id,
            'notes' => 'Approved - Payment verified',
            'created_at' => now()->subDays(12),
        ]);

        // Rejected upgrade request
        UpgradeRequest::create([
            'user_id' => $user->id,
            'plan' => 'enterprise',
            'requested_price' => 299000,
            'base_price' => 299000,
            'tax_rate' => 0,
            'tax_amount' => 0,
            'admin_fee' => 0,
            'total_amount' => 299000,
            'currency' => 'IDR',
            'status' => 'rejected',
            'rejection_reason' => 'Bukti transfer tidak valid',
            'rejected_at' => now()->subDays(5),
            'approved_by_merchant_id' => $merchant->id,
            'notes' => 'Payment proof was unclear',
            'created_at' => now()->subDays(7),
        ]);
    }
}
