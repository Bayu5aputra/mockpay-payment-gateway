<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

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
            'user.active' => \App\Http\Middleware\EnsureUserIsActive::class,
            'api.key' => \App\Http\Middleware\ApiKeyAuthentication::class,
            'log.api' => \App\Http\Middleware\LogApiRequest::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
