<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMerchantStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        $merchant = Auth::guard('merchant')->user();

        if (!$merchant) {
            return redirect()->route('login');
        }

        if (!$merchant->isActive()) {
            Auth::guard('merchant')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->withErrors(['email' => 'Your merchant account is not active. Please contact support.']);
        }

        return $next($request);
    }
}
