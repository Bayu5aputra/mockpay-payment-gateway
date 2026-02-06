<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-5xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Merchant Invitations</h1>
            <p class="text-gray-600">Invite new merchant accounts to join your team.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <p class="text-red-700 font-medium">{{ session('error') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow p-6 mb-8 space-y-6">
            <form method="POST" action="{{ route('dashboard.invitations.store') }}" class="flex flex-col md:flex-row gap-4">
                @csrf
                <input type="email" name="email" required class="flex-1 border border-gray-300 rounded-lg px-4 py-2" placeholder="invitee@email.com">
                <button class="px-6 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700">
                    Create Invitation
                </button>
            </form>

            <form method="POST" action="{{ route('dashboard.invitations.test-email') }}" class="flex flex-col md:flex-row gap-4">
                @csrf
                <input type="email" name="email" required class="flex-1 border border-gray-300 rounded-lg px-4 py-2" placeholder="test@email.com">
                <button class="px-6 py-2 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800">
                    Send Test Email
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-800">Invitation List</h3>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($invitations as $invitation)
                    <div class="p-6 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $invitation->email }}</p>
                            <p class="text-sm text-gray-500">
                                Status: <span class="font-medium">{{ ucfirst($invitation->status) }}</span>
                                @if($invitation->expires_at)
                                    • Expires {{ $invitation->expires_at->format('d M Y') }}
                                @endif
                            </p>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                            @if($invitation->status === 'pending')
                                <input
                                    type="text"
                                    readonly
                                    class="w-full sm:w-96 border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-600 bg-gray-50"
                                    value="{{ route('merchant-invitations.accept', $invitation->token) }}"
                                    onclick="this.select();"
                                >
                            @endif
                            <form method="POST" action="{{ route('dashboard.invitations.delete', $invitation) }}">
                                @csrf
                                <button class="px-4 py-2 text-sm text-red-600 border border-red-200 rounded-lg hover:bg-red-50">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-gray-500">No invitations yet.</div>
                @endforelse
            </div>
        </div>
            </div>
        </div>
    </div>
</x-app-layout>
