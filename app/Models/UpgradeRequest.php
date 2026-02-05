<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UpgradeRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'approved_by_merchant_id',
        'plan',
        'requested_price',
        'base_price',
        'tax_rate',
        'tax_amount',
        'admin_fee',
        'total_amount',
        'currency',
        'status',
        'invoice_number',
        'invoice_sent_at',
        'approved_at',
        'rejected_at',
        'rejection_reason',
        'proof_path',
        'proof_original_name',
        'proof_mime',
        'proof_size',
        'proof_hash',
        'notes',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'invoice_sent_at' => 'datetime',
        'tax_rate' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'approved_by_merchant_id');
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}
