<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
                <div class="flex flex-col gap-3">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Webhooks</p>
                    <h1 class="text-4xl font-semibold text-slate-900">Webhook Settings</h1>
                    <p class="text-sm text-slate-600 max-w-2xl">Set the endpoint to receive transaction notifications from MockPay and rotate your signing secret securely.</p>
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

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                        <form method="POST" action="{{ route('client.settings.webhooks.update') }}" class="space-y-4">
                            @csrf
                            @method('PUT')
                            @php
                                $availableEvents = [
                                    'transaction.pending' => 'Transaction Pending',
                                    'transaction.processing' => 'Transaction Processing',
                                    'transaction.success' => 'Transaction Success',
                                    'transaction.failed' => 'Transaction Failed',
                                    'transaction.cancelled' => 'Transaction Cancelled',
                                    'transaction.expired' => 'Transaction Expired',
                                    'transaction.refunded' => 'Transaction Refunded',
                                ];
                                $selectedEvents = $user->webhook_events ?: array_keys($availableEvents);
                            @endphp
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Webhook URL</label>
                                <input type="url" name="webhook_url" value="{{ $user->webhook_url }}" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-900/20" placeholder="https://example.com/webhook">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Webhook Events</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @foreach($availableEvents as $eventKey => $eventLabel)
                                        <label class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700">
                                            <input
                                                type="checkbox"
                                                name="webhook_events[]"
                                                value="{{ $eventKey }}"
                                                class="rounded border-slate-300 text-slate-900 focus:ring-slate-900/20"
                                                {{ in_array($eventKey, $selectedEvents, true) ? 'checked' : '' }}
                                            >
                                            <span>{{ $eventLabel }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <button class="px-6 py-2 rounded-2xl bg-slate-900 text-white text-sm font-semibold hover:bg-slate-800 transition">
                                Save Webhook
                            </button>
                        </form>
                        <form method="POST" action="{{ route('client.settings.webhooks.test') }}" class="mt-4">
                            @csrf
                            <button class="w-full px-6 py-2 rounded-2xl border border-slate-200 text-slate-700 text-sm font-semibold hover:bg-slate-50 transition">
                                Send Test Webhook
                            </button>
                        </form>
                    </div>

                    <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70 flex flex-col justify-between">
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Webhook Secret</p>
                            <p class="text-xs text-slate-500 mt-1">Use this to verify webhook signatures.</p>
                            <p class="mt-4 font-mono text-sm text-slate-700 break-all">{{ $user->webhook_secret ?? '-' }}</p>
                        </div>
                        <form method="POST" action="{{ route('client.settings.webhooks.generate-secret') }}" class="mt-6">
                            @csrf
                            <button class="w-full px-4 py-2 rounded-2xl border border-slate-200 text-slate-700 text-sm font-semibold hover:bg-slate-50 transition">
                                Generate New Secret
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
