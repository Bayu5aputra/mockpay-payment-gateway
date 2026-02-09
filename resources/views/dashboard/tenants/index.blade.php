<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
                <div class="flex flex-col gap-2">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Platform Admin</p>
                    <h1 class="text-4xl font-semibold text-slate-900">Tenant Management</h1>
                    <p class="text-sm text-slate-600">Metadata-level tenant controls only.</p>
                </div>

                @if(session('success'))
                    <div class="rounded-2xl border border-emerald-200 bg-emerald-50/80 p-4">
                        <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Search</label>
                            <input type="text" name="search" value="{{ request('search') }}" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700" placeholder="Tenant ID or Email">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Status</label>
                            <select name="status" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700">
                                <option value="">All</option>
                                <option value="active" @selected(request('status') === 'active')>Active</option>
                                <option value="suspended" @selected(request('status') === 'suspended')>Suspended</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Plan</label>
                            <select name="plan" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700">
                                <option value="">All</option>
                                <option value="free" @selected(request('plan') === 'free')>Free</option>
                                <option value="pro" @selected(request('plan') === 'pro')>Pro</option>
                                <option value="enterprise" @selected(request('plan') === 'enterprise')>Enterprise</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button class="rounded-2xl bg-slate-900 text-white px-5 py-2 text-sm font-semibold hover:bg-slate-800 transition">Apply Filters</button>
                        </div>
                    </form>
                </div>

                <div class="rounded-[28px] bg-white shadow-sm border border-white/70 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-slate-50/70 border-b border-slate-200">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Tenant</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Plan</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Usage Summary</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Created</th>
                                    <th class="px-4 py-3 text-right text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @forelse($tenants as $tenant)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <p class="font-semibold text-slate-900">#{{ $tenant->id }}</p>
                                            <p class="text-xs text-slate-500">{{ $tenant->email }}</p>
                                        </td>
                                        <td class="px-4 py-3 text-slate-700">{{ ucfirst($tenant->status ?? 'active') }}</td>
                                        <td class="px-4 py-3 text-slate-700">{{ strtoupper($tenant->plan ?? 'free') }}</td>
                                        <td class="px-4 py-3 text-xs text-slate-600">
                                            <p>Transactions: {{ number_format($tenant->transactions_count) }}</p>
                                            <p>Webhook Logs: {{ number_format($tenant->webhook_logs_count) }}</p>
                                            <p>API Logs: {{ number_format($tenant->api_request_logs_count) }}</p>
                                        </td>
                                        <td class="px-4 py-3 text-slate-700">{{ $tenant->created_at?->format('Y-m-d') }}</td>
                                        <td class="px-4 py-3">
                                            <div class="flex justify-end gap-2">
                                                <form method="POST" action="{{ route('dashboard.tenants.status.update', $tenant) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="{{ $tenant->status === 'suspended' ? 'active' : 'suspended' }}">
                                                    <button class="rounded-xl border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-700 hover:bg-slate-50">
                                                        {{ $tenant->status === 'suspended' ? 'Activate' : 'Suspend' }}
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('dashboard.tenants.plan.update', $tenant) }}" class="flex gap-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="plan" class="rounded-xl border border-slate-200 px-2 py-1 text-xs text-slate-700">
                                                        <option value="free" @selected($tenant->plan === 'free')>FREE</option>
                                                        <option value="pro" @selected($tenant->plan === 'pro')>PRO</option>
                                                        <option value="enterprise" @selected($tenant->plan === 'enterprise')>ENT</option>
                                                    </select>
                                                    <button class="rounded-xl bg-slate-900 px-3 py-1 text-xs font-semibold text-white">Set</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-6 text-center text-slate-500">No tenants found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="bg-slate-50/80 px-6 py-4 border-t border-slate-200">
                        {{ $tenants->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
