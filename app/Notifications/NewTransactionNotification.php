<?php

namespace App\Notifications;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewTransactionNotification extends Notification
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
            'type' => 'new_transaction',
            'title' => 'Transaksi Baru',
            'message' => "Transaksi {$this->transaction->transaction_id} sebesar " . $this->transaction->formatted_amount . " telah dibuat.",
            'icon' => 'credit-card',
            'color' => 'blue',
            'transaction_id' => $this->transaction->id,
            'url' => route('client.transactions.show', $this->transaction),
        ];
    }
}
