@extends('layouts.app')

@section('title', 'Client Dashboard')

@section('content')
    @php
        $totalSimulations = (int) ($stats['total_payments'] ?? 0);
        $successRate = (float) ($stats['success_rate'] ?? 0);
        $successCount = (int) round($totalSimulations * ($successRate / 100));
        $pendingCount = max(0, $totalSimulations - $successCount);
        $dailyLimit = (int) ($stats['daily_limit'] ?? 0);
        $dailyUsed = (int) ($stats['daily_used'] ?? 0);
        $limitPercent = $dailyLimit > 0 ? min(100, (int) round(($dailyUsed / $dailyLimit) * 100)) : 0;
        $successRing = min(100, max(0, (int) round($successRate)));
        $totalAmount = (float) ($stats['total_amount'] ?? 0);
        $pendingRate = $totalSimulations > 0 ? min(100, (int) round(($pendingCount / $totalSimulations) * 100)) : 0;
        $userBadge = strtoupper(substr(trim($user->name ?? 'U'), 0, 1));
    @endphp

    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Client Analytics</p>
                        <h1 class="text-4xl font-semibold text-slate-900 mt-2">Analytics</h1>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <div class="inline-flex items-center gap-3 rounded-full bg-white/90 px-4 py-2 text-sm font-medium text-slate-700 shadow-sm border border-white">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-white text-xs font-semibold">{{ $userBadge }}</span>
                            <span class="text-slate-700">{{ $user->email }}</span>
                        </div>
                        <div class="relative">
                            <input type="text" placeholder="Search" class="w-48 rounded-full border border-white bg-white/90 px-4 py-2 text-sm text-slate-600 shadow-sm focus:border-slate-300 focus:outline-none">
                        </div>
                        <a href="{{ route('client.api-keys.index') }}" class="inline-flex items-center rounded-full bg-slate-900 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 transition">
                            New Project
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <div class="lg:col-span-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="rounded-[32px] bg-gradient-to-br from-[#ff7a59] via-[#ff6ea9] to-[#ff4fa3] p-6 text-white shadow-[0_25px_60px_rgba(255,79,163,0.28)]">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm uppercase tracking-widest text-white/70">Total Simulations</p>
                                    <span class="text-xs text-white/60">All time</span>
                                </div>
                                <div class="mt-6 text-4xl font-semibold">{{ number_format($totalSimulations) }}</div>
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
                                        <div class="h-28 w-28 rounded-full" style="background: conic-gradient(#ff7a59 {{ $successRing }}%, #f1f1f1 0)"></div>
                                        <div class="absolute inset-3 rounded-full bg-white flex items-center justify-center">
                                            <span class="text-xl font-semibold text-slate-900">{{ number_format($successRate, 1) }}%</span>
                                        </div>
                                    </div>
                                    <div class="space-y-2 text-sm text-slate-600">
                                        <div class="flex items-center gap-2">
                                            <span class="h-2 w-2 rounded-full bg-[#ff7a59]"></span>
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
                                            'refunded' => 'bg-slate-200 text-slate-700',
                                            default => 'bg-slate-100 text-slate-600',
                                        };
                                    @endphp
                                    <div class="flex items-center justify-between rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3">
                                        <div>
                                            <p class="text-sm font-semibold text-slate-900">{{ $transaction->transaction_id }}</p>
                                            <p class="text-xs text-slate-500">{{ $transaction->customer_name }} · {{ $transaction->payment_method }}</p>
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
                        </div>
                    </div>

                    <div class="lg:col-span-4 space-y-6">
                        <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-slate-700">Simulated Volume</p>
                                <span class="text-xs text-slate-400">All time</span>
                            </div>
                            <div class="mt-4 text-3xl font-semibold text-slate-900">Rp {{ number_format($totalAmount, 0, ',', '.') }}</div>
                            <div class="mt-4 h-2 w-full rounded-full bg-slate-100">
                                <div class="h-2 rounded-full bg-slate-900" style="width: {{ $successRing }}%"></div>
                            </div>
                        </div>

                        <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-slate-700">Daily Limit</p>
                                <span class="text-xs text-slate-400">{{ $dailyLimit > 0 ? $dailyLimit . ' max' : 'Unlimited' }}</span>
                            </div>
                            <div class="mt-4">
                                <p class="text-2xl font-semibold text-slate-900">{{ number_format($dailyUsed) }}</p>
                                <p class="text-xs text-slate-500">Used today</p>
                            </div>
                            @if($dailyLimit > 0)
                                <div class="mt-4 h-2 w-full rounded-full bg-slate-100">
                                    <div class="h-2 rounded-full bg-[#ff7a59]" style="width: {{ $limitPercent }}%"></div>
                                </div>
                                <div class="mt-2 text-xs text-slate-400">{{ $limitPercent }}% of daily limit</div>
                            @endif
                        </div>

                        <div class="rounded-[28px] bg-slate-900 p-6 text-white shadow-sm">
                            <p class="text-sm uppercase tracking-widest text-white/60">Quick Actions</p>
                            <div class="mt-4 space-y-3">
                                <a href="{{ route('docs.index') }}" class="flex items-center justify-between rounded-xl bg-white/10 px-4 py-3 text-sm font-semibold text-white hover:bg-white/20 transition">
                                    Documentation
                                </a>
                                <a href="{{ route('client.developers.index') }}" class="flex items-center justify-between rounded-xl bg-white/10 px-4 py-3 text-sm font-semibold text-white hover:bg-white/20 transition">
                                    Developer Tools
                                </a>
                                <a href="{{ route('contact') }}" class="flex items-center justify-between rounded-xl bg-white/10 px-4 py-3 text-sm font-semibold text-white hover:bg-white/20 transition">
                                    Contact Support
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
