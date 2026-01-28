<?php

namespace App\Jobs;

use App\Models\Merchant;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ProcessSettlementJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $merchantId;
    protected $date;

    /**
     * The number of times the job may be attempted.
     */
    public $tries = 3;

    /**
     * Create a new job instance.
     */
    public function __construct(int $merchantId, Carbon $date)
    {
        $this->merchantId = $merchantId;
        $this->date = $date;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Log::info('ProcessSettlementJob started', [
                'merchant_id' => $this->merchantId,
                'date' => $this->date->toDateString(),
            ]);

            $merchant = Merchant::find($this->merchantId);

            if (!$merchant) {
                Log::error('Merchant not found', ['merchant_id' => $this->merchantId]);
                return;
            }

            // Get all settled transactions for the date
            $transactions = Transaction::where('merchant_id', $this->merchantId)
                ->where('status', Transaction::STATUS_SETTLEMENT)
                ->whereDate('settled_at', $this->date)
                ->get();

            if ($transactions->isEmpty()) {
                Log::info('No transactions to settle', [
                    'merchant_id' => $this->merchantId,
                    'date' => $this->date->toDateString(),
                ]);
                return;
            }

            // Calculate settlement summary
            $summary = [
                'merchant_id' => $this->merchantId,
                'settlement_date' => $this->date,
                'transaction_count' => $transactions->count(),
                'gross_amount' => $transactions->sum('amount'),
                'total_fee' => $transactions->sum('fee'),
                'net_amount' => $transactions->sum('amount') - $transactions->sum('fee'),
                'transactions' => $transactions->pluck('transaction_id')->toArray(),
            ];

            Log::info('Settlement processed successfully', $summary);

            // In real application, create Settlement record and trigger payout
            // Settlement::create($summary);

        } catch (\Exception $e) {
            Log::error('ProcessSettlementJob failed', [
                'merchant_id' => $this->merchantId,
                'date' => $this->date->toDateString(),
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
        Log::error('ProcessSettlementJob permanently failed', [
            'merchant_id' => $this->merchantId,
            'date' => $this->date->toDateString(),
            'error' => $exception->getMessage(),
        ]);
    }
}