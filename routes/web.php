<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\DocumentationController;
use App\Http\Controllers\Public\PricingController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\TransactionController as DashboardTransactionController;
use App\Http\Controllers\Dashboard\SettlementController as DashboardSettlementController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\MerchantController;
use App\Http\Controllers\Dashboard\CustomerController as DashboardCustomerController;
use App\Http\Controllers\Dashboard\UpgradeRequestController as DashboardUpgradeRequestController;
use App\Http\Controllers\Payment\CheckoutController;
use App\Http\Controllers\Payment\VirtualAccountController;
use App\Http\Controllers\Payment\EwalletController;
use App\Http\Controllers\Payment\QrisController;
use App\Http\Controllers\Payment\CreditCardController;
use App\Http\Controllers\Payment\RetailController;
use App\Http\Controllers\LegalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ClientDashboardController;
use App\Http\Controllers\Client\UpgradeRequestController as ClientUpgradeRequestController;
use App\Http\Controllers\Client\ApiKeyController as ClientApiKeyController;
use App\Http\Controllers\Client\DeveloperToolsController as ClientDeveloperToolsController;
use App\Http\Controllers\Client\SettingController as ClientSettingController;

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
    Route::get('/troubleshooting', [DocumentationController::class, 'troubleshooting'])->name('troubleshooting');
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

// ==========================================
// CLIENT/USER DASHBOARD ROUTES (PROTECTED)
// ==========================================

Route::middleware(['auth:web'])->prefix('client')->name('client.')->group(function () {
    // Client Dashboard Home
    Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');

    Route::prefix('developers')->name('developers.')->group(function () {
        Route::get('/', [ClientDeveloperToolsController::class, 'index'])->name('index');
        Route::get('/logs', [ClientDeveloperToolsController::class, 'logs'])->name('logs');
        Route::get('/api-docs', function () {
            return view('dashboard.developers.api-docs');
        })->name('api-docs');
        Route::get('/code-examples', function () {
            $examples = [
                'php' => [
                    'examples' => [
                        'create_payment' => [
                            'title' => 'Create Payment',
                            'code' => file_get_contents(resource_path('examples/php/create-payment.php'))
                        ]
                    ]
                ],
                'javascript' => [
                    'examples' => [
                        'create_payment' => [
                            'title' => 'Create Payment',
                            'code' => file_get_contents(resource_path('examples/javascript/create-payment.js'))
                        ]
                    ]
                ],
                'python' => [
                    'examples' => [
                        'create_payment' => [
                            'title' => 'Create Payment',
                            'code' => file_get_contents(resource_path('examples/python/create-payment.py'))
                        ]
                    ]
                ]
            ];
            return view('dashboard.developers.code-examples', compact('examples'));
        })->name('code-examples');
        Route::get('/simulator', function () {
            return view('dashboard.developers.simulator');
        })->name('simulator');
    });

    Route::prefix('api-keys')->name('api-keys.')->group(function () {
        Route::get('/', [ClientApiKeyController::class, 'index'])->name('index');
        Route::post('/', [ClientApiKeyController::class, 'store'])->name('store');
        Route::delete('/{id}', [ClientApiKeyController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/regenerate', [ClientApiKeyController::class, 'rotate'])->name('regenerate');
    });

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/webhooks', [ClientSettingController::class, 'webhooks'])->name('webhooks');
        Route::put('/webhooks', [ClientSettingController::class, 'updateWebhooks'])->name('webhooks.update');
        Route::post('/webhooks/generate-secret', [ClientSettingController::class, 'generateWebhookSecret'])->name('webhooks.generate-secret');
    });
    
    Route::prefix('upgrade-requests')->name('upgrade-requests.')->group(function () {
        Route::get('/', [ClientUpgradeRequestController::class, 'index'])->name('index');
        Route::get('/create', [ClientUpgradeRequestController::class, 'create'])->name('create');
        Route::post('/', [ClientUpgradeRequestController::class, 'store'])->name('store');
        Route::get('/{upgradeRequest}', [ClientUpgradeRequestController::class, 'show'])->name('show');
        Route::get('/{upgradeRequest}/proof', [ClientUpgradeRequestController::class, 'downloadProof'])->name('proof');
        Route::get('/{upgradeRequest}/invoice', [ClientUpgradeRequestController::class, 'downloadInvoice'])->name('invoice');
    });
});

