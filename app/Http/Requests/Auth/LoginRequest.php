<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use App\Models\Merchant;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'Please provide a valid email address',
            'password.required' => 'Password is required',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     * Checks both users and merchants tables.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $email = $this->input('email');
        $password = $this->input('password');
        $remember = $this->boolean('remember');

        // First, try to find merchant
        $merchant = Merchant::where('email', $email)->first();
        
        if ($merchant && Hash::check($password, $merchant->password)) {
            // Check if merchant is active
            if ($merchant->status !== 'active') {
                throw ValidationException::withMessages([
                    'email' => 'Your merchant account is not active. Please contact support.',
                ]);
            }

            // Login as merchant
            Auth::guard('merchant')->login($merchant, $remember);
            RateLimiter::clear($this->throttleKey());
            return;
        }

        // If not found in merchants, try users table
        $user = User::where('email', $email)->first();
        
        if ($user && Hash::check($password, $user->password)) {
            // Login as user
            Auth::guard('web')->login($user, $remember);
            RateLimiter::clear($this->throttleKey());
            return;
        }

        // If no match found
        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    /**
     * Check which guard is authenticated and return the guard name
     */
    public function getAuthenticatedGuard(): ?string
    {
        if (Auth::guard('merchant')->check()) {
            return 'merchant';
        }
        
        if (Auth::guard('web')->check()) {
            return 'web';
        }

        return null;
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')) . '|' . $this->ip());
    }
}