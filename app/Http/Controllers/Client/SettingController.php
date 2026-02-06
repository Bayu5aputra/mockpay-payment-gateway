<?php

declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('client.settings.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'avatar' => ['nullable', 'url', 'max:500'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->avatar = $request->avatar;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function webhooks()
    {
        $user = Auth::user();
        return view('client.settings.webhooks', compact('user'));
    }

    public function updateWebhooks(Request $request)
    {
        $request->validate([
            'webhook_url' => 'nullable|url|max:500',
            'webhook_events' => 'nullable|array',
            'webhook_events.*' => 'string|max:100',
        ]);

        $user = Auth::user();
        $user->webhook_url = $request->webhook_url;
        $user->webhook_events = $request->has('webhook_events') ? $request->webhook_events : [];
        $user->save();

        return redirect()->back()->with('success', 'Webhook settings updated successfully.');
    }

    public function generateWebhookSecret()
    {
        $user = Auth::user();
        $user->webhook_secret = Str::random(32);
        $user->save();

        return redirect()->back()->with('success', 'Webhook secret generated successfully.');
    }
}
