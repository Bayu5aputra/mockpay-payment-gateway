<?php

declare(strict_types=1);

namespace App\Services;

use App\Mail\RegistrationOtpMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegistrationOtpService
{
    private const SESSION_KEY = 'registration_otp';
    private const EXPIRY_MINUTES = 10;
    private const RESEND_COOLDOWN_SECONDS = 60;

    /**
     * @param array<string, mixed> $payload
     */
    public function start(array $payload): void
    {
        $email = Str::lower((string) ($payload['email'] ?? ''));
        $name = (string) ($payload['name'] ?? '');

        $otp = (string) random_int(100000, 999999);

        $sessionData = [
            'email' => $email,
            'name' => $name,
            'provider' => $payload['provider'] ?? 'manual',
            'password_hash' => $payload['password_hash'] ?? null,
            'google_id' => $payload['google_id'] ?? null,
            'avatar' => $payload['avatar'] ?? null,
            'otp_hash' => Hash::make($otp),
            'expires_at' => now()->addMinutes(self::EXPIRY_MINUTES)->timestamp,
            'attempts' => 0,
            'resend_available_at' => now()->addSeconds(self::RESEND_COOLDOWN_SECONDS)->timestamp,
        ];

        session([self::SESSION_KEY => $sessionData]);

        Mail::to($email)->send(new RegistrationOtpMail($name, $otp));
    }

    public function resend(): bool
    {
        $data = $this->getSession();
        if (!$data) {
            return false;
        }

        $availableAt = (int) ($data['resend_available_at'] ?? 0);
        if (now()->timestamp < $availableAt) {
            return false;
        }

        $this->start([
            'email' => $data['email'] ?? '',
            'name' => $data['name'] ?? '',
            'provider' => $data['provider'] ?? 'manual',
            'password_hash' => $data['password_hash'] ?? null,
            'google_id' => $data['google_id'] ?? null,
            'avatar' => $data['avatar'] ?? null,
        ]);

        return true;
    }

    /**
     * @return array<string, mixed>|null
     */
    public function getSession(): ?array
    {
        $data = session(self::SESSION_KEY);

        return is_array($data) ? $data : null;
    }

    public function clear(): void
    {
        session()->forget(self::SESSION_KEY);
    }
}
