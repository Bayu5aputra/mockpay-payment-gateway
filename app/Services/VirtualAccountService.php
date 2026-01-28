<?php

namespace App\Services;

class VirtualAccountService
{
    /**
     * Generate VA number based on bank code and transaction ID
     */
    public static function generateVANumber(string $bankCode, int $transactionId): string
    {
        $prefixes = [
            'bca' => '80777',
            'mandiri' => '88888',
            'bni' => '88800',
            'bri' => '88900',
            'permata' => '88950',
            'cimb' => '88960',
        ];

        $prefix = $prefixes[$bankCode] ?? '88999';
        $suffix = str_pad($transactionId, 10, '0', STR_PAD_LEFT);

        return $prefix . $suffix;
    }

    /**
     * Validate VA number format
     */
    public static function validateVANumber(string $vaNumber, string $bankCode): bool
    {
        $prefixes = [
            'bca' => '80777',
            'mandiri' => '88888',
            'bni' => '88800',
            'bri' => '88900',
            'permata' => '88950',
            'cimb' => '88960',
        ];

        $expectedPrefix = $prefixes[$bankCode] ?? '88999';

        return str_starts_with($vaNumber, $expectedPrefix) && strlen($vaNumber) === 15;
    }
}
