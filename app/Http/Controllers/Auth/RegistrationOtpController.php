<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerifyRegistrationOtpRequest;
use App\Models\User;
use App\Services\RegistrationOtpService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RegistrationOtpController extends Controller
{
    private const MAX_ATTEMPTS = 5;

    public function show(RegistrationOtpService $otpService): View|RedirectResponse
    {
        $data = $otpService->getSession();
        if (!$data) {
            return redirect()
                ->route('register')
                ->with('error', 'Sesi registrasi tidak ditemukan. Silakan daftar ulang.');
        }

        return view('auth.verify-otp', [
            'email' => $data['email'] ?? null,
            'resendAvailableAt' => $data['resend_available_at'] ?? null,
        ]);
    }

    public function verify(VerifyRegistrationOtpRequest $request, RegistrationOtpService $otpService): RedirectResponse
    {
        $data = $otpService->getSession();
        if (!$data) {
            return redirect()
                ->route('register')
                ->with('error', 'Sesi registrasi telah berakhir. Silakan daftar ulang.');
        }

        if (now()->timestamp > (int) ($data['expires_at'] ?? 0)) {
            $otpService->clear();

            return redirect()
                ->route('register')
                ->with('error', 'Kode OTP telah kedaluwarsa. Silakan daftar ulang.');
        }

        $attempts = (int) ($data['attempts'] ?? 0);
        if ($attempts >= self::MAX_ATTEMPTS) {
            $otpService->clear();

            return redirect()
                ->route('register')
                ->with('error', 'Terlalu banyak percobaan. Silakan daftar ulang.');
        }

        $otp = (string) $request->input('otp');
        if (!Hash::check($otp, (string) ($data['otp_hash'] ?? ''))) {
            $data['attempts'] = $attempts + 1;
            session(['registration_otp' => $data]);

            return back()
                ->withErrors(['otp' => 'Kode OTP tidak valid.'])
                ->withInput();
        }

        $email = (string) ($data['email'] ?? '');
        if ($email === '') {
            $otpService->clear();

            return redirect()
                ->route('register')
                ->with('error', 'Data registrasi tidak lengkap. Silakan daftar ulang.');
        }

        if (User::where('email', $email)->exists()) {
            $otpService->clear();

            return redirect()
                ->route('login')
                ->with('error', 'Email sudah terdaftar. Silakan login.');
        }

        $provider = (string) ($data['provider'] ?? 'manual');
        $name = (string) ($data['name'] ?? '');
        if ($name === '') {
            $otpService->clear();

            return redirect()
                ->route('register')
                ->with('error', 'Data registrasi tidak lengkap. Silakan daftar ulang.');
        }

        if ($provider !== 'google' && empty($data['password_hash'])) {
            $otpService->clear();

            return redirect()
                ->route('register')
                ->with('error', 'Data registrasi tidak lengkap. Silakan daftar ulang.');
        }

        $userData = [
            'name' => $name,
            'email' => $email,
            'email_verified_at' => now(),
        ];

        if ($provider === 'google') {
            $userData['google_id'] = $data['google_id'] ?? null;
            $userData['avatar'] = $data['avatar'] ?? null;
            $userData['provider'] = 'google';
            $userData['password'] = Hash::make(Str::random(24));
        } else {
            $userData['password'] = (string) ($data['password_hash'] ?? '');
        }

        $user = User::create($userData);

        event(new Registered($user));
        Auth::login($user);

        $otpService->clear();

        return redirect()->route('client.dashboard');
    }

    public function resend(RegistrationOtpService $otpService): RedirectResponse
    {
        if (!$otpService->getSession()) {
            return redirect()
                ->route('register')
                ->with('error', 'Sesi registrasi tidak ditemukan. Silakan daftar ulang.');
        }

        if (!$otpService->resend()) {
            return back()->with('error', 'Mohon tunggu sebelum mengirim ulang OTP.');
        }

        return back()->with('status', 'Kode OTP baru telah dikirim ke email Anda.');
    }
}
