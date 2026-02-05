<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientDashboardController extends Controller
{
    /**
     * Display the client dashboard.
     */
    public function index(): View
    {
        $user = auth()->user();

        $today = now();
        $dailyLimit = $user->dailyTransactionLimit();
        $todayCount = Transaction::where('user_id', $user->id)
            ->whereDate('created_at', $today->toDateString())
            ->count();

        $totalTransactions = Transaction::where('user_id', $user->id)->count();
        $totalAmount = Transaction::where('user_id', $user->id)->sum('amount');
        $successCount = Transaction::where('user_id', $user->id)->where('status', 'settlement')->count();
        $successRate = $totalTransactions > 0 ? round(($successCount / $totalTransactions) * 100, 2) : 0;

        $stats = [
            'total_payments' => $totalTransactions,
            'total_amount' => $totalAmount,
            'pending_payments' => Transaction::where('user_id', $user->id)->where('status', 'pending')->count(),
            'success_rate' => $successRate,
            'daily_limit' => $dailyLimit,
            'daily_used' => $todayCount,
        ];

        $recentTransactions = Transaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('client.dashboard', compact('user', 'stats', 'recentTransactions'));
    }
}
