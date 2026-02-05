<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Get transaction by ID
     * GET /api/v1/transaction/{transaction_id}
     */
    public function show(Request $request, $transactionId)
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

            return response()->json([
                'status' => 'success',
                'data' => [
                    'transaction_id' => $transaction->transaction_id,
                    'order_id' => $transaction->order_id,
                    'amount' => $transaction->amount,
                    'fee' => $transaction->fee,
                    'total_amount' => $transaction->total_amount,
                    'currency' => $transaction->currency,
                    'status' => $transaction->status,
                    'payment_method' => $transaction->payment_method,
                    'payment_channel' => $transaction->payment_channel,
                    'customer' => [
                        'name' => $transaction->customer_name,
                        'email' => $transaction->customer_email,
                        'phone' => $transaction->customer_phone,
                    ],
                    'description' => $transaction->description,
                    'payment_url' => url('/payment/' . $transaction->transaction_id),
                    'expired_at' => $transaction->expired_at ? $transaction->expired_at->toIso8601String() : null,
                    'paid_at' => $transaction->paid_at ? $transaction->paid_at->toIso8601String() : null,
                    'settled_at' => $transaction->settled_at ? $transaction->settled_at->toIso8601String() : null,
                    'cancelled_at' => $transaction->cancelled_at ? $transaction->cancelled_at->toIso8601String() : null,
                    'created_at' => $transaction->created_at->toIso8601String(),
                    'updated_at' => $transaction->updated_at->toIso8601String(),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get transaction: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get transaction list
     * GET /api/v1/transactions
     */
    public function index(Request $request)
    {
        try {
            $client = $request->user();

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
            $transactions = $this->transactionService->getTransactionsByUser(
                $client->id,
                $filters,
                $perPage
            );

            return response()->json([
                'status' => 'success',
                'data' => $transactions->items(),
                'pagination' => [
                    'total' => $transactions->total(),
                    'per_page' => $transactions->perPage(),
                    'current_page' => $transactions->currentPage(),
                    'last_page' => $transactions->lastPage(),
                    'from' => $transactions->firstItem(),
                    'to' => $transactions->lastItem(),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get transactions: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cancel transaction
     * POST /api/v1/transaction/{transaction_id}/cancel
     */
    public function cancel(Request $request, $transactionId)
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

            if (!$transaction->canBeCancelled()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaction cannot be cancelled'
                ], 400);
            }

            $this->transactionService->cancelTransaction(
                $transaction,
                $request->reason ?? 'Cancelled by client'
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Transaction cancelled successfully',
                'data' => [
                    'transaction_id' => $transaction->transaction_id,
                    'status' => $transaction->fresh()->status,
                    'cancelled_at' => $transaction->fresh()->cancelled_at->toIso8601String(),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to cancel transaction: ' . $e->getMessage()
            ], 500);
        }
    }
}
