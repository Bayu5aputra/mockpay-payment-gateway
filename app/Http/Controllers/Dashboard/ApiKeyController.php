<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ApiKeyController extends Controller
{
    /**
     * Display API keys list
     * GET /dashboard/settings/api-keys
     */
    public function index()
    {
        $merchant = Auth::user();
        $apiKeys = ApiKey::where('merchant_id', $merchant->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.settings.api-keys', compact('apiKeys'));
    }

    /**
     * Generate new API key
     * POST /dashboard/settings/api-keys
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'environment' => 'required|in:sandbox,production',
        ]);

        $merchant = Auth::user();

        try {
            $prefix = $request->environment === 'sandbox' ? 'sandbox_sk_' : 'live_sk_';
            $key = $prefix . Str::random(32);

            $apiKey = ApiKey::create([
                'merchant_id' => $merchant->id,
                'name' => $request->name,
                'key' => $key,
                'environment' => $request->environment,
                'is_active' => true,
            ]);

            return redirect()->back()->with([
                'success' => 'API key generated successfully',
                'new_key' => $key,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to generate API key: ' . $e->getMessage());
        }
    }

    /**
     * Revoke API key
     * DELETE /dashboard/settings/api-keys/{id}
     */
    public function destroy($id)
    {
        $merchant = Auth::user();
        $apiKey = ApiKey::where('merchant_id', $merchant->id)
            ->where('id', $id)
            ->firstOrFail();

        try {
            $apiKey->update(['is_active' => false]);

            return redirect()->back()->with('success', 'API key revoked successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to revoke API key: ' . $e->getMessage());
        }
    }

    /**
     * Rotate API key
     * POST /dashboard/settings/api-keys/{id}/rotate
     */
    public function rotate($id)
    {
        $merchant = Auth::user();
        $apiKey = ApiKey::where('merchant_id', $merchant->id)
            ->where('id', $id)
            ->firstOrFail();

        try {
            $prefix = $apiKey->environment === 'sandbox' ? 'sandbox_sk_' : 'live_sk_';
            $newKey = $prefix . Str::random(32);

            $apiKey->update(['key' => $newKey]);

            return redirect()->back()->with([
                'success' => 'API key rotated successfully',
                'new_key' => $newKey,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to rotate API key: ' . $e->getMessage());
        }
    }
}
