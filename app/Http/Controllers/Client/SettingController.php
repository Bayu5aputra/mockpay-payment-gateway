<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function webhooks()
    {
        $user = Auth::user();
        return view('client.settings.webhooks', compact('user'));
    }

    public function updateWebhooks(Request $request)
    {
        $request->validate([
            'webhook_url' => 'nullable|url|max:500',
        ]);

        $user = Auth::user();
        $user->webhook_url = $request->webhook_url;
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
