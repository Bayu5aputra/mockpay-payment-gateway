<?php

namespace App\Http\Middleware;

use App\Models\ApiRequestLog;
use App\Models\ClientApiKey;
use App\Models\PlatformSetting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyAuthentication
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

        if ($key->user && $key->user->isSuspended()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tenant account is suspended',
            ], 403);
        }

        if ($key->user) {
            $defaults = PlatformSetting::getValue('platform.defaults', [
                'baseline_rate_limit' => 500,
            ]);
            $baselineRateLimit = max(1, (int) ($defaults['baseline_rate_limit'] ?? 500));
            $planRateLimit = $key->user->dailyApiRequestLimit();
            $effectiveRateLimit = $planRateLimit !== null
                ? min($planRateLimit, $baselineRateLimit)
                : $baselineRateLimit;

            $todayCount = ApiRequestLog::where('user_id', $key->user->id)
                ->whereDate('created_at', now()->toDateString())
                ->count();

            if ($todayCount >= $effectiveRateLimit) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Daily API request limit reached',
                    'limit' => $effectiveRateLimit,
                    'current' => $todayCount,
                ], 429);
            }
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
