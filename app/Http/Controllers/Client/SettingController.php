<?php

declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\WebhookLog;
use App\Services\SignatureService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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
            'webhook_events.*' => [
                'string',
                'max:100',
                Rule::in([
                    'transaction.pending',
                    'transaction.processing',
                    'transaction.success',
                    'transaction.failed',
                    'transaction.cancelled',
                    'transaction.expired',
                    'transaction.refunded',
                ]),
            ],
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

    public function testWebhook(SignatureService $signatureService)
    {
        $user = Auth::user();

        if (!$user->webhook_url) {
            return redirect()->back()->with('error', 'Webhook URL is not set.');
        }

        if (!$user->webhook_secret) {
            return redirect()->back()->with('error', 'Webhook secret is not set.');
        }

        $payload = [
            'event' => 'webhook.test',
            'timestamp' => now()->toIso8601String(),
            'data' => [
                'transaction_id' => 'TEST-' . strtoupper(Str::random(8)),
                'order_id' => 'ORDER-TEST-' . strtoupper(Str::random(6)),
                'status' => 'pending',
                'amount' => 100000,
                'currency' => 'IDR',
                'payment_method' => 'bank_transfer',
                'payment_channel' => 'bca_va',
                'customer' => [
                    'name' => 'MockPay Tester',
                    'email' => 'tester@example.com',
                ],
            ],
        ];

        $signature = $signatureService->generateSignature($payload, $user->webhook_secret);
        $headers = [
            'X-Mockpay-Signature' => $signature,
            'Content-Type' => 'application/json',
        ];

        $log = WebhookLog::create([
            'merchant_id' => null,
            'user_id' => $user->id,
            'transaction_id' => null,
            'event' => 'webhook.test',
            'webhook_url' => $user->webhook_url,
            'payload' => $payload,
            'headers' => $headers,
            'status' => 'pending',
            'attempt_count' => 1,
            'sent_at' => now(),
        ]);

        try {
            $response = Http::withHeaders($headers)
                ->timeout(10)
                ->post($user->webhook_url, $payload);

            $log->update([
                'response_code' => $response->status(),
                'response_body' => $response->body(),
                'status' => $response->successful() ? 'success' : 'failed',
                'error_message' => $response->successful() ? null : 'HTTP ' . $response->status(),
            ]);

            if ($response->successful()) {
                return redirect()->back()->with('success', 'Test webhook delivered successfully.');
            }

            return redirect()->back()->with('error', 'Test webhook failed with status ' . $response->status() . '.');
        } catch (\Throwable $e) {
            $log->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);

            return redirect()->back()->with('error', 'Test webhook failed: ' . $e->getMessage());
        }
    }
}
