<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionOverride extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'user_id',
        'previous_status',
        'new_status',
        'reason',
        'refund_amount',
        'payload_snapshot',
    ];

    protected $casts = [
        'refund_amount' => 'decimal:2',
        'payload_snapshot' => 'array',
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
