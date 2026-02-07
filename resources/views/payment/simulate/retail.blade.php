@extends('layouts.payment')

@section('title', 'Retail Simulator')

@section('content')
    <div class="max-w-4xl mx-auto px-6">
        <div class="rounded-[28px] bg-white p-8 shadow-sm border border-white/70 space-y-6">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Simulator</p>
                <h1 class="text-3xl font-semibold text-slate-900 mt-2">Retail Payment Simulator</h1>
                <p class="text-sm text-slate-600 mt-2">Check payment code and record a payment attempt.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Payment Code</label>
                    <input type="text" id="payment_code" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700" placeholder="ALFA-XXXXXX">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Amount</label>
                    <input type="number" id="amount" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700" placeholder="100000">
                </div>
            </div>

            <div class="flex flex-wrap gap-3">
                <button type="button" id="checkBtn" class="rounded-2xl border border-slate-200 px-6 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Check Code</button>
                <button type="button" id="payBtn" class="rounded-2xl bg-slate-900 px-6 py-2 text-sm font-semibold text-white">Simulate Pay</button>
            </div>

            <div id="result" class="text-sm text-slate-600"></div>
        </div>
    </div>

    @push('scripts')
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const resultEl = document.getElementById('result');

        document.getElementById('checkBtn').addEventListener('click', async () => {
            const paymentCode = document.getElementById('payment_code').value;
            if (!paymentCode) {
                resultEl.textContent = 'Enter payment code.';
                return;
            }
            resultEl.textContent = 'Checking...';
            try {
                const response = await fetch(`/payment/simulate/retail/check/${paymentCode}`);
                const data = await response.json();
                resultEl.textContent = data.message || JSON.stringify(data.data);
            } catch (error) {
                resultEl.textContent = 'Failed to check payment code.';
            }
        });

        document.getElementById('payBtn').addEventListener('click', async () => {
            const paymentCode = document.getElementById('payment_code').value;
            const amount = document.getElementById('amount').value;
            if (!paymentCode || !amount) {
                resultEl.textContent = 'Enter payment code and amount.';
                return;
            }
            resultEl.textContent = 'Recording payment attempt...';
            try {
                const response = await fetch('{{ route('payment.simulate.retail.pay') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ payment_code: paymentCode, amount: Number(amount) }),
                });
                const data = await response.json();
                resultEl.textContent = data.message || 'Payment attempt recorded.';
            } catch (error) {
                resultEl.textContent = 'Failed to record payment attempt.';
            }
        });
    </script>
    @endpush
@endsection
