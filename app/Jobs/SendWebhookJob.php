<?php

namespace App\Jobs;

use App\Models\Transaction;
use App\Services\WebhookService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendWebhookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Transaction $transaction;
    public int $attempt;

    /**
     * The number of times the job may be attempted.
     */
    public $tries = 5;

    /**
     * The number of seconds to wait before retrying the job.
     */
    public $backoff = [300, 600, 1200, 2400, 4800]; // 5min, 10min, 20min, 40min, 80min

    /**
     * Create a new job instance.
     */
    public function __construct(Transaction $transaction, int $attempt = 1)
    {
        $this->transaction = $transaction;
        $this->attempt = $attempt;
    }

    /**
     * Execute the job.
     */
    public function handle(WebhookService $webhookService): void
    {
        try {
            Log::info('SendWebhookJob started', [
                'transaction_id' => $this->transaction->transaction_id,
                'attempt' => $this->attempt,
            ]);

            // Check if merchant has webhook URL
            if (!$this->transaction->merchant->webhook_url) {
                Log::info('Webhook not sent - no webhook URL configured', [
                    'transaction_id' => $this->transaction->transaction_id,
                ]);
                return;
            }

            // Send webhook
            $result = $webhookService->deliverWebhook($this->transaction, $this->attempt);

            if ($result['success']) {
                Log::info('Webhook sent successfully', [
                    'transaction_id' => $this->transaction->transaction_id,
                    'attempt' => $this->attempt,
                    'response_code' => $result['response_code'],
                ]);
            } else {
                Log::warning('Webhook delivery failed', [
                    'transaction_id' => $this->transaction->transaction_id,
                    'attempt' => $this->attempt,
                    'error' => $result['error_message'],
                ]);

                // If not last attempt, schedule retry
                if ($this->attempt < $this->tries) {
                    $this->retryWebhook();
                }
            }

        } catch (\Exception $e) {
            Log::error('SendWebhookJob failed', [
                'transaction_id' => $this->transaction->transaction_id,
                'attempt' => $this->attempt,
                'error' => $e->getMessage(),
            ]);

            // Retry on next attempt
            if ($this->attempt < $this->tries) {
                $this->retryWebhook();
            }
        }
    }

    /**
     * Schedule retry with exponential backoff
     */
    protected function retryWebhook(): void
    {
        $nextAttempt = $this->attempt + 1;
        $delay = $this->backoff[$this->attempt - 1] ?? 4800;

        SendWebhookJob::dispatch($this->transaction, $nextAttempt)
            ->delay(now()->addSeconds($delay));

        Log::info('Webhook retry scheduled', [
            'transaction_id' => $this->transaction->transaction_id,
            'next_attempt' => $nextAttempt,
            'delay_seconds' => $delay,
        ]);
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('SendWebhookJob permanently failed', [
            'transaction_id' => $this->transaction->transaction_id,
            'attempt' => $this->attempt,
            'error' => $exception->getMessage(),
        ]);
    }
}