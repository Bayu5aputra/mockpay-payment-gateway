<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Get webhook logs for a transaction
     * GET /api/v1/webhook/logs/{transaction_id}
     */
    public function logs(Request $request, $transactionId)
    {
        try {
            $client = $request->user();
            $transaction = $this->transactionService->getByTransactionIdForUser($transactionId, $client->id);

            if (!$transaction) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaction not found'
                ], 404);
            }

            $logs = $transaction->webhookLogs()
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($log) {
                    return [
                        'id' => $log->id,
                        'event' => $log->event,
                        'url' => $log->webhook_url,
                        'payload' => $log->payload,
                        'response_code' => $log->response_code,
                        'response_body' => $log->response_body,
                        'error_message' => $log->error_message,
                        'attempt' => $log->attempt_count,
                        'status' => $log->status,
                        'created_at' => $log->created_at->toIso8601String(),
                    ];
                });

            return response()->json([
                'status' => 'success',
                'data' => $logs
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get webhook logs: ' . $e->getMessage()
            ], 500);
        }
    }
}
