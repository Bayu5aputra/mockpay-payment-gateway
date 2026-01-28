<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class TransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Display transaction list
     * GET /dashboard/transactions
     */
    public function index(Request $request)
    {
        $merchant = Auth::user();

        $filters = [
            'status' => $request->status,
            'payment_method' => $request->payment_method,
            'payment_channel' => $request->payment_channel,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'search' => $request->search,
            'order_by' => $request->order_by ?? 'created_at',
            'order_direction' => $request->order_direction ?? 'desc',
        ];

        $perPage = $request->per_page ?? 15;
        $transactions = $this->transactionService->getTransactionsByMerchant(
            $merchant->id,
            $filters,
            $perPage
        );

        // For AJAX requests (DataTables)
        if ($request->ajax()) {
            return response()->json([
                'data' => $transactions->items(),
                'recordsTotal' => $transactions->total(),
                'recordsFiltered' => $transactions->total(),
                'draw' => $request->draw,
            ]);
        }

        return view('dashboard.transactions.index', compact('transactions', 'filters'));
    }

    /**
     * Display transaction detail
     * GET /dashboard/transactions/{transaction_id}
     */
    public function show($transactionId)
    {
        $merchant = Auth::user();
        $transaction = $this->transactionService->getByTransactionId($transactionId);

        if (!$transaction || $transaction->merchant_id !== $merchant->id) {
            abort(404, 'Transaction not found');
        }

        // Get webhook logs
        $webhookLogs = $transaction->webhookLogs()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.transactions.show', compact('transaction', 'webhookLogs'));
    }

    /**
     * Cancel transaction
     * POST /dashboard/transactions/{transaction_id}/cancel
     */
    public function cancel(Request $request, $transactionId)
    {
        $merchant = Auth::user();
        $transaction = $this->transactionService->getByTransactionId($transactionId);

        if (!$transaction || $transaction->merchant_id !== $merchant->id) {
            return redirect()->back()->with('error', 'Transaction not found');
        }

        try {
            $this->transactionService->cancelTransaction(
                $transaction,
                $request->reason ?? 'Cancelled by merchant'
            );

            return redirect()->back()->with('success', 'Transaction cancelled successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to cancel transaction: ' . $e->getMessage());
        }
    }

    /**
     * Refund transaction
     * POST /dashboard/transactions/{transaction_id}/refund
     */
    public function refund(Request $request, $transactionId)
    {
        $merchant = Auth::user();
        $transaction = $this->transactionService->getByTransactionId($transactionId);

        if (!$transaction || $transaction->merchant_id !== $merchant->id) {
            return redirect()->back()->with('error', 'Transaction not found');
        }

        try {
            $this->transactionService->refundTransaction(
                $transaction,
                $request->reason ?? 'Refund requested by merchant'
            );

            return redirect()->back()->with('success', 'Transaction refunded successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to refund transaction: ' . $e->getMessage());
        }
    }

    /**
     * Export transactions to CSV
     * GET /dashboard/transactions/export
     */
    public function export(Request $request)
    {
        $merchant = Auth::user();

        $filters = [
            'status' => $request->status,
            'payment_method' => $request->payment_method,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];

        try {
            $filepath = $this->transactionService->exportToCsv($merchant->id, $filters);

            return Response::download($filepath, basename($filepath), [
                'Content-Type' => 'text/csv',
            ])->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to export transactions: ' . $e->getMessage());
        }
    }

    /**
     * Resend webhook
     * POST /dashboard/transactions/{transaction_id}/resend-webhook
     */
    public function resendWebhook($transactionId)
    {
        $merchant = Auth::user();
        $transaction = $this->transactionService->getByTransactionId($transactionId);

        if (!$transaction || $transaction->merchant_id !== $merchant->id) {
            return redirect()->back()->with('error', 'Transaction not found');
        }

        try {
            app(\App\Services\WebhookService::class)->sendWebhook($transaction);

            return redirect()->back()->with('success', 'Webhook resent successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to resend webhook: ' . $e->getMessage());
        }
    }
}
