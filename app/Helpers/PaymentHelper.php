<?php

namespace App\Helpers;

class PaymentHelper
{
    /**
     * Get payment method name
     */
    public static function getPaymentMethodName(string $method): string
    {
        return match($method) {
            'bank_transfer' => 'Bank Transfer',
            'ewallet' => 'E-Wallet',
            'credit_card' => 'Credit Card',
            'qris' => 'QRIS',
            'retail' => 'Retail',
            default => ucfirst(str_replace('_', ' ', $method)),
        };
    }

    /**
     * Get payment channel name
     */
    public static function getPaymentChannelName(string $channel): string
    {
        return match($channel) {
            'bca_va' => 'BCA Virtual Account',
            'mandiri_va' => 'Mandiri Virtual Account',
            'bni_va' => 'BNI Virtual Account',
            'bri_va' => 'BRI Virtual Account',
            'permata_va' => 'Permata Virtual Account',
            'gopay' => 'GoPay',
            'ovo' => 'OVO',
            'dana' => 'DANA',
            'shopeepay' => 'ShopeePay',
            'linkaja' => 'LinkAja',
            'credit_card' => 'Credit Card',
            'qris' => 'QRIS',
            'alfamart' => 'Alfamart',
            'indomaret' => 'Indomaret',
            default => strtoupper($channel),
        };
    }

    /**
     * Get payment channel icon
     */
    public static function getPaymentChannelIcon(string $channel): string
    {
        return match($channel) {
            'bca_va' => 'bank-bca',
            'mandiri_va' => 'bank-mandiri',
            'bni_va' => 'bank-bni',
            'bri_va' => 'bank-bri',
            'permata_va' => 'bank-permata',
            'gopay' => 'gopay',
            'ovo' => 'ovo',
            'dana' => 'dana',
            'shopeepay' => 'shopeepay',
            'linkaja' => 'linkaja',
            'credit_card' => 'credit-card',
            'qris' => 'qris',
            'alfamart' => 'alfamart',
            'indomaret' => 'indomaret',
            default => 'payment',
        };
    }

    /**
     * Get payment method icon
     */
    public static function getPaymentMethodIcon(string $method): string
    {
        return match($method) {
            'bank_transfer' => 'building-columns',
            'ewallet' => 'wallet',
            'credit_card' => 'credit-card',
            'qris' => 'qrcode',
            'retail' => 'store',
            default => 'money-bill',
        };
    }

    /**
     * Format currency
     */
    public static function formatCurrency(float $amount, string $currency = 'IDR'): string
    {
        if ($currency === 'IDR') {
            return 'Rp ' . number_format($amount, 0, ',', '.');
        }

        return $currency . ' ' . number_format($amount, 2, '.', ',');
    }

