<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SettlementController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Display settlement list
     * GET /dashboard/settlements
     */
    public function index(Request $request)
    {
        $merchant = Auth::user();

        $filters = [
            'status' => 'settlement',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'order_by' => 'settled_at',
            'order_direction' => 'desc',
        ];

        $perPage = $request->per_page ?? 15;
        $settlements = $this->transactionService->getTransactionsByMerchant(
            $merchant->id,
            $filters,
            $perPage
        );

        // Calculate totals
        $totals = [
            'count' => $settlements->total(),
            'gross' => $settlements->sum('amount'),
            'fee' => $settlements->sum('fee'),
            'net' => $settlements->sum('amount') - $settlements->sum('fee'),
        ];

        return view('dashboard.settlements.index', compact('settlements', 'totals', 'filters'));
    }

    /**
     * Display settlement detail
     * GET /dashboard/settlements/{date}
     */
    public function show($date)
    {
        $merchant = Auth::user();

        try {
            $startDate = \Carbon\Carbon::parse($date)->startOfDay();
            $endDate = \Carbon\Carbon::parse($date)->endOfDay();
        } catch (\Exception $e) {
            abort(404, 'Invalid date format');
        }

        $transactions = DB::table('transactions')
            ->where('merchant_id', $merchant->id)
            ->where('status', 'settlement')
            ->whereBetween('settled_at', [$startDate, $endDate])
            ->get();

        if ($transactions->isEmpty()) {
            abort(404, 'No settlements found for this date');
        }

        $summary = [
            'date' => $startDate->format('Y-m-d'),
            'total_transactions' => $transactions->count(),
            'gross_amount' => $transactions->sum('amount'),
            'total_fee' => $transactions->sum('fee'),
            'net_amount' => $transactions->sum('amount') - $transactions->sum('fee'),
            'by_payment_method' => [],
        ];

        // Group by payment method
        $grouped = $transactions->groupBy('payment_method');
        foreach ($grouped as $method => $items) {
            $summary['by_payment_method'][$method] = [
                'count' => $items->count(),
                'gross' => $items->sum('amount'),
                'fee' => $items->sum('fee'),
                'net' => $items->sum('amount') - $items->sum('fee'),
            ];
        }

        return view('dashboard.settlements.show', compact('summary', 'transactions'));
    }

    /**
     * Display bank account settings
     * GET /dashboard/settlements/bank-account
     */
    public function bankAccount()
    {
        $merchant = Auth::user();
        return view('dashboard.settlements.bank-account', compact('merchant'));
    }

    /**
     * Update bank account
     * PUT /dashboard/settlements/bank-account
     */
    public function updateBankAccount(Request $request)
    {
        $merchant = Auth::user();

        $request->validate([
            'bank_name' => 'required|string|max:100',
            'account_number' => 'required|string|max:50',
            'account_name' => 'required|string|max:255',
        ]);

        try {
            $merchant->update([
                'bank_name' => $request->bank_name,
                'bank_account_number' => $request->account_number,
                'bank_account_name' => $request->account_name,
            ]);

            return redirect()->back()->with('success', 'Bank account updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update bank account: ' . $e->getMessage());
        }
    }

    /**
     * Request withdrawal
     * POST /dashboard/settlements/withdraw
     */
    public function requestWithdrawal(Request $request)
    {
        $merchant = Auth::user();

        $request->validate([
            'amount' => 'required|numeric|min:10000',
        ]);

        // Check if merchant has bank account
        if (!$merchant->bank_account_number) {
            return redirect()->back()->with('error', 'Please set up your bank account first');
        }

        try {
            // In real application, create withdrawal request record
            // For now, just return success
            return redirect()->back()->with('success', 'Withdrawal request submitted successfully. It will be processed within 1-3 business days.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to request withdrawal: ' . $e->getMessage());
        }
    }

    /**
     * Download settlement report (PDF)
     * GET /dashboard/settlements/{date}/download
     */
    public function download($date)
    {
        $merchant = Auth::user();

        try {
            $startDate = \Carbon\Carbon::parse($date)->startOfDay();
            $endDate = \Carbon\Carbon::parse($date)->endOfDay();
        } catch (\Exception $e) {
            abort(404, 'Invalid date format');
        }

        $transactions = DB::table('transactions')
            ->where('merchant_id', $merchant->id)
            ->where('status', 'settlement')
            ->whereBetween('settled_at', [$startDate, $endDate])
            ->get();

        if ($transactions->isEmpty()) {
            return redirect()->back()->with('error', 'No settlements found for this date');
        }

        $summary = [
            'date' => $startDate->format('Y-m-d'),
            'merchant' => $merchant,
            'total_transactions' => $transactions->count(),
            'gross_amount' => $transactions->sum('amount'),
            'total_fee' => $transactions->sum('fee'),
            'net_amount' => $transactions->sum('amount') - $transactions->sum('fee'),
        ];

        // Generate PDF using DomPDF
        $pdf = \PDF::loadView('dashboard.settlements.report-pdf', compact('summary', 'transactions'));

        return $pdf->download('settlement-report-' . $date . '.pdf');
    }
}
