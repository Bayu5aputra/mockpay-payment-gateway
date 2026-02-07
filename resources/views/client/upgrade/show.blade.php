<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Upgrade Request</p>
                        <h1 class="text-4xl font-semibold text-slate-900 mt-2">Upgrade Details</h1>
                        <p class="text-sm text-slate-600 mt-2">Track your request status, invoice, and proof documents.</p>
                    </div>
                    <a href="{{ route('client.upgrade-requests.index') }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:text-slate-900 hover:border-slate-300 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Upgrade
                    </a>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 bg-white/80 border border-white/70 rounded-[28px] shadow-sm p-6">
                        <div class="flex flex-wrap items-center justify-between gap-6 mb-6">
                            <div>
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Status</p>
                                @if($upgradeRequest->status === 'approved')
                                    <span class="inline-flex mt-2 px-3 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/70">Approved</span>
                                @elseif($upgradeRequest->status === 'rejected')
                                    <span class="inline-flex mt-2 px-3 py-1 text-xs font-semibold rounded-full bg-rose-50 text-rose-700 border border-rose-200/70">Rejected</span>
                                @else
                                    <span class="inline-flex mt-2 px-3 py-1 text-xs font-semibold rounded-full bg-amber-50 text-amber-700 border border-amber-200/70">Pending</span>
                                @endif
                            </div>
                            <div class="text-right">
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Invoice</p>
                                <p class="text-sm font-semibold text-slate-800 mt-2">{{ $upgradeRequest->invoice_number ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Plan</p>
                                <p class="text-lg font-semibold text-slate-900 uppercase mt-2">{{ $upgradeRequest->plan }}</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Total</p>
                                <p class="text-lg font-semibold text-slate-900 mt-2">Rp {{ number_format($upgradeRequest->total_amount, 0, ',', '.') }}</p>
                            </div>
                            @if($upgradeRequest->rejection_reason)
                                <div class="rounded-2xl border border-rose-200/70 bg-rose-50 px-4 py-3">
                                    <p class="text-xs uppercase tracking-[0.2em] text-rose-500">Rejection Reason</p>
                                    <p class="text-sm text-rose-700 mt-2">{{ $upgradeRequest->rejection_reason }}</p>
                                </div>
                            @endif
                        </div>

                        <div class="mt-6 flex flex-wrap items-center gap-3">
                            <a href="{{ route('client.upgrade-requests.proof', $upgradeRequest) }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:text-slate-900 hover:border-slate-300 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Download Transfer Proof
                            </a>
                            @if($upgradeRequest->invoice_number)
                                <a href="{{ route('client.upgrade-requests.invoice', $upgradeRequest) }}" class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l2 2 4-4M7 7h10M7 11h4m-6 8h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    Download Invoice
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="bg-white/80 border border-white/70 rounded-[28px] shadow-sm p-6 space-y-4">
                        <h2 class="text-lg font-semibold text-slate-900">Cost Summary</h2>
                        <div class="space-y-2 text-sm text-slate-600">
                            <div class="flex items-center justify-between">
                                <span>Plan Price</span>
                                <span>Rp {{ number_format($upgradeRequest->base_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Tax ({{ number_format($upgradeRequest->tax_rate, 2) }}%)</span>
                                <span>Rp {{ number_format($upgradeRequest->tax_amount, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Admin Fee</span>
                                <span>Rp {{ number_format($upgradeRequest->admin_fee, 0, ',', '.') }}</span>
                            </div>
                            <div class="border-t border-slate-200 pt-2 flex items-center justify-between font-semibold text-slate-900">
                                <span>Total</span>
                                <span>Rp {{ number_format($upgradeRequest->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="border-t border-slate-200 pt-4">
                            <h3 class="text-sm font-semibold text-slate-900 mb-2">Destination Accounts</h3>
                            <div class="space-y-2 text-sm text-slate-600">
                                @foreach($banks as $bank)
                                    <div class="flex items-center justify-between">
                                        <span>{{ $bank['name'] }}</span>
                                        <span>{{ $bank['account_number'] ?? 'Not set' }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
