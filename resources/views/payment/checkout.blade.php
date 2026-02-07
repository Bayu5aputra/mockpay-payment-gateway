@extends('layouts.payment')

@section('title', 'Checkout')

@section('content')
    @php
        $expiresAt = $transaction->expired_at?->toIso8601String();
        $paymentDetail = $paymentDetail ?? $transaction->getPaymentDetail();
    @endphp

    <div class="max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Payment</p>
                            <h1 class="text-3xl font-semibold text-slate-900 mt-2">Complete Your Payment</h1>
                            <p class="text-sm text-slate-600 mt-2">Order ID: {{ $transaction->order_id }}</p>
                        </div>
                        <div class="rounded-2xl bg-slate-900 text-white px-4 py-2 text-sm font-semibold">
                            {{ strtoupper($transaction->payment_method) }}
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-slate-700">
                        <div>
                            <p class="text-xs text-slate-500">Merchant</p>
                            <p class="font-semibold text-slate-900">{{ $transaction->user?->name ?? 'MockPay Tenant' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500">Amount</p>
                            <p class="font-semibold text-slate-900">Rp {{ number_format($transaction->total_amount ?? $transaction->amount, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70 space-y-4">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                        <h2 class="text-lg font-semibold text-slate-900">Payment Instructions</h2>
                        <div class="text-xs text-slate-500">
                            Expires at: <span id="expiresAtLabel">-</span>
                            <span class="mx-2">•</span>
                            Time left: <span id="countdown">-</span>
                        </div>
                    </div>

                    @if($transaction->payment_method === 'bank_transfer' && $paymentDetail)
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Virtual Account</p>
                            <div class="mt-2 flex items-center justify-between">
                                <p class="text-lg font-semibold text-slate-900">{{ $paymentDetail->va_number }}</p>
                                <button type="button" class="text-xs font-semibold text-slate-700 hover:text-slate-900" onclick="copyText('{{ $paymentDetail->va_number }}')">Copy</button>
                            </div>
                            <p class="text-xs text-slate-500 mt-1">Bank: {{ strtoupper($paymentDetail->bank_code) }}</p>
                        </div>

                        @if(!empty($paymentDetail->instructions))
                            <div class="space-y-3 text-sm text-slate-700">
                                @foreach($paymentDetail->instructions as $channel => $steps)
                                    <div>
                                        <p class="text-xs uppercase tracking-[0.2em] text-slate-500">{{ $channel }}</p>
                                        <ol class="list-decimal ml-5 mt-2 space-y-1">
                                            @foreach($steps as $step)
                                                <li>{{ $step }}</li>
                                            @endforeach
                                        </ol>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @elseif($transaction->payment_method === 'ewallet' && $paymentDetail)
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">E-Wallet</p>
                            <p class="text-lg font-semibold text-slate-900 mt-2">{{ strtoupper($paymentDetail->provider) }}</p>
                            <a href="{{ $paymentDetail->deeplink_url ?? '#' }}" class="inline-flex mt-3 rounded-xl border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-700 hover:bg-slate-100">Open App</a>
                        </div>
                    @elseif($transaction->payment_method === 'qris' && $paymentDetail)
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-center">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">QRIS</p>
                            <img src="{{ route('payment.qris.qr', $transaction->transaction_id) }}" alt="QRIS" class="mx-auto mt-3 h-48 w-48 rounded-2xl border border-slate-200">
                            <div class="mt-3 flex items-center justify-center gap-2">
                                <p class="text-xs font-mono text-slate-700">{{ $paymentDetail->qr_string }}</p>
                                <button type="button" class="text-xs font-semibold text-slate-700 hover:text-slate-900" onclick="copyText('{{ $paymentDetail->qr_string }}')">Copy</button>
                            </div>
                        </div>
                    @elseif($transaction->payment_method === 'retail' && $paymentDetail)
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Retail Payment</p>
                            <p class="text-lg font-semibold text-slate-900 mt-2">{{ strtoupper($paymentDetail->store_type) }}</p>
                            <div class="mt-3 flex items-center justify-between">
                                <p class="text-lg font-semibold text-slate-900">{{ $paymentDetail->payment_code }}</p>
                                <button type="button" class="text-xs font-semibold text-slate-700 hover:text-slate-900" onclick="copyText('{{ $paymentDetail->payment_code }}')">Copy</button>
                            </div>
                            <img src="{{ route('payment.retail.barcode', $transaction->transaction_id) }}" alt="Barcode" class="mt-4 h-16 w-full object-contain">
                        </div>
                    @elseif($transaction->payment_method === 'credit_card')
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Credit Card</p>
                            <p class="text-sm text-slate-600 mt-2">Enter card details to simulate payment.</p>
                            <a href="{{ route('payment.credit-card.form', $transaction->transaction_id) }}" class="inline-flex mt-3 rounded-xl bg-slate-900 px-4 py-2 text-xs font-semibold text-white">Enter Card</a>
                        </div>
                    @endif
                </div>

                <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4">Simulate Payment</h2>
                    <p class="text-sm text-slate-600 mb-4">This action only records a payment attempt. The final outcome is controlled by the tenant via manual override.</p>
                    <button type="button" id="simulateBtn" class="rounded-2xl bg-slate-900 px-6 py-2 text-sm font-semibold text-white">Record Payment Attempt</button>
                    <p id="simulateResult" class="text-sm text-slate-600 mt-3"></p>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4">Status</h2>
                    <div class="space-y-3 text-sm text-slate-700">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Transaction ID</span>
                            <span class="font-semibold text-slate-900">{{ $transaction->transaction_id }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Status</span>
                            <span class="font-semibold text-slate-900">{{ strtoupper($transaction->status) }}</span>
                        </div>
                    </div>
                </div>

                <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4">Need Help?</h2>
                    <p class="text-sm text-slate-600">Contact the merchant if you need assistance with this payment.</p>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const paymentMethod = '{{ $transaction->payment_method }}';
        const transactionId = '{{ $transaction->transaction_id }}';
        const amount = '{{ $transaction->total_amount ?? $transaction->amount }}';
        const paymentDetail = @json($paymentDetail);
        const expiresAt = @json($expiresAt);

        function formatCountdown(ms) {
            if (ms <= 0) {
                return 'Expired';
            }
            const totalSeconds = Math.floor(ms / 1000);
            const hours = Math.floor(totalSeconds / 3600);
            const minutes = Math.floor((totalSeconds % 3600) / 60);
            const seconds = totalSeconds % 60;
            return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        }

        function updateCountdown() {
            if (!expiresAt) {
                return;
            }
            const countdownEl = document.getElementById('countdown');
            const expiry = new Date(expiresAt).getTime();
            const diff = expiry - Date.now();
            countdownEl.textContent = formatCountdown(diff);
        }

        if (expiresAt) {
            const label = document.getElementById('expiresAtLabel');
            label.textContent = new Date(expiresAt).toLocaleString();
            updateCountdown();
            setInterval(updateCountdown, 1000);
        }

        function copyText(text) {
            navigator.clipboard.writeText(text);
        }

        async function postJson(url, payload) {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify(payload),
            });
            const data = await response.json();
            return { ok: response.ok, data };
        }

        document.getElementById('simulateBtn').addEventListener('click', async () => {
            const resultEl = document.getElementById('simulateResult');
            resultEl.textContent = 'Recording payment attempt...';

            let response;

            if (paymentMethod === 'bank_transfer' && paymentDetail?.va_number) {
                response = await postJson('{{ route('payment.simulate.va.pay') }}', {
                    va_number: paymentDetail.va_number,
                    amount: Number(amount),
                });
            } else if (paymentMethod === 'ewallet') {
                response = await postJson(`/payment/ewallet/${transactionId}/simulate`, {
                    action: 'approve',
                });
            } else if (paymentMethod === 'qris' && paymentDetail?.qr_string) {
                response = await postJson('{{ route('payment.simulate.qris.pay') }}', {
                    qr_string: paymentDetail.qr_string,
                    action: 'approve',
                });
            } else if (paymentMethod === 'retail' && paymentDetail?.payment_code) {
                response = await postJson('{{ route('payment.simulate.retail.pay') }}', {
                    payment_code: paymentDetail.payment_code,
                    amount: Number(amount),
                });
            } else if (paymentMethod === 'credit_card') {
                resultEl.textContent = 'Open the credit card form to simulate payment.';
                return;
            }

            if (response?.ok) {
                resultEl.textContent = response.data.message || 'Payment attempt recorded.';
            } else {
                resultEl.textContent = response?.data?.message || 'Failed to record payment attempt.';
            }
        });
    </script>
    @endpush
@endsection
