<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\WebhookLog;
use App\Jobs\SendWebhookJob;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebhookService
{
    protected $signatureService;

    public function __construct(SignatureService $signatureService)
    {
        $this->signatureService = $signatureService;
    }

    /**
     * Send webhook notification
     */
    public function sendWebhook(Transaction $transaction, bool $async = true)
    {
        $webhookUrl = $transaction->merchant->webhook_url;

        if (empty($webhookUrl)) {
            return false;
        }

        if ($async) {
            // Send via queue
            SendWebhookJob::dispatch($transaction)->delay(now()->addSeconds(2));
            return true;
        }

        // Send immediately
        return $this->deliverWebhook($transaction);
    }

    /**
     * Actually deliver the webhook
     */
    public function deliverWebhook(Transaction $transaction): bool
    {
        $webhookUrl = $transaction->merchant->webhook_url;
        $payload = $this->preparePayload($transaction);
        $signature = $this->signatureService->generateSignature($payload, $transaction->merchant->webhook_secret);

        $headers = [
            'X-Webhook-Signature' => $signature,
            'X-Transaction-Id' => $transaction->transaction_id,
            'Content-Type' => 'application/json',
        ];

        // Create webhook log
        $webhookLog = WebhookLog::create([
            'merchant_id' => $transaction->merchant_id,
            'transaction_id' => $transaction->id,
            'event' => $this->getEventName($transaction->status),
            'webhook_url' => $webhookUrl,
            'payload' => $payload,
            'headers' => $headers,
            'status' => 'pending',
            'attempt_count' => 1,
            'sent_at' => now(),
        ]);

        try {
            $response = Http::withHeaders($headers)
                ->timeout(30)
                ->post($webhookUrl, $payload);

            $webhookLog->update([
                'response_code' => $response->status(),
                'response_body' => $response->body(),
                'status' => $response->successful() ? 'success' : 'failed',
                'error_message' => !$response->successful() ? 'HTTP ' . $response->status() : null,
            ]);

            return $response->successful();

        } catch (\Exception $e) {
            $webhookLog->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
                'next_retry_at' => $this->calculateNextRetry($webhookLog->attempt_count),
            ]);

            Log::error('Webhook delivery failed', [
                'transaction_id' => $transaction->transaction_id,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * Prepare webhook payload
     */
    protected function preparePayload(Transaction $transaction): array
    {
        return [
            'event' => $this->getEventName($transaction->status),
            'timestamp' => now()->toIso8601String(),
            'data' => [
                'transaction_id' => $transaction->transaction_id,
                'order_id' => $transaction->order_id,
                'status' => $transaction->status,
                'amount' => $transaction->amount,
                'fee' => $transaction->fee,
                'total_amount' => $transaction->total_amount,
                'currency' => $transaction->currency,
                'payment_type' => $transaction->payment_type,
                'payment_method' => $transaction->payment_method,
                'customer_name' => $transaction->customer_name,
                'customer_email' => $transaction->customer_email,
                'paid_at' => $transaction->paid_at?->toIso8601String(),
                'settled_at' => $transaction->settled_at?->toIso8601String(),
                'created_at' => $transaction->created_at->toIso8601String(),
                'updated_at' => $transaction->updated_at->toIso8601String(),
            ],
        ];
    }

    /**
     * Get event name from status
     */
    protected function getEventName(string $status): string
    {
        return match($status) {
            'pending' => 'transaction.pending',
            'processing' => 'transaction.processing',
            'settlement' => 'transaction.success',
            'cancel' => 'transaction.cancelled',
            'expire' => 'transaction.expired',
            'failed' => 'transaction.failed',
            'refund', 'partial_refund' => 'transaction.refunded',
            default => 'transaction.updated',
        };
    }

    /**
     * Calculate next retry time using exponential backoff
     */
    protected function calculateNextRetry(int $attemptCount): \DateTime
    {
        // Exponential backoff: 5, 10, 20, 40, 80 minutes
        $minutes = pow(2, $attemptCount - 1) * 5;
        return now()->addMinutes($minutes);
    }

    /**
     * Retry failed webhook
     */
    public function retryWebhook(WebhookLog $webhookLog): bool
    {
        if ($webhookLog->attempt_count >= 5) {
            return false;
        }

        $transaction = $webhookLog->transaction;
        $webhookLog->increment('attempt_count');

        return $this->deliverWebhook($transaction);
    }
}
