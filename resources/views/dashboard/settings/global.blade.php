<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
                <div class="flex flex-col gap-2">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Platform Admin</p>
                    <h1 class="text-4xl font-semibold text-slate-900">Global Configuration</h1>
                    <p class="text-sm text-slate-600">Manage channel availability, baseline fee, and baseline rate limit.</p>
                </div>

                @if(session('success'))
                    <div class="rounded-2xl border border-emerald-200 bg-emerald-50/80 p-4">
                        <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4">Platform Baseline</h2>
                    <form method="POST" action="{{ route('dashboard.settings.global.defaults.update') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        @csrf
                        @method('PATCH')
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Fee Percentage</label>
                            <input type="number" name="baseline_fee_percentage" step="0.01" min="0" max="100" value="{{ $defaults['baseline_fee_percentage'] ?? 0 }}" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Fee Fixed</label>
                            <input type="number" name="baseline_fee_fixed" step="0.01" min="0" value="{{ $defaults['baseline_fee_fixed'] ?? 0 }}" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Rate Limit (daily)</label>
                            <input type="number" name="baseline_rate_limit" min="1" value="{{ $defaults['baseline_rate_limit'] ?? 500 }}" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700">
                        </div>
                        <div class="flex items-end">
                            <button class="rounded-2xl bg-slate-900 text-white px-5 py-2 text-sm font-semibold hover:bg-slate-800 transition">Save Baseline</button>
                        </div>
                    </form>
                </div>

                <div class="rounded-[28px] bg-white shadow-sm border border-white/70 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-semibold text-slate-900">Payment Channel Availability & Fee</h2>
                    </div>
                    <div class="divide-y divide-slate-200">
                        @foreach($channels as $channel)
                            <form method="POST" action="{{ route('dashboard.settings.global.channels.update', $channel) }}" class="grid grid-cols-1 md:grid-cols-6 gap-3 px-6 py-4 items-end">
                                @csrf
                                @method('PATCH')
                                <div class="md:col-span-2">
                                    <p class="text-sm font-semibold text-slate-900">{{ $channel->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $channel->code }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs text-slate-600 mb-1">Enabled</label>
                                    <select name="is_active" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm text-slate-700">
                                        <option value="1" @selected($channel->is_active)>Yes</option>
                                        <option value="0" @selected(!$channel->is_active)>No</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs text-slate-600 mb-1">Fee %</label>
                                    <input type="number" name="fee_merchant_percentage" step="0.01" min="0" max="100" value="{{ $channel->fee_merchant_percentage }}" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm text-slate-700">
                                </div>
                                <div>
                                    <label class="block text-xs text-slate-600 mb-1">Fee Fixed</label>
                                    <input type="number" name="fee_merchant_fixed" step="0.01" min="0" value="{{ $channel->fee_merchant_fixed }}" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm text-slate-700">
                                </div>
                                <div class="text-right">
                                    <button class="rounded-xl bg-slate-900 px-4 py-2 text-xs font-semibold text-white hover:bg-slate-800 transition">Update</button>
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
