<?php

namespace App\Mail;

use App\Models\Merchant;
use App\Models\MerchantInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MerchantInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public MerchantInvitation $invitation;
    public Merchant $merchant;

    public function __construct(MerchantInvitation $invitation, Merchant $merchant)
    {
        $this->invitation = $invitation;
        $this->merchant = $merchant;
    }

    public function build()
    {
        return $this->subject('You are invited to join MockPay')
            ->view('emails.merchant-invitation');
    }
}
