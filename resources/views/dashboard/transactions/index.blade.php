# 2. resources/views/dashboard/transactions/index.blade.php
<x-app-layout>
    <div class="p-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Transactions</h1>
            <p class="text-gray-600">View and manage all your payment transactions</p>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Search</label>
                    <input type="text" placeholder="Transaction ID, Customer..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="settlement">Settlement</option>
                        <option value="cancel">Cancel</option>
                        <option value="expire">Expire</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Payment Method</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <option value="">All Methods</option>
                        <option value="virtual_account">Virtual Account</option>
                        <option value="ewallet">E-Wallet</option>
                        <option value="credit_card">Credit Card</option>
                        <option value="qris">QRIS</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Date From</label>
                    <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Date To</label>
                    <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
            </div>
            <div class="mt-4 flex justify-end space-x-3">
                <button class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">Reset</button>
                <button class="px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700">Apply Filters</button>
            </div>
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
                        @for($i = 1; $i <= 15; $i++)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">TRX-20260129-{{ str_pad($i, 5, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">ORD-{{ rand(10000, 99999) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">Customer {{ $i }}</div>
                                <div class="text-sm text-gray-500">customer{{ $i }}@example.com</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">Rp {{ number_format(rand(100000, 5000000), 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                @php
                                    $methods = ['BCA VA', 'Mandiri VA', 'GoPay', 'OVO', 'Credit Card', 'QRIS'];
                                    echo $methods[array_rand($methods)];
                                @endphp
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statuses = [
                                        ['label' => 'Settlement', 'class' => 'bg-green-100 text-green-800'],
                                        ['label' => 'Pending', 'class' => 'bg-amber-100 text-amber-800'],
                                        ['label' => 'Expired', 'class' => 'bg-red-100 text-red-800'],
                                        ['label' => 'Cancel', 'class' => 'bg-gray-100 text-gray-800'],
                                    ];
                                    $status = $statuses[array_rand($statuses)];
                                @endphp
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $status['class'] }}">
                                    {{ $status['label'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                Jan {{ rand(20, 29) }}, 2026 {{ rand(8, 23) }}:{{ str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="#" class="text-purple-600 hover:text-purple-700 font-medium">View Details</a>
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-600">
                        Showing <span class="font-semibold">1</span> to <span class="font-semibold">15</span> of <span class="font-semibold">543</span> results
                    </p>
                    <div class="flex space-x-2">
                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</button>
                        <button class="px-4 py-2 bg-purple-600 text-white rounded-lg text-sm font-medium">1</button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">2</button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">3</button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">Next</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Export Options -->
        <div class="mt-6 flex justify-end space-x-3">
            <button class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Export CSV
            </button>
            <button class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Export PDF
            </button>
        </div>
    </div>
</x-app-layout>