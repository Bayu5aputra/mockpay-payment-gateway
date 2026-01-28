<?php

namespace App\Listeners;

use App\Events\TransactionCreated;
use App\Events\TransactionPending;
use App\Events\TransactionSuccess;
use App\Events\TransactionFailed;
use App\Events\TransactionExpired;
use App\Events\RefundProcessed;
use App\Services\WebhookService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendTransactionWebhook implements ShouldQueue
{
    use InteractsWithQueue;

    protected $webhookService;

    /**
     * Create the event listener.
     */
    public function __construct(WebhookService $webhookService)
    {
        $this->webhookService = $webhookService;
    }

    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        try {
            $transaction = $event->transaction;

            // Check if merchant has webhook URL configured
            if (!$transaction->merchant->webhook_url) {
                Log::info('Webhook not sent - no webhook URL configured', [
                    'transaction_id' => $transaction->transaction_id,
                    'merchant_id' => $transaction->merchant_id,
                ]);
                return;
            }

            // Send webhook
            $this->webhookService->sendWebhook($transaction);

            Log::info('Webhook sent successfully', [
                'transaction_id' => $transaction->transaction_id,
                'status' => $transaction->status,
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send webhook', [
                'transaction_id' => $event->transaction->transaction_id ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Optionally re-throw to retry via queue
            // throw $e;
        }
    }

    /**
     * Determine whether the listener should be queued.
     */
    public function shouldQueue($event): bool
    {
        return true;
    }

    /**
     * Handle a job failure.
     */
    public function failed($event, \Throwable $exception): void
    {
        Log::error('Webhook listener failed', [
            'transaction_id' => $event->transaction->transaction_id ?? null,
            'error' => $exception->getMessage(),
        ]);
    }
}