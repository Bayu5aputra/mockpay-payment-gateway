<x-app-layout>
    <div class="p-8">
        @php
            $merchantUser = Auth::guard('merchant')->user();
        @endphp
        <div class="mb-8 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-xs uppercase tracking-widest text-slate-400">Platform Admin</p>
                <h1 class="text-3xl font-bold text-gray-900 mt-2">Welcome back, {{ $merchantUser?->name }}!</h1>
                <p class="text-gray-600">Overview of platform usage {{ $period === 'today' ? 'today' : 'this period' }}.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('dashboard.upgrade-requests.index') }}" class="inline-flex items-center gap-2 rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800 transition">
                    Review Upgrade Requests
                </a>
                <a href="{{ route('dashboard.customers.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-white transition">
                    View Clients
                </a>
            </div>
        </div>

        <div class="mb-8 bg-blue-50 border border-blue-200 rounded-2xl p-4 text-blue-900">
            <p class="text-sm">
                Merchant accounts manage users, plan approvals, and overall usage. Client teams control their own simulation outcomes and integrations.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-slate-400 mb-1">Total Simulations</p>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($statistics['total_transactions']) }}</p>
                        <p class="text-sm {{ $changes['transactions'] >= 0 ? 'text-green-600' : 'text-red-600' }} mt-2">
                            {{ $changes['transactions'] >= 0 ? '+' : '' }}{{ number_format($changes['transactions'], 2) }}% from last period
                        </p>
                    </div>
                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-slate-400 mb-1">Successful Simulations</p>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($statistics['settlement']) }}</p>
                        <p class="text-sm text-green-600 mt-2">{{ number_format($statistics['success_rate'], 2) }}% success rate</p>
                    </div>
                    <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-slate-400 mb-1">Simulated Volume</p>
                        <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($statistics['total_amount'], 0, ',', '.') }}</p>
                        <p class="text-sm {{ $changes['amount'] >= 0 ? 'text-green-600' : 'text-red-600' }} mt-2">
                            {{ $changes['amount'] >= 0 ? '+' : '' }}{{ number_format($changes['amount'], 2) }}% from last period
                        </p>
                    </div>
                    <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-slate-400 mb-1">Pending Transactions</p>
                        <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($statistics['pending_amount'] ?? 0, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-600 mt-2">{{ number_format($statistics['pending']) }} transactions</p>
                    </div>
                    <div class="w-14 h-14 bg-amber-100 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-slate-400 mb-1">Pending Upgrade Requests</p>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($pendingUpgradeCount) }}</p>
                        <p class="text-sm text-gray-600 mt-2">Needs review</p>
                    </div>
                    <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-slate-400 mb-1">Total Clients</p>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($activeClients) }}</p>
                        <p class="text-sm text-gray-600 mt-2">Registered accounts</p>
                    </div>
                    <div class="w-14 h-14 bg-indigo-100 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Simulation Overview</h2>
                    <div class="flex space-x-2">
                        <button class="px-4 py-2 bg-purple-600 text-white rounded-lg text-sm font-medium">7 Days</button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200">30 Days</button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200">90 Days</button>
                    </div>
                </div>
                @php
                    $max = max(array_merge($chartData['transactions'] ?? [0], $chartData['success'] ?? [0], [1]));
                @endphp
                <div class="h-80 flex items-end justify-between space-x-2">
                    @forelse($chartData['transactions'] as $index => $value)
                        @php
                            $success = $chartData['success'][$index] ?? 0;
                            $heightSuccess = $max > 0 ? round(($success / $max) * 100) : 0;
                            $heightTotal = $max > 0 ? round(($value / $max) * 100) : 0;
                        @endphp
                        <div class="flex-1 flex flex-col justify-end space-y-2">
                            <div class="bg-gradient-to-t from-purple-500 to-purple-400 rounded-t-lg" style="height: {{ $heightSuccess }}%"></div>
                            <div class="bg-gradient-to-t from-blue-500 to-blue-400 rounded-t-lg" style="height: {{ $heightTotal }}%"></div>
                        </div>
                    @empty
                        <div class="text-center text-gray-500 w-full">No data yet.</div>
                    @endforelse
                </div>
                <div class="flex items-center justify-center space-x-6 mt-6">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600">Total</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-purple-500 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600">Successful</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Method Distribution</h2>
                @if(count($distribution) === 0)
                    <p class="text-sm text-gray-500">No payment method data yet.</p>
                @else
                    <div class="space-y-4">
                        @foreach($distribution as $item)
                            @php
                                $name = $item['method'] ? ucwords(str_replace('_', ' ', $item['method'])) : 'Unknown';
                                $percentage = $item['percentage'] ?? 0;
                            @endphp
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-700">{{ $name }}</span>
                                    <span class="text-sm font-bold text-gray-900">{{ number_format($percentage, 2) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">Recent Simulations</h2>
                <a href="{{ route('dashboard.transactions.index') }}" class="text-purple-600 hover:text-purple-700 font-medium text-sm">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Transaction ID</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Method</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($recentTransactions as $transaction)
                            @php
                                $statusMap = [
                                    'pending' => ['label' => 'Pending', 'class' => 'bg-amber-100 text-amber-800'],
                                    'processing' => ['label' => 'Processing', 'class' => 'bg-blue-100 text-blue-800'],
                                    'settlement' => ['label' => 'Success', 'class' => 'bg-green-100 text-green-800'],
                                    'failed' => ['label' => 'Failed', 'class' => 'bg-red-100 text-red-800'],
                                    'expired' => ['label' => 'Expired', 'class' => 'bg-gray-100 text-gray-800'],
                                    'cancelled' => ['label' => 'Cancelled', 'class' => 'bg-gray-100 text-gray-800'],
                                    'refund' => ['label' => 'Refunded', 'class' => 'bg-purple-100 text-purple-800'],
                                ];
                                $status = $statusMap[$transaction->status] ?? ['label' => ucfirst($transaction->status), 'class' => 'bg-gray-100 text-gray-800'];
                                $method = $transaction->payment_method ? ucwords(str_replace('_', ' ', $transaction->payment_method)) : '-';
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    <a href="{{ route('dashboard.transactions.show', $transaction->transaction_id) }}" class="text-purple-600 hover:text-purple-700">
                                        {{ $transaction->transaction_id }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $transaction->customer_name }}</td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $method }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $status['class'] }}">{{ $status['label'] }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $transaction->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-6 text-center text-gray-500">No transactions yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
