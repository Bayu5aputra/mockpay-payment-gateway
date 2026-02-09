<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PaymentChannel;
use App\Services\PaymentService;
use App\Services\TransactionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    protected $paymentService;
    protected $transactionService;

    public function __construct(
        PaymentService $paymentService,
        TransactionService $transactionService
    ) {
        $this->paymentService = $paymentService;
        $this->transactionService = $transactionService;
    }

    /**
     * Create new payment transaction
     * POST /api/v1/payment/create
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1000',
            'currency' => 'nullable|string|in:IDR',
            'payment_method' => 'required|in:bank_transfer,ewallet,credit_card,qris,retail',
            'payment_channel' => 'required|string',
            'customer.name' => 'required|string|max:255',
            'customer.email' => 'required|email|max:255',
            'customer.phone' => 'nullable|string|max:20',
            'items' => 'nullable|array',
            'items.*.name' => 'required_with:items|string',
            'items.*.quantity' => 'required_with:items|integer|min:1',
            'items.*.price' => 'required_with:items|numeric|min:0',
            'description' => 'nullable|string|max:500',
            'callback_url' => 'nullable|url',
            'metadata' => 'nullable|array',
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

            $dailyLimit = $client->dailyTransactionLimit();
            if ($dailyLimit !== null) {
                $todayCount = $this->transactionService->getUserDailyTransactionCount(
                    $client->id,
                    Carbon::now()
                );

                if ($todayCount >= $dailyLimit) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Daily transaction limit reached for Free plan',
                        'limit' => $dailyLimit,
                        'current' => $todayCount,
                    ], 429);
                }
            }

            // Check if order_id already exists for this merchant
            $existingTransaction = $this->transactionService->getByOrderId(
                $request->order_id,
                $client->id
            );

            if ($existingTransaction) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Order ID already exists',
                    'transaction_id' => $existingTransaction->transaction_id,
                ], 409);
            }

            $paymentData = [
                'merchant_id' => null,
                'user_id' => $client->id,
                'order_id' => $request->order_id,
                'amount' => $request->amount,
                'currency' => $request->currency ?? 'IDR',
                'payment_method' => $request->payment_method,
                'payment_channel' => $request->payment_channel,
                'customer_name' => $request->input('customer.name'),
                'customer_email' => $request->input('customer.email'),
                'customer_phone' => $request->input('customer.phone'),
                'description' => $request->description,
                'callback_url' => $request->callback_url ?? $client->webhook_url,
                'metadata' => $request->metadata,
            ];

            $transaction = $this->paymentService->createPayment($paymentData);

            return response()->json([
                'status' => 'success',
                'message' => 'Payment created successfully',
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
                    'payment_url' => url('/payment/' . $transaction->transaction_id),
                    'payment_detail' => $this->formatPaymentDetail($transaction),
                    'expired_at' => $transaction->expired_at->toIso8601String(),
                    'created_at' => $transaction->created_at->toIso8601String(),
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create payment: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get payment channels
     * GET /api/v1/payment/channels
     */
    public function channels(Request $request)
    {
        try {
            $channels = PaymentChannel::query()
                ->orderBy('display_order')
                ->orderBy('name')
                ->get()
                ->groupBy(function (PaymentChannel $channel): string {
                    return match ($channel->type) {
                        'card' => 'credit_card',
                        default => $channel->type,
                    };
                })
                ->map(function ($group) {
                    return $group->mapWithKeys(function (PaymentChannel $channel): array {
                        return [
                            $channel->code => [
                                'name' => $channel->name,
                                'code' => $channel->code,
                                'fee_percentage' => (float) $channel->fee_merchant_percentage,
                                'fee_fixed' => (float) $channel->fee_merchant_fixed,
                                'min_amount' => (float) $channel->min_amount,
                                'max_amount' => (float) $channel->max_amount,
                                'status' => $channel->is_active ? 'active' : 'inactive',
                            ],
                        ];
                    });
                });

            return response()->json([
                'status' => 'success',
                'data' => $channels
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get payment channels: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Format payment detail based on payment method
     */
    private function formatPaymentDetail($transaction)
    {
        $detail = $transaction->getPaymentDetail();

        if (!$detail) {
            return null;
        }

        switch ($transaction->payment_method) {
            case 'bank_transfer':
                return [
                    'type' => 'virtual_account',
                    'bank_code' => $detail->bank_code,
                    'va_number' => $detail->va_number,
                    'instructions' => $detail->instructions,
                ];

            case 'ewallet':
                return [
                    'type' => 'ewallet',
                    'provider' => $detail->provider,
                    'deeplink_url' => $detail->deeplink_url,
                    'qr_string' => $detail->qr_string,
                ];

            case 'credit_card':
                return [
                    'type' => 'credit_card',
                    'redirect_url' => $detail->redirect_url,
                    'token' => $detail->token,
                ];

            case 'qris':
                return [
                    'type' => 'qris',
                    'qr_string' => $detail->qr_string,
                    'qr_url' => $detail->qr_url,
                ];

            case 'retail':
                return [
                    'type' => 'retail',
                    'store_type' => $detail->store_type,
                    'payment_code' => $detail->payment_code,
                    'barcode_url' => $detail->barcode_url,
                ];

            default:
                return null;
        }
    }
}
