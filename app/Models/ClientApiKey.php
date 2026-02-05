<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ClientApiKey extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeNotExpired($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('expires_at')
              ->orWhere('expires_at', '>', now());
        });
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
}
