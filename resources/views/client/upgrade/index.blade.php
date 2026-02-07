<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Upgrade Plan</p>
                        <h1 class="text-4xl font-semibold text-slate-900 mt-2">Upgrade Plan</h1>
                        <p class="text-sm text-slate-600 mt-2">Manage your upgrade requests and payment status.</p>
                    </div>
                    <a href="{{ route('client.upgrade-requests.create') }}"
                       class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 transition">
                        Request Upgrade
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4">
                        <p class="text-emerald-700 font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                <div class="bg-white/80 border border-white/70 rounded-[24px] shadow-sm p-6">
                    <div class="flex flex-wrap items-center justify-between gap-6">
                        <div>
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Current Plan</p>
                            <p class="text-2xl font-semibold text-slate-900 uppercase mt-2">{{ $user->effectivePlan() }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Valid Until</p>
                            <p class="text-sm font-semibold text-slate-700 mt-2">
                                @if($user->plan_ends_at)
                                    {{ $user->plan_ends_at->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white/80 border border-white/70 rounded-[28px] shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-slate-900">Request History</h2>
                    </div>
                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full text-sm">
                            <thead class="text-left text-slate-500 border-b border-slate-200/70">
                                <tr>
                                    <th class="py-2">Date</th>
                                    <th class="py-2">Plan</th>
                                    <th class="py-2">Total</th>
                                    <th class="py-2">Status</th>
                                    <th class="py-2">Invoice</th>
                                    <th class="py-2 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200/70">
                                @forelse($requests as $request)
                                    <tr>
                                        <td class="py-3 text-slate-700">{{ $request->created_at->format('d M Y') }}</td>
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
                                        <td class="py-3 text-slate-600 font-mono text-xs">{{ $request->invoice_number ?? '-' }}</td>
                                        <td class="py-3 text-right">
                                            <a href="{{ route('client.upgrade-requests.show', $request) }}" class="text-slate-700 hover:text-slate-900 font-semibold">Details</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-6 text-center text-slate-500">No upgrade requests yet.</td>
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
