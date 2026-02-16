<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'client' => \App\Http\Middleware\RedirectIfNotClient::class,
            'merchant' => \App\Http\Middleware\RedirectIfNotMerchant::class,
            'merchant.status' => \App\Http\Middleware\CheckMerchantStatus::class,
            'user.active' => \App\Http\Middleware\EnsureUserIsActive::class,
            'api.key' => \App\Http\Middleware\ApiKeyAuthentication::class,
            'log.api' => \App\Http\Middleware\LogApiRequest::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (TokenMismatchException $exception, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Session expired. Please authenticate again.',
                ], 419);
            }

            Auth::guard('web')->logout();
            Auth::guard('merchant')->logout();

            if ($request->hasSession()) {
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }

            return redirect()->route('home');
        });
    })->create();
