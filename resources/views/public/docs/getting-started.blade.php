@extends('layouts.docs')

@section('title', 'Getting Started - MockPay Documentation')

@section('doc-content')
<div class="bg-white rounded-lg shadow-md p-8">
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm">
            <li><a href="{{ route('docs.index') }}" class="text-blue-600 hover:text-blue-800">Documentation</a></li>
            <li class="text-gray-500">/</li>
            <li class="text-gray-900 font-semibold">Getting Started</li>
        </ol>
    </nav>

    <h1 class="text-4xl font-bold text-gray-900 mb-6">Getting Started</h1>

    <section id="introduction" class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Introduction</h2>
        <p class="text-gray-700 mb-4">
            MockPay is a complete payment gateway simulation platform designed for developers to test payment integrations without connecting to real payment processors. 
            It mimics the behavior of popular Indonesian payment gateways like Midtrans and Xendit.
        </p>
        <div class="bg-blue-50 border-l-4 border-blue-600 p-4 mb-6">
            <p class="text-blue-900">
                <strong>Note:</strong> MockPay is for testing and development only. Do not use it for production transactions.
            </p>
        </div>
    </section>

    <section id="quick-start" class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Quick Start</h2>
        
        <h3 class="text-xl font-semibold text-gray-900 mb-3">1. Create an Account</h3>
        <p class="text-gray-700 mb-4">
            Register for a free account at <a href="{{ route('register') }}" class="text-blue-600 hover:underline">mockpay.test/register</a>
        </p>

        <h3 class="text-xl font-semibold text-gray-900 mb-3">2. Generate API Keys</h3>
        <p class="text-gray-700 mb-4">
            Once logged in, navigate to the Dashboard and generate your API keys:
        </p>
        <ol class="list-decimal list-inside space-y-2 mb-6 ml-4">
            <li class="text-gray-700">Go to Dashboard → API Keys</li>
            <li class="text-gray-700">Click "Generate New Key"</li>
            <li class="text-gray-700">Copy your Server Key (starts with <code class="bg-gray-100 px-2 py-1 rounded text-sm">sandbox_sk_</code>)</li>
            <li class="text-gray-700">Keep it secure - treat it like a password</li>
        </ol>

        <h3 class="text-xl font-semibold text-gray-900 mb-3">3. Make Your First API Call</h3>
        <div class="bg-gray-900 text-gray-100 rounded-lg p-6 mb-6 overflow-x-auto">
            <pre><code>curl -X POST https://mockpay.test/api/v1/payment/create \
  -H "Authorization: Bearer sandbox_sk_test_xxxxxxxxxx" \
  -H "Content-Type: application/json" \
  -d '{
    "order_id": "ORDER-12345",
    "amount": 100000,
    "payment_method": "bank_transfer",
    "payment_channel": "bca_va",
    "customer": {
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "081234567890"
    }
}'</code></pre>
        </div>

        <h3 class="text-xl font-semibold text-gray-900 mb-3">4. Handle the Response</h3>
        <p class="text-gray-700 mb-4">
            The API will return a response with payment details:
        </p>
        <div class="bg-gray-900 text-gray-100 rounded-lg p-6 mb-6 overflow-x-auto">
            <pre><code>{
    "success": true,
    "data": {
        "transaction_id": "TRX-xxxxx",
        "order_id": "ORDER-12345",
        "amount": 100000,
        "status": "pending",
        "payment_url": "https://mockpay.test/payment/TRX-xxxxx",
        "virtual_account_number": "8808123456789012",
        "expires_at": "2024-01-30T23:59:59Z"
    }
}</code></pre>
        </div>

        <h3 class="text-xl font-semibold text-gray-900 mb-3">5. Test Payment</h3>
        <p class="text-gray-700 mb-4">
            Direct your customer to the <code class="bg-gray-100 px-2 py-1 rounded text-sm">payment_url</code> to complete the payment. 
            Use our simulation tools to test different payment scenarios.
        </p>
    </section>

    <section id="api-keys" class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Understanding API Keys</h2>
        
        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div class="border border-gray-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Server Key</h3>
                <p class="text-sm text-gray-600 mb-2"><code class="bg-gray-100 px-2 py-1 rounded">sandbox_sk_test_...</code></p>
                <p class="text-gray-700">
                    Used for server-side API calls. Keep this secret and never expose it in client-side code.
                </p>
            </div>
            <div class="border border-gray-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Client Key</h3>
                <p class="text-sm text-gray-600 mb-2"><code class="bg-gray-100 px-2 py-1 rounded">sandbox_pk_test_...</code></p>
                <p class="text-gray-700">
                    Used for client-side integrations. Safe to expose in frontend applications.
                </p>
            </div>
        </div>

        <div class="bg-yellow-50 border-l-4 border-yellow-600 p-4">
            <p class="text-yellow-900">
                <strong>Security Warning:</strong> Never commit API keys to version control. Use environment variables instead.
            </p>
        </div>
    </section>

    <section class="border-t border-gray-200 pt-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Next Steps</h2>
        <div class="grid md:grid-cols-3 gap-4">
            <a href="{{ route('docs.authentication') }}" class="border border-gray-200 rounded-lg p-4 hover:border-blue-600 hover:shadow-md transition-all">
                <h3 class="font-semibold text-gray-900 mb-2">Authentication</h3>
                <p class="text-sm text-gray-600">Learn how to authenticate API requests</p>
            </a>
            <a href="{{ route('docs.api-reference') }}" class="border border-gray-200 rounded-lg p-4 hover:border-blue-600 hover:shadow-md transition-all">
                <h3 class="font-semibold text-gray-900 mb-2">API Reference</h3>
                <p class="text-sm text-gray-600">Explore all available endpoints</p>
            </a>
            <a href="{{ route('docs.examples') }}" class="border border-gray-200 rounded-lg p-4 hover:border-blue-600 hover:shadow-md transition-all">
                <h3 class="font-semibold text-gray-900 mb-2">Code Examples</h3>
                <p class="text-sm text-gray-600">See implementation examples</p>
            </a>
        </div>
    </section>
</div>
@endsection