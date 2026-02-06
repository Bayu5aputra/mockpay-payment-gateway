@extends('layouts.app')

@section('title', 'Transactions')

@section('content')
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
                <div class="flex flex-col gap-3">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Transactions</p>
                    <h1 class="text-4xl font-semibold text-slate-900">Transaction List</h1>
                    <p class="text-sm text-slate-600">Manage transaction outcomes and download testing evidence.</p>
                </div>

                <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Status</label>
                            <select name="status" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700">
                                <option value="">All</option>
                                <option value="pending" @selected(request('status')==='pending')>Pending</option>
                                <option value="settlement" @selected(request('status')==='settlement')>Settlement</option>
                                <option value="failed" @selected(request('status')==='failed')>Failed</option>
                                <option value="expired" @selected(request('status')==='expired')>Expired</option>
                                <option value="cancelled" @selected(request('status')==='cancelled')>Cancelled</option>
                                <option value="refunded" @selected(request('status')==='refunded')>Refunded</option>
                                <option value="partial_refund" @selected(request('status')==='partial_refund')>Partial Refund</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Payment Method</label>
                            <select name="payment_method" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700">
                                <option value="">All</option>
                                <option value="bank_transfer" @selected(request('payment_method')==='bank_transfer')>Bank Transfer</option>
                                <option value="ewallet" @selected(request('payment_method')==='ewallet')>E-Wallet</option>
                                <option value="credit_card" @selected(request('payment_method')==='credit_card')>Credit Card</option>
                                <option value="qris" @selected(request('payment_method')==='qris')>QRIS</option>
                                <option value="retail" @selected(request('payment_method')==='retail')>Retail</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Start Date</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">End Date</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700">
                        </div>
                        <div class="md:col-span-4 flex flex-wrap items-center gap-3">
                            <button class="rounded-2xl bg-slate-900 px-5 py-2 text-sm font-semibold text-white">Apply Filters</button>
                            <a href="{{ route('client.transactions.export', request()->query()) }}" class="rounded-2xl border border-slate-200 px-5 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Export CSV</a>
                            <a href="{{ route('client.transactions.webhooks.export', request()->query()) }}" class="rounded-2xl border border-slate-200 px-5 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Export Webhook Logs</a>
                        </div>
                    </form>
                </div>

                <div class="rounded-[28px] bg-white shadow-sm border border-white/70 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-slate-50/70 border-b border-slate-200">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Transaction</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Customer</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Method</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Amount</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @forelse($transactions as $transaction)
                                    @php
                                        $status = $transaction->status ?? 'pending';
                                        $statusClass = match($status) {
                                            'settlement', 'processing' => 'bg-emerald-100 text-emerald-700',
                                            'pending' => 'bg-amber-100 text-amber-700',
                                            'failed', 'cancelled', 'expired' => 'bg-rose-100 text-rose-700',
                                            'refunded', 'partial_refund' => 'bg-slate-200 text-slate-700',
                                            default => 'bg-slate-100 text-slate-600',
                                        };
                                    @endphp
                                    <tr class="hover:bg-slate-50/70 transition-colors">
                                        <td class="px-6 py-4 text-sm text-slate-900">
                                            <div class="font-semibold">{{ $transaction->transaction_id }}</div>
                                            <div class="text-xs text-slate-500">{{ $transaction->order_id }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-700">
                                            <div>{{ $transaction->customer_name }}</div>
                                            <div class="text-xs text-slate-500">{{ $transaction->customer_email }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-700">
                                            {{ strtoupper($transaction->payment_method ?? '-') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-900">
                                            Rp {{ number_format($transaction->total_amount ?? $transaction->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusClass }}">{{ strtoupper($status) }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            <a href="{{ route('client.transactions.show', $transaction->transaction_id) }}" class="rounded-xl border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-700 hover:bg-slate-50">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-6 text-center text-slate-500">No transactions found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="bg-slate-50/80 px-6 py-4 border-t border-slate-200">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
