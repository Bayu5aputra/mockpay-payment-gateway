<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ApiKeyController extends Controller
{
    /**
     * Display a listing of API keys
     */
    public function index()
    {
        // Mock API keys data
        $apiKeys = [
            [
                'id' => 1,
                'name' => 'Production Key',
                'key' => 'mpk_prod_' . Str::random(32),
                'environment' => 'production',
                'is_active' => true,
                'last_used_at' => now()->subHours(2),
                'created_at' => now()->subDays(30)
            ],
            [
                'id' => 2,
                'name' => 'Development Key',
                'key' => 'mpk_test_' . Str::random(32),
                'environment' => 'sandbox',
                'is_active' => true,
                'last_used_at' => now()->subMinutes(15),
                'created_at' => now()->subDays(5)
            ]
        ];

        return view('dashboard.settings.api-keys', compact('apiKeys'));
    }

    /**
     * Store a new API key
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'environment' => 'required|in:sandbox,production'
        ]);

        // Generate new API key
        $prefix = $request->environment === 'production' ? 'mpk_prod_' : 'mpk_test_';
        $apiKey = $prefix . Str::random(32);

        // In real implementation, save to database
        // ApiKey::create([...]);

        return redirect()->route('dashboard.api-keys.index')
            ->with('success', 'API Key created successfully!')
            ->with('new_api_key', $apiKey);
    }

    /**
     * Delete an API key
     */
    public function destroy($id)
    {
        // In real implementation, delete from database
        // ApiKey::findOrFail($id)->delete();

        return redirect()->route('dashboard.api-keys.index')
            ->with('success', 'API Key deleted successfully!');
    }

    /**
     * Regenerate an API key
     */
    public function regenerate($id)
    {
        // In real implementation, regenerate key in database
        $newKey = 'mpk_prod_' . Str::random(32);

        return redirect()->route('dashboard.api-keys.index')
            ->with('success', 'API Key regenerated successfully!')
            ->with('new_api_key', $newKey);
    }
}
