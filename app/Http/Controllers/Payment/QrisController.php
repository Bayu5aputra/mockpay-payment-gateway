<?php

declare(strict_types=1);

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\QrisPayment;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class QrisController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Display QRIS payment page
     * GET /payment/qris/{transaction_id}
     */
    public function show($transactionId)
    {
        $transaction = $this->transactionService->getByTransactionId($transactionId);

        if (!$transaction) {
            abort(404, 'Transaction not found');
        }

        if ($transaction->payment_method !== 'qris') {
            abort(400, 'Invalid payment method');
        }

        $qris = $transaction->qris;

        return view('payment.qris.show', compact('transaction', 'qris'));
    }

    /**
     * Generate QRIS QR code image
     * GET /payment/qris/{transaction_id}/qr
     */
    public function qrCode($transactionId)
    {
        $transaction = $this->transactionService->getByTransactionId($transactionId);

        if (!$transaction) {
            abort(404, 'Transaction not found');
        }

        $qris = $transaction->qris;

        if (!$qris || !$qris->qr_string) {
            abort(400, 'QRIS QR code not available');
        }

        // Generate QR code image
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')
            ->size(400)
            ->margin(2)
            ->generate($qris->qr_string);

        return response($qrCode)->header('Content-Type', 'image/png');
    }

    /**
     * Display QRIS simulation page
     * GET /payment/simulate/qris
     */
    public function simulatePage()
    {
        return view('payment.simulate.qris');
    }

    /**
     * Scan QRIS code (simulation)
     * POST /payment/simulate/qris/scan
     */
    public function scan(Request $request)
    {
        $request->validate([
            'qr_string' => 'required|string',
        ]);

        try {
            // Find QRIS by QR string
            $qris = QrisPayment::where('qr_string', $request->qr_string)->first();

            if (!$qris) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid QRIS code'
                ], 404);
            }

            $transaction = $qris->transaction;

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

            $this->transactionService->recordPaymentAttempt(
                $transaction,
                $transaction->user_id,
                'guest_qris_scan',
                [
                    'qr_string' => $request->qr_string,
                ]
            );

            return response()->json([
                'status' => 'success',
                'data' => [
                    'transaction_id' => $transaction->transaction_id,
                    'merchant_name' => $transaction->merchant->company_name ?? 'MockPay Demo',
                    'amount' => $transaction->total_amount,
                    'description' => $transaction->description,
                    'expired_at' => $transaction->expired_at ? $transaction->expired_at->toIso8601String() : null,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to scan QRIS: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Process QRIS payment (simulation)
     * POST /payment/simulate/qris/pay
     */
    public function pay(Request $request)
    {
        $request->validate([
            'qr_string' => 'required|string',
            'action' => 'required|in:approve,reject',
        ]);

        try {
            // Find QRIS by QR string
            $qris = QrisPayment::where('qr_string', $request->qr_string)->first();

            if (!$qris) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid QRIS code'
                ], 404);
            }

            $transaction = $qris->transaction;

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

            $this->transactionService->recordPaymentAttempt(
                $transaction,
                $transaction->user_id,
                'guest_qris_pay',
                [
                    'action' => $request->action,
                    'qr_string' => $request->qr_string,
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
     * Check QRIS transaction by transaction ID
     * GET /payment/simulate/qris/check/{transaction_id}
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

            if ($transaction->payment_method !== 'qris') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Not a QRIS transaction'
                ], 400);
            }

            $qris = $transaction->qris;

            return response()->json([
                'status' => 'success',
                'data' => [
                    'transaction_id' => $transaction->transaction_id,
                    'qr_string' => $qris->qr_string,
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
