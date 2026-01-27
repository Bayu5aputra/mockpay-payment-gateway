<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VirtualAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'bank_code',
        'va_number',
        'amount',
        'is_open_amount',
        'is_single_use',
        'is_closed',
        'instructions',
        'expired_at',
        'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'is_open_amount' => 'boolean',
        'is_single_use' => 'boolean',
        'is_closed' => 'boolean',
        'instructions' => 'array',
        'expired_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    // Relationships
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    // Helper methods
    public function isExpired(): bool
    {
        return now()->greaterThan($this->expired_at);
    }

    public function isPaid(): bool
    {
        return $this->paid_at !== null;
    }

    public function markAsPaid()
    {
        $this->paid_at = now();
        $this->is_closed = true;
        $this->save();
    }

    public static function generateVANumber(string $bankCode, int $transactionId): string
    {
        $prefixes = [
            'bca' => '80777',
            'mandiri' => '88888',
            'bni' => '88800',
            'bri' => '88900',
            'permata' => '88950',
            'cimb' => '88960',
        ];

        $prefix = $prefixes[$bankCode] ?? '88999';
        $suffix = str_pad($transactionId, 10, '0', STR_PAD_LEFT);

        return $prefix . $suffix;
    }
}
