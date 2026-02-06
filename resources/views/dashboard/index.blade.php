<x-app-layout>
    @php
        $merchantUser = Auth::guard('merchant')->user();
        $periodLabel = $period === 'today' ? 'today' : 'this period';
        $totalSimulations = (int) ($statistics['total_transactions'] ?? 0);
        $successCount = (int) ($statistics['settlement'] ?? 0);
        $successRate = (float) ($statistics['success_rate'] ?? 0);
        $pendingCount = (int) ($statistics['pending'] ?? 0);
        $pendingAmount = (float) ($statistics['pending_amount'] ?? 0);
        $totalAmount = (float) ($statistics['total_amount'] ?? 0);
        $transactionChange = (float) ($changes['transactions'] ?? 0);
        $amountChange = (float) ($changes['amount'] ?? 0);
        $successRing = min(100, max(0, (int) round($successRate)));
        $pendingRate = $totalSimulations > 0 ? min(100, (int) round(($pendingCount / $totalSimulations) * 100)) : 0;
    @endphp

    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Platform Admin</p>
                        <h1 class="text-4xl font-semibold text-slate-900 mt-2">Merchant Analytics</h1>
                        <p class="text-sm text-slate-500 mt-2">Overview of platform usage {{ $periodLabel }}.</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <div class="inline-flex items-center gap-3 rounded-full bg-white/90 px-4 py-2 text-sm font-medium text-slate-700 shadow-sm border border-white">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-white text-xs font-semibold">
                                {{ strtoupper(substr(trim($merchantUser?->name ?? 'M'), 0, 1)) }}
                            </span>
                            <span class="text-slate-700">{{ $merchantUser?->email }}</span>
                        </div>
                        <a href="{{ route('dashboard.upgrade-requests.index') }}" class="inline-flex items-center rounded-full bg-slate-900 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 transition">
                            Review Upgrade Requests
                        </a>
                        <a href="{{ route('dashboard.customers.index') }}" class="inline-flex items-center rounded-full border border-slate-200 bg-white/90 px-5 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-white transition">
                            View Clients
                        </a>
                    </div>
                </div>

                <div class="rounded-[28px] bg-white/80 border border-white px-6 py-4 text-sm text-slate-600">
                    Merchant accounts manage users, plan approvals, and overall usage. Client teams control their own simulation outcomes and integrations.
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <div class="lg:col-span-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="rounded-[32px] bg-gradient-to-br from-[#111827] via-[#1f2937] to-[#0f172a] p-6 text-white shadow-[0_25px_60px_rgba(15,23,42,0.28)]">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm uppercase tracking-widest text-white/70">Total Simulations</p>
                                    <span class="text-xs text-white/60">{{ $periodLabel }}</span>
                                </div>
                                <div class="mt-6 text-4xl font-semibold">{{ number_format($totalSimulations) }}</div>
                                <p class="mt-2 text-sm {{ $transactionChange >= 0 ? 'text-emerald-300' : 'text-rose-300' }}">
                                    {{ $transactionChange >= 0 ? '+' : '' }}{{ number_format($transactionChange, 2) }}% from last period
                                </p>
                                <div class="mt-6 h-16">
                                    <svg viewBox="0 0 240 60" class="h-full w-full" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 40C20 20 40 20 60 32C80 44 100 56 120 34C140 12 160 12 180 24C200 36 220 40 240 20" stroke="rgba(255,255,255,0.7)" stroke-width="3" stroke-linecap="round"/>
                                        <path d="M0 50C20 30 40 28 60 40C80 52 100 60 120 42C140 24 160 22 180 30C200 38 220 44 240 30" stroke="rgba(255,255,255,0.4)" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </div>
                                <div class="mt-6 grid grid-cols-3 gap-4 text-xs">
                                    <div>
                                        <p class="text-white/70">Success</p>
                                        <p class="font-semibold">{{ number_format($successCount) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-white/70">Pending</p>
                                        <p class="font-semibold">{{ number_format($pendingCount) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-white/70">Rate</p>
                                        <p class="font-semibold">{{ number_format($successRate, 2) }}%</p>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-[32px] bg-white p-6 shadow-sm border border-white/70">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-semibold text-slate-700">Success Rate</p>
                                    <span class="text-xs text-slate-400">Last 30 days</span>
                                </div>
                                <div class="mt-6 flex items-center gap-6">
                                    <div class="relative h-28 w-28">
                                        <div class="h-28 w-28 rounded-full" style="background: conic-gradient(#111827 {{ $successRing }}%, #f1f1f1 0)"></div>
                                        <div class="absolute inset-3 rounded-full bg-white flex items-center justify-center">
                                            <span class="text-xl font-semibold text-slate-900">{{ number_format($successRate, 1) }}%</span>
                                        </div>
                                    </div>
                                    <div class="space-y-2 text-sm text-slate-600">
                                        <div class="flex items-center gap-2">
                                            <span class="h-2 w-2 rounded-full bg-slate-900"></span>
                                            Successful simulations
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="h-2 w-2 rounded-full bg-slate-300"></span>
                                            Other outcomes
                                        </div>
                                        <div class="text-xs text-slate-400">{{ number_format($successCount) }} success from {{ number_format($totalSimulations) }}</div>
                                    </div>
                                </div>
                                <div class="mt-4 rounded-2xl bg-slate-50 px-4 py-3 text-xs text-slate-600">
                                    Pending simulations: {{ number_format($pendingCount) }} ({{ $pendingRate }}%)
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                                <div class="flex items-center justify-between mb-6">
                                    <h2 class="text-lg font-semibold text-slate-900">Simulation Trends</h2>
                                    <span class="text-xs text-slate-400">7 days</span>
                                </div>
                                @php
                                    $max = max(array_merge($chartData['transactions'] ?? [0], $chartData['success'] ?? [0], [1]));
                                @endphp
                                <div class="h-56 flex items-end justify-between gap-2">
                                    @forelse($chartData['transactions'] as $index => $value)
                                        @php
                                            $success = $chartData['success'][$index] ?? 0;
                                            $heightSuccess = $max > 0 ? round(($success / $max) * 100) : 0;
                                            $heightTotal = $max > 0 ? round(($value / $max) * 100) : 0;
                                        @endphp
                                        <div class="flex-1 flex flex-col justify-end space-y-2">
                                            <div class="bg-gradient-to-t from-slate-900 to-slate-700 rounded-t-lg" style="height: {{ $heightSuccess }}%"></div>
                                            <div class="bg-gradient-to-t from-slate-200 to-slate-100 rounded-t-lg" style="height: {{ $heightTotal }}%"></div>
                                        </div>
                                    @empty
                                        <div class="text-center text-sm text-slate-500 w-full">No data yet.</div>
                                    @endforelse
                                </div>
                                <div class="flex items-center justify-center space-x-6 mt-6">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-slate-200 rounded-full mr-2"></div>
                                        <span class="text-xs text-slate-600">Total</span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-slate-800 rounded-full mr-2"></div>
                                        <span class="text-xs text-slate-600">Successful</span>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                                <div class="flex items-center justify-between mb-6">
                                    <h2 class="text-lg font-semibold text-slate-900">Method Distribution</h2>
                                    <span class="text-xs text-slate-400">All time</span>
                                </div>
                                @if(count($distribution) === 0)
                                    <p class="text-sm text-slate-500">No payment method data yet.</p>
                                @else
                                    <div class="space-y-4">
                                        @foreach($distribution as $item)
                                            @php
                                                $name = $item['method'] ? ucwords(str_replace('_', ' ', $item['method'])) : 'Unknown';
                                                $percentage = $item['percentage'] ?? 0;
                                            @endphp
                                            <div>
                                                <div class="flex items-center justify-between mb-2">
                                                    <span class="text-sm font-medium text-slate-700">{{ $name }}</span>
                                                    <span class="text-sm font-semibold text-slate-900">{{ number_format($percentage, 2) }}%</span>
                                                </div>
                                                <div class="w-full bg-slate-100 rounded-full h-2">
                                                    <div class="bg-slate-900 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-lg font-semibold text-slate-900">Recent Activity</h2>
                                <span class="text-xs text-slate-500">Last 5 transactions</span>
                            </div>
                            <div class="space-y-4">
                                @forelse($recentTransactions as $transaction)
                                    @php
                                        $status = $transaction->status ?? 'pending';
                                        $statusClass = match($status) {
                                            'settlement', 'processing' => 'bg-emerald-100 text-emerald-700',
                                            'pending' => 'bg-amber-100 text-amber-700',
                                            'failed', 'cancelled', 'expired' => 'bg-rose-100 text-rose-700',
                                            'refund', 'refunded' => 'bg-slate-200 text-slate-700',
                                            default => 'bg-slate-100 text-slate-600',
                                        };
                                        $method = $transaction->payment_method ? ucwords(str_replace('_', ' ', $transaction->payment_method)) : '-';
                                    @endphp
                                    <div class="flex flex-col gap-3 rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3 sm:flex-row sm:items-center sm:justify-between">
                                        <div>
                                            <p class="text-sm font-semibold text-slate-900">{{ $transaction->transaction_id }}</p>
                                            <p class="text-xs text-slate-500">{{ $transaction->customer_name }} · {{ $method }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-semibold text-slate-900">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>
                                            <div class="flex items-center justify-end gap-2">
                                                <span class="inline-flex items-center rounded-full px-2 py-1 text-[10px] font-semibold uppercase {{ $statusClass }}">{{ $status }}</span>
                                                <span class="text-xs text-slate-500">{{ $transaction->created_at->format('d M Y H:i') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-6 text-sm text-slate-500">No recent transactions yet.</div>
                                @endforelse
                            </div>
                            <div class="mt-4 text-right">
                                <a href="{{ route('dashboard.transactions.index') }}" class="text-sm font-semibold text-slate-700 hover:text-slate-900">View all transactions</a>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-4 space-y-6">
                        <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-slate-700">Simulated Volume</p>
                                <span class="text-xs text-slate-400">All time</span>
                            </div>
                            <div class="mt-4 text-3xl font-semibold text-slate-900">Rp {{ number_format($totalAmount, 0, ',', '.') }}</div>
                            <div class="mt-2 text-sm {{ $amountChange >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                {{ $amountChange >= 0 ? '+' : '' }}{{ number_format($amountChange, 2) }}% from last period
                            </div>
                            <div class="mt-4 h-2 w-full rounded-full bg-slate-100">
                                <div class="h-2 rounded-full bg-slate-900" style="width: {{ $successRing }}%"></div>
                            </div>
                        </div>

                        <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-slate-700">Pending Transactions</p>
                                <span class="text-xs text-slate-400">{{ number_format($pendingCount) }} pending</span>
                            </div>
                            <div class="mt-4 text-3xl font-semibold text-slate-900">Rp {{ number_format($pendingAmount, 0, ',', '.') }}</div>
                            <div class="mt-4 h-2 w-full rounded-full bg-slate-100">
                                <div class="h-2 rounded-full bg-amber-400" style="width: {{ $pendingRate }}%"></div>
                            </div>
                            <div class="mt-2 text-xs text-slate-400">{{ $pendingRate }}% of total simulations</div>
                        </div>

                        <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-slate-700">Total Clients</p>
                                <span class="text-xs text-slate-400">Active accounts</span>
                            </div>
                            <div class="mt-4 text-3xl font-semibold text-slate-900">{{ number_format($activeClients) }}</div>
                            <div class="mt-2 text-xs text-slate-400">Registered client workspaces</div>
                        </div>

                        <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-slate-700">Pending Upgrades</p>
                                <span class="text-xs text-slate-400">Needs review</span>
                            </div>
                            <div class="mt-4 text-3xl font-semibold text-slate-900">{{ number_format($pendingUpgradeCount) }}</div>
                            <a href="{{ route('dashboard.upgrade-requests.index') }}" class="mt-4 inline-flex items-center rounded-full bg-slate-900 px-4 py-2 text-xs font-semibold text-white hover:bg-slate-800 transition">
                                Review Requests
                            </a>
                        </div>

                        <div class="rounded-[28px] bg-slate-900 p-6 text-white shadow-sm">
                            <p class="text-sm uppercase tracking-widest text-white/60">Quick Actions</p>
                            <div class="mt-4 space-y-3">
                                <a href="{{ route('dashboard.transactions.index') }}" class="flex items-center justify-between rounded-xl bg-white/10 px-4 py-3 text-sm font-semibold text-white hover:bg-white/20 transition">
                                    View Transactions
                                </a>
                                <a href="{{ route('dashboard.customers.index') }}" class="flex items-center justify-between rounded-xl bg-white/10 px-4 py-3 text-sm font-semibold text-white hover:bg-white/20 transition">
                                    Manage Clients
                                </a>
                                <a href="{{ route('docs.index') }}" class="flex items-center justify-between rounded-xl bg-white/10 px-4 py-3 text-sm font-semibold text-white hover:bg-white/20 transition">
                                    Documentation
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
