<?php

declare(strict_types=1);

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\RetailPayment;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RetailController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Display retail payment page
     * GET /payment/retail/{transaction_id}
     */
    public function show($transactionId)
    {
        $transaction = $this->transactionService->getByTransactionId($transactionId);

        if (!$transaction) {
            abort(404, 'Transaction not found');
        }

        if ($transaction->payment_method !== 'retail') {
            abort(400, 'Invalid payment method');
        }

        $retail = $transaction->retail;

        return view('payment.retail.show', compact('transaction', 'retail'));
    }

    /**
     * Generate barcode image
     * GET /payment/retail/{transaction_id}/barcode
     */
    public function barcode($transactionId)
    {
        $transaction = $this->transactionService->getByTransactionId($transactionId);

        if (!$transaction) {
            abort(404, 'Transaction not found');
        }

        $retail = $transaction->retail;

        if (!$retail || !$retail->payment_code) {
            abort(400, 'Retail payment code not available');
        }

        // Generate barcode using Picqer library
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($retail->payment_code, $generator::TYPE_CODE_128, 3, 80);

        return response($barcode)->header('Content-Type', 'image/png');
    }

    /**
     * Display retail simulation page
     * GET /payment/simulate/retail
     */
    public function simulatePage()
    {
        return view('payment.simulate.retail');
    }

    /**
     * Check payment code
     * GET /payment/simulate/retail/check/{payment_code}
     */
    public function checkPaymentCode($paymentCode)
    {
        try {
            $retail = RetailPayment::where('payment_code', $paymentCode)->first();

            if (!$retail) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Payment code not found'
                ], 404);
            }

            $transaction = $retail->transaction;

            return response()->json([
                'status' => 'success',
                'data' => [
                    'payment_code' => $retail->payment_code,
                    'store_type' => $retail->store_type,
                    'transaction_id' => $transaction->transaction_id,
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
                'message' => 'Failed to check payment code: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Process retail payment (simulation)
     * POST /payment/simulate/retail/pay
     */
    public function pay(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_code' => 'required|string',
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
            $retail = RetailPayment::where('payment_code', $request->payment_code)->first();

            if (!$retail) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Payment code not found'
                ], 404);
            }

            $transaction = $retail->transaction;

            // Check if transaction is still pending
            if ($transaction->status !== 'pending') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaction is not in pending status'
                ], 400);
            }

            // Check if transaction is expired
            if ($transaction->isExpired()) {
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

            // Record guest payment attempt only
            $this->transactionService->recordPaymentAttempt(
                $transaction,
                $transaction->user_id,
                'guest_retail',
                [
                    'payment_code' => $request->payment_code,
                    'amount' => $request->amount,
                ]
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Payment attempt recorded. Awaiting tenant manual override.',
                'data' => [
                    'transaction_id' => $transaction->transaction_id,
                    'order_id' => $transaction->order_id,
                    'amount' => $transaction->amount,
                    'status' => $transaction->fresh()->status,
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
     * Check retail transaction by transaction ID
     * GET /payment/simulate/retail/check-transaction/{transaction_id}
     */
    public function checkTransaction($transactionId)
    {
        try {
            $transaction = $this->transactionService->getByTransactionId($transactionId);

            if (!$transaction) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaction not found'
                ], 404);
            }

            if ($transaction->payment_method !== 'retail') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Not a retail transaction'
                ], 400);
            }

            $retail = $transaction->retail;

            return response()->json([
                'status' => 'success',
                'data' => [
                    'transaction_id' => $transaction->transaction_id,
                    'payment_code' => $retail->payment_code,
                    'store_type' => $retail->store_type,
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
                'message' => 'Failed to get transaction: ' . $e->getMessage()
            ], 500);
        }
    }
}
