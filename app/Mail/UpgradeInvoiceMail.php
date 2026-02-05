<?php

namespace App\Mail;

use App\Models\UpgradeRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class UpgradeInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public UpgradeRequest $upgradeRequest;

    public function __construct(UpgradeRequest $upgradeRequest)
    {
        $this->upgradeRequest = $upgradeRequest->load('user');
    }

    public function build()
    {
        $banks = Config::get('mockpay.banks', []);
        $subject = 'Invoice Upgrade ' . ($this->upgradeRequest->invoice_number ?? '');

        $mail = $this->subject(trim($subject))
            ->view('emails.upgrade-invoice')
            ->with([
                'upgradeRequest' => $this->upgradeRequest,
                'banks' => $banks,
            ]);

        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.upgrade-invoice', [
                'upgradeRequest' => $this->upgradeRequest,
                'banks' => $banks,
            ]);
            $mail->attachData($pdf->output(), ($this->upgradeRequest->invoice_number ?? 'invoice') . '.pdf', [
                'mime' => 'application/pdf',
            ]);
        }

        return $mail;
    }
}
