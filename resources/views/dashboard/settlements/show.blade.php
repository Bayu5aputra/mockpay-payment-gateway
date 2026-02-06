<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
        <a href="{{ route('dashboard.settlements.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Settlements
        </a>

        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Settlement Summary</h1>
                    <p class="text-gray-600">Date: {{ $summary['date'] }}</p>
                </div>
                <div class="mt-4 md:mt-0 grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-xs text-gray-500">Transactions</p>
                        <p class="text-lg font-semibold text-gray-900">{{ number_format($summary['total_transactions']) }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-xs text-gray-500">Gross</p>
                        <p class="text-lg font-semibold text-gray-900">Rp {{ number_format($summary['gross_amount'], 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-xs text-gray-500">Fees</p>
                        <p class="text-lg font-semibold text-gray-900">Rp {{ number_format($summary['total_fee'], 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-xs text-gray-500">Net</p>
                        <p class="text-lg font-semibold text-gray-900">Rp {{ number_format($summary['net_amount'], 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Transaction ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Order ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Fee</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Net</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Payment Method</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($transactions as $transaction)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $transaction->transaction_id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $transaction->order_id }}</td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">Rp {{ number_format($transaction->fee ?? 0, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">Rp {{ number_format(($transaction->amount - ($transaction->fee ?? 0)), 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ strtoupper($transaction->payment_method ?? '-') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">By Payment Method</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($summary['by_payment_method'] as $method => $data)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm text-gray-600 mb-1">{{ strtoupper($method ?? '-') }}</p>
                        <p class="text-sm text-gray-700">Transactions: {{ number_format($data['count']) }}</p>
                        <p class="text-sm text-gray-700">Gross: Rp {{ number_format($data['gross'], 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-700">Fee: Rp {{ number_format($data['fee'], 0, ',', '.') }}</p>
                        <p class="text-sm font-semibold text-gray-900">Net: Rp {{ number_format($data['net'], 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>
        </div>
            </div>
        </div>
    </div>
</x-app-layout>
