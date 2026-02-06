<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Upgrade Requests</h1>
            <p class="text-gray-600">Kelola permintaan upgrade dari client.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <form method="GET" class="flex flex-wrap gap-4 items-end">
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Status</label>
                    <select name="status" class="border border-gray-300 rounded-lg px-3 py-2">
                        <option value="">All</option>
                        <option value="pending" @selected(request('status')==='pending')>Pending</option>
                        <option value="approved" @selected(request('status')==='approved')>Approved</option>
                        <option value="rejected" @selected(request('status')==='rejected')>Rejected</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Plan</label>
                    <select name="plan" class="border border-gray-300 rounded-lg px-3 py-2">
                        <option value="">All</option>
                        <option value="pro" @selected(request('plan')==='pro')>Pro</option>
                        <option value="enterprise" @selected(request('plan')==='enterprise')>Enterprise</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[220px]">
                    <label class="block text-sm text-gray-600 mb-1">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2" placeholder="Invoice / Name / Email">
                </div>
                <button class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">Filter</button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="text-left text-gray-500 border-b">
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
                    <tbody class="divide-y">
                        @forelse($requests as $request)
                            <tr>
                                <td class="py-3 text-gray-700">{{ $request->created_at->format('d M Y') }}</td>
                                <td class="py-3 text-gray-700">
                                    <div class="font-semibold">{{ $request->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $request->user->email }}</div>
                                </td>
                                <td class="py-3 text-gray-700 uppercase">{{ $request->plan }}</td>
                                <td class="py-3 text-gray-700">Rp {{ number_format($request->total_amount, 0, ',', '.') }}</td>
                                <td class="py-3">
                                    @if($request->status === 'approved')
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">Approved</span>
                                    @elseif($request->status === 'rejected')
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">Rejected</span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">Pending</span>
                                    @endif
                                </td>
                                <td class="py-3 text-gray-600">{{ $request->invoice_number ?? '-' }}</td>
                                <td class="py-3 text-right">
                                    <a href="{{ route('dashboard.upgrade-requests.show', $request) }}" class="text-purple-600 hover:text-purple-700 font-medium">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-6 text-center text-gray-500">Belum ada permintaan upgrade.</td>
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
