@extends('layouts.docs')

@section('title', 'Authentication - MockPay Documentation')

@section('doc-content')
@php
    $baseUrl = rtrim(config('app.url'), '/');
@endphp
<div class="rounded-[28px] bg-white/90 border border-white/70 shadow-[0_25px_60px_rgba(15,23,42,0.08)] p-8 lg:p-10">
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm">
            <li><a href="{{ route('docs.index') }}" class="text-slate-500 hover:text-slate-900">Documentation</a></li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-900 font-semibold">Authentication</li>
        </ol>
    </nav>

    <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">API Security</p>
    <h1 class="text-4xl lg:text-5xl font-semibold text-slate-900 mb-6">Authentication</h1>

    <p class="text-base text-slate-600 mb-8">
        MockPay API uses Bearer token authentication. All API requests must include your Server Key in the Authorization header. Keys are scoped to your client account, and all data is strictly isolated per client.
    </p>

    <section class="mb-12">
        <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">Setup</p>
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">Obtaining API Keys</h2>
        <p class="text-base text-slate-600 mb-4">
            API keys are available exclusively for registered clients. Follow these steps to obtain your credentials:
        </p>
        <div class="space-y-4">
            <div class="flex gap-4">
                <div class="w-8 h-8 rounded-full bg-slate-900 text-white flex items-center justify-center font-semibold flex-shrink-0 text-sm">1</div>
                <div>
                    <p class="text-sm text-slate-600">Register at <a href="{{ route('register') }}" class="text-slate-900 font-medium underline hover:text-slate-700">{{ route('register') }}</a></p>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="w-8 h-8 rounded-full bg-slate-900 text-white flex items-center justify-center font-semibold flex-shrink-0 text-sm">2</div>
                <div>
                    <p class="text-sm text-slate-600">Login at <a href="{{ route('login') }}" class="text-slate-900 font-medium underline hover:text-slate-700">{{ route('login') }}</a></p>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="w-8 h-8 rounded-full bg-slate-900 text-white flex items-center justify-center font-semibold flex-shrink-0 text-sm">3</div>
                <div>
                    <p class="text-sm text-slate-600">Navigate to <strong>Client Dashboard → API Keys</strong></p>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center font-semibold flex-shrink-0 text-sm">4</div>
                <div>
                    <p class="text-sm text-slate-600">Click <strong>"Generate New Key"</strong> to create your Server Key</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-12">
        <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">Header Format</p>
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">Authorization Header</h2>
        <p class="text-base text-slate-600 mb-4">
            Include your Server Key in the Authorization header for every API request:
        </p>
        <div class="rounded-[22px] bg-slate-900 text-slate-100 p-6 overflow-x-auto">
            <pre class="text-sm font-mono"><code>Authorization: Bearer sandbox_sk_test_xxxxxxxxxx</code></pre>
        </div>
    </section>

    <section class="mb-12">
        <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">Implementation Examples</p>
        <h2 class="text-2xl font-semibold text-slate-900 mb-6">Code Examples</h2>

        <div class="space-y-6">
            <div>
                <h3 class="text-base font-semibold text-slate-900 mb-3 flex items-center">
                    <span class="w-6 h-6 rounded bg-amber-500 text-white text-xs flex items-center justify-center mr-2 font-bold">$</span>
                    cURL
                </h3>
                <div class="rounded-[22px] bg-slate-900 text-slate-100 p-6 overflow-x-auto">
                    <pre class="text-sm font-mono"><code>curl -X POST {{ $baseUrl }}/api/v1/payment/create \
  -H "Authorization: Bearer sandbox_sk_test_xxxxxxxxxx" \
  -H "Content-Type: application/json" \
  -d '{"order_id": "ORDER-123", "amount": 100000}'</code></pre>
                </div>
            </div>

            <div>
                <h3 class="text-base font-semibold text-slate-900 mb-3 flex items-center">
                    <span class="w-6 h-6 rounded bg-indigo-500 text-white text-xs flex items-center justify-center mr-2 font-bold">P</span>
                    PHP (Laravel HTTP Client)
                </h3>
                <div class="rounded-[22px] bg-slate-900 text-slate-100 p-6 overflow-x-auto">
                    <pre class="text-sm font-mono"><code>$apiKey = 'sandbox_sk_test_xxxxxxxxxx';

