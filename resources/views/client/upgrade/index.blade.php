<x-app-layout>
    <div class="p-8">
        <div class="flex items-start justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Upgrade Plan</h1>
                <p class="text-gray-600">Manage your upgrade requests and payment status.</p>
            </div>
            <a href="{{ route('client.upgrade-requests.create') }}"
               class="px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700">
                Request Upgrade
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Current Plan</p>
                    <p class="text-xl font-semibold text-gray-900 uppercase">{{ $user->effectivePlan() }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Valid Until</p>
                    <p class="text-sm font-semibold text-gray-700">
                        @if($user->plan_ends_at)
                            {{ $user->plan_ends_at->format('d M Y') }}
                        @else
                            -
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Request History</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="text-left text-gray-500 border-b">
                        <tr>
                            <th class="py-2">Date</th>
                            <th class="py-2">Plan</th>
                            <th class="py-2">Total</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Invoice</th>
                            <th class="py-2 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($requests as $request)
                            <tr>
                                <td class="py-3 text-gray-700">{{ $request->created_at->format('d M Y') }}</td>
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
                                    <a href="{{ route('client.upgrade-requests.show', $request) }}" class="text-purple-600 hover:text-purple-700 font-medium">Details</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-6 text-center text-gray-500">No upgrade requests yet.</td>
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
</x-app-layout>
