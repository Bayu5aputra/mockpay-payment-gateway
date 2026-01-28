<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\Merchant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class TransactionService
{
    /**
     * Get transaction by transaction ID
     */
    public function getByTransactionId(string $transactionId): ?Transaction
    {
        return Transaction::where('transaction_id', $transactionId)
            ->with(['virtualAccount', 'ewallet', 'creditCard', 'qris', 'retail'])
            ->first();
    }

    /**
     * Get transaction by order ID and merchant
     */
    public function getByOrderId(string $orderId, int $merchantId): ?Transaction
    {
        return Transaction::where('order_id', $orderId)
            ->where('merchant_id', $merchantId)
            ->with(['virtualAccount', 'ewallet', 'creditCard', 'qris', 'retail'])
            ->first();
    }

    /**
     * Get transactions by merchant with filters
     */
    public function getTransactionsByMerchant(
        int $merchantId,
        array $filters = [],
        int $perPage = 15
    ) {
        $query = Transaction::where('merchant_id', $merchantId)
            ->with(['virtualAccount', 'ewallet', 'creditCard', 'qris', 'retail']);

        // Filter by status
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        // Filter by payment method
        if (!empty($filters['payment_method'])) {
            $query->where('payment_method', $filters['payment_method']);
        }

        // Filter by payment channel
        if (!empty($filters['payment_channel'])) {
            $query->where('payment_channel', $filters['payment_channel']);
        }

        // Filter by date range
        if (!empty($filters['start_date'])) {
            $query->whereDate('created_at', '>=', $filters['start_date']);
        }

        if (!empty($filters['end_date'])) {
            $query->whereDate('created_at', '<=', $filters['end_date']);
        }

        // Search by transaction ID or order ID
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('transaction_id', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('order_id', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('customer_name', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('customer_email', 'like', '%' . $filters['search'] . '%');
            });
        }

        // Order by
        $orderBy = $filters['order_by'] ?? 'created_at';
        $orderDirection = $filters['order_direction'] ?? 'desc';
        $query->orderBy($orderBy, $orderDirection);

        return $query->paginate($perPage);
    }

    /**
     * Get transaction statistics for merchant
     */
    public function getStatistics(int $merchantId, string $period = 'today'): array
    {
        $query = Transaction::where('merchant_id', $merchantId);

        // Apply period filter
        switch ($period) {
            case 'today':
                $query->whereDate('created_at', today());
                break;
            case 'yesterday':
                $query->whereDate('created_at', today()->subDay());
                break;
            case 'week':
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
                break;
            case 'year':
                $query->whereYear('created_at', now()->year);
                break;
        }

        $statistics = [
            'total_transactions' => (clone $query)->count(),
            'total_amount' => (clone $query)->sum('amount'),
            'total_fee' => (clone $query)->sum('fee'),
            'pending' => (clone $query)->where('status', Transaction::STATUS_PENDING)->count(),
            'settlement' => (clone $query)->where('status', Transaction::STATUS_SETTLEMENT)->count(),
            'cancelled' => (clone $query)->where('status', Transaction::STATUS_CANCELLED)->count(),
            'expired' => (clone $query)->where('status', Transaction::STATUS_EXPIRED)->count(),
            'failed' => (clone $query)->where('status', Transaction::STATUS_FAILED)->count(),
            'success_rate' => 0,
        ];

        // Calculate success rate
        if ($statistics['total_transactions'] > 0) {
            $statistics['success_rate'] = round(
                ($statistics['settlement'] / $statistics['total_transactions']) * 100,
                2
            );
        }

        return $statistics;
    }

    /**
     * Get transaction chart data
     */
    public function getChartData(int $merchantId, string $period = 'week'): array
    {
        $query = Transaction::where('merchant_id', $merchantId);

        switch ($period) {
            case 'week':
                $startDate = now()->startOfWeek();
                $endDate = now()->endOfWeek();
                $groupBy = 'DATE(created_at)';
                break;
            case 'month':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                $groupBy = 'DATE(created_at)';
                break;
            case 'year':
                $startDate = now()->startOfYear();
                $endDate = now()->endOfYear();
                $groupBy = 'MONTH(created_at)';
                break;
            default:
                $startDate = now()->subDays(6);
                $endDate = now();
                $groupBy = 'DATE(created_at)';
        }

        $data = $query->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw("{$groupBy} as date")
            ->selectRaw('COUNT(*) as total_transactions')
            ->selectRaw('SUM(amount) as total_amount')
            ->selectRaw('SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) as success_count', [Transaction::STATUS_SETTLEMENT])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return [
            'labels' => $data->pluck('date')->toArray(),
            'transactions' => $data->pluck('total_transactions')->toArray(),
            'amounts' => $data->pluck('total_amount')->toArray(),
            'success' => $data->pluck('success_count')->toArray(),
        ];
    }

    /**
     * Get payment method distribution
     */
    public function getPaymentMethodDistribution(int $merchantId, string $period = 'month'): array
    {
        $query = Transaction::where('merchant_id', $merchantId);

        // Apply period filter
        switch ($period) {
            case 'today':
                $query->whereDate('created_at', today());
                break;
            case 'week':
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
                break;
            case 'year':
                $query->whereYear('created_at', now()->year);
                break;
        }

        return $query->selectRaw('payment_method, COUNT(*) as count, SUM(amount) as total')
            ->groupBy('payment_method')
            ->get()
            ->map(function ($item) {
                return [
                    'method' => $item->payment_method,
                    'count' => $item->count,
                    'total' => $item->total,
                    'percentage' => 0, // Will be calculated after getting all data
                ];
            })
            ->toArray();
    }

    /**
     * Cancel transaction
     */
    public function cancelTransaction(Transaction $transaction, string $reason = null): bool
    {
        if (!$transaction->canBeCancelled()) {
            throw new \Exception('Transaction cannot be cancelled');
        }

        DB::beginTransaction();
        try {
            $transaction->update([
                'status' => Transaction::STATUS_CANCELLED,
                'cancelled_at' => now(),
                'failure_reason' => $reason,
            ]);

            // Trigger webhook
            app(WebhookService::class)->sendWebhook($transaction);

            DB::commit();
            Log::info('Transaction cancelled', [
                'transaction_id' => $transaction->transaction_id,
                'reason' => $reason,
            ]);

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to cancel transaction', [
                'transaction_id' => $transaction->transaction_id,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Mark transaction as settlement
     */
    public function settleTransaction(Transaction $transaction): bool
    {
        if ($transaction->status === Transaction::STATUS_SETTLEMENT) {
            return true;
        }

        DB::beginTransaction();
        try {
            $transaction->update([
                'status' => Transaction::STATUS_SETTLEMENT,
                'paid_at' => now(),
                'settled_at' => now(),
            ]);

            // Trigger webhook
            app(WebhookService::class)->sendWebhook($transaction);

            DB::commit();
            Log::info('Transaction settled', [
                'transaction_id' => $transaction->transaction_id,
            ]);

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to settle transaction', [
                'transaction_id' => $transaction->transaction_id,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Refund transaction
     */
    public function refundTransaction(Transaction $transaction, string $reason = null): bool
    {
        if (!$transaction->canBeRefunded()) {
            throw new \Exception('Transaction cannot be refunded');
        }

        DB::beginTransaction();
        try {
            $transaction->update([
                'status' => Transaction::STATUS_REFUNDED,
                'refunded_at' => now(),
                'failure_reason' => $reason,
            ]);

            // Trigger webhook
            app(WebhookService::class)->sendWebhook($transaction);

            DB::commit();
            Log::info('Transaction refunded', [
                'transaction_id' => $transaction->transaction_id,
                'reason' => $reason,
            ]);

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to refund transaction', [
                'transaction_id' => $transaction->transaction_id,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Expire old pending transactions
     */
    public function expireOldTransactions(): int
    {
        $expiredCount = 0;
        $transactions = Transaction::expired()->get();

        foreach ($transactions as $transaction) {
            try {
                DB::beginTransaction();

                $transaction->update([
                    'status' => Transaction::STATUS_EXPIRED,
                ]);

                // Trigger webhook
                app(WebhookService::class)->sendWebhook($transaction);

                DB::commit();
                $expiredCount++;

                Log::info('Transaction expired', [
                    'transaction_id' => $transaction->transaction_id,
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Failed to expire transaction', [
                    'transaction_id' => $transaction->transaction_id,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return $expiredCount;
    }

    /**
     * Get recent transactions for dashboard
     */
    public function getRecentTransactions(int $merchantId, int $limit = 10)
    {
        return Transaction::where('merchant_id', $merchantId)
            ->with(['virtualAccount', 'ewallet', 'creditCard', 'qris', 'retail'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Export transactions to CSV
     */
    public function exportToCsv(int $merchantId, array $filters = []): string
    {
        $query = Transaction::where('merchant_id', $merchantId)
            ->with(['virtualAccount', 'ewallet', 'creditCard', 'qris', 'retail']);

        // Apply filters
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['start_date'])) {
            $query->whereDate('created_at', '>=', $filters['start_date']);
        }

        if (!empty($filters['end_date'])) {
            $query->whereDate('created_at', '<=', $filters['end_date']);
        }

        $transactions = $query->orderBy('created_at', 'desc')->get();

        // Generate CSV
        $filename = 'transactions_' . now()->format('YmdHis') . '.csv';
        $filepath = storage_path('app/exports/' . $filename);

        // Create directory if not exists
        if (!file_exists(storage_path('app/exports'))) {
            mkdir(storage_path('app/exports'), 0755, true);
        }

        $file = fopen($filepath, 'w');

        // Headers
        fputcsv($file, [
            'Transaction ID',
            'Order ID',
            'Payment Method',
            'Payment Channel',
            'Amount',
            'Fee',
            'Total Amount',
            'Status',
            'Customer Name',
            'Customer Email',
            'Created At',
            'Paid At',
        ]);

        // Data rows
        foreach ($transactions as $transaction) {
            fputcsv($file, [
                $transaction->transaction_id,
                $transaction->order_id,
                $transaction->payment_method,
                $transaction->payment_channel,
                $transaction->amount,
                $transaction->fee,
                $transaction->total_amount,
                $transaction->status,
                $transaction->customer_name,
                $transaction->customer_email,
                $transaction->created_at->format('Y-m-d H:i:s'),
                $transaction->paid_at ? $transaction->paid_at->format('Y-m-d H:i:s') : '',
            ]);
        }

        fclose($file);

        return $filepath;
    }
}
