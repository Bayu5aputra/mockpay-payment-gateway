<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        if ($request->user()->hasVerifiedEmail()) {
            // Redirect based on guard
            if (Auth::guard('merchant')->check()) {
                return redirect()->intended(route('dashboard.index'));
            }
            
            return redirect()->intended(route('client.dashboard'));
        }

        return view('auth.verify-email');
    }
}