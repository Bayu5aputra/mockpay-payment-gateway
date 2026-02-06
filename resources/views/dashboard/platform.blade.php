<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
                <div class="flex flex-col gap-3">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Platform Admin</p>
                    <h1 class="text-4xl font-semibold text-slate-900">Platform Overview</h1>
                    <p class="text-sm text-slate-600">Tenant lifecycle and plan visibility only.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Tenants</p>
                        <p class="mt-3 text-3xl font-semibold text-slate-900">{{ number_format($tenantCount) }}</p>
                        <p class="text-xs text-slate-500 mt-2">Total registered tenants</p>
                    </div>
                    <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Pending Upgrades</p>
                        <p class="mt-3 text-3xl font-semibold text-slate-900">{{ number_format($pendingUpgradeCount) }}</p>
                        <p class="text-xs text-slate-500 mt-2">Awaiting approval</p>
                    </div>
                    <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Plan Split</p>
                        <div class="mt-3 space-y-2 text-sm text-slate-700">
                            <div class="flex items-center justify-between">
                                <span>Free</span>
                                <span class="font-semibold">{{ number_format($planCounts['free']) }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Pro</span>
                                <span class="font-semibold">{{ number_format($planCounts['pro']) }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Enterprise</span>
                                <span class="font-semibold">{{ number_format($planCounts['enterprise']) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                    <p class="text-sm text-slate-600">
                        Platform admin does not access tenant operational data, transactions, or webhook payloads.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