$response = Http::withHeaders([
    'Authorization' => 'Bearer ' . $apiKey,
    'Content-Type' => 'application/json',
])->post('{{ $baseUrl }}/api/v1/payment/create', [
    'order_id' => 'ORDER-123',
    'amount' => 100000
]);</code></pre>
                </div>
            </div>

            <div>
                <h3 class="text-base font-semibold text-slate-900 mb-3 flex items-center">
                    <span class="w-6 h-6 rounded bg-yellow-500 text-white text-xs flex items-center justify-center mr-2 font-bold">JS</span>
                    JavaScript (Fetch API)
                </h3>
                <div class="rounded-[22px] bg-slate-900 text-slate-100 p-6 overflow-x-auto">
                    <pre class="text-sm font-mono"><code>const apiKey = 'sandbox_sk_test_xxxxxxxxxx';

const response = await fetch('{{ $baseUrl }}/api/v1/payment/create', {
    method: 'POST',
    headers: {
        'Authorization': `Bearer ${apiKey}`,
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        order_id: 'ORDER-123',
        amount: 100000
    })
});</code></pre>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-12">
        <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">Error Handling</p>
        <h2 class="text-2xl font-semibold text-slate-900 mb-6">Authentication Errors</h2>

        <div class="space-y-6">
            <div class="rounded-[22px] border border-red-200 bg-red-50 p-6">
                <h3 class="text-base font-semibold text-red-900 mb-2">401 Unauthorized</h3>
                <p class="text-sm text-red-800 mb-4">Missing or invalid API key</p>
                <div class="rounded-[16px] bg-slate-900 text-slate-100 p-5 overflow-x-auto">
                    <pre class="text-sm font-mono"><code>{
    "success": false,
    "error": {
        "code": "UNAUTHORIZED",
        "message": "Invalid or missing API key"
    }
}</code></pre>
                </div>
            </div>

            <div class="rounded-[22px] border border-amber-200 bg-amber-50 p-6">
                <h3 class="text-base font-semibold text-amber-900 mb-2">403 Forbidden</h3>
                <p class="text-sm text-amber-800 mb-4">API key lacks required permissions for the operation</p>
                <div class="rounded-[16px] bg-slate-900 text-slate-100 p-5 overflow-x-auto">
                    <pre class="text-sm font-mono"><code>{
    "success": false,
    "error": {
        "code": "FORBIDDEN",
        "message": "Insufficient permissions for this operation"
    }
}</code></pre>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-12">
        <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">Security</p>
        <h2 class="text-2xl font-semibold text-slate-900 mb-6">Best Practices</h2>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-5">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-500 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-900 mb-1">Use Environment Variables</p>
                        <p class="text-xs text-slate-600">Store API keys in environment variables, never hardcode them in source code</p>
                    </div>
                </div>
            </div>

            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-5">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-500 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-900 mb-1">Rotate Keys Regularly</p>
                        <p class="text-xs text-slate-600">Use separate keys for development and testing, rotate and revoke unused keys</p>
                    </div>
                </div>
            </div>

            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-5">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-500 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-900 mb-1">Server-Side Only</p>
                        <p class="text-xs text-slate-600">Never expose Server Keys in client-side code or browser applications</p>
                    </div>
                </div>
            </div>

            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-5">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-500 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-900 mb-1">Use HTTPS</p>
                        <p class="text-xs text-slate-600">Always use secure HTTPS connections to protect API credentials in transit</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="rounded-[22px] bg-slate-900 text-white p-6">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-white mb-1">Need Assistance?</h3>
                <p class="text-sm text-white/70">
                    Review our <a href="{{ route('docs.examples') }}" class="text-emerald-400 hover:text-emerald-300 underline">code examples</a> for complete implementations or <a href="{{ route('contact') }}" class="text-emerald-400 hover:text-emerald-300 underline">contact support</a> for technical assistance.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
