<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TestTransactionSeeder extends Seeder
{
    public function run(): void
    {
        // Create test user first
        $user = User::firstOrCreate(
            ['email' => 'test@mockpay.test'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $this->command->info("User created: ID " . $user->id);

        // Create minimal transaction
        try {
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'transaction_id' => 'TRX-' . strtoupper(Str::random(12)),
                'order_id' => 'ORD-001',
                'amount' => 100000,
                'fee' => 3000,
                'total_amount' => 103000,
                'currency' => 'IDR',
                'status' => 'pending',
                'payment_method' => 'bank_transfer',
                'payment_channel' => 'bca_va',
                'customer_name' => 'Test Customer',
                'customer_email' => 'customer@test.com',
                'customer_phone' => '+6281234567890',
                'description' => 'Test transaction',
                'callback_url' => 'https://example.com/callback',
                'expired_at' => now()->addDay(),
            ]);
            
            $this->command->info("Transaction created: " . $transaction->transaction_id);
        } catch (\Exception $e) {
            $this->command->error("Error: " . $e->getMessage());
        }
    }
}
