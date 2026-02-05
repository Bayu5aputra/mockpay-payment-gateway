<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ApiKey;
use App\Models\Transaction;
use App\Models\WebhookLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeveloperToolsController extends Controller
{
    public function index()
    {
        $merchant = Auth::guard('merchant')->user();
        $today = now()->toDateString();

        $transactionsToday = Transaction::where('merchant_id', $merchant->id)
            ->whereDate('created_at', $today)
            ->count();

        $totalTransactions = Transaction::where('merchant_id', $merchant->id)->count();
        $successTransactions = Transaction::where('merchant_id', $merchant->id)
            ->where('status', 'settlement')
            ->count();

        $successRate = $totalTransactions > 0
            ? round(($successTransactions / $totalTransactions) * 100, 2)
            : 0;

        $webhooksToday = WebhookLog::where('merchant_id', $merchant->id)
            ->whereDate('created_at', $today)
            ->count();

        $activeApiKeys = ApiKey::where('merchant_id', $merchant->id)
            ->active()
            ->notExpired()
            ->count();

        $stats = [
            'transactions_today' => $transactionsToday,
            'success_rate' => $successRate,
            'webhooks_today' => $webhooksToday,
            'active_api_keys' => $activeApiKeys,
        ];

        return view('dashboard.developers.index', compact('stats'));
    }

    public function logs(Request $request)
    {
        $merchant = Auth::guard('merchant')->user();

        $query = WebhookLog::where('merchant_id', $merchant->id)->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('event')) {
            $query->where('event', 'like', '%' . $request->event . '%');
        }

        $logs = $query->paginate(20)->withQueryString();

        $totalLogs = WebhookLog::where('merchant_id', $merchant->id)->count();
        $successLogs = WebhookLog::where('merchant_id', $merchant->id)->where('status', 'success')->count();
        $successRate = $totalLogs > 0 ? round(($successLogs / $totalLogs) * 100, 2) : 0;
        $errorsLast24h = WebhookLog::where('merchant_id', $merchant->id)
            ->where('status', 'failed')
            ->where('created_at', '>=', now()->subDay())
            ->count();

        $stats = [
            'total' => $totalLogs,
            'success_rate' => $successRate,
            'errors_24h' => $errorsLast24h,
        ];

        return view('dashboard.developers.logs', compact('logs', 'stats'));
    }
}
