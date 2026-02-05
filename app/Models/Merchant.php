<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Merchant extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'company_name',
        'company_address',
        'phone',
        'business_type',
        'status',
        'api_key_production',
        'api_key_sandbox',
        'webhook_url',
        'webhook_secret',
        'callback_url',
        'balance',
        'logo',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'email_notifications',
        'webhook_notifications',
        'website',
        'tax_id',
        'city',
        'state',
        'postal_code',
        'country',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'api_key_production',
        'api_key_sandbox',
        'webhook_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'balance' => 'decimal:2',
        'password' => 'hashed',
        'email_notifications' => 'boolean',
        'webhook_notifications' => 'boolean',
    ];

    // Boot method untuk auto-generate API keys
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($merchant) {
            if (!$merchant->api_key_sandbox) {
                $merchant->api_key_sandbox = 'mpk_test_' . Str::random(32);
            }
            if (!$merchant->webhook_secret) {
                $merchant->webhook_secret = Str::random(32);
            }
        });
    }

    // Relationships
    public function apiKeys(): HasMany
    {
        return $this->hasMany(ApiKey::class);
    }

    public function invitationsSent(): HasMany
    {
        return $this->hasMany(MerchantInvitation::class, 'invited_by');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function settlements(): HasMany
    {
        return $this->hasMany(Settlement::class);
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
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeSuspended($query)
    {
        return $query->where('status', 'suspended');
    }

    public function scopeByBusinessType($query, string $type)
    {
        return $query->where('business_type', $type);
    }

    // Helper Methods
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isSuspended(): bool
    {
        return $this->status === 'suspended';
    }

    public function activate()
    {
        $this->status = 'active';
        $this->save();
    }

    public function suspend()
    {
        $this->status = 'suspended';
        $this->save();
    }

    public function generateProductionApiKey(): string
    {
        $this->api_key_production = 'mpk_prod_' . Str::random(32);
        $this->save();
        return $this->api_key_production;
    }

    public function regenerateSandboxApiKey(): string
    {
        $this->api_key_sandbox = 'mpk_test_' . Str::random(32);
        $this->save();
        return $this->api_key_sandbox;
    }

    public function regenerateWebhookSecret(): string
    {
        $this->webhook_secret = Str::random(32);
        $this->save();
        return $this->webhook_secret;
    }

    public function getMaskedProductionKey(): string
    {
        if (!$this->api_key_production) {
            return 'Not generated';
        }
        return substr($this->api_key_production, 0, 20) . '************************';
    }

    public function getMaskedSandboxKey(): string
    {
        if (!$this->api_key_sandbox) {
            return 'Not generated';
        }
        return substr($this->api_key_sandbox, 0, 20) . '************************';
    }

    public function addBalance(float $amount): void
    {
        $this->balance += $amount;
        $this->save();
    }

    public function subtractBalance(float $amount): void
    {
        if ($this->balance < $amount) {
            throw new \Exception('Insufficient balance');
        }
        $this->balance -= $amount;
        $this->save();
    }

    public function getTotalTransactions(): int
    {
        return $this->transactions()->count();
    }

    public function getTotalSuccessTransactions(): int
    {
        return $this->transactions()->where('status', 'settlement')->count();
    }

    public function getTotalTransactionAmount(): float
    {
        return $this->transactions()->where('status', 'settlement')->sum('amount');
    }

    public function getSuccessRate(): float
    {
        $total = $this->getTotalTransactions();
        if ($total === 0) {
            return 0;
        }
        $success = $this->getTotalSuccessTransactions();
        return round(($success / $total) * 100, 2);
    }

    public function getPendingTransactionsCount(): int
    {
        return $this->transactions()->where('status', 'pending')->count();
    }

    public function getPendingTransactionsAmount(): float
    {
        return $this->transactions()->where('status', 'pending')->sum('amount');
    }

    /**
     * Get merchant avatar URL (uses logo if available)
     */
    public function getAvatarUrlAttribute(): ?string
    {
        if ($this->logo) {
            $logo = $this->logo;
            if (str_starts_with($logo, 'http://')) {
                return 'https://' . substr($logo, 7);
            }
            return $logo;
        }

        return null;
    }

    /**
     * Get merchant initials for avatar fallback
     */
    public function getInitialsAttribute(): string
    {
        $name = trim((string) $this->name);
        if ($name === '') {
            return '?';
        }

        $parts = preg_split('/\s+/', $name);
        if (!$parts || count($parts) === 0) {
            return '?';
        }

        $first = strtoupper(mb_substr($parts[0], 0, 1));
        $last = count($parts) > 1 ? strtoupper(mb_substr($parts[count($parts) - 1], 0, 1)) : '';

        return $first . $last;
    }
}
