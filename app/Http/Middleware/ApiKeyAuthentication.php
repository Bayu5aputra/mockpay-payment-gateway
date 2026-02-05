<?php

namespace App\Http\Middleware;

use App\Models\ClientApiKey;
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

        $key = ClientApiKey::where('api_key', $apiKey)
            ->active()
            ->notExpired()
            ->with('user')
            ->first();

        if (!$key) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid API key'
            ], 401);
        }

        // Update last used timestamp
        $key->update(['last_used_at' => now()]);

        // Set authenticated client
        $request->setUserResolver(function () use ($key) {
            return $key->user;
        });

        return $next($request);
    }
}
