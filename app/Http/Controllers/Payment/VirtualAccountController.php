<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use App\Models\VirtualAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VirtualAccountController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Display VA simulation page
     * GET /payment/simulate/va
     */
    public function simulatePage()
    {
        return view('payment.simulate.virtual-account');
    }

    /**
     * Process VA payment simulation
     * POST /payment/simulate/va/pay
     */
    public function simulatePay(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'va_number' => 'required|string|size:15',
            'amount' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Find virtual account
            $virtualAccount = VirtualAccount::where('va_number', $request->va_number)->first();

            if (!$virtualAccount) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Virtual Account number not found'
                ], 404);
            }

            $transaction = $virtualAccount->transaction;

            // Check if transaction is still pending
            if ($transaction->status !== 'pending') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaction is not in pending status'
                ], 400);
            }

            // Check if transaction is expired
            if ($transaction->isExpired()) {
                // Update to expired
                $this->transactionService->cancelTransaction($transaction, 'Transaction expired');

                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaction has expired'
                ], 400);
            }

            // Validate amount
            if ($request->amount != $transaction->total_amount) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Payment amount does not match. Expected: Rp ' . number_format($transaction->total_amount, 0, ',', '.')
                ], 400);
            }

            // Process payment - update to settlement
            $this->transactionService->settleTransaction($transaction);

            return response()->json([
                'status' => 'success',
                'message' => 'Payment successful',
                'data' => [
                    'transaction_id' => $transaction->transaction_id,
                    'order_id' => $transaction->order_id,
                    'amount' => $transaction->amount,
                    'status' => $transaction->fresh()->status,
                    'paid_at' => $transaction->fresh()->paid_at->toIso8601String(),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to process payment: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get VA details for simulation
     * GET /payment/simulate/va/check/{va_number}
     */
    public function checkVA($vaNumber)
    {
        try {
            $virtualAccount = VirtualAccount::where('va_number', $vaNumber)->first();

            if (!$virtualAccount) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Virtual Account number not found'
                ], 404);
            }

            $transaction = $virtualAccount->transaction;

            return response()->json([
                'status' => 'success',
                'data' => [
                    'va_number' => $virtualAccount->va_number,
                    'bank_code' => $virtualAccount->bank_code,
                    'amount' => $transaction->total_amount,
                    'customer_name' => $transaction->customer_name,
                    'description' => $transaction->description,
                    'expired_at' => $transaction->expired_at ? $transaction->expired_at->toIso8601String() : null,
                    'status' => $transaction->status,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get VA details: ' . $e->getMessage()
            ], 500);
        }
    }
}
