<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RetailPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'store_type',
        'payment_code',
        'barcode_string',
        'barcode_image_url',
        'store_name',
        'message',
        'expired_at',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
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

    public static function generatePaymentCode(string $storeType, int $transactionId): string
    {
        $prefixes = [
            'alfamart' => 'ALF',
            'alfamidi' => 'ALF',
            'indomaret' => 'IDM',
            'lawson' => 'LAW',
            'dandan' => 'DAN',
        ];

        $prefix = $prefixes[$storeType] ?? 'RTL';
        return $prefix . str_pad($transactionId, 12, '0', STR_PAD_LEFT);
    }

    public function getInstructions(): string
    {
        $storeName = match($this->store_type) {
            'alfamart', 'alfamidi' => 'Alfamart/Alfamidi',
            'indomaret' => 'Indomaret',
            'lawson' => 'Lawson',
            'dandan' => 'Dan+Dan',
            default => 'Retail Store',
        };

        return "Show this code to cashier at {$storeName}: {$this->payment_code}";
    }
}
