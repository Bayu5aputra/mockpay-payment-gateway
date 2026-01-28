<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class SettlementController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Get settlement list
     * GET /api/v1/settlements
     */
    public function index(Request $request)
    {
        try {
            $merchant = $request->user();

            $filters = [
                'status' => 'settlement',
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'search' => $request->search,
                'order_by' => $request->order_by ?? 'settled_at',
                'order_direction' => $request->order_direction ?? 'desc',
            ];

            $perPage = $request->per_page ?? 15;
            $settlements = $this->transactionService->getTransactionsByMerchant(
                $merchant->id,
                $filters,
                $perPage
            );

            $data = $settlements->map(function ($transaction) {
                return [
                    'transaction_id' => $transaction->transaction_id,
                    'order_id' => $transaction->order_id,
                    'amount' => $transaction->amount,
                    'fee' => $transaction->fee,
                    'total_amount' => $transaction->total_amount,
                    'payment_method' => $transaction->payment_method,
                    'payment_channel' => $transaction->payment_channel,
                    'settled_at' => $transaction->settled_at ? $transaction->settled_at->toIso8601String() : null,
                ];
            });

            return response()->json([
                'status' => 'success',
                'data' => $data,
                'pagination' => [
                    'total' => $settlements->total(),
                    'per_page' => $settlements->perPage(),
                    'current_page' => $settlements->currentPage(),
                    'last_page' => $settlements->lastPage(),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get settlements: ' . $e->getMessage()
            ], 500);
        }
    }
}
