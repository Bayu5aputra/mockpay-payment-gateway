<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-6xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
                <div class="flex flex-col gap-3">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Platform Admin</p>
                    <h1 class="text-4xl font-semibold text-slate-900">Merchant Invitations</h1>
                    <p class="text-sm text-slate-600">Invite new platform admins to manage MockPay safely.</p>
                </div>

                @if(session('success'))
                    <div class="rounded-2xl border border-emerald-200 bg-emerald-50/80 p-4">
                        <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
                    </div>
                @endif
                @if(session('error'))
                    <div class="rounded-2xl border border-rose-200 bg-rose-50/80 p-4">
                        <p class="text-rose-800 font-medium">{{ session('error') }}</p>
                    </div>
                @endif

                <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70 space-y-5">
                    <form method="POST" action="{{ route('dashboard.invitations.store') }}" class="grid grid-cols-1 md:grid-cols-[1fr_auto] gap-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Invite Email</label>
                            <input type="email" name="email" required class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700" placeholder="invitee@email.com">
                        </div>
                        <div class="flex items-end">
                            <button class="px-6 py-2 rounded-2xl bg-slate-900 text-white text-sm font-semibold hover:bg-slate-800 transition">
                                Create Invitation
                            </button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('dashboard.invitations.test-email') }}" class="grid grid-cols-1 md:grid-cols-[1fr_auto] gap-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Test Email</label>
                            <input type="email" name="email" required class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700" placeholder="test@email.com">
                        </div>
                        <div class="flex items-end">
                            <button class="px-6 py-2 rounded-2xl border border-slate-200 text-slate-700 text-sm font-semibold hover:bg-slate-50 transition">
                                Send Test Email
                            </button>
                        </div>
                    </form>
                </div>

                <div class="rounded-[28px] bg-white shadow-sm border border-white/70 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 bg-slate-50/70">
                        <h3 class="text-lg font-semibold text-slate-900">Invitation List</h3>
                    </div>
                    <div class="divide-y divide-slate-200">
                        @forelse($invitations as $invitation)
                            <div class="p-6 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                                <div>
                                    <p class="font-semibold text-slate-900">{{ $invitation->email }}</p>
                                    <p class="text-sm text-slate-500">
                                        Status: <span class="font-medium">{{ ucfirst($invitation->status) }}</span>
                                        @if($invitation->expires_at)
                                            â€¢ Expires {{ $invitation->expires_at->format('d M Y') }}
                                        @endif
                                    </p>
                                </div>
                                <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                                    @if($invitation->status === 'pending')
                                        <input
                                            type="text"
                                            readonly
                                            class="w-full sm:w-96 rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2 text-xs text-slate-600"
                                            value="{{ route('merchant-invitations.accept', $invitation->token) }}"
                                            onclick="this.select();"
                                        >
                                    @endif
                                    <form method="POST" action="{{ route('dashboard.invitations.delete', $invitation) }}">
                                        @csrf
                                        <button class="px-4 py-2 text-xs font-semibold text-rose-600 border border-rose-200 rounded-2xl hover:bg-rose-50">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="p-6 text-slate-500">No invitations yet.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
