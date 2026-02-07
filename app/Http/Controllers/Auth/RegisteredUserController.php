<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\RegistrationOtpService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request, RegistrationOtpService $otpService): RedirectResponse
    {
        $validated = $request->validated();

        $otpService->start([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'provider' => 'manual',
            'password_hash' => Hash::make($validated['password']),
        ]);

        Auth::logout();

        return redirect()
            ->route('register.otp')
            ->with('status', 'Kode OTP telah dikirim ke email Anda.');
    }
}
