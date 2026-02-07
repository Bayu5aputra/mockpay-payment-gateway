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
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Simulator</p>
                        <h1 class="text-4xl font-semibold text-slate-900 mt-2">Quick Transaction Generator</h1>
                        <p class="text-sm text-slate-600 mt-2">Create a real transaction using your sandbox key.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                        <form id="simulatorForm" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Payment Channel</label>
                                <select id="channel" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700">
                                    <option value="bca_va" data-method="bank_transfer">BCA Virtual Account</option>
                                    <option value="gopay" data-method="ewallet">GoPay E-Wallet</option>
                                    <option value="qris" data-method="qris">QRIS</option>
                                    <option value="credit_card" data-method="credit_card">Credit Card</option>
                                    <option value="alfamart" data-method="retail">Alfamart Retail</option>
                                </select>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Amount (IDR)</label>
                                    <input type="number" id="amount" value="250000" min="1000" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Order ID</label>
                                    <input type="text" id="order_id" value="ORDER-{{ now()->format('YmdHis') }}" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Customer Name</label>
                                    <input type="text" id="customer_name" value="John Doe" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Customer Email</label>
                                    <input type="email" id="customer_email" value="john@example.com" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700">
                                </div>
                            </div>
                            <button type="submit" class="w-full rounded-2xl bg-slate-900 px-6 py-2 text-sm font-semibold text-white hover:bg-slate-800 transition" {{ $sandboxKey ? '' : 'disabled' }}>
                                Create Transaction
                            </button>
                            @if(!$sandboxKey)
                                <p class="text-xs text-rose-600">Generate a sandbox API key first to use the simulator.</p>
                            @endif
                        </form>
                    </div>

                    <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">Result</h2>
                        <div id="result" class="text-sm text-slate-600">
                            Create a transaction to see the response.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const apiKey = @json($sandboxKey?->getFullKey());
        const baseUrl = '{{ rtrim(config('app.url') ?: url('/'), '/') }}';

        document.getElementById('simulatorForm').addEventListener('submit', async function (event) {
            event.preventDefault();
            if (!apiKey) {
                return;
            }

            const channelSelect = document.getElementById('channel');
            const selected = channelSelect.options[channelSelect.selectedIndex];
            const paymentChannel = selected.value;
            const paymentMethod = selected.getAttribute('data-method');

            const payload = {
                order_id: document.getElementById('order_id').value,
                amount: Number(document.getElementById('amount').value),
                payment_method: paymentMethod,
                payment_channel: paymentChannel,
                customer: {
                    name: document.getElementById('customer_name').value,
                    email: document.getElementById('customer_email').value,
                },
            };

            const resultEl = document.getElementById('result');
            resultEl.textContent = 'Creating transaction...';

            try {
                const response = await fetch(`${baseUrl}/api/v1/payment/create`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${apiKey}`,
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(payload),
                });

                const data = await response.json();
                if (!response.ok) {
                    resultEl.textContent = data.message || 'Failed to create transaction.';
                    return;
                }

                const detail = data.data;
                resultEl.innerHTML = `
                    <div class="space-y-2">
                        <div class="font-semibold text-slate-900">Transaction Created</div>
                        <div class="text-xs text-slate-500">Transaction ID</div>
                        <div class="font-mono text-slate-900">${detail.transaction_id}</div>
                        <div class="text-xs text-slate-500">Status</div>
                        <div class="font-semibold text-slate-900">${detail.status}</div>
                        <a href="${detail.payment_url}" class="inline-flex mt-2 rounded-xl border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-700 hover:bg-slate-50">Open Hosted Payment Page</a>
                    </div>
                `;
            } catch (error) {
                resultEl.textContent = 'Failed to create transaction.';
            }
        });
    </script>
    @endpush
</x-app-layout>
