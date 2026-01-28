<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\DocumentationController;
use App\Http\Controllers\Public\PricingController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\TransactionController;
use App\Http\Controllers\Dashboard\SettlementController;
use App\Http\Controllers\Dashboard\ApiKeyController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\MerchantController;
use App\Http\Controllers\Payment\CheckoutController;
use App\Http\Controllers\Payment\VirtualAccountController;
use App\Http\Controllers\Payment\EwalletController;
use App\Http\Controllers\Payment\QrisController;
use App\Http\Controllers\Payment\CreditCardController;
use App\Http\Controllers\Payment\RetailController;
use App\Http\Controllers\LegalController;
use Illuminate\Support\Facades\Route;

// ==========================================
// PUBLIC ROUTES
// ==========================================

// Landing & Marketing Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/features', [HomeController::class, 'features'])->name('features');
Route::get('/pricing', [PricingController::class, 'index'])->name('pricing');

// Contact & Support
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/support', [ContactController::class, 'support'])->name('support');

// Documentation Routes
Route::prefix('docs')->name('docs.')->group(function () {
    Route::get('/', [DocumentationController::class, 'index'])->name('index');
    Route::get('/getting-started', [DocumentationController::class, 'gettingStarted'])->name('getting-started');
    Route::get('/authentication', [DocumentationController::class, 'authentication'])->name('authentication');
    Route::get('/api-reference', [DocumentationController::class, 'apiReference'])->name('api-reference');
    Route::get('/payment-methods', [DocumentationController::class, 'paymentMethods'])->name('payment-methods');
    Route::get('/webhooks', [DocumentationController::class, 'webhooks'])->name('webhooks');
    Route::get('/testing', [DocumentationController::class, 'testing'])->name('testing');
    Route::get('/examples', [DocumentationController::class, 'examples'])->name('examples');
    Route::get('/faq', [DocumentationController::class, 'faq'])->name('faq');
    Route::get('/search', [DocumentationController::class, 'search'])->name('search');
});

// Legal Pages
Route::get('/privacy-policy', [LegalController::class, 'privacyPolicy'])->name('legal.privacy-policy');
Route::get('/terms-of-service', [LegalController::class, 'termsOfService'])->name('legal.terms-of-service');
Route::get('/cookie-policy', [LegalController::class, 'cookiePolicy'])->name('legal.cookie-policy');

// ==========================================
// PAYMENT CHECKOUT ROUTES (PUBLIC)
// ==========================================

Route::prefix('payment')->name('payment.')->group(function () {
    // Checkout pages
    Route::get('/{transaction_id}', [CheckoutController::class, 'show'])->name('show');
    Route::get('/{transaction_id}/success', [CheckoutController::class, 'success'])->name('success');
    Route::get('/{transaction_id}/failed', [CheckoutController::class, 'failed'])->name('failed');
    Route::get('/{transaction_id}/status', [CheckoutController::class, 'checkStatus'])->name('status');
    Route::get('/{transaction_id}/instructions', [CheckoutController::class, 'instructions'])->name('instructions');

    // Credit Card Payment
    Route::get('/credit-card/{transaction_id}', [CreditCardController::class, 'form'])->name('credit-card.form');
    Route::post('/credit-card/{transaction_id}/process', [CreditCardController::class, 'process'])->name('credit-card.process');
    Route::get('/credit-card/{transaction_id}/3ds', [CreditCardController::class, 'threeDSecure'])->name('credit-card.3ds');
    Route::post('/credit-card/{transaction_id}/3ds/authenticate', [CreditCardController::class, 'authenticate3DS'])->name('credit-card.3ds.authenticate');

    // E-wallet Payment
    Route::get('/ewallet/{transaction_id}', [EwalletController::class, 'show'])->name('ewallet.show');
    Route::get('/ewallet/{transaction_id}/redirect', [EwalletController::class, 'redirect'])->name('ewallet.redirect');
    Route::get('/ewallet/{transaction_id}/qr', [EwalletController::class, 'qrCode'])->name('ewallet.qr');
    Route::post('/ewallet/{transaction_id}/simulate', [EwalletController::class, 'simulate'])->name('ewallet.simulate');

    // QRIS Payment
    Route::get('/qris/{transaction_id}', [QrisController::class, 'show'])->name('qris.show');
    Route::get('/qris/{transaction_id}/qr', [QrisController::class, 'qrCode'])->name('qris.qr');

    // Retail Payment
    Route::get('/retail/{transaction_id}', [RetailController::class, 'show'])->name('retail.show');
    Route::get('/retail/{transaction_id}/barcode', [RetailController::class, 'barcode'])->name('retail.barcode');
});

// ==========================================
// PAYMENT SIMULATION ROUTES (PUBLIC)
// ==========================================

