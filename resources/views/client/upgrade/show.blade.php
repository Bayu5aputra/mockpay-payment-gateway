<x-app-layout>
    <div class="p-8">
        <div class="mb-6">
            <a href="{{ route('client.upgrade-requests.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Upgrade Details</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white rounded-xl shadow p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        @if($upgradeRequest->status === 'approved')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">Approved</span>
                        @elseif($upgradeRequest->status === 'rejected')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">Rejected</span>
                        @else
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">Pending</span>
                        @endif
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Invoice</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $upgradeRequest->invoice_number ?? '-' }}</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500">Plan</p>
                        <p class="text-lg font-semibold text-gray-900 uppercase">{{ $upgradeRequest->plan }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total</p>
                        <p class="text-lg font-semibold text-gray-900">Rp {{ number_format($upgradeRequest->total_amount, 0, ',', '.') }}</p>
                    </div>
                    @if($upgradeRequest->rejection_reason)
                        <div>
                            <p class="text-sm text-gray-500">Rejection Reason</p>
                            <p class="text-sm text-red-600">{{ $upgradeRequest->rejection_reason }}</p>
                        </div>
                    @endif
                </div>

                <div class="mt-6 space-y-2">
                    <a href="{{ route('client.upgrade-requests.proof', $upgradeRequest) }}" class="inline-flex items-center text-sm text-purple-600 hover:text-purple-700 font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download Transfer Proof
                    </a>
                    @if($upgradeRequest->invoice_number)
                        <a href="{{ route('client.upgrade-requests.invoice', $upgradeRequest) }}" class="inline-flex items-center text-sm text-emerald-600 hover:text-emerald-700 font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l2 2 4-4M7 7h10M7 11h4m-6 8h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Download Invoice
                        </a>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-xl shadow p-6 space-y-4">
                <h2 class="text-lg font-semibold text-gray-900">Cost Summary</h2>
                <div class="space-y-2 text-sm">
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
                    <div class="border-t pt-2 flex items-center justify-between font-semibold">
                        <span>Total</span>
                        <span>Rp {{ number_format($upgradeRequest->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="border-t pt-4">
                    <h3 class="text-sm font-semibold text-gray-900 mb-2">Destination Accounts</h3>
                    <div class="space-y-2 text-sm text-gray-600">
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
</x-app-layout>
