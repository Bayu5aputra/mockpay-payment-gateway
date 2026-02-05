<x-app-layout>
    <div class="p-8">
        <a href="{{ route('dashboard.customers.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Customers
        </a>

        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $customerInfo['name'] ?? 'Customer' }}</h1>
                    <p class="text-gray-600">{{ $customerInfo['email'] }}</p>
                    <p class="text-gray-600">{{ $customerInfo['phone'] ?? '-' }}</p>
                </div>
                <div class="mt-4 md:mt-0 grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-xs text-gray-500">Total Transactions</p>
                        <p class="text-lg font-semibold text-gray-900">{{ number_format($stats['total_transactions']) }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-xs text-gray-500">Total Amount</p>
                        <p class="text-lg font-semibold text-gray-900">Rp {{ number_format($stats['total_amount'], 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Transaction ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Order ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Method</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($transactions as $transaction)
                            @php
                                $statusMap = [
                                    'settlement' => ['label' => 'Settlement', 'class' => 'bg-green-100 text-green-800'],
                                    'pending' => ['label' => 'Pending', 'class' => 'bg-amber-100 text-amber-800'],
                                    'processing' => ['label' => 'Processing', 'class' => 'bg-blue-100 text-blue-800'],
                                    'cancelled' => ['label' => 'Cancelled', 'class' => 'bg-gray-100 text-gray-800'],
                                    'expired' => ['label' => 'Expired', 'class' => 'bg-red-100 text-red-800'],
                                    'failed' => ['label' => 'Failed', 'class' => 'bg-red-100 text-red-800'],
                                    'refunded' => ['label' => 'Refunded', 'class' => 'bg-purple-100 text-purple-800'],
                                ];
                                $statusMeta = $statusMap[$transaction->status] ?? ['label' => ucfirst($transaction->status), 'class' => 'bg-gray-100 text-gray-800'];
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $transaction->transaction_id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $transaction->order_id }}</td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ strtoupper($transaction->payment_method ?? '-') }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusMeta['class'] }}">
                                        {{ $statusMeta['label'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $transaction->created_at->format('M d, Y H:i') }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <a href="{{ route('dashboard.transactions.show', $transaction->transaction_id) }}" class="text-purple-600 hover:text-purple-700 font-medium">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500">No transactions yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-600">
                        Showing <span class="font-semibold">{{ $transactions->firstItem() ?? 0 }}</span> to <span class="font-semibold">{{ $transactions->lastItem() ?? 0 }}</span> of <span class="font-semibold">{{ $transactions->total() }}</span> results
                    </p>
                    <div>
                        {{ $transactions->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
