<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\ApiRequestLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogApiRequest
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);

        // Process request
        $response = $next($request);

        // Calculate request duration
        $duration = round((microtime(true) - $startTime) * 1000, 2);

        // Get user info if authenticated
        $user = $request->user();
        $userId = $user ? $user->id : null;

        // Log API request
        Log::info('API Request', [
            'user_id' => $userId,
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status_code' => $response->getStatusCode(),
            'duration_ms' => $duration,
        ]);

        if ($userId) {
            ApiRequestLog::create([
                'user_id' => $userId,
                'method' => $request->method(),
                'path' => $request->path(),
                'status_code' => $response->getStatusCode(),
                'duration_ms' => $duration,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        return $response;
    }
}
