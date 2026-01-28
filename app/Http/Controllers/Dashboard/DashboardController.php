<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Display dashboard home
     * GET /dashboard
     */
    public function index(Request $request)
    {
        $merchant = Auth::user();
        $period = $request->period ?? 'today';

        // Get statistics
        $statistics = $this->transactionService->getStatistics($merchant->id, $period);

        // Get chart data
        $chartData = $this->transactionService->getChartData($merchant->id, 'week');

        // Get payment method distribution
        $distribution = $this->transactionService->getPaymentMethodDistribution($merchant->id, $period);

        // Calculate percentages for distribution
        $total = array_sum(array_column($distribution, 'count'));
        if ($total > 0) {
            foreach ($distribution as &$item) {
                $item['percentage'] = round(($item['count'] / $total) * 100, 2);
            }
        }

        // Get recent transactions
        $recentTransactions = $this->transactionService->getRecentTransactions($merchant->id, 10);

        // Get comparison data (previous period)
        $previousPeriod = $this->getPreviousPeriod($period);
        $previousStats = $this->transactionService->getStatistics($merchant->id, $previousPeriod);

        // Calculate changes
        $changes = [
            'transactions' => $this->calculatePercentageChange(
                $previousStats['total_transactions'],
                $statistics['total_transactions']
            ),
            'amount' => $this->calculatePercentageChange(
                $previousStats['total_amount'],
                $statistics['total_amount']
            ),
            'success_rate' => $statistics['success_rate'] - $previousStats['success_rate'],
        ];

        return view('dashboard.index', compact(
            'statistics',
            'chartData',
            'distribution',
            'recentTransactions',
            'changes',
            'period'
        ));
    }

    /**
     * Get previous period based on current period
     */
    private function getPreviousPeriod($period)
    {
        switch ($period) {
            case 'today':
                return 'yesterday';
            case 'week':
                // Not implemented in service, use today as fallback
                return 'today';
            case 'month':
                // Not implemented in service, use week as fallback
                return 'week';
            default:
                return 'yesterday';
        }
    }

    /**
     * Calculate percentage change
     */
    private function calculatePercentageChange($old, $new)
    {
        if ($old == 0) {
            return $new > 0 ? 100 : 0;
        }

        return round((($new - $old) / $old) * 100, 2);
    }
}
