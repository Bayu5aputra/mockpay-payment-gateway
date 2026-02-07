<?php

declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ApiRequestLog;
use App\Models\ClientApiKey;
use App\Models\Transaction;
use App\Models\WebhookLog;
use App\Services\WebhookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeveloperToolsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = now()->toDateString();

        $transactionsToday = Transaction::where('user_id', $user->id)
            ->whereDate('created_at', $today)
            ->count();

        $totalTransactions = Transaction::where('user_id', $user->id)->count();
        $successTransactions = Transaction::where('user_id', $user->id)
            ->where('status', 'settlement')
            ->count();

        $successRate = $totalTransactions > 0
            ? round(($successTransactions / $totalTransactions) * 100, 2)
            : 0;

        $webhooksToday = WebhookLog::where('user_id', $user->id)
            ->whereDate('created_at', $today)
            ->count();

        $activeApiKeys = ClientApiKey::where('user_id', $user->id)
            ->active()
            ->notExpired()
            ->count();

        $apiRequestsToday = ApiRequestLog::where('user_id', $user->id)
            ->whereDate('created_at', $today)
            ->count();

        $lastApiRequestAt = ApiRequestLog::where('user_id', $user->id)
            ->latest('created_at')
            ->first()
            ?->created_at;

        $apiLimit = $user->dailyApiRequestLimit();
        $apiUsagePercent = $apiLimit ? round(($apiRequestsToday / $apiLimit) * 100, 2) : null;

        $sandboxKey = ClientApiKey::where('user_id', $user->id)
            ->where('environment', 'sandbox')
            ->active()
            ->notExpired()
            ->latest()
            ->first();

        $productionKey = ClientApiKey::where('user_id', $user->id)
            ->where('environment', 'production')
            ->active()
            ->notExpired()
            ->latest()
            ->first();

        $stats = [
            'transactions_today' => $transactionsToday,
            'success_rate' => $successRate,
            'webhooks_today' => $webhooksToday,
            'active_api_keys' => $activeApiKeys,
            'api_requests_today' => $apiRequestsToday,
            'api_limit' => $apiLimit,
            'api_usage_percent' => $apiUsagePercent,
            'last_api_request_at' => $lastApiRequestAt,
        ];

        return view('client.developers.index', compact('stats', 'sandboxKey', 'productionKey'));
    }

    public function logs(Request $request)
    {
        $user = Auth::user();

        $query = WebhookLog::where('user_id', $user->id)->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('event')) {
            $query->where('event', 'like', '%' . $request->event . '%');
        }

        $logs = $query->paginate(20)->withQueryString();

        $totalLogs = WebhookLog::where('user_id', $user->id)->count();
        $successLogs = WebhookLog::where('user_id', $user->id)->where('status', 'success')->count();
        $successRate = $totalLogs > 0 ? round(($successLogs / $totalLogs) * 100, 2) : 0;
        $errorsLast24h = WebhookLog::where('user_id', $user->id)
            ->where('status', 'failed')
            ->where('created_at', '>=', now()->subDay())
            ->count();

        $stats = [
            'total' => $totalLogs,
            'success_rate' => $successRate,
            'errors_24h' => $errorsLast24h,
        ];

        return view('client.developers.logs', compact('logs', 'stats'));
    }

    public function apiDocs()
    {
        $user = Auth::user();

        $sandboxKey = ClientApiKey::where('user_id', $user->id)
            ->where('environment', 'sandbox')
            ->active()
            ->notExpired()
            ->latest()
            ->first();

        $productionKey = ClientApiKey::where('user_id', $user->id)
            ->where('environment', 'production')
            ->active()
            ->notExpired()
            ->latest()
            ->first();

        $baseUrl = config('app.url') ?: url('/');

        $webhookSecret = $user->webhook_secret;

        return view('client.developers.api-docs', compact('sandboxKey', 'productionKey', 'baseUrl', 'webhookSecret'));
    }

    public function codeExamples()
    {
        $user = Auth::user();

        $sandboxKey = ClientApiKey::where('user_id', $user->id)
            ->where('environment', 'sandbox')
            ->active()
            ->notExpired()
            ->latest()
            ->first();

        $productionKey = ClientApiKey::where('user_id', $user->id)
            ->where('environment', 'production')
            ->active()
            ->notExpired()
            ->latest()
            ->first();

        $baseUrl = config('app.url') ?: url('/');
        $replacements = [
            'http://127.0.0.1:8000' => $baseUrl,
            'mpk_test_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' => $sandboxKey?->getFullKey() ?? 'mpk_test_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
            'mpk_prod_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' => $productionKey?->getFullKey() ?? 'mpk_prod_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
        ];

        $examples = [
            'php' => [
                'examples' => [
                    'create_payment' => [
                        'title' => 'Create Payment',
                        'code' => file_get_contents(resource_path('examples/php/create-payment.php')),
                    ],
                ],
            ],
            'javascript' => [
                'examples' => [
                    'create_payment' => [
                        'title' => 'Create Payment',
                        'code' => file_get_contents(resource_path('examples/javascript/create-payment.js')),
                    ],
                ],
            ],
            'python' => [
                'examples' => [
                    'create_payment' => [
                        'title' => 'Create Payment',
                        'code' => file_get_contents(resource_path('examples/python/create-payment.py')),
                    ],
                ],
            ],
        ];

        foreach ($examples as $language => $group) {
            foreach ($group['examples'] as $key => $example) {
                $code = $example['code'];
                foreach ($replacements as $search => $replace) {
                    $code = str_replace($search, $replace, $code);
                }
                $examples[$language]['examples'][$key]['code'] = $code;
            }
        }

        $webhookSecret = $user->webhook_secret;

        return view('client.developers.code-examples', compact(
            'examples',
            'sandboxKey',
            'productionKey',
            'webhookSecret'
        ));
    }

    public function simulator()
    {
        $user = Auth::user();

        $sandboxKey = ClientApiKey::where('user_id', $user->id)
            ->where('environment', 'sandbox')
            ->active()
            ->notExpired()
            ->latest()
            ->first();

        return view('client.developers.simulator', compact('sandboxKey'));
    }

    public function apiLogs(Request $request)
    {
        $user = Auth::user();

        $query = ApiRequestLog::where('user_id', $user->id)->latest();

        if ($request->filled('status')) {
            if ($request->status === 'success') {
                $query->whereBetween('status_code', [200, 299]);
            } elseif ($request->status === 'error') {
                $query->where('status_code', '>=', 400);
            }
        }

        if ($request->filled('method')) {
            $query->where('method', strtoupper($request->method));
        }

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $logs = $query->paginate(20)->withQueryString();

        $totalLogs = ApiRequestLog::where('user_id', $user->id)->count();
        $errorLogs = ApiRequestLog::where('user_id', $user->id)
            ->where('status_code', '>=', 400)
            ->count();
        $successRate = $totalLogs > 0 ? round((($totalLogs - $errorLogs) / $totalLogs) * 100, 2) : 0;
        $errorsLast24h = ApiRequestLog::where('user_id', $user->id)
            ->where('status_code', '>=', 400)
            ->where('created_at', '>=', now()->subDay())
            ->count();

        $stats = [
            'total' => $totalLogs,
            'success_rate' => $successRate,
            'errors_24h' => $errorsLast24h,
        ];

        return view('client.developers.api-logs', compact('logs', 'stats'));
    }

    public function retryWebhook(WebhookLog $webhookLog, WebhookService $webhookService)
    {
        $user = Auth::user();

        if ($webhookLog->user_id !== $user->id) {
            return redirect()->back()->with('error', 'Webhook log not found');
        }

        if (!$webhookLog->canRetry()) {
            return redirect()->back()->with('error', 'Webhook cannot be retried');
        }

        try {
            $webhookService->retryWebhook($webhookLog);
            return redirect()->back()->with('success', 'Webhook retry queued');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to retry webhook: ' . $e->getMessage());
        }
    }
}
