<?php

namespace Database\Seeders;

use App\Models\User;
use App\Notifications\UpgradeApprovedNotification;
use App\Notifications\UpgradeRejectedNotification;
use App\Notifications\NewTransactionNotification;
use App\Notifications\TransactionPaidNotification;
use App\Notifications\TransactionExpiredNotification;
use App\Notifications\PlanExpiringNotification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'tenant@mockpay.test')->first();

        if (!$user) {
            $this->command->info('Demo tenant user not found. Skipping notification seeding.');
            return;
        }

        // Create sample notifications
        $notifications = [
            [
                'type' => 'upgrade_approved',
                'data' => [
                    'type' => 'upgrade_approved',
                    'title' => 'Upgrade Disetujui! 🎉',
                    'message' => 'Upgrade ke paket PRO telah disetujui.',
                    'icon' => 'check-circle',
                    'color' => 'green',
                    'url' => route('client.upgrade-requests.index'),
                ],
            ],
            [
                'type' => 'new_transaction',
                'data' => [
                    'type' => 'new_transaction',
                    'title' => 'Transaksi Baru',
                    'message' => 'Transaksi TXN-DEMO-001 sebesar Rp 150.000 telah dibuat.',
                    'icon' => 'credit-card',
                    'color' => 'blue',
                    'url' => route('client.transactions.index'),
                ],
            ],
            [
                'type' => 'transaction_paid',
                'data' => [
                    'type' => 'transaction_paid',
                    'title' => 'Pembayaran Berhasil 💰',
                    'message' => 'Transaksi TXN-DEMO-002 sebesar Rp 250.000 telah dibayar.',
                    'icon' => 'currency-dollar',
                    'color' => 'green',
                    'url' => route('client.transactions.index'),
                ],
            ],
            [
                'type' => 'transaction_expired',
                'data' => [
                    'type' => 'transaction_expired',
                    'title' => 'Transaksi Expired ⏰',
                    'message' => 'Transaksi TXN-DEMO-003 sebesar Rp 100.000 telah kadaluarsa.',
                    'icon' => 'clock',
                    'color' => 'yellow',
                    'url' => route('client.transactions.index'),
                ],
            ],
            [
                'type' => 'plan_expiring',
                'data' => [
                    'type' => 'plan_expiring',
                    'title' => 'Paket Akan Berakhir ⚠️',
                    'message' => 'Paket PRO Anda akan berakhir dalam 3 hari.',
                    'icon' => 'exclamation-triangle',
                    'color' => 'yellow',
                    'url' => route('client.upgrade-requests.create'),
                ],
            ],
        ];

        foreach ($notifications as $index => $notification) {
            $user->notifications()->create([
                'id' => \Illuminate\Support\Str::uuid(),
                'type' => 'App\\Notifications\\' . ucfirst($notification['type']) . 'Notification',
                'data' => $notification['data'],
                'read_at' => $index > 2 ? null : now()->subHours($index + 1), // First 3 are read
                'created_at' => now()->subHours($index + 1),
            ]);
        }

        $this->command->info('Created ' . count($notifications) . ' sample notifications for demo tenant.');
    }
}
