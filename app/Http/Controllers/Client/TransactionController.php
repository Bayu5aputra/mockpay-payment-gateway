<?php

declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManualOverrideRequest;
use App\Services\TransactionService;
use App\Services\WebhookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class TransactionController extends Controller
{
    protected TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $filters = [
            'status' => $request->status,
            'payment_method' => $request->payment_method,
            'payment_channel' => $request->payment_channel,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'search' => $request->search,
            'order_by' => $request->order_by ?? 'created_at',
            'order_direction' => $request->order_direction ?? 'desc',
            'per_page' => $request->per_page ?? 15,
        ];

        $perPage = $filters['per_page'];
        $transactions = $this->transactionService->getTransactionsByUser(
            $user->id,
            $filters,
            $perPage
        );

        return view('client.transactions.index', compact('transactions', 'filters'));
    }

    public function show(string $transactionId)
    {
        $user = Auth::user();
        $transaction = $this->transactionService->getByTransactionIdForUser($transactionId, $user->id);

        if (!$transaction) {
            abort(404, 'Transaction not found');
        }

        $transaction->load(['webhookLogs', 'overrides', 'paymentAttempts']);

        return view('client.transactions.show', compact('transaction'));
    }

    public function override(ManualOverrideRequest $request, string $transactionId)
    {
        $user = Auth::user();
        $transaction = $this->transactionService->getByTransactionIdForUser($transactionId, $user->id);

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaction not found');
        }

        try {
            $this->transactionService->manualOverride(
                $transaction,
                $user,
                $request->input('action'),
                $request->input('reason'),
                $request->input('refund_amount')
            );

            return redirect()->back()->with('success', 'Manual override applied successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to override: ' . $e->getMessage());
        }
    }

    public function resendWebhook(string $transactionId, WebhookService $webhookService)
    {
        $user = Auth::user();
        $transaction = $this->transactionService->getByTransactionIdForUser($transactionId, $user->id);

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaction not found');
        }

        try {
            $webhookService->sendWebhook($transaction);

            return redirect()->back()->with('success', 'Webhook resent successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to resend webhook: ' . $e->getMessage());
        }
    }

    public function downloadJson(string $transactionId)
    {
        $user = Auth::user();
        $transaction = $this->transactionService->getByTransactionIdForUser($transactionId, $user->id);

        if (!$transaction) {
            abort(404, 'Transaction not found');
        }

        $transaction->load(['webhookLogs', 'overrides', 'paymentAttempts']);

        $payload = [
            'transaction' => $transaction->toArray(),
            'payment_detail' => $transaction->getPaymentDetail()?->toArray(),
            'overrides' => $transaction->overrides->toArray(),
            'webhook_logs' => $transaction->webhookLogs->toArray(),
            'payment_attempts' => $transaction->paymentAttempts->toArray(),
        ];

        $filename = 'transaction-' . $transaction->transaction_id . '.json';

        return response()->streamDownload(function () use ($payload) {
            echo json_encode($payload, JSON_PRETTY_PRINT);
        }, $filename, ['Content-Type' => 'application/json']);
    }

    public function downloadPdf(string $transactionId)
    {
        $user = Auth::user();
        $transaction = $this->transactionService->getByTransactionIdForUser($transactionId, $user->id);

        if (!$transaction) {
            abort(404, 'Transaction not found');
        }

        $transaction->load(['webhookLogs', 'overrides', 'paymentAttempts']);

        $pdf = \PDF::loadView('pdf.receipt', [
            'transaction' => $transaction,
            'paymentDetail' => $transaction->getPaymentDetail(),
            'overrides' => $transaction->overrides,
            'webhookLogs' => $transaction->webhookLogs,
            'paymentAttempts' => $transaction->paymentAttempts,
        ]);

        return $pdf->download('transaction-' . $transaction->transaction_id . '.pdf');
    }

    public function export(Request $request)
    {
        $user = Auth::user();

        $filters = [
            'status' => $request->status,
            'payment_method' => $request->payment_method,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];

        try {
            $filepath = $this->transactionService->exportToCsvForUser($user->id, $filters);

            return Response::download($filepath, basename($filepath), [
                'Content-Type' => 'text/csv',
            ])->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to export transactions: ' . $e->getMessage());
        }
    }

    public function exportWebhookLogs(Request $request)
    {
        $user = Auth::user();

        $logs = $user->webhookLogs()
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->filled('event'), function ($query) use ($request) {
                $query->where('event', 'like', '%' . $request->event . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $filename = 'webhook-logs_' . now()->format('YmdHis') . '.csv';
        $filepath = storage_path('app/exports/' . $filename);

        if (!file_exists(storage_path('app/exports'))) {
            mkdir(storage_path('app/exports'), 0755, true);
        }

        $file = fopen($filepath, 'w');

        fputcsv($file, [
            'ID',
            'Transaction ID',
            'Event',
            'Status',
            'Attempts',
            'Response Code',
            'Response Body',
            'Error Message',
            'Sent At',
            'Created At',
        ]);

        foreach ($logs as $log) {
            fputcsv($file, [
                $log->id,
                $log->transaction?->transaction_id,
                $log->event,
                $log->status,
                $log->attempt_count,
                $log->response_code,
                $log->response_body,
                $log->error_message,
                optional($log->sent_at)?->format('Y-m-d H:i:s'),
                $log->created_at?->format('Y-m-d H:i:s'),
            ]);
        }

        fclose($file);

        return Response::download($filepath, basename($filepath), [
            'Content-Type' => 'text/csv',
        ])->deleteFileAfterSend(true);
    }
}
