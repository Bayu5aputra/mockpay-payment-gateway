<?php

namespace Tests\Feature\Api;

use App\Models\ClientApiKey;
use App\Models\Merchant;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class TransactionScopeTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_cannot_access_other_clients_transaction(): void
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

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

        $transactionB = Transaction::create([
            'merchant_id' => $merchant->id,
            'user_id' => $userB->id,
            'transaction_id' => 'TRX-' . Str::random(10),
            'order_id' => 'ORDER-USER-B',
            'amount' => 20000,
            'fee' => 0,
            'total_amount' => 20000,
            'currency' => 'IDR',
            'status' => 'pending',
            'payment_type' => 'bank_transfer',
            'payment_method' => 'bank_transfer',
            'customer_name' => 'Customer B',
            'customer_email' => 'customerb@example.test',
            'expired_at' => now()->addHours(24),
        ]);

        $apiKeyA = ClientApiKey::create([
            'user_id' => $userA->id,
            'key_name' => 'User A Key',
            'environment' => 'sandbox',
            'is_active' => true,
        ]);

        $response = $this->withHeader('Authorization', 'Bearer ' . $apiKeyA->getFullKey())
            ->getJson('/api/v1/transaction/' . $transactionB->transaction_id);

        $response->assertStatus(404);
    }
}
