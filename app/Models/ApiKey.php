<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ApiKey extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'merchant_id',
        'key_name',
        'api_key',
        'environment',
        'is_active',
        'last_used_at',
        'expires_at',
    ];

    protected $hidden = [
        'api_key',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'last_used_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    // Boot method
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($apiKey) {
            if (!$apiKey->api_key) {
                $prefix = $apiKey->environment === 'production' ? 'mpk_prod_' : 'mpk_test_';
                $apiKey->api_key = $prefix . Str::random(32);
            }
        });
    }

    // Relationships
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeProduction($query)
    {
        return $query->where('environment', 'production');
    }

    public function scopeSandbox($query)
    {
        return $query->where('environment', 'sandbox');
    }

    public function scopeNotExpired($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('expires_at')
              ->orWhere('expires_at', '>', now());
        });
    }

    // Helper methods
    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function isProduction(): bool
    {
        return $this->environment === 'production';
    }

    public function isSandbox(): bool
    {
        return $this->environment === 'sandbox';
    }

    public function isExpired(): bool
    {
        if (!$this->expires_at) {
            return false;
        }
        return now()->greaterThan($this->expires_at);
    }

    public function isValid(): bool
    {
        return $this->isActive() && !$this->isExpired();
    }

    public function updateLastUsed(): void
    {
        $this->last_used_at = now();
        $this->save();
    }

    public function activate(): void
    {
        $this->is_active = true;
        $this->save();
    }

    public function deactivate(): void
    {
        $this->is_active = false;
        $this->save();
    }

    public function regenerate(): string
    {
        $prefix = $this->environment === 'production' ? 'mpk_prod_' : 'mpk_test_';
        $this->api_key = $prefix . Str::random(32);
        $this->save();
        return $this->api_key;
    }

    public function getMaskedKey(): string
    {
        return substr($this->api_key, 0, 15) . '************************';
    }

    public function getFullKey(): string
    {
        return $this->api_key;
    }

    public static function findByKey(string $key): ?self
    {
        return self::where('api_key', $key)->first();
    }

    public static function validateKey(string $key): bool
    {
        $apiKey = self::findByKey($key);
        return $apiKey && $apiKey->isValid();
    }
}
