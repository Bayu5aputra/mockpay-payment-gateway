<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ewallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'provider',
        'account_phone',
        'deeplink_url',
        'qr_string',
        'qr_image_url',
        'callback_url',
        'reference_id',
        'is_paid',
        'paid_at',
    ];

    protected $casts = [
        'is_paid' => 'boolean',
        'paid_at' => 'datetime',
    ];

    // Relationships
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    // Helper methods
    public function isPaid(): bool
    {
        return $this->is_paid;
    }

    public function markAsPaid()
    {
        $this->is_paid = true;
        $this->paid_at = now();
        $this->save();
    }

    public function generateDeeplink(): string
    {
        $baseUrls = [
            'gopay' => 'gojek://gopay/merchanttransfer',
            'ovo' => 'ovo://payment',
            'dana' => 'dana://qr',
            'shopeepay' => 'shopeepay://payment',
            'linkaja' => 'linkaja://payment',
        ];

        $baseUrl = $baseUrls[$this->provider] ?? '#';
        $params = http_build_query([
            'amount' => $this->transaction->amount,
            'ref' => $this->reference_id,
        ]);

        return $baseUrl . '?' . $params;
    }
}
