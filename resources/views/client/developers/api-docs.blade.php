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
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-500">API Docs</p>
                        <h1 class="text-4xl font-semibold text-slate-900 mt-2">MockPay API Reference</h1>
                        <p class="text-sm text-slate-600 mt-2">Tenant-scoped endpoints for payment simulation.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                        <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Base URL</p>
                        <p class="mt-3 font-mono text-slate-900">{{ rtrim($baseUrl, '/') }}/api/v1</p>
                    </div>
                    <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                        <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Your API Keys</p>
                        <div class="mt-3 space-y-3 text-sm text-slate-700">
                            <div>
                                <p class="text-xs text-slate-500">Sandbox</p>
                                <p class="font-mono break-all text-slate-900">{{ $sandboxKey?->getFullKey() ?? 'Not generated yet' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500">Production</p>
                                <p class="font-mono break-all text-slate-900">{{ $productionKey?->getFullKey() ?? 'Not generated yet' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                        <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Webhook Secret</p>
                        <p class="mt-3 font-mono text-slate-900 break-all">{{ $webhookSecret ?? 'Not generated yet' }}</p>
                    </div>
                </div>

                <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4">Authentication</h2>
                    <p class="text-sm text-slate-600 mb-3">All API requests require your API key via Bearer token.</p>
                    <div class="rounded-2xl bg-slate-900 text-slate-100 px-4 py-3 text-sm font-mono">
                        Authorization: Bearer YOUR_API_KEY
                    </div>
                </div>

                <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4">Endpoints</h2>
                    <div class="grid grid-cols-1 gap-3 text-sm">
                        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                            <span class="font-mono text-slate-900">POST /api/v1/payment/create</span>
                            <span class="text-slate-500">Create transaction</span>
                        </div>
                        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                            <span class="font-mono text-slate-900">GET /api/v1/payment/channels</span>
                            <span class="text-slate-500">List payment channels</span>
                        </div>
                        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                            <span class="font-mono text-slate-900">GET /api/v1/transaction/{transaction_id}</span>
                            <span class="text-slate-500">Transaction detail</span>
                        </div>
                        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                            <span class="font-mono text-slate-900">GET /api/v1/transactions</span>
                            <span class="text-slate-500">Transaction list + filters</span>
                        </div>
                        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                            <span class="font-mono text-slate-900">POST /api/v1/transaction/{transaction_id}/cancel</span>
                            <span class="text-slate-500">Cancel pending transaction</span>
                        </div>
                        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                            <span class="font-mono text-slate-900">POST /api/v1/refund</span>
                            <span class="text-slate-500">Refund or partial refund</span>
                        </div>
                        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                            <span class="font-mono text-slate-900">GET /api/v1/webhook/logs/{transaction_id}</span>
                            <span class="text-slate-500">Webhook delivery logs</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">Create Payment Request</h2>
                        <div class="rounded-2xl bg-slate-900 text-slate-100 px-4 py-3 text-xs font-mono whitespace-pre-wrap">
{
  "order_id": "ORDER-1001",
  "amount": 250000,
  "payment_method": "bank_transfer",
  "payment_channel": "bca_va",
  "customer": {
    "name": "John Doe",
    "email": "john@example.com",
    "phone": "081234567890"
  },
  "items": [
    { "name": "MockPay Pro", "quantity": 1, "price": 250000 }
  ],
  "description": "Test payment via MockPay"
}
                        </div>
                    </div>
                    <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">Create Payment Response</h2>
                        <div class="rounded-2xl bg-slate-900 text-slate-100 px-4 py-3 text-xs font-mono whitespace-pre-wrap">
{
  "status": "success",
  "message": "Payment created successfully",
  "data": {
    "transaction_id": "TRX-20260207-ABCDE",
    "order_id": "ORDER-1001",
    "amount": 250000,
    "total_amount": 253750,
    "status": "pending",
    "payment_method": "bank_transfer",
    "payment_channel": "bca_va",
    "payment_url": "{{ rtrim($baseUrl, '/') }}/payment/TRX-20260207-ABCDE",
    "expired_at": "2026-02-08T10:00:00Z"
  }
}
                        </div>
                    </div>
                </div>

                <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4">Webhook Signature</h2>
                    <p class="text-sm text-slate-600 mb-3">Verify webhook payloads using HMAC SHA-256 and the header below.</p>
                    <div class="rounded-2xl bg-slate-900 text-slate-100 px-4 py-3 text-xs font-mono whitespace-pre-wrap">
$signature = hash_hmac('sha256', $payload, $webhookSecret);
if ($signature === $_SERVER['HTTP_X_MOCKPAY_SIGNATURE']) {
    // Webhook is authentic
}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
