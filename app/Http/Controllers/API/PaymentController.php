<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use App\Services\TransactionService;
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
            $merchant = $request->user();

            // Check if order_id already exists for this merchant
            $existingTransaction = $this->transactionService->getByOrderId(
                $request->order_id,
                $merchant->id
            );

            if ($existingTransaction) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Order ID already exists',
                    'transaction_id' => $existingTransaction->transaction_id,
                ], 409);
            }

            $paymentData = [
                'merchant_id' => $merchant->id,
                'order_id' => $request->order_id,
                'amount' => $request->amount,
                'currency' => $request->currency ?? 'IDR',
                'payment_method' => $request->payment_method,
                'payment_channel' => $request->payment_channel,
                'customer_name' => $request->input('customer.name'),
                'customer_email' => $request->input('customer.email'),
                'customer_phone' => $request->input('customer.phone'),
                'description' => $request->description,
                'callback_url' => $request->callback_url ?? $merchant->webhook_url,
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
            $channels = [
                'bank_transfer' => [
                    'bca_va' => [
                        'name' => 'BCA Virtual Account',
                        'code' => 'bca_va',
                        'fee_percentage' => 1.5,
                        'fee_fixed' => 0,
                        'min_amount' => 10000,
                        'max_amount' => 50000000,
                        'status' => 'active',
                    ],
                    'mandiri_va' => [
                        'name' => 'Mandiri Virtual Account',
                        'code' => 'mandiri_va',
                        'fee_percentage' => 1.5,
                        'fee_fixed' => 0,
                        'min_amount' => 10000,
                        'max_amount' => 50000000,
                        'status' => 'active',
                    ],
                    'bni_va' => [
                        'name' => 'BNI Virtual Account',
                        'code' => 'bni_va',
                        'fee_percentage' => 1.5,
                        'fee_fixed' => 0,
                        'min_amount' => 10000,
                        'max_amount' => 50000000,
                        'status' => 'active',
                    ],
                    'bri_va' => [
                        'name' => 'BRI Virtual Account',
                        'code' => 'bri_va',
                        'fee_percentage' => 1.5,
                        'fee_fixed' => 0,
                        'min_amount' => 10000,
                        'max_amount' => 50000000,
                        'status' => 'active',
                    ],
                    'permata_va' => [
                        'name' => 'Permata Virtual Account',
                        'code' => 'permata_va',
                        'fee_percentage' => 1.5,
                        'fee_fixed' => 0,
                        'min_amount' => 10000,
                        'max_amount' => 50000000,
                        'status' => 'active',
                    ],
                ],
                'ewallet' => [
                    'gopay' => [
                        'name' => 'GoPay',
                        'code' => 'gopay',
                        'fee_percentage' => 2.0,
                        'fee_fixed' => 0,
                        'min_amount' => 1000,
                        'max_amount' => 10000000,
                        'status' => 'active',
                    ],
                    'ovo' => [
                        'name' => 'OVO',
                        'code' => 'ovo',
                        'fee_percentage' => 2.0,
                        'fee_fixed' => 0,
                        'min_amount' => 10000,
                        'max_amount' => 10000000,
                        'status' => 'active',
                    ],
                    'dana' => [
                        'name' => 'DANA',
                        'code' => 'dana',
                        'fee_percentage' => 2.0,
                        'fee_fixed' => 0,
                        'min_amount' => 1000,
                        'max_amount' => 10000000,
                        'status' => 'active',
                    ],
                    'shopeepay' => [
                        'name' => 'ShopeePay',
                        'code' => 'shopeepay',
                        'fee_percentage' => 2.0,
                        'fee_fixed' => 0,
                        'min_amount' => 1000,
                        'max_amount' => 10000000,
                        'status' => 'active',
                    ],
                    'linkaja' => [
                        'name' => 'LinkAja',
                        'code' => 'linkaja',
                        'fee_percentage' => 2.0,
                        'fee_fixed' => 0,
                        'min_amount' => 1000,
                        'max_amount' => 10000000,
                        'status' => 'active',
                    ],
                ],
                'credit_card' => [
                    'credit_card' => [
                        'name' => 'Credit Card',
                        'code' => 'credit_card',
                        'fee_percentage' => 2.9,
                        'fee_fixed' => 2000,
                        'min_amount' => 10000,
                        'max_amount' => 100000000,
                        'status' => 'active',
                    ],
                ],
                'qris' => [
                    'qris' => [
                        'name' => 'QRIS',
                        'code' => 'qris',
                        'fee_percentage' => 0.7,
                        'fee_fixed' => 0,
                        'min_amount' => 1000,
                        'max_amount' => 10000000,
                        'status' => 'active',
                    ],
                ],
                'retail' => [
                    'alfamart' => [
                        'name' => 'Alfamart',
                        'code' => 'alfamart',
                        'fee_percentage' => 0,
                        'fee_fixed' => 2500,
                        'min_amount' => 10000,
                        'max_amount' => 5000000,
                        'status' => 'active',
                    ],
                    'indomaret' => [
                        'name' => 'Indomaret',
                        'code' => 'indomaret',
                        'fee_percentage' => 0,
                        'fee_fixed' => 2500,
                        'min_amount' => 10000,
                        'max_amount' => 5000000,
                        'status' => 'active',
                    ],
                ],
            ];

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
