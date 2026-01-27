<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id',
        'payment_channel_id',
        'transaction_id',
        'order_id',
        'amount',
        'fee',
        'total_amount',
        'currency',
        'status',
        'payment_type',
        'payment_method',
        'customer_name',
        'customer_email',
        'customer_phone',
        'description',
        'items',
        'metadata',
        'callback_url',
        'expired_at',
        'paid_at',
        'settled_at',
        'cancelled_at',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'fee' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'items' => 'array',
        'metadata' => 'array',
        'expired_at' => 'datetime',
        'paid_at' => 'datetime',
        'settled_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    // Boot method untuk auto-generate transaction_id
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            if (!$transaction->transaction_id) {
                $transaction->transaction_id = self::generateTransactionId();
            }
            if (!$transaction->expired_at) {
                $transaction->expired_at = now()->addHours(24);
            }
            // Calculate fee and total_amount
            if ($transaction->payment_channel_id && !$transaction->fee) {
                $channel = PaymentChannel::find($transaction->payment_channel_id);
                if ($channel) {
                    $transaction->fee = $channel->calculateMerchantFee($transaction->amount);
                    $transaction->total_amount = $transaction->amount + $transaction->fee;
                }
            }
        });
    }

    // Relationships
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }

    public function paymentChannel(): BelongsTo
    {
        return $this->belongsTo(PaymentChannel::class);
    }

    public function paymentDetail(): HasOne
    {
        return $this->hasOne(PaymentDetail::class);
    }

    public function virtualAccount(): HasOne
    {
        return $this->hasOne(VirtualAccount::class);
    }

    public function creditCard(): HasOne
    {
        return $this->hasOne(CreditCard::class);
    }

    public function ewallet(): HasOne
    {
        return $this->hasOne(Ewallet::class);
    }

    public function qrisPayment(): HasOne
    {
        return $this->hasOne(QrisPayment::class);
    }

    public function retailPayment(): HasOne
    {
        return $this->hasOne(RetailPayment::class);
    }

    public function refunds(): HasMany
    {
        return $this->hasMany(Refund::class);
    }

    public function webhookLogs(): HasMany
    {
        return $this->hasMany(WebhookLog::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeProcessing($query)
    {
        return $query->where('status', 'processing');
    }

    public function scopeSettlement($query)
    {
        return $query->where('status', 'settlement');
    }

    public function scopeCancel($query)
    {
        return $query->where('status', 'cancel');
    }

    public function scopeExpire($query)
    {
        return $query->where('status', 'expire');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    public function scopeRefund($query)
    {
        return $query->where('status', 'refund');
    }

    public function scopeByPaymentMethod($query, string $method)
    {
        return $query->where('payment_method', $method);
    }

    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    public function scopeExpired($query)
    {
        return $query->where('expired_at', '<', now())
                     ->where('status', 'pending');
    }

    // Static Methods
    public static function generateTransactionId(): string
    {
        $date = date('Ymd');
        $random = strtoupper(Str::random(5));
        return "TRX-{$date}-{$random}";
    }

    // Helper Methods
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isProcessing(): bool
    {
        return $this->status === 'processing';
    }

    public function isSettlement(): bool
    {
        return $this->status === 'settlement';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancel';
    }

    public function isExpired(): bool
    {
        return $this->status === 'expire' || ($this->expired_at && now()->greaterThan($this->expired_at));
    }

    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    public function isRefunded(): bool
    {
        return $this->status === 'refund' || $this->status === 'partial_refund';
    }

    public function canBePaid(): bool
    {
        return $this->isPending() && !$this->isExpired();
    }

    public function canBeRefunded(): bool
    {
        return $this->isSettlement() && !$this->isRefunded();
    }

    public function canBeCancelled(): bool
    {
        return $this->isPending() && !$this->isExpired();
    }

    public function markAsPaid(): void
    {
        $this->status = 'settlement';
        $this->paid_at = now();
        $this->settled_at = now();
        $this->save();
    }

    public function markAsProcessing(): void
    {
        $this->status = 'processing';
        $this->save();
    }

    public function markAsSettlement(): void
    {
        $this->status = 'settlement';
        $this->settled_at = now();
        $this->save();
    }

    public function markAsCancelled(): void
    {
        $this->status = 'cancel';
        $this->cancelled_at = now();
        $this->save();
    }

    public function markAsExpired(): void
    {
        $this->status = 'expire';
        $this->save();
    }

    public function markAsFailed(): void
    {
        $this->status = 'failed';
        $this->save();
    }

    public function markAsRefunded(): void
    {
        $this->status = 'refund';
        $this->save();
    }

    public function markAsPartialRefund(): void
    {
        $this->status = 'partial_refund';
        $this->save();
    }

    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'processing' => 'bg-blue-100 text-blue-800',
            'settlement' => 'bg-green-100 text-green-800',
            'cancel' => 'bg-gray-100 text-gray-800',
            'expire' => 'bg-red-100 text-red-800',
            'failed' => 'bg-red-100 text-red-800',
            'refund', 'partial_refund' => 'bg-purple-100 text-purple-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getStatusLabel(): string
    {
        return match($this->status) {
            'pending' => 'Pending',
            'processing' => 'Processing',
            'settlement' => 'Success',
            'cancel' => 'Cancelled',
            'expire' => 'Expired',
            'failed' => 'Failed',
            'refund' => 'Refunded',
            'partial_refund' => 'Partial Refund',
            default => ucfirst($this->status),
        };
    }

    public function getFormattedAmount(): string
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    public function getFormattedFee(): string
    {
        return 'Rp ' . number_format($this->fee, 0, ',', '.');
    }

    public function getFormattedTotalAmount(): string
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    public function getRemainingTime(): ?string
    {
        if (!$this->expired_at || $this->isExpired()) {
            return null;
        }

        $diff = now()->diffInMinutes($this->expired_at);
        $hours = floor($diff / 60);
        $minutes = $diff % 60;

        return sprintf('%02d:%02d:00', $hours, $minutes);
    }

    public function getTimeSincePaid(): ?string
    {
        if (!$this->paid_at) {
            return null;
        }
        return $this->paid_at->diffForHumans();
    }

    public function getTotalRefunded(): float
    {
        return $this->refunds()->where('status', 'completed')->sum('refund_amount');
    }

    public function getRemainingRefundableAmount(): float
    {
        return $this->amount - $this->getTotalRefunded();
    }

    public function createVirtualAccount(array $data): VirtualAccount
    {
        return $this->virtualAccount()->create($data);
    }

    public function createCreditCard(array $data): CreditCard
    {
        return $this->creditCard()->create($data);
    }

    public function createEwallet(array $data): Ewallet
    {
        return $this->ewallet()->create($data);
    }

    public function createQrisPayment(array $data): QrisPayment
    {
        return $this->qrisPayment()->create($data);
    }

    public function createRetailPayment(array $data): RetailPayment
    {
        return $this->retailPayment()->create($data);
    }

    public function toWebhookPayload(): array
    {
        return [
            'event' => $this->getWebhookEventName(),
            'timestamp' => now()->toIso8601String(),
            'data' => [
                'transaction_id' => $this->transaction_id,
                'order_id' => $this->order_id,
                'status' => $this->status,
                'amount' => $this->amount,
                'fee' => $this->fee,
                'total_amount' => $this->total_amount,
                'currency' => $this->currency,
                'payment_type' => $this->payment_type,
                'payment_method' => $this->payment_method,
                'customer_name' => $this->customer_name,
                'customer_email' => $this->customer_email,
                'paid_at' => $this->paid_at?->toIso8601String(),
                'settled_at' => $this->settled_at?->toIso8601String(),
                'created_at' => $this->created_at->toIso8601String(),
                'updated_at' => $this->updated_at->toIso8601String(),
            ],
        ];
    }

    private function getWebhookEventName(): string
    {
        return match($this->status) {
            'pending' => 'transaction.pending',
            'processing' => 'transaction.processing',
            'settlement' => 'transaction.success',
            'cancel' => 'transaction.cancelled',
            'expire' => 'transaction.expired',
            'failed' => 'transaction.failed',
            'refund', 'partial_refund' => 'transaction.refunded',
            default => 'transaction.updated',
        };
    }
}
