<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
                <div class="flex flex-col gap-3">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Developer Hub</p>
                    <h1 class="text-4xl font-semibold text-slate-900">Developer Tools</h1>
                    <p class="text-sm text-slate-600 max-w-2xl">All MockPay API integration tools for your client account, including docs, logs, and quick links to launch integrations faster.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                    <div class="rounded-[24px] bg-white p-5 border border-white/70 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Transactions Today</p>
                                <p class="text-3xl font-semibold text-slate-900 mt-3">{{ number_format($stats['transactions_today']) }}</p>
                            </div>
                            <div class="h-12 w-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[24px] bg-white p-5 border border-white/70 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Success Rate</p>
                                <p class="text-3xl font-semibold text-slate-900 mt-3">{{ number_format($stats['success_rate'], 2) }}%</p>
                            </div>
                            <div class="h-12 w-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[24px] bg-white p-5 border border-white/70 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Webhook Deliveries</p>
                                <p class="text-3xl font-semibold text-slate-900 mt-3">{{ number_format($stats['webhooks_today']) }}</p>
                            </div>
                            <div class="h-12 w-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[24px] bg-white p-5 border border-white/70 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Active API Keys</p>
                                <p class="text-3xl font-semibold text-slate-900 mt-3">{{ number_format($stats['active_api_keys']) }}</p>
                            </div>
                            <div class="h-12 w-12 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[24px] bg-white p-5 border border-white/70 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">API Requests Today</p>
                                <p class="text-3xl font-semibold text-slate-900 mt-3">{{ number_format($stats['api_requests_today']) }}</p>
                                @if($stats['api_limit'])
                                    <p class="text-xs text-slate-500 mt-2">{{ $stats['api_usage_percent'] }}% of {{ number_format($stats['api_limit']) }} limit</p>
                                @endif
                            </div>
                            <div class="h-12 w-12 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-slate-500 mt-3">
                            Last request: {{ $stats['last_api_request_at'] ? $stats['last_api_request_at']->format('Y-m-d H:i') : '-' }}
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <a href="{{ route('client.developers.api-docs') }}" class="group block rounded-[28px] bg-white border border-white/70 p-6 shadow-sm hover:shadow-[0_20px_40px_rgba(15,23,42,0.12)] transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Docs</p>
                                <h3 class="text-2xl font-semibold text-slate-900 mt-3">API Documentation</h3>
                                <p class="text-sm text-slate-600 mt-2">Complete endpoint reference</p>
                            </div>
                            <div class="h-14 w-14 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('client.developers.code-examples') }}" class="group block rounded-[28px] bg-white border border-white/70 p-6 shadow-sm hover:shadow-[0_20px_40px_rgba(15,23,42,0.12)] transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Samples</p>
                                <h3 class="text-2xl font-semibold text-slate-900 mt-3">Code Examples</h3>
                                <p class="text-sm text-slate-600 mt-2">Ready-to-use integration snippets</p>
                            </div>
                            <div class="h-14 w-14 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                </svg>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('client.developers.logs') }}" class="group block rounded-[28px] bg-white border border-white/70 p-6 shadow-sm hover:shadow-[0_20px_40px_rgba(15,23,42,0.12)] transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Monitoring</p>
                                <h3 class="text-2xl font-semibold text-slate-900 mt-3">Webhook Logs</h3>
                                <p class="text-sm text-slate-600 mt-2">Monitor webhook deliveries</p>
                            </div>
                            <div class="h-14 w-14 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('client.developers.simulator') }}" class="group block rounded-[28px] bg-white border border-white/70 p-6 shadow-sm hover:shadow-[0_20px_40px_rgba(15,23,42,0.12)] transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Simulator</p>
                                <h3 class="text-2xl font-semibold text-slate-900 mt-3">Quick Generator</h3>
                                <p class="text-sm text-slate-600 mt-2">Create sandbox transactions</p>
                            </div>
                            <div class="h-14 w-14 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('client.developers.api-logs') }}" class="group block rounded-[28px] bg-white border border-white/70 p-6 shadow-sm hover:shadow-[0_20px_40px_rgba(15,23,42,0.12)] transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.25em] text-slate-500">API Logs</p>
                                <h3 class="text-2xl font-semibold text-slate-900 mt-3">Request Logs</h3>
                                <p class="text-sm text-slate-600 mt-2">Audit API usage & errors</p>
                            </div>
                            <div class="h-14 w-14 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4">Your API Keys</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-slate-700">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Sandbox Key</p>
                            <p class="font-mono text-slate-900 mt-2 break-all">{{ $sandboxKey?->getFullKey() ?? 'Not generated yet' }}</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Production Key</p>
                            <p class="font-mono text-slate-900 mt-2 break-all">{{ $productionKey?->getFullKey() ?? 'Not generated yet' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
