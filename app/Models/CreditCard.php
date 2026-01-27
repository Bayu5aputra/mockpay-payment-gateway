<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CreditCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'card_token',
        'masked_card',
        'card_type',
        'card_category',
        'bank',
        'authentication_type',
        'authentication_url',
        'is_authenticated',
        'authentication_id',
        'installment_term',
        'installment_rate',
        'save_card',
    ];

    protected $casts = [
        'is_authenticated' => 'boolean',
        'installment_term' => 'integer',
        'installment_rate' => 'decimal:2',
        'save_card' => 'boolean',
    ];

    // Relationships
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    // Helper methods
    public static function maskCardNumber(string $cardNumber): string
    {
        $first6 = substr($cardNumber, 0, 6);
        $last4 = substr($cardNumber, -4);
        return $first6 . '******' . $last4;
    }

    public static function detectCardType(string $cardNumber): string
    {
        $firstDigit = substr($cardNumber, 0, 1);
        $firstTwo = substr($cardNumber, 0, 2);

        if ($firstDigit == '4') return 'visa';
        if (in_array($firstTwo, ['51', '52', '53', '54', '55'])) return 'mastercard';
        if (in_array($firstTwo, ['34', '37'])) return 'amex';
        if ($firstTwo == '35') return 'jcb';

        return 'unknown';
    }

    public function requires3DS(): bool
    {
        return $this->authentication_type === '3ds';
    }
}
