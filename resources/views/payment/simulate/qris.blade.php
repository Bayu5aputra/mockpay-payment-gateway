@extends('layouts.payment')

@section('title', 'QRIS Simulator')

@section('content')
    <div class="max-w-4xl mx-auto px-6">
        <div class="rounded-[28px] bg-white p-8 shadow-sm border border-white/70 space-y-6">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Simulator</p>
                <h1 class="text-3xl font-semibold text-slate-900 mt-2">QRIS Simulator</h1>
                <p class="text-sm text-slate-600 mt-2">Scan QR string and record a payment attempt.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">QR String</label>
                <textarea id="qr_string" rows="3" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700" placeholder="000201..."></textarea>
            </div>

            <div class="flex flex-wrap gap-3">
                <button type="button" id="scanBtn" class="rounded-2xl border border-slate-200 px-6 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Scan QR</button>
                <button type="button" id="payBtn" class="rounded-2xl bg-slate-900 px-6 py-2 text-sm font-semibold text-white">Simulate Pay</button>
            </div>

            <div id="result" class="text-sm text-slate-600"></div>
        </div>
    </div>

    @push('scripts')
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const resultEl = document.getElementById('result');

        document.getElementById('scanBtn').addEventListener('click', async () => {
            const qrString = document.getElementById('qr_string').value;
            if (!qrString) {
                resultEl.textContent = 'Enter QR string.';
                return;
            }
            resultEl.textContent = 'Scanning...';
            try {
                const response = await fetch('{{ route('payment.simulate.qris.scan') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ qr_string: qrString }),
                });
                const data = await response.json();
                resultEl.textContent = data.message || JSON.stringify(data.data);
            } catch (error) {
                resultEl.textContent = 'Failed to scan QR.';
            }
        });

        document.getElementById('payBtn').addEventListener('click', async () => {
            const qrString = document.getElementById('qr_string').value;
            if (!qrString) {
                resultEl.textContent = 'Enter QR string.';
                return;
            }
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
