<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'plan',
        'plan_ends_at',
        'google_id',
        'avatar',
        'provider',
        'webhook_url',
        'webhook_secret',
        'webhook_events',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'plan_ends_at' => 'datetime',
            'webhook_events' => 'array',
        ];
    }

    /**
     * Check if user registered via OAuth
     */
    public function isOAuthUser(): bool
    {
        return !empty($this->provider);
    }

    /**
     * Get user's avatar URL
     */
    public function getAvatarUrlAttribute(): ?string
    {
        if ($this->avatar) {
            $avatar = $this->avatar;
            if (str_starts_with($avatar, 'http://')) {
                return 'https://' . substr($avatar, 7);
            }
            return $avatar;
        }

        return null;
    }

    /**
     * Get user's initials for avatar fallback
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

    public function upgradeRequests()
    {
        return $this->hasMany(UpgradeRequest::class);
    }

    public function apiKeys()
    {
        return $this->hasMany(ClientApiKey::class);
    }

    public function webhookLogs()
    {
        return $this->hasMany(WebhookLog::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function isPro(): bool
    {
        return $this->effectivePlan() === 'pro';
    }

    public function isEnterprise(): bool
    {
        return $this->effectivePlan() === 'enterprise';
    }

    public function isFree(): bool
    {
        return $this->effectivePlan() === 'free';
    }

    public function isPlanExpired(): bool
    {
        if (!$this->plan_ends_at) {
            return false;
        }

        return $this->plan_ends_at->isPast();
    }

    public function effectivePlan(): string
    {
        $plan = $this->plan ?? 'free';

        if (in_array($plan, ['pro', 'enterprise'], true) && $this->isPlanExpired()) {
            return 'free';
        }

        return $plan;
    }

    public function hasActivePaidPlan(): bool
    {
        return in_array($this->effectivePlan(), ['pro', 'enterprise'], true);
    }

    public function dailyTransactionLimit(): ?int
    {
        if ($this->effectivePlan() === 'free') {
            return (int) config('mockpay.limits.free_daily_transactions', 10);
        }

        return null;
    }
}
