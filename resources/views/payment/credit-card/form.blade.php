@extends('layouts.payment')

@section('title', 'Card Payment')

@section('content')
    <div class="max-w-4xl mx-auto px-6">
        <div class="rounded-[28px] bg-white p-8 shadow-sm border border-white/70 space-y-6">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Credit Card</p>
                <h1 class="text-3xl font-semibold text-slate-900 mt-2">Enter Card Details</h1>
                <p class="text-sm text-slate-600 mt-2">This is a simulation. Use test card numbers.</p>
            </div>

            <form id="cardForm" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Card Number</label>
                    <input type="text" id="card_number" maxlength="16" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700" placeholder="4111111111111111" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Card Holder</label>
                    <input type="text" id="card_holder" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700" placeholder="JOHN DOE" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">CVV</label>
                    <input type="text" id="cvv" maxlength="3" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700" placeholder="123" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Expiry Month</label>
                    <input type="number" id="expiry_month" min="1" max="12" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700" placeholder="12" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Expiry Year</label>
                    <input type="number" id="expiry_year" min="{{ now()->year }}" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700" placeholder="{{ now()->year + 1 }}" required>
                </div>
                <div class="md:col-span-2">
                    <button type="submit" class="w-full rounded-2xl bg-slate-900 px-6 py-2 text-sm font-semibold text-white">Submit Card</button>
                </div>
            </form>

            <div class="rounded-2xl bg-slate-50 px-4 py-3 text-xs text-slate-700">
                <p class="font-semibold mb-2">Test cards</p>
                <ul class="list-disc ml-4 space-y-1">
                    <li>4111111111111111 (success)</li>
                    <li>5555555555554444 (success)</li>
                    <li>4000000000000002 (failed)</li>
                    <li>4000000000000000 (3DS required)</li>
                </ul>
            </div>

            <p id="result" class="text-sm text-slate-600"></p>
        </div>
    </div>

    @push('scripts')
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const transactionId = '{{ $transaction->transaction_id }}';

        document.getElementById('cardForm').addEventListener('submit', async (event) => {
            event.preventDefault();
            const payload = {
                card_number: document.getElementById('card_number').value,
                card_holder: document.getElementById('card_holder').value,
                expiry_month: document.getElementById('expiry_month').value,
                expiry_year: document.getElementById('expiry_year').value,
                cvv: document.getElementById('cvv').value,
            };

            const resultEl = document.getElementById('result');
            resultEl.textContent = 'Processing...';

            try {
                const response = await fetch(`/payment/credit-card/${transactionId}/process`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify(payload),
                });

                const data = await response.json();
                if (data.requires_3ds && data.redirect_url) {
                    window.location.href = data.redirect_url;
                    return;
                }

                resultEl.textContent = data.message || 'Card processed.';
            } catch (error) {
                resultEl.textContent = 'Failed to process card.';
            }
        });
    </script>
    @endpush
@endsection
