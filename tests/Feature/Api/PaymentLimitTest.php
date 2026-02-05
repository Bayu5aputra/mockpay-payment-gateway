<?php

namespace Tests\Feature\Api;

use App\Models\ClientApiKey;
use App\Models\Merchant;
use App\Models\PaymentChannel;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class PaymentLimitTest extends TestCase
{
    use RefreshDatabase;

    public function test_free_plan_hits_daily_limit(): void
    {
        $user = User::factory()->create([
            'plan' => 'free',
        ]);

        $merchant = Merchant::create([
            'name' => 'Demo Merchant',
            'email' => 'merchant@example.test',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'company_name' => 'Demo Store',
            'phone' => '0800000000',
            'business_type' => 'ecommerce',
            'status' => 'active',
        ]);

        PaymentChannel::create([
            'code' => 'bank_transfer',
            'name' => 'Bank Transfer',
            'type' => 'bank_transfer',
            'category' => 'virtual_account',
            'provider' => 'bca',
            'fee_merchant_percentage' => 0,
            'fee_merchant_fixed' => 0,
            'min_amount' => 1000,
            'max_amount' => 50000000,
            'is_active' => true,
        ]);

        $dailyLimit = config('mockpay.limits.free_daily_transactions', 10);
        for ($i = 0; $i < $dailyLimit; $i++) {
            Transaction::create([
                'merchant_id' => $merchant->id,
                'user_id' => $user->id,
                'transaction_id' => 'TRX-' . Str::random(10) . $i,
                'order_id' => 'ORDER-' . $i,
                'amount' => 10000,
                'fee' => 0,
                'total_amount' => 10000,
                'currency' => 'IDR',
                'status' => 'pending',
                'payment_type' => 'bank_transfer',
                'payment_method' => 'bank_transfer',
                'customer_name' => 'Test Customer',
                'customer_email' => 'customer@example.test',
                'expired_at' => now()->addHours(24),
            ]);
        }

        $apiKey = ClientApiKey::create([
            'user_id' => $user->id,
            'key_name' => 'Test Key',
            'environment' => 'sandbox',
            'is_active' => true,
        ]);

        $payload = [
            'order_id' => 'ORDER-NEW',
            'amount' => 15000,
            'currency' => 'IDR',
            'payment_method' => 'bank_transfer',
            'payment_channel' => 'bca_va',
            'customer' => [
                'name' => 'John Doe',
                'email' => 'john@example.test',
                'phone' => '081234567890',
            ],
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $apiKey->getFullKey())
            ->postJson('/api/v1/payment/create', $payload);

        $response->assertStatus(429);
    }
}
