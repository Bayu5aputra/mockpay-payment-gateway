<?php

use App\Http\Controllers\API\MetaController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\RefundController;
use App\Http\Controllers\API\SettlementController;
use App\Http\Controllers\API\TransactionController;
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

Route::get('/health', [MetaController::class, 'health'])->name('api.health');

// ==========================================
// API DOCUMENTATION ENDPOINT (No Auth Required)
// ==========================================

Route::get('/docs', [MetaController::class, 'docs'])->name('api.docs');
