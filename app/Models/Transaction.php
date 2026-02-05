<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'merchant_id',
        'user_id',
        'payment_channel_id',
        'transaction_id',
        'order_id',
        'payment_type',
        'payment_method',
        'payment_channel',
        'amount',
        'fee',
        'total_amount',
        'currency',
        'status',
        'customer_name',
        'customer_email',
        'customer_phone',
        'description',
        'callback_url',
        'items',
        'ip_address',
        'user_agent',
        'expired_at',
        'paid_at',
        'settled_at',
        'cancelled_at',
        'refunded_at',
        'failure_reason',
        'metadata',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'fee' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'items' => 'array',
        'expired_at' => 'datetime',
        'paid_at' => 'datetime',
        'settled_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'refunded_at' => 'datetime',
        'metadata' => 'array',
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SETTLEMENT = 'settlement';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_EXPIRED = 'expired';
    const STATUS_FAILED = 'failed';
    const STATUS_REFUNDED = 'refunded';

    // Payment method constants
    const METHOD_BANK_TRANSFER = 'bank_transfer';
    const METHOD_EWALLET = 'ewallet';
    const METHOD_CREDIT_CARD = 'credit_card';
    const METHOD_QRIS = 'qris';
    const METHOD_RETAIL = 'retail';

    /**
     * Get the merchant that owns the transaction
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }

    /**
     * Get the client that owns the transaction
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the virtual account detail
     */
    public function virtualAccount(): HasOne
    {
        return $this->hasOne(VirtualAccount::class);
    }

    /**
     * Get the ewallet detail
     */
    public function ewallet(): HasOne
    {
        return $this->hasOne(Ewallet::class);
    }

    /**
     * Get the credit card detail
     */
    public function creditCard(): HasOne
    {
        return $this->hasOne(CreditCard::class);
    }

    /**
     * Get the QRIS detail
     */
    public function qris(): HasOne
    {
        return $this->hasOne(Qris::class);
    }

    /**
     * Get the retail detail
     */
    public function retail(): HasOne
    {
        return $this->hasOne(Retail::class);
    }

    /**
     * Get the webhook logs
     */
    public function webhookLogs(): HasMany
    {
        return $this->hasMany(WebhookLog::class);
    }

    /**
     * Scope for filtering by status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for filtering by merchant
     */
    public function scopeMerchant($query, $merchantId)
    {
        return $query->where('merchant_id', $merchantId);
    }

    public function scopeClient($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope for expired transactions
     */
    public function scopeExpired($query)
    {
        return $query->where('status', self::STATUS_PENDING)
            ->where('expired_at', '<=', now());
    }

    /**
     * Scope for pending transactions
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Check if transaction is expired
     */
    public function isExpired(): bool
    {
        return $this->status === self::STATUS_PENDING &&
               $this->expired_at &&
               $this->expired_at->isPast();
    }

    /**
     * Check if transaction is paid
     */
    public function isPaid(): bool
    {
        return in_array($this->status, [
            self::STATUS_SETTLEMENT,
            self::STATUS_PROCESSING,
        ]);
    }

    /**
     * Check if transaction can be cancelled
     */
    public function canBeCancelled(): bool
    {
        return in_array($this->status, [
            self::STATUS_PENDING,
            self::STATUS_PROCESSING,
        ]);
    }

    /**
     * Check if transaction can be refunded
     */
    public function canBeRefunded(): bool
    {
        return $this->status === self::STATUS_SETTLEMENT;
    }

    /**
     * Get payment detail based on payment method
     */
    public function getPaymentDetail()
    {
        switch ($this->payment_method) {
            case self::METHOD_BANK_TRANSFER:
                return $this->virtualAccount;
            case self::METHOD_EWALLET:
                return $this->ewallet;
            case self::METHOD_CREDIT_CARD:
                return $this->creditCard;
            case self::METHOD_QRIS:
                return $this->qris;
            case self::METHOD_RETAIL:
                return $this->retail;
            default:
                return null;
        }
    }

    /**
     * Get formatted amount
     */
    public function getFormattedAmountAttribute(): string
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    /**
     * Get formatted total amount
     */
    public function getFormattedTotalAmountAttribute(): string
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'warning',
            self::STATUS_PROCESSING => 'info',
            self::STATUS_SETTLEMENT => 'success',
            self::STATUS_CANCELLED => 'secondary',
            self::STATUS_EXPIRED => 'dark',
            self::STATUS_FAILED => 'danger',
            self::STATUS_REFUNDED => 'primary',
            default => 'secondary',
        };
    }
}
