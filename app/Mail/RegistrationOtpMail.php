<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public string $otp;

    public function __construct(string $name, string $otp)
    {
        $this->name = $name;
        $this->otp = $otp;
    }

    public function build(): self
    {
        return $this->subject('Kode OTP Registrasi MockPay')
            ->view('emails.registration-otp')
            ->with([
                'name' => $this->name,
                'otp' => $this->otp,
            ]);
    }
}
