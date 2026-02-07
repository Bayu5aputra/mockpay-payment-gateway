<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PlanExpiredNotification extends Notification
{
    use Queueable;

    public function __construct() {}

    public function via($notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toArray($notifiable): array
    {
        return [
            'type' => 'plan_expired',
            'title' => 'Paket Telah Berakhir',
            'message' => "Paket Anda telah berakhir. Akun Anda sekarang menggunakan paket Free.",
            'icon' => 'exclamation-circle',
            'color' => 'red',
            'url' => route('client.upgrade-requests.create'),
        ];
    }

    public function toMail($notifiable): MailMessage
    {
        $planName = strtoupper($notifiable->plan ?? 'FREE');

        return (new MailMessage)
            ->subject("❌ Paket {$planName} Anda Telah Berakhir")
            ->greeting("Halo {$notifiable->name},")
            ->line("Paket **{$planName}** Anda telah **berakhir**.")
            ->line('Akun Anda sekarang kembali ke paket **Free** dengan batasan berikut:')
            ->line('• Maksimal 10 transaksi per hari')
            ->line('• Maksimal 500 API request per hari')
            ->line('• Fitur premium tidak tersedia')
            ->line('')
            ->line('Untuk melanjutkan menggunakan fitur premium tanpa batasan, silakan perpanjang paket Anda.')
            ->action('Upgrade Sekarang', route('client.upgrade-requests.create'))
            ->line('Terima kasih telah menggunakan MockPay!')
            ->salutation('Salam, Tim MockPay');
    }
}
