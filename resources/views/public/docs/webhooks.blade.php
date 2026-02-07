@extends('layouts.docs')

@section('title', 'Webhooks - MockPay Documentation')

@section('doc-content')
<div class="rounded-[28px] bg-white/90 border border-white/70 shadow-[0_25px_60px_rgba(15,23,42,0.08)] p-8 lg:p-10">
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm">
            <li><a href="{{ route('docs.index') }}" class="text-slate-500 hover:text-slate-900">Documentation</a></li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-900 font-semibold">Webhooks</li>
        </ol>
    </nav>

    <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">Event Notifications</p>
    <h1 class="text-4xl lg:text-5xl font-semibold text-slate-900 mb-6">Webhooks</h1>
    <p class="text-base text-slate-600 mb-8">
        Webhooks enable MockPay to notify your application in real-time when transaction status changes occur. Configure your webhook URL in the Client Dashboard settings. All webhook events are scoped to your client account.
    </p>

    <section id="overview" class="mb-12">
        <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">How It Works</p>
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">Webhook Overview</h2>
        <p class="text-base text-slate-600 mb-4">
            When a transaction status changes (via manual override or automatic expiration), MockPay sends a <code class="bg-slate-100 px-2 py-0.5 rounded text-xs font-mono">POST</code> request to your configured webhook URL containing the transaction details.
        </p>
        <div class="rounded-[22px] bg-slate-900 text-slate-100 p-6 mb-6 overflow-x-auto">
            <p class="text-xs text-slate-400 mb-3 font-mono">// Example Webhook Payload</p>
            <pre class="text-sm font-mono"><code>{
    "event": "transaction.success",
    "timestamp": "2026-01-29T12:00:00Z",
    "data": {
        "transaction_id": "TRX-xxxxx",
        "order_id": "ORDER-12345",
        "amount": 100000,
        "status": "success",
        "payment_method": "bank_transfer",
        "payment_channel": "bca_va",
        "paid_at": "2026-01-29T12:00:00Z"
    }
}</code></pre>
        </div>
    </section>

    <section id="events" class="mb-12">
        <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">Supported Events</p>
        <h2 class="text-2xl font-semibold text-slate-900 mb-6">Event Types</h2>
        <div class="space-y-4">
            @foreach($events as $event)
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-5 hover:border-slate-400 transition-all">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-8 h-8 rounded-lg bg-slate-900 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <code class="text-sm font-mono font-semibold text-slate-900">{{ $event['name'] }}</code>
                </div>
                <p class="text-sm text-slate-600 ml-11">{{ $event['description'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <section id="verification" class="mb-12">
        <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">Security</p>
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">Signature Verification</h2>
        <p class="text-base text-slate-600 mb-4">
            To ensure webhook authenticity, verify the <code class="bg-slate-100 px-2 py-0.5 rounded text-xs font-mono">X-Mockpay-Signature</code> header against the computed HMAC-SHA256 signature of the request body.
        </p>
        <div class="rounded-[22px] bg-slate-900 text-slate-100 p-6 mb-6 overflow-x-auto">
            <p class="text-xs text-slate-400 mb-3 font-mono">// PHP Signature Verification Example</p>
            <pre class="text-sm font-mono"><code>$payload = file_get_contents('php://input');
$signature = hash_hmac('sha256', $payload, $webhookSecret);
$headerSignature = $_SERVER['HTTP_X_MOCKPAY_SIGNATURE'] ?? '';

if (hash_equals($signature, $headerSignature)) {
    // Webhook is authentic — process the event
    $event = json_decode($payload, true);
    // Handle event based on $event['event'] type
} else {
    // Invalid signature — reject the request
    http_response_code(401);
    exit('Invalid signature');
}</code></pre>
        </div>
        
        <div class="rounded-[22px] bg-red-50 border border-red-200 p-6 mb-6">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-red-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-red-900 mb-1">Security Best Practice</h3>
                    <p class="text-sm text-red-800">Always verify webhook signatures before processing events. Use <code class="bg-red-100 px-1 py-0.5 rounded text-xs font-mono">hash_equals()</code> for timing-safe string comparison to prevent timing attacks.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="retry" class="mb-12">
        <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">Delivery</p>
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">Retry Logic</h2>
        <p class="text-base text-slate-600 mb-4">
            MockPay automatically retries failed webhook deliveries using exponential backoff. The retry schedule is as follows:
        </p>
        <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-6">
            <div class="grid grid-cols-4 gap-4 text-center">
                <div>
                    <p class="text-2xl font-semibold text-slate-900">1</p>
                    <p class="text-xs text-slate-500 mt-1">Immediate</p>
                </div>
                <div>
                    <p class="text-2xl font-semibold text-slate-900">2</p>
                    <p class="text-xs text-slate-500 mt-1">After 5 min</p>
                </div>
                <div>
                    <p class="text-2xl font-semibold text-slate-900">3</p>
                    <p class="text-xs text-slate-500 mt-1">After 30 min</p>
                </div>
                <div>
                    <p class="text-2xl font-semibold text-slate-900">4</p>
                    <p class="text-xs text-slate-500 mt-1">After 2 hours</p>
                </div>
            </div>
        </div>
    </section>

    <div class="rounded-[22px] bg-slate-900 text-white p-6">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-white mb-1">Development Tip</h3>
                <p class="text-sm text-white/70">
                    Test webhooks locally using tools like <a href="https://webhook.site" target="_blank" class="text-emerald-400 hover:text-emerald-300 underline">webhook.site</a> or <a href="https://ngrok.com" target="_blank" class="text-emerald-400 hover:text-emerald-300 underline">ngrok</a> to expose your local server to the internet.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
