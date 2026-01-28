<?php

namespace App\Helpers;

use Carbon\Carbon;

class TransactionHelper
{
    /**
     * Generate unique transaction ID
     */
    public static function generateTransactionId(): string
    {
        $date = now()->format('Ymd');
        $random = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 5));

        return "TRX-{$date}-{$random}";
    }

    /**
     * Get transaction status label
     */
    public static function getStatusLabel(string $status): string
    {
        return match($status) {
            'pending' => 'Pending',
            'processing' => 'Processing',
            'settlement' => 'Success',
            'cancelled' => 'Cancelled',
            'expired' => 'Expired',
            'failed' => 'Failed',
            'refunded' => 'Refunded',
            default => ucfirst($status),
        };
    }

    /**
     * Get transaction status color
     */
    public static function getStatusColor(string $status): string
    {
        return match($status) {
            'pending' => 'warning',
            'processing' => 'info',
            'settlement' => 'success',
            'cancelled' => 'secondary',
            'expired' => 'dark',
            'failed' => 'danger',
            'refunded' => 'primary',
            default => 'secondary',
        };
    }

    /**
     * Get transaction status icon
     */
    public static function getStatusIcon(string $status): string
    {
        return match($status) {
            'pending' => 'clock',
            'processing' => 'spinner',
            'settlement' => 'check-circle',
            'cancelled' => 'times-circle',
            'expired' => 'hourglass-end',
            'failed' => 'exclamation-circle',
            'refunded' => 'undo',
            default => 'question-circle',
        };
    }

    /**
     * Format datetime for display
     */
    public static function formatDateTime(?Carbon $datetime, string $format = 'd M Y H:i'): string
    {
        if (!$datetime) {
            return '-';
        }

        return $datetime->format($format);
    }

    /**
     * Get human readable time difference
     */
    public static function getTimeDifference(?Carbon $datetime): string
    {
        if (!$datetime) {
            return '-';
        }

        return $datetime->diffForHumans();
    }

    /**
     * Check if transaction is successful
     */
    public static function isSuccessful(string $status): bool
    {
        return in_array($status, ['settlement', 'processing']);
    }

    /**
     * Check if transaction is failed
     */
    public static function isFailed(string $status): bool
    {
        return in_array($status, ['failed', 'cancelled', 'expired']);
    }

    /**
     * Check if transaction can be refunded
     */
    public static function canBeRefunded(string $status): bool
    {
        return $status === 'settlement';
    }

    /**
     * Check if transaction can be cancelled
     */
    public static function canBeCancelled(string $status): bool
    {
        return in_array($status, ['pending', 'processing']);
    }

    /**
     * Get expiry duration based on payment method
     */
    public static function getExpiryDuration(string $paymentMethod, string $paymentChannel): int
    {
        $config = PaymentHelper::getChannelConfig($paymentChannel);
        return $config['expiry_hours'] ?? 24;
    }

    /**
     * Calculate expiry time
     */
    public static function calculateExpiryTime(string $paymentMethod, string $paymentChannel): Carbon
    {
        $hours = self::getExpiryDuration($paymentMethod, $paymentChannel);
        return now()->addHours($hours);
    }

    /**
     * Get payment instructions URL
     */
    public static function getInstructionsUrl(string $transactionId): string
    {
        return url("/payment/{$transactionId}/instructions");
    }

    /**
     * Get payment page URL
     */
    public static function getPaymentUrl(string $transactionId): string
    {
        return url("/payment/{$transactionId}");
    }

    /**
     * Parse transaction status from event name
     */
    public static function parseStatusFromEvent(string $eventName): ?string
    {
        $parts = explode('.', $eventName);
        return $parts[1] ?? null;
    }

    /**
     * Get webhook event name from transaction status
     */
    public static function getWebhookEventName(string $status): string
    {
        return "transaction.{$status}";
    }

    /**
     * Format transaction for API response
     */
    public static function formatForApi($transaction): array
    {
        return [
            'transaction_id' => $transaction->transaction_id,
            'order_id' => $transaction->order_id,
            'amount' => $transaction->amount,
            'fee' => $transaction->fee,
            'total_amount' => $transaction->total_amount,
            'currency' => $transaction->currency,
            'status' => $transaction->status,
            'payment_method' => $transaction->payment_method,
            'payment_channel' => $transaction->payment_channel,
            'customer' => [
                'name' => $transaction->customer_name,
                'email' => $transaction->customer_email,
                'phone' => $transaction->customer_phone,
            ],
            'description' => $transaction->description,
            'expired_at' => $transaction->expired_at ? $transaction->expired_at->toIso8601String() : null,
            'paid_at' => $transaction->paid_at ? $transaction->paid_at->toIso8601String() : null,
            'created_at' => $transaction->created_at->toIso8601String(),
            'updated_at' => $transaction->updated_at->toIso8601String(),
        ];
    }

    /**
     * Get transaction summary statistics
     */
    public static function getSummaryStats(array $transactions): array
    {
        $total = count($transactions);
        $successful = 0;
        $failed = 0;
        $pending = 0;
        $totalAmount = 0;

        foreach ($transactions as $transaction) {
            if (self::isSuccessful($transaction['status'])) {
                $successful++;
                $totalAmount += $transaction['amount'];
            } elseif (self::isFailed($transaction['status'])) {
                $failed++;
            } elseif ($transaction['status'] === 'pending') {
                $pending++;
            }
        }

        return [
            'total' => $total,
            'successful' => $successful,
            'failed' => $failed,
            'pending' => $pending,
            'total_amount' => $totalAmount,
            'success_rate' => $total > 0 ? round(($successful / $total) * 100, 2) : 0,
        ];
    }
}
