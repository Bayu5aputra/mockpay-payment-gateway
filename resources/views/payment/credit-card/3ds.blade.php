@extends('layouts.payment')

@section('title', '3DS Verification')

@section('content')
    <div class="max-w-3xl mx-auto px-6">
        <div class="rounded-[28px] bg-white p-8 shadow-sm border border-white/70 space-y-6 text-center">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-slate-500">3DS</p>
                <h1 class="text-3xl font-semibold text-slate-900 mt-2">3D Secure Verification</h1>
                <p class="text-sm text-slate-600 mt-2">Enter the OTP sent to your device (use 112233).</p>
            </div>

            <form id="otpForm" class="space-y-4">
                <input type="text" id="otp" maxlength="6" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-center text-lg tracking-[0.3em] text-slate-700" placeholder="112233" required>
                <button type="submit" class="w-full rounded-2xl bg-slate-900 px-6 py-2 text-sm font-semibold text-white">Verify OTP</button>
            </form>

            <p id="result" class="text-sm text-slate-600"></p>
        </div>
    </div>

    @push('scripts')
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const transactionId = '{{ $transaction->transaction_id }}';

        document.getElementById('otpForm').addEventListener('submit', async (event) => {
            event.preventDefault();
            const otp = document.getElementById('otp').value;
            const resultEl = document.getElementById('result');
            resultEl.textContent = 'Verifying...';

            try {
                const response = await fetch(`/payment/credit-card/${transactionId}/3ds/authenticate`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ otp }),
                });

                const data = await response.json();
                resultEl.textContent = data.message || 'Verification complete.';
            } catch (error) {
                resultEl.textContent = 'Failed to verify OTP.';
            }
        });
    </script>
    @endpush
@endsection