Route::prefix('payment/simulate')->name('payment.simulate.')->group(function () {
    // Virtual Account Simulator
    Route::get('/va', [VirtualAccountController::class, 'simulatePage'])->name('va');
    Route::post('/va/pay', [VirtualAccountController::class, 'simulatePay'])->name('va.pay');
    Route::get('/va/check/{va_number}', [VirtualAccountController::class, 'checkVA'])->name('va.check');

    // E-wallet Simulator
    Route::get('/ewallet', [EwalletController::class, 'simulatePage'])->name('ewallet');
    Route::get('/ewallet/check/{transaction_id}', [EwalletController::class, 'checkTransaction'])->name('ewallet.check');

    // QRIS Simulator
    Route::get('/qris', [QrisController::class, 'simulatePage'])->name('qris');
    Route::post('/qris/scan', [QrisController::class, 'scan'])->name('qris.scan');
    Route::post('/qris/pay', [QrisController::class, 'pay'])->name('qris.pay');
    Route::get('/qris/check/{transaction_id}', [QrisController::class, 'checkTransaction'])->name('qris.check');

    // Retail Simulator
    Route::get('/retail', [RetailController::class, 'simulatePage'])->name('retail');
    Route::get('/retail/check/{payment_code}', [RetailController::class, 'checkPaymentCode'])->name('retail.check');
    Route::post('/retail/pay', [RetailController::class, 'pay'])->name('retail.pay');
    Route::get('/retail/check-transaction/{transaction_id}', [RetailController::class, 'checkTransaction'])->name('retail.check-transaction');
});

// ==========================================
// DASHBOARD ROUTES (PROTECTED)
// ==========================================

Route::middleware(['auth', 'verified'])->prefix('dashboard')->name('dashboard.')->group(function () {
    
    // Dashboard Home
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // ==========================================
    // TRANSACTIONS
    // ==========================================
    Route::prefix('transactions')->name('transactions.')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('index');
        Route::get('/{transaction_id}', [TransactionController::class, 'show'])->name('show');
        Route::post('/{transaction_id}/cancel', [TransactionController::class, 'cancel'])->name('cancel');
        Route::post('/{transaction_id}/refund', [TransactionController::class, 'refund'])->name('refund');
        Route::post('/{transaction_id}/resend-webhook', [TransactionController::class, 'resendWebhook'])->name('resend-webhook');
        Route::get('/export/csv', [TransactionController::class, 'export'])->name('export');
    });

    // ==========================================
    // SETTLEMENTS
    // ==========================================
    Route::prefix('settlements')->name('settlements.')->group(function () {
        Route::get('/', [SettlementController::class, 'index'])->name('index');
        Route::get('/{date}', [SettlementController::class, 'show'])->name('show');
        Route::get('/{date}/download', [SettlementController::class, 'download'])->name('download');
        
        // Bank Account Settings
        Route::get('/bank-account', [SettlementController::class, 'bankAccount'])->name('bank-account');
        Route::put('/bank-account', [SettlementController::class, 'updateBankAccount'])->name('bank-account.update');
        
        // Withdrawal Request
        Route::post('/withdraw', [SettlementController::class, 'requestWithdrawal'])->name('withdraw');
    });

    // ==========================================
    // API KEYS
    // ==========================================
    Route::prefix('settings/api-keys')->name('settings.api-keys.')->group(function () {
        Route::get('/', [ApiKeyController::class, 'index'])->name('index');
        Route::post('/', [ApiKeyController::class, 'store'])->name('store');
        Route::delete('/{id}', [ApiKeyController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/rotate', [ApiKeyController::class, 'rotate'])->name('rotate');
    });

    // ==========================================
    // SETTINGS
    // ==========================================
    Route::prefix('settings')->name('settings.')->group(function () {
        // General Settings
        Route::get('/', [SettingController::class, 'index'])->name('index');
        
        // Webhook Settings
        Route::get('/webhooks', [SettingController::class, 'webhooks'])->name('webhooks');
        Route::put('/webhooks', [SettingController::class, 'updateWebhooks'])->name('webhooks.update');
        Route::post('/webhooks/generate-secret', [SettingController::class, 'generateWebhookSecret'])->name('webhooks.generate-secret');
        Route::post('/webhooks/test', [SettingController::class, 'testWebhook'])->name('webhooks.test');
        
        // Payment Methods Settings
        Route::get('/payment-methods', [SettingController::class, 'paymentMethods'])->name('payment-methods');
        Route::put('/payment-methods', [SettingController::class, 'updatePaymentMethods'])->name('payment-methods.update');
        
        // Notification Settings
        Route::get('/notifications', [SettingController::class, 'notifications'])->name('notifications');
        Route::put('/notifications', [SettingController::class, 'updateNotifications'])->name('notifications.update');
    });

    // ==========================================
    // MERCHANT PROFILE
    // ==========================================
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [MerchantController::class, 'profile'])->name('index');
        Route::put('/', [MerchantController::class, 'updateProfile'])->name('update');
        Route::put('/password', [MerchantController::class, 'updatePassword'])->name('password.update');
    });

    // ==========================================
    // COMPANY INFORMATION
    // ==========================================
    Route::prefix('company')->name('company.')->group(function () {
        Route::get('/', [MerchantController::class, 'company'])->name('index');
        Route::put('/', [MerchantController::class, 'updateCompany'])->name('update');
    });

    // ==========================================
    // PROFILE (User Account)
    // ==========================================
    Route::get('/account', [ProfileController::class, 'edit'])->name('account.edit');
    Route::patch('/account', [ProfileController::class, 'update'])->name('account.update');
    Route::delete('/account', [ProfileController::class, 'destroy'])->name('account.destroy');
});

// Include Auth Routes
require __DIR__.'/auth.php';