<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MerchantInvitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'invited_by',
        'email',
        'token',
        'status',
        'expires_at',
        'accepted_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'accepted_at' => 'datetime',
    ];

    public function inviter(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'invited_by');
    }
}
