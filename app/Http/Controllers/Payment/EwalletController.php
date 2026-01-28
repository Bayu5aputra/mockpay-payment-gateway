<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use App\Models\Ewallet;
use Illuminate\Http\Request;

class EwalletController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Display e-wallet payment page
     * GET /payment/ewallet/{transaction_id}
     */
    public function show($transactionId)
    {
        $transaction = $this->transactionService->getByTransactionId($transactionId);

        if (!$transaction) {
            abort(404, 'Transaction not found');
        }

        if ($transaction->payment_method !== 'ewallet') {
            abort(400, 'Invalid payment method');
        }

        $ewallet = $transaction->ewallet;

        return view('payment.ewallet.show', compact('transaction', 'ewallet'));
    }

    /**
     * Redirect to e-wallet app (deeplink)
     * GET /payment/ewallet/{transaction_id}/redirect
     */
    public function redirect($transactionId)
    {
        $transaction = $this->transactionService->getByTransactionId($transactionId);

        if (!$transaction) {
            abort(404, 'Transaction not found');
        }

        $ewallet = $transaction->ewallet;

        if (!$ewallet || !$ewallet->deeplink_url) {
            abort(400, 'E-wallet deeplink not available');
        }

        return redirect($ewallet->deeplink_url);
    }

    /**
     * Display QR code for scanning
     * GET /payment/ewallet/{transaction_id}/qr
     */
    public function qrCode($transactionId)
    {
        $transaction = $this->transactionService->getByTransactionId($transactionId);

        if (!$transaction) {
            abort(404, 'Transaction not found');
        }

        $ewallet = $transaction->ewallet;

        if (!$ewallet || !$ewallet->qr_string) {
            abort(400, 'E-wallet QR code not available');
        }

        // Generate QR code image
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')
            ->size(300)
            ->generate($ewallet->qr_string);

        return response($qrCode)->header('Content-Type', 'image/png');
    }

    /**
     * Simulate e-wallet payment
     * POST /payment/ewallet/{transaction_id}/simulate
     */
    public function simulate(Request $request, $transactionId)
    {
        try {
            $transaction = $this->transactionService->getByTransactionId($transactionId);

            if (!$transaction) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaction not found'
                ], 404);
            }

            // Check if transaction is still pending
            if ($transaction->status !== 'pending') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaction is not in pending status'
                ], 400);
            }

            // Check if transaction is expired
            if ($transaction->isExpired()) {
                $this->transactionService->cancelTransaction($transaction, 'Transaction expired');

                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaction has expired'
                ], 400);
            }

            // Simulate payment action
            $action = $request->action ?? 'approve'; // approve or reject

            if ($action === 'approve') {
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
            } else {
                // Reject payment
                $this->transactionService->cancelTransaction($transaction, 'Payment rejected by user');

                return response()->json([
                    'status' => 'error',
                    'message' => 'Payment rejected',
                    'data' => [
                        'transaction_id' => $transaction->transaction_id,
                        'status' => $transaction->fresh()->status,
                    ]
                ], 400);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to process payment: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display e-wallet simulation page
     * GET /payment/simulate/ewallet
     */
    public function simulatePage()
    {
        return view('payment.simulate.ewallet');
    }

    /**
     * Check e-wallet payment by transaction ID
     * GET /payment/simulate/ewallet/check/{transaction_id}
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

            if ($transaction->payment_method !== 'ewallet') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Not an e-wallet transaction'
                ], 400);
            }

            $ewallet = $transaction->ewallet;

            return response()->json([
                'status' => 'success',
                'data' => [
                    'transaction_id' => $transaction->transaction_id,
                    'provider' => $ewallet->provider,
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
