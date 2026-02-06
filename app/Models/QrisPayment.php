<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QrisPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'qr_string',
        'qr_image_url',
        'acquirer',
        'nmid',
        'terminal_id',
        'expired_at',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
    ];

    // Relationships
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    // Helper methods
    public function isExpired(): bool
    {
        return now()->greaterThan($this->expired_at);
    }

    public static function generateNMID(): string
    {
        return 'ID' . str_pad(rand(1, 9999999999999999), 16, '0', STR_PAD_LEFT);
    }

    public function generateQRString(): string
    {
        // Format QRIS standard
        return sprintf(
            "00020101021126%s0014%s0215%s0303%s5204%s5303%s5405%s5802ID5913%s6304%s",
            strlen($this->acquirer) + 4,
            $this->acquirer,
            $this->transaction->transaction_id,
            'UMI',
            '5411', // MCC
            '360', // Currency IDR
            number_format($this->transaction->amount, 2, '', ''),
            $this->transaction->user?->name ?? 'MOCKPAY',
            $this->generateChecksum()
        );
    }

    private function generateChecksum(): string
    {
        return strtoupper(substr(md5(uniqid(rand(), true)), 0, 4));
    }
}
