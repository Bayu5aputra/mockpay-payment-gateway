<x-app-layout>
    <div class="p-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Customers</h1>
            <p class="text-gray-600">View and manage your registered client accounts</p>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <form method="GET" action="{{ route('dashboard.customers.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                <div class="md:col-span-8">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Search</label>
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Name, email"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
                <div class="md:col-span-2">
                    <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700">
                        Search
                    </button>
                </div>
                <div class="md:col-span-2">
                    <a href="{{ route('dashboard.customers.index') }}" class="block w-full text-center px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
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
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Client</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Transactions</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total Amount</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Last Activity</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($customers as $customer)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $customer->name ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $customer->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ number_format($customer->total_transactions ?? 0) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">Rp {{ number_format($customer->total_amount ?? 0, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    @if($customer->last_transaction_at)
                                        {{ \Carbon\Carbon::parse($customer->last_transaction_at)->format('M d, Y H:i') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <a href="{{ route('dashboard.customers.show', base64_encode($customer->email)) }}" class="text-purple-600 hover:text-purple-700 font-medium">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">No clients found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-600">
                        Showing <span class="font-semibold">{{ $customers->firstItem() ?? 0 }}</span> to <span class="font-semibold">{{ $customers->lastItem() ?? 0 }}</span> of <span class="font-semibold">{{ $customers->total() }}</span> results
                    </p>
                    <div>
                        {{ $customers->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