// ==========================================
// MERCHANT DASHBOARD ROUTES (PROTECTED)
// ==========================================

Route::middleware(['auth:merchant', 'verified'])->prefix('dashboard')->name('dashboard.')->group(function () {    
    // Dashboard Home
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // ==========================================
    // TRANSACTIONS
    // ==========================================
    Route::prefix('transactions')->name('transactions.')->group(function () {
        Route::get('/', [DashboardTransactionController::class, 'index'])->name('index');
        Route::get('/{transaction_id}', [DashboardTransactionController::class, 'show'])->name('show');
        Route::post('/{transaction_id}/cancel', [DashboardTransactionController::class, 'cancel'])->name('cancel');
        Route::post('/{transaction_id}/refund', [DashboardTransactionController::class, 'refund'])->name('refund');
        Route::post('/{transaction_id}/resend-webhook', [DashboardTransactionController::class, 'resendWebhook'])->name('resend-webhook');
        Route::get('/export/csv', [DashboardTransactionController::class, 'export'])->name('export');
    });

    // ==========================================
    // CUSTOMERS
    // ==========================================
    Route::prefix('customers')->name('customers.')->group(function () {
        Route::get('/', [DashboardCustomerController::class, 'index'])->name('index');
        Route::get('/{customer}', [DashboardCustomerController::class, 'show'])->name('show');
    });

    // ==========================================
    // UPGRADE REQUESTS
    // ==========================================
    Route::prefix('upgrade-requests')->name('upgrade-requests.')->group(function () {
        Route::get('/', [DashboardUpgradeRequestController::class, 'index'])->name('index');
        Route::get('/{upgradeRequest}', [DashboardUpgradeRequestController::class, 'show'])->name('show');
        Route::post('/{upgradeRequest}/approve', [DashboardUpgradeRequestController::class, 'approve'])->name('approve');
        Route::post('/{upgradeRequest}/reject', [DashboardUpgradeRequestController::class, 'reject'])->name('reject');
        Route::get('/{upgradeRequest}/proof', [DashboardUpgradeRequestController::class, 'downloadProof'])->name('proof');
    });

    // ==========================================
    // SETTLEMENTS
    // ==========================================
    Route::prefix('settlements')->name('settlements.')->group(function () {
        // Bank Account Settings
        Route::get('/bank-account', [DashboardSettlementController::class, 'bankAccount'])->name('bank-account');
        Route::put('/bank-account', [DashboardSettlementController::class, 'updateBankAccount'])->name('bank-account.update');
        
        // Withdrawal Request
        Route::post('/withdraw', [DashboardSettlementController::class, 'requestWithdrawal'])->name('withdraw');

        Route::get('/', [DashboardSettlementController::class, 'index'])->name('index');
        Route::get('/{date}', [DashboardSettlementController::class, 'show'])->name('show');
        Route::get('/{date}/download', [DashboardSettlementController::class, 'download'])->name('download');
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
    Route::prefix('merchant')->name('merchant.')->group(function () {
        Route::get('/profile', [MerchantController::class, 'profile'])->name('profile');
        Route::put('/profile', [MerchantController::class, 'updateProfile'])->name('profile.update');
        Route::put('/password', [MerchantController::class, 'updatePassword'])->name('password.update');
    });

    // ==========================================
    // COMPANY INFORMATION
    // ==========================================
    Route::prefix('merchant')->name('merchant.')->group(function () {
        Route::get('/company', [MerchantController::class, 'company'])->name('company');
        Route::put('/company', [MerchantController::class, 'updateCompany'])->name('company.update');
    });

    // ==========================================
    // PROFILE (User Account)
    // ==========================================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include Auth Routes
require __DIR__.'/auth.php';
