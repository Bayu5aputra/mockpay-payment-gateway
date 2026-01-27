<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentChannel extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'type',
        'category',
        'provider',
        'icon',
        'description',
        'fee_merchant_percentage',
        'fee_merchant_fixed',
        'fee_customer_percentage',
        'fee_customer_fixed',
        'min_amount',
        'max_amount',
        'is_active',
        'settings',
        'display_order',
    ];

    protected $casts = [
        'fee_merchant_percentage' => 'decimal:2',
        'fee_merchant_fixed' => 'decimal:2',
        'fee_customer_percentage' => 'decimal:2',
        'fee_customer_fixed' => 'decimal:2',
        'min_amount' => 'decimal:2',
        'max_amount' => 'decimal:2',
        'is_active' => 'boolean',
        'settings' => 'array',
    ];

    // Relationships
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    // Helper methods
    public function calculateMerchantFee(float $amount): float
    {
        $percentageFee = ($amount * $this->fee_merchant_percentage) / 100;
        return $percentageFee + $this->fee_merchant_fixed;
    }

    public function calculateCustomerFee(float $amount): float
    {
        $percentageFee = ($amount * $this->fee_customer_percentage) / 100;
        return $percentageFee + $this->fee_customer_fixed;
    }

    public function isAmountValid(float $amount): bool
    {
        return $amount >= $this->min_amount && $amount <= $this->max_amount;
    }
}
