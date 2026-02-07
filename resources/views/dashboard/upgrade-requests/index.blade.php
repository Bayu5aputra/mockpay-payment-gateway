<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Upgrade Requests</h1>
            <p class="text-slate-600">Kelola permintaan upgrade dari client.</p>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 mb-6">
                <p class="text-emerald-700 font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white/80 rounded-[24px] border border-white/70 shadow-sm p-6 mb-6">
            <form method="GET" class="flex flex-wrap gap-4 items-end">
                <div>
                    <label class="block text-sm text-slate-500 mb-1">Status</label>
                    <select name="status" class="border border-slate-200 rounded-xl px-3 py-2 text-sm text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-300">
                        <option value="">All</option>
                        <option value="pending" @selected(request('status')==='pending')>Pending</option>
                        <option value="approved" @selected(request('status')==='approved')>Approved</option>
                        <option value="rejected" @selected(request('status')==='rejected')>Rejected</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-slate-500 mb-1">Plan</label>
                    <select name="plan" class="border border-slate-200 rounded-xl px-3 py-2 text-sm text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-300">
                        <option value="">All</option>
                        <option value="pro" @selected(request('plan')==='pro')>Pro</option>
                        <option value="enterprise" @selected(request('plan')==='enterprise')>Enterprise</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[220px]">
                    <label class="block text-sm text-slate-500 mb-1">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-300" placeholder="Invoice / Name / Email">
                </div>
                <button class="px-5 py-2.5 bg-slate-900 text-white rounded-full text-sm font-semibold shadow-sm hover:bg-slate-800 transition">Filter</button>
            </form>
        </div>

        <div class="bg-white/80 rounded-[28px] border border-white/70 shadow-sm p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="text-left text-slate-500 border-b border-slate-200/70">
                        <tr>
                            <th class="py-2">Tanggal</th>
                            <th class="py-2">Client</th>
                            <th class="py-2">Plan</th>
                            <th class="py-2">Total</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Invoice</th>
                            <th class="py-2 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200/70">
                        @forelse($requests as $request)
                            <tr>
                                <td class="py-3 text-slate-700">{{ $request->created_at->format('d M Y') }}</td>
                                <td class="py-3 text-slate-700">
                                    <div class="font-semibold text-slate-900">{{ $request->user->name }}</div>
                                    <div class="text-xs text-slate-500">{{ $request->user->email }}</div>
                                </td>
                                <td class="py-3 text-slate-700 uppercase">{{ $request->plan }}</td>
                                <td class="py-3 text-slate-700">Rp {{ number_format($request->total_amount, 0, ',', '.') }}</td>
                                <td class="py-3">
                                    @if($request->status === 'approved')
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/70">Approved</span>
                                    @elseif($request->status === 'rejected')
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-rose-50 text-rose-700 border border-rose-200/70">Rejected</span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-amber-50 text-amber-700 border border-amber-200/70">Pending</span>
                                    @endif
                                </td>
                                <td class="py-3">
                                    @if($request->invoice_number)
                                        <div class="flex items-center gap-3">
                                            <span class="text-xs text-slate-600 font-mono">{{ $request->invoice_number }}</span>
                                            <a href="{{ route('dashboard.upgrade-requests.invoice', $request) }}" 
                                               class="inline-flex items-center gap-1.5 px-2.5 py-1.5 text-xs font-semibold text-white bg-slate-900 rounded-lg hover:bg-slate-800 shadow-sm transition-all duration-200" 
                                               title="Download Invoice PDF">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                                PDF
                                            </a>
                                        </div>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="py-3 text-right">
                                    <a href="{{ route('dashboard.upgrade-requests.show', $request) }}" class="text-slate-700 hover:text-slate-900 font-semibold">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-6 text-center text-slate-500">Belum ada permintaan upgrade.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $requests->links() }}
            </div>
        </div>
            </div>
        </div>
    </div>
</x-app-layout>
