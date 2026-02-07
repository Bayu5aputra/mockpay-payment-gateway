<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PlanExpiringNotification extends Notification
{
    use Queueable;

    public function __construct(
        public int $daysRemaining
    ) {}

    public function via($notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toArray($notifiable): array
    {
        $message = $this->daysRemaining === 0
            ? "Paket " . strtoupper($notifiable->plan) . " Anda berakhir hari ini!"
            : "Paket " . strtoupper($notifiable->plan) . " Anda akan berakhir dalam {$this->daysRemaining} hari.";

        return [
            'type' => 'plan_expiring',
            'title' => 'Paket Akan Berakhir ⚠️',
            'message' => $message,
            'icon' => 'exclamation-triangle',
            'color' => 'yellow',
            'days_remaining' => $this->daysRemaining,
            'url' => route('client.upgrade-requests.create'),
        ];
    }

    public function toMail($notifiable): MailMessage
    {
        $planName = strtoupper($notifiable->plan ?? 'FREE');
        $expiryDate = $notifiable->plan_ends_at?->format('d F Y') ?? '-';

        if ($this->daysRemaining === 0) {
            $subject = "⚠️ Paket {$planName} Anda Berakhir Hari Ini!";
            $greeting = "Halo {$notifiable->name},";
            $introLine = "Paket **{$planName}** Anda berakhir **hari ini** ({$expiryDate}).";
        } else {
            $subject = "⏰ Paket {$planName} Anda Akan Berakhir dalam {$this->daysRemaining} Hari";
            $greeting = "Halo {$notifiable->name},";
            $introLine = "Paket **{$planName}** Anda akan berakhir dalam **{$this->daysRemaining} hari** ({$expiryDate}).";
        }

        return (new MailMessage)
            ->subject($subject)
            ->greeting($greeting)
            ->line($introLine)
            ->line('Setelah paket berakhir, akun Anda akan kembali ke paket Free dengan batasan:')
            ->line('• Maksimal 10 transaksi per hari')
            ->line('• Maksimal 500 API request per hari')
            ->line('• Fitur premium tidak tersedia')
            ->action('Perpanjang Sekarang', route('client.upgrade-requests.create'))
            ->line('Terima kasih telah menggunakan MockPay!')
            ->salutation('Salam, Tim MockPay');
    }
}
