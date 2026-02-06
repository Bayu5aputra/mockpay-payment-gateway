<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RefundController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Create refund request
     * POST /api/v1/refund
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required|string',
            'reason' => 'nullable|string|max:500',
            'refund_amount' => 'nullable|numeric|min:0.01',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $client = $request->user();
            $transaction = $this->transactionService->getByTransactionIdForUser($request->transaction_id, $client->id);

            if (!$transaction) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaction not found'
                ], 404);
            }

            $action = $request->refund_amount ? 'partial_refund' : 'refund';
            $this->transactionService->manualOverride(
                $transaction,
                $client,
                $action,
                $request->reason ?? 'Refund requested by merchant',
                $request->refund_amount
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Refund processed successfully',
                'data' => [
                    'transaction_id' => $transaction->transaction_id,
                    'order_id' => $transaction->order_id,
                    'amount' => $transaction->amount,
                    'status' => $transaction->fresh()->status,
                    'refunded_at' => $transaction->fresh()->refunded_at?->toIso8601String(),
                    'refund_amount' => $transaction->fresh()->refund_amount,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to process refund: ' . $e->getMessage()
            ], 500);
        }
    }
}
