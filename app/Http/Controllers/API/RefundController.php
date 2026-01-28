<?php

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
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $merchant = $request->user();
            $transaction = $this->transactionService->getByTransactionId($request->transaction_id);

            if (!$transaction) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaction not found'
                ], 404);
            }

            if ($transaction->merchant_id !== $merchant->id) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized access'
                ], 403);
            }

            if (!$transaction->canBeRefunded()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaction cannot be refunded. Only settled transactions can be refunded.'
                ], 400);
            }

            $this->transactionService->refundTransaction(
                $transaction,
                $request->reason ?? 'Refund requested by merchant'
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Refund processed successfully',
                'data' => [
                    'transaction_id' => $transaction->transaction_id,
                    'order_id' => $transaction->order_id,
                    'amount' => $transaction->amount,
                    'status' => $transaction->fresh()->status,
                    'refunded_at' => $transaction->fresh()->refunded_at->toIso8601String(),
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
