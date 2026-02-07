<?php

namespace App\Notifications;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TransactionPaidNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Transaction $transaction
    ) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'type' => 'transaction_paid',
            'title' => 'Pembayaran Berhasil 💰',
            'message' => "Transaksi {$this->transaction->transaction_id} sebesar " . $this->transaction->formatted_amount . " telah dibayar.",
            'icon' => 'currency-dollar',
            'color' => 'green',
            'transaction_id' => $this->transaction->id,
            'url' => route('client.transactions.show', $this->transaction),
        ];
    }
}
