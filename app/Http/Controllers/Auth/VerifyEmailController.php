<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            // Redirect based on guard
            if (Auth::guard('merchant')->check()) {
                return redirect()->intended(route('dashboard.index') . '?verified=1');
            }
            
            return redirect()->intended(route('client.dashboard') . '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // Redirect based on guard
        if (Auth::guard('merchant')->check()) {
            return redirect()->intended(route('dashboard.index') . '?verified=1');
        }
        
        return redirect()->intended(route('client.dashboard') . '?verified=1');
    }
}