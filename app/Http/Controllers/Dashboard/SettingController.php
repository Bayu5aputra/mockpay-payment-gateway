<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\WebhookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    protected $webhookService;

    public function __construct(WebhookService $webhookService)
    {
        $this->webhookService = $webhookService;
    }

    /**
     * Display general settings
     * GET /dashboard/settings
     */
    public function index()
    {
        $merchant = Auth::user();
        return view('dashboard.settings.index', compact('merchant'));
    }

    /**
     * Display webhook settings
     * GET /dashboard/settings/webhooks
     */
    public function webhooks()
    {
        $merchant = Auth::user();
        return view('dashboard.settings.webhooks', compact('merchant'));
    }

    /**
     * Update webhook settings
     * PUT /dashboard/settings/webhooks
     */
    public function updateWebhooks(Request $request)
    {
        $merchant = Auth::user();

        $request->validate([
            'webhook_url' => 'required|url|max:255',
        ]);

        try {
            $merchant->update([
                'webhook_url' => $request->webhook_url,
            ]);

            return redirect()->back()->with('success', 'Webhook settings updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update webhook settings: ' . $e->getMessage());
        }
    }

    /**
     * Generate webhook secret
     * POST /dashboard/settings/webhooks/generate-secret
     */
    public function generateWebhookSecret()
    {
        $merchant = Auth::user();

        try {
            $secret = 'whsec_' . Str::random(40);

            $merchant->update([
                'webhook_secret' => $secret,
            ]);

            return redirect()->back()->with([
                'success' => 'Webhook secret generated successfully',
                'new_secret' => $secret,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to generate webhook secret: ' . $e->getMessage());
        }
    }

    /**
     * Test webhook
     * POST /dashboard/settings/webhooks/test
     */
    public function testWebhook(Request $request)
    {
        $merchant = Auth::user();

        if (!$merchant->webhook_url) {
            return redirect()->back()->with('error', 'Please set webhook URL first');
        }

        try {
            // Create test payload
            $testPayload = [
                'event' => 'test.webhook',
                'timestamp' => now()->toIso8601String(),
                'data' => [
                    'message' => 'This is a test webhook from MockPay',
                    'merchant_id' => $merchant->id,
                ],
            ];

            // Send test webhook
            $signature = app(\App\Services\SignatureService::class)
                ->generateSignature($testPayload, $merchant->webhook_secret);

            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-Mockpay-Signature' => $signature,
            ])->timeout(10)->post($merchant->webhook_url, $testPayload);

            if ($response->successful()) {
                return redirect()->back()->with('success', 'Webhook test sent successfully. Response code: ' . $response->status());
            } else {
                return redirect()->back()->with('error', 'Webhook test failed. Response code: ' . $response->status());
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send test webhook: ' . $e->getMessage());
        }
    }

    /**
     * Display payment methods settings
     * GET /dashboard/settings/payment-methods
     */
    public function paymentMethods()
    {
        $merchant = Auth::user();

        // In real application, this would come from database
        $paymentMethods = [
            'bank_transfer' => [
                'name' => 'Bank Transfer',
                'enabled' => true,
                'channels' => ['bca_va', 'mandiri_va', 'bni_va', 'bri_va', 'permata_va'],
            ],
            'ewallet' => [
                'name' => 'E-Wallet',
                'enabled' => true,
                'channels' => ['gopay', 'ovo', 'dana', 'shopeepay', 'linkaja'],
            ],
            'credit_card' => [
                'name' => 'Credit Card',
                'enabled' => true,
                'channels' => ['credit_card'],
            ],
            'qris' => [
                'name' => 'QRIS',
                'enabled' => true,
                'channels' => ['qris'],
            ],
            'retail' => [
                'name' => 'Retail',
                'enabled' => true,
                'channels' => ['alfamart', 'indomaret'],
            ],
        ];

        return view('dashboard.settings.payment-methods', compact('paymentMethods', 'merchant'));
    }

    /**
     * Update payment methods settings
     * PUT /dashboard/settings/payment-methods
     */
    public function updatePaymentMethods(Request $request)
    {
        $merchant = Auth::user();

        // In real application, save to database
        // For now, just return success

        return redirect()->back()->with('success', 'Payment methods updated successfully');
    }

    /**
     * Display notification settings
     * GET /dashboard/settings/notifications
     */
    public function notifications()
    {
        $merchant = Auth::user();
        return view('dashboard.settings.notifications', compact('merchant'));
    }

    /**
     * Update notification settings
     * PUT /dashboard/settings/notifications
     */
    public function updateNotifications(Request $request)
    {
        $merchant = Auth::user();

        $request->validate([
            'email_notifications' => 'boolean',
            'webhook_notifications' => 'boolean',
        ]);

        try {
            $merchant->update([
                'email_notifications' => $request->has('email_notifications'),
                'webhook_notifications' => $request->has('webhook_notifications'),
            ]);

            return redirect()->back()->with('success', 'Notification settings updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update notification settings: ' . $e->getMessage());
        }
    }
}
