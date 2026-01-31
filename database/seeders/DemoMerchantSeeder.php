<?php

namespace Database\Seeders;

use App\Models\Merchant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoMerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create demo merchant account
        Merchant::create([
            'name' => 'Demo Merchant',
            'email' => 'merchant@mockpay.test',
            'password' => Hash::make('password'),
            'company_name' => 'MockPay Demo Company',
            'company_address' => 'Jl. Teknologi No. 123, Jakarta',
            'phone' => '+628123456789',
            'business_type' => 'ecommerce',
            'status' => 'active',
            'balance' => 0,
            'email_verified_at' => now(),
        ]);

        echo "✓ Demo merchant created: merchant@mockpay.test / password\n";
    }
}