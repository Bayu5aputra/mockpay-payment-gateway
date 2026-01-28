<?php

namespace App\Services;

class SignatureService
{
    /**
     * Generate webhook signature
     */
    public function generateSignature(array $payload, string $secret): string
    {
        $jsonPayload = json_encode($payload, JSON_UNESCAPED_SLASHES);
        return hash_hmac('sha256', $jsonPayload, $secret);
    }

    /**
     * Verify webhook signature
     */
    public function verifySignature(array $payload, string $signature, string $secret): bool
    {
        $expectedSignature = $this->generateSignature($payload, $secret);
        return hash_equals($expectedSignature, $signature);
    }
}
