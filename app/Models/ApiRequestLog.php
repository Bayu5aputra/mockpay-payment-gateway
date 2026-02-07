<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApiRequestLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'method',
        'path',
        'status_code',
        'duration_ms',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'status_code' => 'integer',
        'duration_ms' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
