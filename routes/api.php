<?php

use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\RefundController;
use App\Http\Controllers\API\SettlementController;
use App\Http\Controllers\API\WebhookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| MockPay API Routes - Payment Gateway Simulation
| All routes require API key authentication via Bearer token
|
*/

// ==========================================
// API V1 ROUTES
// ==========================================

Route::prefix('v1')->middleware(['api.key', 'log.api'])->group(function () {
    
    // ==========================================
    // PAYMENT ENDPOINTS
    // ==========================================
    
    // Create Payment Transaction
    Route::post('/payment/create', [PaymentController::class, 'create'])
        ->name('api.payment.create');
    
    // Get Available Payment Channels
    Route::get('/payment/channels', [PaymentController::class, 'channels'])
        ->name('api.payment.channels');

    // ==========================================
    // TRANSACTION ENDPOINTS
    // ==========================================
    
    // Get Transaction by ID
    Route::get('/transaction/{transaction_id}', [TransactionController::class, 'show'])
        ->name('api.transaction.show');
    
    // Get Transaction List (with filters)
    Route::get('/transactions', [TransactionController::class, 'index'])
        ->name('api.transactions.index');
    
    // Cancel Transaction
    Route::post('/transaction/{transaction_id}/cancel', [TransactionController::class, 'cancel'])
        ->name('api.transaction.cancel');

    // ==========================================
    // REFUND ENDPOINTS
    // ==========================================
    
    // Create Refund Request
    Route::post('/refund', [RefundController::class, 'create'])
        ->name('api.refund.create');

    // ==========================================
    // SETTLEMENT ENDPOINTS
    // ==========================================
    
    // Get Settlement List
    Route::get('/settlements', [SettlementController::class, 'index'])
        ->name('api.settlements.index');

    // ==========================================
    // WEBHOOK ENDPOINTS
    // ==========================================
    
    // Get Webhook Logs for Transaction
    Route::get('/webhook/logs/{transaction_id}', [WebhookController::class, 'logs'])
        ->name('api.webhook.logs');
});

// ==========================================
// HEALTH CHECK (No Auth Required)
// ==========================================

Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'service' => 'MockPay API',
        'version' => '1.0.0',
        'timestamp' => now()->toIso8601String(),
    ]);
})->name('api.health');

// ==========================================
// API DOCUMENTATION ENDPOINT (No Auth Required)
// ==========================================

Route::get('/docs', function () {
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
})->name('api.docs');