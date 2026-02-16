<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class MetaController extends Controller
{
    public function health(): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'service' => 'MockPay API',
            'version' => '1.0.0',
            'timestamp' => now()->toIso8601String(),
        ]);
    }

    public function docs(): JsonResponse
    {
        return response()->json([
            'message' => 'MockPay API Documentation',
            'documentation_url' => url('/docs/api-reference'),
            'version' => 'v1',
            'endpoints' => [
                'POST /api/v1/payment/create' => 'Create new payment transaction',
                'GET /api/v1/payment/channels' => 'Get available payment channels',
                'GET /api/v1/transaction/{id}' => 'Get transaction details',
                'GET /api/v1/transactions' => 'Get transaction list',
                'POST /api/v1/transaction/{id}/cancel' => 'Cancel transaction',
                'POST /api/v1/refund' => 'Create refund request',
                'GET /api/v1/settlements' => 'Get settlement list',
                'GET /api/v1/webhook/logs/{transaction_id}' => 'Get webhook logs',
            ],
        ]);
    }
}
