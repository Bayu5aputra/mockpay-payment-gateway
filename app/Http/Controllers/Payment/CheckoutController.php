<?php

declare(strict_types=1);

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Display payment page
     * GET /payment/{transaction_id}
     */
    public function show($transactionId)
    {
        $transaction = $this->transactionService->getByTransactionId($transactionId);

        if (!$transaction) {
            abort(404, 'Transaction not found');
        }

        if ($transaction->isExpired()) {
            return view('payment.expired', compact('transaction'));
        }

        if ($transaction->isPaid()) {
            return view('payment.success', compact('transaction'));
        }

        if (in_array($transaction->status, ['failed', 'refunded', 'partial_refund'], true)) {
            return view('payment.failed', compact('transaction'));
        }

        if ($transaction->status === 'cancelled') {
            return view('payment.cancelled', compact('transaction'));
        }

        // Get payment detail
        $paymentDetail = $transaction->getPaymentDetail();

        return view('payment.checkout', compact('transaction', 'paymentDetail'));
    }

    /**
     * Display success page
     * GET /payment/{transaction_id}/success
     */
    public function success($transactionId)
    {
        $transaction = $this->transactionService->getByTransactionId($transactionId);

        if (!$transaction) {
            abort(404, 'Transaction not found');
        }

        return view('payment.success', compact('transaction'));
    }

    /**
     * Display failed page
     * GET /payment/{transaction_id}/failed
     */
    public function failed($transactionId)
    {
        $transaction = $this->transactionService->getByTransactionId($transactionId);

        if (!$transaction) {
            abort(404, 'Transaction not found');
        }

        return view('payment.failed', compact('transaction'));
    }

    /**
     * Check payment status (AJAX)
     * GET /payment/{transaction_id}/status
     */
    public function checkStatus($transactionId)
    {
        $transaction = $this->transactionService->getByTransactionId($transactionId);

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
                'transaction_status' => $transaction->status,
                'is_paid' => $transaction->isPaid(),
                'is_expired' => $transaction->isExpired(),
                'expired_at' => $transaction->expired_at ? $transaction->expired_at->toIso8601String() : null,
                'paid_at' => $transaction->paid_at ? $transaction->paid_at->toIso8601String() : null,
            ]
        ]);
    }

    /**
     * Get payment instructions (AJAX)
     * GET /payment/{transaction_id}/instructions
     */
    public function instructions($transactionId)
    {
        $transaction = $this->transactionService->getByTransactionId($transactionId);

        if (!$transaction) {
            return response()->json([
                'status' => 'error',
                'message' => 'Transaction not found'
            ], 404);
        }

        $paymentDetail = $transaction->getPaymentDetail();

        if (!$paymentDetail) {
            return response()->json([
                'status' => 'error',
                'message' => 'Payment detail not found'
            ], 404);
        }

        $instructions = null;

        switch ($transaction->payment_method) {
            case 'bank_transfer':
                $instructions = [
                    'type' => 'virtual_account',
                    'bank_code' => $paymentDetail->bank_code,
                    'va_number' => $paymentDetail->va_number,
                    'instructions' => $paymentDetail->instructions,
                ];
                break;

            case 'ewallet':
                $instructions = [
                    'type' => 'ewallet',
                    'provider' => $paymentDetail->provider,
                    'deeplink_url' => $paymentDetail->deeplink_url,
                    'qr_string' => $paymentDetail->qr_string,
                ];
                break;

            case 'credit_card':
                $instructions = [
                    'type' => 'credit_card',
                    'redirect_url' => $paymentDetail->redirect_url,
                ];
                break;

            case 'qris':
                $instructions = [
                    'type' => 'qris',
                    'qr_string' => $paymentDetail->qr_string,
                    'qr_url' => $paymentDetail->qr_url,
                ];
                break;

            case 'retail':
                $instructions = [
                    'type' => 'retail',
                    'store_type' => $paymentDetail->store_type,
                    'payment_code' => $paymentDetail->payment_code,
                    'barcode_url' => $paymentDetail->barcode_url,
                ];
                break;
        }

        return response()->json([
            'status' => 'success',
            'data' => $instructions
        ]);
    }
}
