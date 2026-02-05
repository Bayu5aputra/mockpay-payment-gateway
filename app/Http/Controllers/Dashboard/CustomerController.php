<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display customer list (aggregated from transactions)
     * GET /dashboard/customers
     */
    public function index(Request $request)
    {
        $merchant = Auth::user();

        $search = $request->search;

        $customers = Transaction::where('merchant_id', $merchant->id)
            ->whereNotNull('customer_email')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('customer_name', 'like', "%{$search}%")
                        ->orWhere('customer_email', 'like', "%{$search}%")
                        ->orWhere('customer_phone', 'like', "%{$search}%");
                });
            })
            ->select([
                'customer_email',
                DB::raw('MAX(customer_name) as customer_name'),
                DB::raw('MAX(customer_phone) as customer_phone'),
                DB::raw('COUNT(*) as total_transactions'),
                DB::raw('SUM(amount) as total_amount'),
                DB::raw('MAX(created_at) as last_transaction_at'),
            ])
            ->groupBy('customer_email')
            ->orderByDesc('last_transaction_at')
            ->paginate(15)
            ->withQueryString();

        return view('dashboard.customers.index', compact('customers', 'search'));
    }

    /**
     * Display customer detail
     * GET /dashboard/customers/{customer}
     */
    public function show(string $customer)
    {
        $merchant = Auth::user();
        $email = $this->decodeCustomer($customer);

        if (!$email) {
            abort(404, 'Customer not found');
        }

        $transactions = Transaction::where('merchant_id', $merchant->id)
            ->where('customer_email', $email)
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        if ($transactions->isEmpty()) {
            abort(404, 'Customer not found');
        }

        $customerInfo = [
            'email' => $email,
            'name' => $transactions->first()->customer_name,
            'phone' => $transactions->first()->customer_phone,
        ];

        $stats = [
            'total_transactions' => $transactions->total(),
            'total_amount' => $transactions->sum('amount'),
        ];

        return view('dashboard.customers.show', compact('customerInfo', 'transactions', 'stats'));
    }

    private function decodeCustomer(string $customer): ?string
    {
        $decoded = base64_decode($customer, true);
        if (!$decoded || !filter_var($decoded, FILTER_VALIDATE_EMAIL)) {
            return null;
        }
        return $decoded;
    }
}
