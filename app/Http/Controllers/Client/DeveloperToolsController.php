<?php

declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
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

        $stats = [
            'transactions_today' => $transactionsToday,
            'success_rate' => $successRate,
            'webhooks_today' => $webhooksToday,
            'active_api_keys' => $activeApiKeys,
        ];

        return view('client.developers.index', compact('stats'));
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
