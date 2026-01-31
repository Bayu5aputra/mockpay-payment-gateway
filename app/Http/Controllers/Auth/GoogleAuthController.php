<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    /**
     * Redirect to Google OAuth page
     */
    public function redirect()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (\Exception $e) {
            Log::error('Google OAuth Redirect Error: ' . $e->getMessage());
            return redirect('login')->with('error', 'Unable to connect to Google. Please check your configuration.');
        }
    }

    /**
     * Handle Google OAuth callback
     */
    public function callback()
    {
        try {
            // Get user info from Google
            $googleUser = Socialite::driver('google')->user();

            Log::info('Google OAuth Success', [
                'google_id' => $googleUser->getId(),
                'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName(),
            ]);

            // Check if user already exists with this google_id
            $user = User::where('google_id', $googleUser->getId())->first();

            if ($user) {
                // User exists, just login
                Auth::login($user, true);
                return redirect()->intended(route('client.dashboard'))->with('success', 'Welcome back, ' . $user->name . '!');
            }

            // Check if user exists with this email
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // Link Google account to existing user
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'provider' => 'google',
                    'email_verified_at' => now(),
                ]);

                Auth::login($user, true);
                return redirect()->intended(route('client.dashboard'))->with('success', 'Google account linked successfully!');
            }

            // Create new user
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'provider' => 'google',
                'password' => Hash::make(Str::random(24)), // Random password for OAuth users
                'email_verified_at' => now(), // Auto-verify email for Google users
            ]);

            Auth::login($user, true);
            return redirect()->intended(route('client.dashboard'))->with('success', 'Account created successfully!');

        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            Log::error('Google OAuth Invalid State Error: ' . $e->getMessage());
            return redirect('login')->with('error', 'Session expired. Please try again.');

        } catch (\Exception $e) {
            Log::error('Google OAuth Callback Error: ' . $e->getMessage());
            Log::error('Stack Trace: ' . $e->getTraceAsString());
            return redirect('login')->with('error', 'Unable to login with Google. Please try again.');
        }
    }

    /**
     * Logout user
     */
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out successfully.');
    }
}