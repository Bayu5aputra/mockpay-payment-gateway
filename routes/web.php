<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\DocumentationController;
use App\Http\Controllers\Public\PricingController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ApiKeyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LegalController;


// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pricing', [PricingController::class, 'index'])->name('pricing');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

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
});

// Legal Pages
Route::get('/privacy-policy', [LegalController::class, 'privacyPolicy'])->name('legal.privacy-policy');
Route::get('/terms-of-service', [LegalController::class, 'termsOfService'])->name('legal.terms-of-service');
Route::get('/cookie-policy', [LegalController::class, 'cookiePolicy'])->name('legal.cookie-policy');

// Dashboard Routes (Protected)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Developer Dashboard Routes
    Route::prefix('dashboard/developers')->name('dashboard.developers.')->group(function () {
        Route::get('/', [DashboardController::class, 'developers'])->name('index');
        Route::get('/api-docs', [DashboardController::class, 'apiDocs'])->name('api-docs');
        Route::get('/code-examples', [DashboardController::class, 'codeExamples'])->name('code-examples');
        Route::get('/simulator', [DashboardController::class, 'simulator'])->name('simulator');
        Route::get('/logs', [DashboardController::class, 'logs'])->name('logs');
    });

    // API Keys Management
    Route::prefix('dashboard/api-keys')->name('dashboard.api-keys.')->group(function () {
        Route::get('/', [ApiKeyController::class, 'index'])->name('index');
        Route::post('/', [ApiKeyController::class, 'store'])->name('store');
        Route::delete('/{apiKey}', [ApiKeyController::class, 'destroy'])->name('destroy');
        Route::post('/{apiKey}/regenerate', [ApiKeyController::class, 'regenerate'])->name('regenerate');
    });

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
