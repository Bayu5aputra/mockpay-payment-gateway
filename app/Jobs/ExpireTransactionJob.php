<?php

namespace App\Jobs;

use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ExpireTransactionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     */
    public $tries = 3;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(TransactionService $transactionService): void
    {
        try {
            Log::info('ExpireTransactionJob started');

            // Get all expired transactions
            $expiredCount = $transactionService->expireOldTransactions();

            Log::info('ExpireTransactionJob completed', [
                'expired_count' => $expiredCount,
            ]);

        } catch (\Exception $e) {
            Log::error('ExpireTransactionJob failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('ExpireTransactionJob permanently failed', [
            'error' => $exception->getMessage(),
        ]);
    }
}