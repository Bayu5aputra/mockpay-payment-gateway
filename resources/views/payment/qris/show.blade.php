@extends('layouts.payment')

@section('title', 'QRIS Payment')

@section('content')
    <div class="max-w-4xl mx-auto px-6">
        <div class="rounded-[28px] bg-white p-8 shadow-sm border border-white/70 space-y-6 text-center">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-slate-500">QRIS</p>
                <h1 class="text-3xl font-semibold text-slate-900 mt-2">Scan QR Code</h1>
                <p class="text-sm text-slate-600 mt-2">Use your mobile banking or e-wallet app.</p>
            </div>

            <img src="{{ route('payment.qris.qr', $transaction->transaction_id) }}" alt="QRIS" class="mx-auto h-56 w-56 rounded-2xl border border-slate-200">

            <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700">
                <div class="text-xs uppercase tracking-[0.2em] text-slate-500">Amount</div>
                <div class="text-lg font-semibold text-slate-900 mt-2">Rp {{ number_format($transaction->total_amount ?? $transaction->amount, 0, ',', '.') }}</div>
            </div>

            <div class="flex flex-wrap justify-center gap-3">
                <button type="button" id="simulateBtn" class="rounded-2xl bg-slate-900 px-6 py-2 text-sm font-semibold text-white">Simulate Payment</button>
                <button type="button" class="rounded-2xl border border-slate-200 px-6 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50" onclick="copyText('{{ $qris->qr_string }}')">Copy QR String</button>
            </div>

            <p id="result" class="text-sm text-slate-600"></p>
        </div>
    </div>

    @push('scripts')
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const qrString = '{{ $qris->qr_string }}';

        function copyText(text) {
            navigator.clipboard.writeText(text);
        }

        document.getElementById('simulateBtn').addEventListener('click', async () => {
            const resultEl = document.getElementById('result');
            resultEl.textContent = 'Recording payment attempt...';

            try {
                const response = await fetch('{{ route('payment.simulate.qris.pay') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ qr_string: qrString, action: 'approve' }),
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
