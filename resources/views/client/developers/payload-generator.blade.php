<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
                <div class="flex flex-col gap-3">
                    <a href="{{ route('client.developers.index') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-slate-900">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Developer Tools
                    </a>
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Generator</p>
                        <h1 class="text-4xl font-semibold text-slate-900 mt-2">Sample Payload Generator</h1>
                        <p class="text-sm text-slate-600 mt-2">Generate request payloads quickly for testing.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Order Prefix</label>
                            <input type="text" id="prefix" value="ORDER-PAYLOAD" class="w-full rounded-2xl border border-slate-200 px-4 py-2 text-sm text-slate-700">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Amount</label>
                            <input type="number" id="amount" min="1000" value="150000" class="w-full rounded-2xl border border-slate-200 px-4 py-2 text-sm text-slate-700">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Payment Method</label>
                            <select id="method" class="w-full rounded-2xl border border-slate-200 px-4 py-2 text-sm text-slate-700">
                                <option value="bank_transfer" data-channel="bca_va">Bank Transfer</option>
                                <option value="ewallet" data-channel="gopay">E-Wallet</option>
                                <option value="credit_card" data-channel="credit_card">Credit Card</option>
                                <option value="qris" data-channel="qris">QRIS</option>
                                <option value="retail" data-channel="alfamart">Retail</option>
                            </select>
                        </div>
                        <button id="generateBtn" class="rounded-2xl bg-slate-900 px-6 py-2 text-sm font-semibold text-white hover:bg-slate-800 transition">
                            Generate Payload
                        </button>
                        <p class="text-xs text-slate-500">Use with sandbox key: <span class="font-mono">{{ $sandboxKey?->getFullKey() ?? 'Not generated yet' }}</span></p>
                    </div>
                    <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-slate-900">Payload JSON</h2>
                            <button id="copyBtn" class="rounded-xl border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-700 hover:bg-slate-50">Copy</button>
                        </div>
                        <pre id="payloadOutput" class="rounded-2xl bg-slate-900 text-slate-100 p-4 text-xs overflow-x-auto whitespace-pre-wrap"></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function buildPayload() {
            const methodSelect = document.getElementById('method');
            const selected = methodSelect.options[methodSelect.selectedIndex];
            const method = selected.value;
            const channel = selected.getAttribute('data-channel');
            const prefix = document.getElementById('prefix').value || 'ORDER-PAYLOAD';
            const orderId = `${prefix}-${Date.now()}`;

            return {
                order_id: orderId,
                amount: Number(document.getElementById('amount').value || 150000),
                payment_method: method,
                payment_channel: channel,
                customer: {
                    name: 'Payload Tester',
                    email: 'payload.tester@example.com',
                    phone: '081234567890',
                },
                metadata: {
                    source: 'payload_generator',
                    generated_at: new Date().toISOString(),
                },
            };
        }

        function renderPayload() {
            const output = document.getElementById('payloadOutput');
            output.textContent = JSON.stringify(buildPayload(), null, 2);
        }

        document.getElementById('generateBtn').addEventListener('click', renderPayload);
        document.getElementById('copyBtn').addEventListener('click', async () => {
            await navigator.clipboard.writeText(document.getElementById('payloadOutput').textContent);
        });

        renderPayload();
    </script>
    @endpush
</x-app-layout>
