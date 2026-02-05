<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
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
        $merchant = Auth::guard('merchant')->user();

        $search = $request->search;

        $customers = User::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->select([
                'users.id',
                'users.name',
                'users.email',
            ])
            ->addSelect([
                'total_transactions' => Transaction::selectRaw('COUNT(*)')
                    ->whereColumn('transactions.user_id', 'users.id')
                    ->where('merchant_id', $merchant->id),
                'total_amount' => Transaction::selectRaw('COALESCE(SUM(amount), 0)')
                    ->whereColumn('transactions.user_id', 'users.id')
                    ->where('merchant_id', $merchant->id),
                'last_transaction_at' => Transaction::selectRaw('MAX(created_at)')
                    ->whereColumn('transactions.user_id', 'users.id')
                    ->where('merchant_id', $merchant->id),
            ])
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
        $merchant = Auth::guard('merchant')->user();
        $email = $this->decodeCustomer($customer);

        if (!$email) {
            abort(404, 'Customer not found');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            abort(404, 'Customer not found');
        }

        $transactions = Transaction::where('merchant_id', $merchant->id)
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        $customerInfo = [
            'email' => $email,
            'name' => $user->name,
            'phone' => null,
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
