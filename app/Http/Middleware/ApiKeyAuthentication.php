<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyAuthenticate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->bearerToken();

        if (!$apiKey) {
            return response()->json([
                'status' => 'error',
                'message' => 'API key is required. Please provide API key in Authorization header.'
            ], 401);
        }

        // Find API key
        $key = ApiKey::where('key', $apiKey)
            ->where('is_active', true)
            ->with('merchant')
            ->first();

        if (!$key) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid API key'
            ], 401);
        }

        // Check if merchant is active
        if (!$key->merchant->is_active) {
            return response()->json([
                'status' => 'error',
                'message' => 'Merchant account is not active'
            ], 403);
        }

        // Update last used timestamp
        $key->update(['last_used_at' => now()]);

        // Set authenticated merchant
        $request->setUserResolver(function () use ($key) {
            return $key->merchant;
        });

        return $next($request);
    }
}