    /**
     * Get payment channel configuration
     */
    public static function getChannelConfig(string $channel): array
    {
        $configs = [
            'bca_va' => [
                'name' => 'BCA Virtual Account',
                'code' => 'bca_va',
                'bank_code' => '014',
                'fee_percentage' => 1.5,
                'fee_fixed' => 0,
                'min_amount' => 10000,
                'max_amount' => 50000000,
                'expiry_hours' => 24,
            ],
            'mandiri_va' => [
                'name' => 'Mandiri Virtual Account',
                'code' => 'mandiri_va',
                'bank_code' => '008',
                'fee_percentage' => 1.5,
                'fee_fixed' => 0,
                'min_amount' => 10000,
                'max_amount' => 50000000,
                'expiry_hours' => 24,
            ],
            'bni_va' => [
                'name' => 'BNI Virtual Account',
                'code' => 'bni_va',
                'bank_code' => '009',
                'fee_percentage' => 1.5,
                'fee_fixed' => 0,
                'min_amount' => 10000,
                'max_amount' => 50000000,
                'expiry_hours' => 24,
            ],
            'bri_va' => [
                'name' => 'BRI Virtual Account',
                'code' => 'bri_va',
                'bank_code' => '002',
                'fee_percentage' => 1.5,
                'fee_fixed' => 0,
                'min_amount' => 10000,
                'max_amount' => 50000000,
                'expiry_hours' => 24,
            ],
            'permata_va' => [
                'name' => 'Permata Virtual Account',
                'code' => 'permata_va',
                'bank_code' => '013',
                'fee_percentage' => 1.5,
                'fee_fixed' => 0,
                'min_amount' => 10000,
                'max_amount' => 50000000,
                'expiry_hours' => 24,
            ],
            'gopay' => [
                'name' => 'GoPay',
                'code' => 'gopay',
                'fee_percentage' => 2.0,
                'fee_fixed' => 0,
                'min_amount' => 1000,
                'max_amount' => 10000000,
                'expiry_hours' => 1,
            ],
            'ovo' => [
                'name' => 'OVO',
                'code' => 'ovo',
                'fee_percentage' => 2.0,
                'fee_fixed' => 0,
                'min_amount' => 10000,
                'max_amount' => 10000000,
                'expiry_hours' => 1,
            ],
            'dana' => [
                'name' => 'DANA',
                'code' => 'dana',
                'fee_percentage' => 2.0,
                'fee_fixed' => 0,
                'min_amount' => 1000,
                'max_amount' => 10000000,
                'expiry_hours' => 1,
            ],
            'shopeepay' => [
                'name' => 'ShopeePay',
                'code' => 'shopeepay',
                'fee_percentage' => 2.0,
                'fee_fixed' => 0,
                'min_amount' => 1000,
                'max_amount' => 10000000,
                'expiry_hours' => 1,
            ],
            'linkaja' => [
                'name' => 'LinkAja',
                'code' => 'linkaja',
                'fee_percentage' => 2.0,
                'fee_fixed' => 0,
                'min_amount' => 1000,
                'max_amount' => 10000000,
                'expiry_hours' => 1,
            ],
            'credit_card' => [
                'name' => 'Credit Card',
                'code' => 'credit_card',
                'fee_percentage' => 2.9,
                'fee_fixed' => 2000,
                'min_amount' => 10000,
                'max_amount' => 100000000,
                'expiry_hours' => 24,
            ],
            'qris' => [
                'name' => 'QRIS',
                'code' => 'qris',
                'fee_percentage' => 0.7,
                'fee_fixed' => 0,
                'min_amount' => 1000,
                'max_amount' => 10000000,
                'expiry_hours' => 24,
            ],
            'alfamart' => [
                'name' => 'Alfamart',
                'code' => 'alfamart',
                'fee_percentage' => 0,
                'fee_fixed' => 2500,
                'min_amount' => 10000,
                'max_amount' => 5000000,
                'expiry_hours' => 48,
            ],
            'indomaret' => [
                'name' => 'Indomaret',
                'code' => 'indomaret',
                'fee_percentage' => 0,
                'fee_fixed' => 2500,
                'min_amount' => 10000,
                'max_amount' => 5000000,
                'expiry_hours' => 48,
            ],
        ];

        return $configs[$channel] ?? [];
    }

    /**
     * Get all payment channels
     */
    public static function getAllChannels(): array
    {
        return [
            'bank_transfer' => [
                'name' => 'Bank Transfer',
                'channels' => ['bca_va', 'mandiri_va', 'bni_va', 'bri_va', 'permata_va'],
            ],
            'ewallet' => [
                'name' => 'E-Wallet',
                'channels' => ['gopay', 'ovo', 'dana', 'shopeepay', 'linkaja'],
            ],
            'credit_card' => [
                'name' => 'Credit Card',
                'channels' => ['credit_card'],
            ],
            'qris' => [
                'name' => 'QRIS',
                'channels' => ['qris'],
            ],
            'retail' => [
                'name' => 'Retail',
                'channels' => ['alfamart', 'indomaret'],
            ],
        ];
    }

    /**
     * Validate amount for channel
     */
    public static function validateAmount(string $channel, float $amount): array
    {
        $config = self::getChannelConfig($channel);

        if (empty($config)) {
            return [
                'valid' => false,
                'message' => 'Invalid payment channel',
            ];
        }

        if ($amount < $config['min_amount']) {
            return [
                'valid' => false,
                'message' => 'Amount below minimum. Minimum: ' . self::formatCurrency($config['min_amount']),
            ];
        }

        if ($amount > $config['max_amount']) {
            return [
                'valid' => false,
                'message' => 'Amount exceeds maximum. Maximum: ' . self::formatCurrency($config['max_amount']),
            ];
        }

        return [
            'valid' => true,
            'message' => 'Amount is valid',
        ];
    }

    /**
     * Calculate fee
     */
    public static function calculateFee(string $channel, float $amount): float
    {
        $config = self::getChannelConfig($channel);

        if (empty($config)) {
            return 0;
        }

        $percentageFee = ($amount * $config['fee_percentage']) / 100;
        $totalFee = $percentageFee + $config['fee_fixed'];

        return round($totalFee, 2);
    }

    /**
     * Calculate total amount (amount + fee)
     */
    public static function calculateTotalAmount(string $channel, float $amount): float
    {
        $fee = self::calculateFee($channel, $amount);
        return $amount + $fee;
    }
}
