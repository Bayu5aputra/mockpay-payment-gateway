<x-app-layout>
    <div class="p-8">
        <div class="mb-6">
            <a href="{{ route('dashboard.upgrade-requests.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Detail Upgrade Request</h1>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <p class="text-red-800 font-medium">{{ session('error') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white rounded-xl shadow p-6 space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Client</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $upgradeRequest->user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $upgradeRequest->user->email }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Status</p>
                        @if($upgradeRequest->status === 'approved')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">Approved</span>
                        @elseif($upgradeRequest->status === 'rejected')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">Rejected</span>
                        @else
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">Pending</span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Plan</p>
                        <p class="font-semibold text-gray-900 uppercase">{{ $upgradeRequest->plan }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Invoice</p>
                        <p class="font-semibold text-gray-900">{{ $upgradeRequest->invoice_number ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Tanggal Permintaan</p>
                        <p class="font-semibold text-gray-900">{{ $upgradeRequest->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Total</p>
                        <p class="font-semibold text-gray-900">Rp {{ number_format($upgradeRequest->total_amount, 0, ',', '.') }}</p>
                    </div>
                </div>

                @if($upgradeRequest->notes)
                    <div>
                        <p class="text-sm text-gray-500">Catatan Client</p>
                        <p class="text-sm text-gray-700">{{ $upgradeRequest->notes }}</p>
                    </div>
                @endif

                <div>
                    <a href="{{ route('dashboard.upgrade-requests.proof', $upgradeRequest) }}" class="inline-flex items-center text-sm text-purple-600 hover:text-purple-700 font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Unduh Bukti Transfer
                    </a>
                </div>

                @if($upgradeRequest->isPending())
                    <div class="flex flex-wrap gap-3">
                        <form method="POST" action="{{ route('dashboard.upgrade-requests.approve', $upgradeRequest) }}">
                            @csrf
                            <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Approve & Kirim Invoice</button>
                        </form>
                        <form method="POST" action="{{ route('dashboard.upgrade-requests.reject', $upgradeRequest) }}" class="flex items-center gap-2">
                            @csrf
                            <input type="text" name="rejection_reason" class="border border-gray-300 rounded-lg px-3 py-2 text-sm" placeholder="Alasan penolakan (opsional)">
                            <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Reject</button>
                        </form>
                    </div>
                @endif
            </div>

            <div class="bg-white rounded-xl shadow p-6 space-y-4">
                <h2 class="text-lg font-semibold text-gray-900">Ringkasan Biaya</h2>
                <div class="space-y-2 text-sm">
                    <div class="flex items-center justify-between">
                        <span>Harga Paket</span>
                        <span>Rp {{ number_format($upgradeRequest->base_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Pajak ({{ number_format($upgradeRequest->tax_rate, 2) }}%)</span>
                        <span>Rp {{ number_format($upgradeRequest->tax_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Biaya Admin</span>
                        <span>Rp {{ number_format($upgradeRequest->admin_fee, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t pt-2 flex items-center justify-between font-semibold">
                        <span>Total</span>
                        <span>Rp {{ number_format($upgradeRequest->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="border-t pt-4">
                    <h3 class="text-sm font-semibold text-gray-900 mb-2">Rekening Tujuan</h3>
                    <div class="space-y-2 text-sm text-gray-600">
                        @foreach($banks as $bank)
                            <div class="flex items-center justify-between">
                                <span>{{ $bank['name'] }}</span>
                                <span>{{ $bank['account_number'] ?? 'Belum diatur' }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
