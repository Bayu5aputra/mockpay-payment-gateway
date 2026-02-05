<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ClientApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiKeyController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $apiKeys = ClientApiKey::where('user_id', $user->id)
            ->withoutTrashed()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('client.api-keys.index', compact('apiKeys'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'environment' => 'required|in:sandbox,production',
        ]);

        $user = Auth::user();

        try {
            $apiKey = ClientApiKey::create([
                'user_id' => $user->id,
                'key_name' => $request->name,
                'environment' => $request->environment,
                'is_active' => true,
            ]);

            return redirect()->back()->with([
                'success' => 'API key generated successfully',
                'new_api_key' => $apiKey->getFullKey(),
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to generate API key: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $apiKey = ClientApiKey::where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();

        try {
            $apiKey->update(['is_active' => false]);
            $apiKey->delete();

            return redirect()->back()->with('success', 'API key deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to revoke API key: ' . $e->getMessage());
        }
    }

    public function rotate($id)
    {
        $user = Auth::user();
        $apiKey = ClientApiKey::where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();

        try {
            $newKey = $apiKey->regenerate();

            return redirect()->back()->with([
                'success' => 'API key rotated successfully',
                'new_api_key' => $newKey,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to rotate API key: ' . $e->getMessage());
        }
    }
}
