@extends('layouts.payment')

@section('title', 'Retail Payment')

@section('content')
    <div class="max-w-4xl mx-auto px-6">
        <div class="rounded-[28px] bg-white p-8 shadow-sm border border-white/70 space-y-6">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Retail</p>
                <h1 class="text-3xl font-semibold text-slate-900 mt-2">{{ strtoupper($retail->store_type ?? 'Retail') }} Payment</h1>
                <p class="text-sm text-slate-600 mt-2">Show the payment code at the cashier.</p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Payment Code</p>
                <div class="mt-2 flex items-center justify-between">
                    <p class="text-lg font-semibold text-slate-900">{{ $retail->payment_code }}</p>
                    <button type="button" class="text-xs font-semibold text-slate-700 hover:text-slate-900" onclick="copyText('{{ $retail->payment_code }}')">Copy</button>
                </div>
            </div>

            <img src="{{ route('payment.retail.barcode', $transaction->transaction_id) }}" alt="Barcode" class="h-16 w-full object-contain">

            <div class="flex flex-wrap gap-3">
                <button type="button" id="simulateBtn" class="rounded-2xl bg-slate-900 px-6 py-2 text-sm font-semibold text-white">Simulate Payment</button>
            </div>

            <p id="result" class="text-sm text-slate-600"></p>
        </div>
    </div>

    @push('scripts')
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const paymentCode = '{{ $retail->payment_code }}';
        const amount = '{{ $transaction->total_amount ?? $transaction->amount }}';

        function copyText(text) {
            navigator.clipboard.writeText(text);
        }

        document.getElementById('simulateBtn').addEventListener('click', async () => {
            const resultEl = document.getElementById('result');
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
