<?php

namespace App\Events;

use App\Models\Transaction;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TransactionFailed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Transaction $transaction;
    public ?string $reason;

    /**
     * Create a new event instance.
     */
    public function __construct(Transaction $transaction, ?string $reason = null)
    {
        $this->transaction = $transaction;
        $this->reason = $reason;
    }
}
