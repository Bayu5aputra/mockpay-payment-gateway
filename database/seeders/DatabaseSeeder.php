<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create demo user/client
        User::create([
            'name' => 'Demo Client',
            'email' => 'client@mockpay.test',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        echo "✓ Demo client created: client@mockpay.test / password\n";

        // Seed payment channels
        $this->call(PaymentChannelSeeder::class);
        
        // Seed demo merchant
        $this->call(DemoMerchantSeeder::class);
    }
}
