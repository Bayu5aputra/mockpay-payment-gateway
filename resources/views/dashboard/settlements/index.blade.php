<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Settlements</h1>
            <p class="text-gray-600">View your completed settlement transactions</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-xl shadow p-5 border-l-4 border-blue-500">
                <p class="text-sm text-gray-500">Total Settlements</p>
                <p class="text-2xl font-semibold text-gray-900">{{ number_format($totals['count']) }}</p>
            </div>
            <div class="bg-white rounded-xl shadow p-5 border-l-4 border-green-500">
                <p class="text-sm text-gray-500">Gross Amount</p>
                <p class="text-2xl font-semibold text-gray-900">Rp {{ number_format($totals['gross'], 0, ',', '.') }}</p>
            </div>
            <div class="bg-white rounded-xl shadow p-5 border-l-4 border-amber-500">
                <p class="text-sm text-gray-500">Total Fees</p>
                <p class="text-2xl font-semibold text-gray-900">Rp {{ number_format($totals['fee'], 0, ',', '.') }}</p>
            </div>
            <div class="bg-white rounded-xl shadow p-5 border-l-4 border-purple-500">
                <p class="text-sm text-gray-500">Net Amount</p>
                <p class="text-2xl font-semibold text-gray-900">Rp {{ number_format($totals['net'], 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <form method="GET" action="{{ route('dashboard.settlements.index') }}" class="grid grid-cols-1 md:grid-cols-6 gap-4 items-end">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Date From</label>
                    <input type="date" name="start_date" value="{{ $filters['start_date'] ?? '' }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Date To</label>
                    <input type="date" name="end_date" value="{{ $filters['end_date'] ?? '' }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
                <div>
                    <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700">
                        Apply
                    </button>
                </div>
                <div>
                    <a href="{{ route('dashboard.settlements.index') }}" class="block w-full text-center px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Settlement Date</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Transaction ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Order ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Fee</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Net</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($settlements as $transaction)
                            @php
                                $settledDate = $transaction->settled_at ? $transaction->settled_at->format('Y-m-d') : $transaction->created_at->format('Y-m-d');
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $settledDate }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $transaction->transaction_id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $transaction->order_id }}</td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">Rp {{ number_format($transaction->fee ?? 0, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">Rp {{ number_format(($transaction->amount - ($transaction->fee ?? 0)), 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <a href="{{ route('dashboard.settlements.show', $settledDate) }}" class="text-purple-600 hover:text-purple-700 font-medium">View Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500">No settlements found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-600">
                        Showing <span class="font-semibold">{{ $settlements->firstItem() ?? 0 }}</span> to <span class="font-semibold">{{ $settlements->lastItem() ?? 0 }}</span> of <span class="font-semibold">{{ $settlements->total() }}</span> results
                    </p>
                    <div>
                        {{ $settlements->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between">
            <a href="{{ route('dashboard.settlements.bank-account') }}" class="text-sm font-medium text-purple-600 hover:text-purple-700">
                Manage Bank Account
            </a>
        </div>
            </div>
        </div>
    </div>
</x-app-layout>
