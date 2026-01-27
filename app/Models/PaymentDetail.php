<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'payment_type',
        'account_number',
        'qr_string',
        'qr_image_url',
        'card_token',
        'deeplink_url',
        'payment_code',
        'expiry_time',
        'payment_instructions',
        'additional_data',
    ];

    protected $casts = [
        'expiry_time' => 'datetime',
        'payment_instructions' => 'array',
        'additional_data' => 'array',
    ];

    // Relationships
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    // Helper methods
    public function isExpired(): bool
    {
        if (!$this->expiry_time) {
            return false;
        }
        return now()->greaterThan($this->expiry_time);
    }

    public function getPaymentInfo(): array
    {
        return match($this->payment_type) {
            'va' => [
                'type' => 'Virtual Account',
                'account_number' => $this->account_number,
            ],
            'ewallet' => [
                'type' => 'E-Wallet',
                'deeplink_url' => $this->deeplink_url,
                'qr_url' => $this->qr_image_url,
            ],
            'card' => [
                'type' => 'Credit/Debit Card',
                'card_token' => $this->card_token,
            ],
            'qris' => [
                'type' => 'QRIS',
                'qr_url' => $this->qr_image_url,
            ],
            'retail' => [
                'type' => 'Retail Payment',
                'payment_code' => $this->payment_code,
            ],
            default => [],
        };
    }
}
