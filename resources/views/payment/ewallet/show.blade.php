@extends('layouts.payment')

@section('title', 'E-Wallet Payment')

@section('content')
    <div class="max-w-4xl mx-auto px-6">
        <div class="rounded-[28px] bg-white p-8 shadow-sm border border-white/70 space-y-6">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-slate-500">E-Wallet</p>
                <h1 class="text-3xl font-semibold text-slate-900 mt-2">Pay with {{ strtoupper($ewallet->provider ?? 'E-Wallet') }}</h1>
                <p class="text-sm text-slate-600 mt-2">Scan or open the app to proceed.</p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Amount</p>
                <p class="text-lg font-semibold text-slate-900 mt-2">Rp {{ number_format($transaction->total_amount ?? $transaction->amount, 0, ',', '.') }}</p>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ $ewallet->deeplink_url ?? '#' }}" class="rounded-2xl bg-slate-900 px-6 py-2 text-sm font-semibold text-white">Open E-Wallet</a>
                <button type="button" id="simulateBtn" class="rounded-2xl border border-slate-200 px-6 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Simulate Payment</button>
            </div>

            <p id="result" class="text-sm text-slate-600"></p>
        </div>
    </div>

    @push('scripts')
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const transactionId = '{{ $transaction->transaction_id }}';

        document.getElementById('simulateBtn').addEventListener('click', async () => {
            const resultEl = document.getElementById('result');
            resultEl.textContent = 'Recording payment attempt...';

            try {
                const response = await fetch(`/payment/ewallet/${transactionId}/simulate`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ action: 'approve' }),
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
