{{-- resources/views/public/docs/webhooks.blade.php --}}
@extends('layouts.public')

@section('title', 'Webhooks - MockPay Documentation')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="{{ route('docs.index') }}" class="text-blue-600 hover:text-blue-800">Documentation</a></li>
                <li class="text-gray-500">/</li>
                <li class="text-gray-900 font-semibold">Webhooks</li>
            </ol>
        </nav>

        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-6">Webhooks</h1>
            <p class="text-gray-700 mb-8">
                Webhooks allow MockPay to notify your application when transaction status changes. 
                Configure your webhook URL in the dashboard settings.
            </p>

            <section id="overview" class="mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Overview</h2>
                <p class="text-gray-700 mb-4">
                    When a transaction status changes, MockPay sends a POST request to your webhook URL with the transaction details.
                </p>
                <div class="bg-gray-900 text-gray-100 rounded-lg p-6 mb-6 overflow-x-auto">
                    <pre><code>{
    "event": "transaction.success",
    "timestamp": "2024-01-29T12:00:00Z",
    "data": {
        "transaction_id": "TRX-xxxxx",
        "order_id": "ORDER-12345",
        "amount": 100000,
        "status": "success",
        "payment_method": "bank_transfer",
        "payment_channel": "bca_va"
    }
}</code></pre>
                </div>
            </section>

            <section id="events" class="mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Event Types</h2>
                <div class="space-y-4">
                    @foreach($events as $event)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h3 class="font-mono text-sm font-semibold text-blue-600 mb-2">{{ $event['name'] }}</h3>
                        <p class="text-gray-700">{{ $event['description'] }}</p>
                    </div>
                    @endforeach
                </div>
            </section>

            <section id="verification" class="mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Signature Verification</h2>
                <p class="text-gray-700 mb-4">
                    Verify webhook authenticity using the X-Signature header:
                </p>
                <div class="bg-gray-900 text-gray-100 rounded-lg p-6 overflow-x-auto">
                    <pre><code>$signature = hash_hmac('sha256', $payload, $webhookSecret);
if ($signature === $_SERVER['HTTP_X_SIGNATURE']) {
    // Webhook is authentic
}</code></pre>
                </div>
            </section>

            <div class="bg-blue-50 border-l-4 border-blue-600 p-4">
                <p class="text-blue-900">
                    <strong>Tip:</strong> Test webhooks using tools like <a href="https://webhook.site" target="_blank" class="underline">webhook.site</a> or ngrok for local development.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection