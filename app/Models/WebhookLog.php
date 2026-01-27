<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebhookLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id',
        'transaction_id',
        'event',
        'webhook_url',
        'payload',
        'headers',
        'response_code',
        'response_body',
        'attempt_count',
        'status',
        'error_message',
        'sent_at',
        'next_retry_at',
    ];

    protected $casts = [
        'payload' => 'array',
        'headers' => 'array',
        'attempt_count' => 'integer',
        'sent_at' => 'datetime',
        'next_retry_at' => 'datetime',
    ];

    // Relationships
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    // Scopes
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Helper methods
    public function isSuccess(): bool
    {
        return $this->status === 'success';
    }

    public function canRetry(): bool
    {
        return $this->attempt_count < 5 && $this->status !== 'success';
    }

    public function calculateNextRetry(): \DateTime
    {
        // Exponential backoff: 5, 10, 20, 40, 80 minutes
        $minutes = pow(2, $this->attempt_count - 1) * 5;
        return now()->addMinutes($minutes);
    }
}
