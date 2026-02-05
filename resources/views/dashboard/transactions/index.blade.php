<x-app-layout>
    <div class="p-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Transactions</h1>
            <p class="text-gray-600">View and manage all your payment transactions</p>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <form method="GET" action="{{ route('dashboard.transactions.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Search</label>
                        <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Transaction ID, Order ID, Customer..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <option value="">All Status</option>
                            @php
                                $statusOptions = ['pending', 'processing', 'settlement', 'cancelled', 'expired', 'failed', 'refunded'];
                            @endphp
                            @foreach ($statusOptions as $status)
                                <option value="{{ $status }}" @selected(($filters['status'] ?? '') === $status)>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Payment Method</label>
                        <select name="payment_method" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <option value="">All Methods</option>
                            <option value="bank_transfer" @selected(($filters['payment_method'] ?? '') === 'bank_transfer')>Bank Transfer</option>
                            <option value="ewallet" @selected(($filters['payment_method'] ?? '') === 'ewallet')>E-Wallet</option>
                            <option value="credit_card" @selected(($filters['payment_method'] ?? '') === 'credit_card')>Credit Card</option>
                            <option value="qris" @selected(($filters['payment_method'] ?? '') === 'qris')>QRIS</option>
                            <option value="retail" @selected(($filters['payment_method'] ?? '') === 'retail')>Retail</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Date From</label>
                        <input type="date" name="start_date" value="{{ $filters['start_date'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Date To</label>
                        <input type="date" name="end_date" value="{{ $filters['end_date'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <label class="text-sm text-gray-600">Per Page</label>
                        <select name="per_page" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                            @foreach ([10, 15, 25, 50] as $size)
                                <option value="{{ $size }}" @selected((int)($filters['per_page'] ?? 15) === $size)>{{ $size }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('dashboard.transactions.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">Reset</a>
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700">Apply Filters</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Transactions Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Transaction ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Order ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Payment Method</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
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
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $transaction->transaction_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $transaction->order_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $transaction->customer_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $transaction->customer_email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ strtoupper($transaction->payment_method ?? '-') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusMeta['class'] }}">
                                        {{ $statusMeta['label'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $transaction->created_at->format('M d, Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('dashboard.transactions.show', $transaction->transaction_id) }}" class="text-purple-600 hover:text-purple-700 font-medium">View</a>
                                        @if ($transaction->canBeCancelled())
                                            <form method="POST" action="{{ route('dashboard.transactions.cancel', $transaction->transaction_id) }}">
                                                @csrf
                                                <button type="submit" class="text-amber-600 hover:text-amber-700 font-medium">Cancel</button>
                                            </form>
                                        @endif
                                        @if ($transaction->canBeRefunded())
                                            <form method="POST" action="{{ route('dashboard.transactions.refund', $transaction->transaction_id) }}">
                                                @csrf
                                                <button type="submit" class="text-red-600 hover:text-red-700 font-medium">Refund</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-8 text-center text-sm text-gray-500">No transactions found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
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

        <!-- Export Options -->
        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('dashboard.transactions.export', request()->query()) }}" class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Export CSV
            </a>
        </div>
    </div>
</x-app-layout>
