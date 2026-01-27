<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Settlement extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id',
        'settlement_id',
        'settlement_date',
        'period_start',
        'period_end',
        'total_transactions',
        'gross_amount',
        'total_fee',
        'net_amount',
        'status',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'transfer_proof',
        'notes',
        'processed_at',
    ];

    protected $casts = [
        'settlement_date' => 'date',
        'period_start' => 'date',
        'period_end' => 'date',
        'total_transactions' => 'integer',
        'gross_amount' => 'decimal:2',
        'total_fee' => 'decimal:2',
        'net_amount' => 'decimal:2',
        'processed_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($settlement) {
            if (!$settlement->settlement_id) {
                $settlement->settlement_id = 'STL-' . date('Ymd') . '-' . strtoupper(Str::random(5));
            }
        });
    }

    // Relationships
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // Helper methods
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function markAsCompleted()
    {
        $this->status = 'completed';
        $this->processed_at = now();
        $this->save();
    }
}
