<?php

namespace App\Mail;

use App\Models\UpgradeRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpgradeRequestNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public UpgradeRequest $upgradeRequest;

    public function __construct(UpgradeRequest $upgradeRequest)
    {
        $this->upgradeRequest = $upgradeRequest->load('user');
    }

    public function build()
    {
        return $this->subject('Notifikasi Upgrade Request MockPay')
            ->view('emails.upgrade-request-notification')
            ->with([
                'upgradeRequest' => $this->upgradeRequest,
            ]);
    }
}
