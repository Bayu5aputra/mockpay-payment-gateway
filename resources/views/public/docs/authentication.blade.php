@extends('layouts.docs')

@section('title', 'Authentication - MockPay Documentation')

@section('doc-content')
<div class="bg-white rounded-lg shadow-md p-8">
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm">
            <li><a href="{{ route('docs.index') }}" class="text-blue-600 hover:text-blue-800">Documentation</a></li>
            <li class="text-gray-500">/</li>
            <li class="text-gray-900 font-semibold">Authentication</li>
        </ol>
    </nav>

    <h1 class="text-4xl font-bold text-gray-900 mb-6">Authentication</h1>

    <p class="text-gray-700 mb-8">
        MockPay API uses Bearer token authentication. All API requests must include your Server Key in the Authorization header.
    </p>

    <section class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Authentication Header</h2>
        <p class="text-gray-700 mb-4">
            Include your Server Key in every API request:
        </p>
        <div class="bg-gray-900 text-gray-100 rounded-lg p-6 mb-6 overflow-x-auto">
            <pre><code>Authorization: Bearer sandbox_sk_test_xxxxxxxxxx</code></pre>
        </div>
    </section>

    <section class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Example Request</h2>
        
        <h3 class="text-xl font-semibold text-gray-900 mb-3">cURL</h3>
        <div class="bg-gray-900 text-gray-100 rounded-lg p-6 mb-6 overflow-x-auto">
            <pre><code>curl -X POST https://mockpay.test/api/v1/payment/create \
  -H "Authorization: Bearer sandbox_sk_test_xxxxxxxxxx" \
  -H "Content-Type: application/json" \
  -d '{"order_id": "ORDER-123", "amount": 100000}'</code></pre>
        </div>

        <h3 class="text-xl font-semibold text-gray-900 mb-3">PHP</h3>
        <div class="bg-gray-900 text-gray-100 rounded-lg p-6 mb-6 overflow-x-auto">
            <pre><code>$apiKey = 'sandbox_sk_test_xxxxxxxxxx';

$response = Http::withHeaders([
    'Authorization' => 'Bearer ' . $apiKey,
    'Content-Type' => 'application/json',
])->post('https://mockpay.test/api/v1/payment/create', [
    'order_id' => 'ORDER-123',
    'amount' => 100000
]);</code></pre>
        </div>

        <h3 class="text-xl font-semibold text-gray-900 mb-3">JavaScript</h3>
        <div class="bg-gray-900 text-gray-100 rounded-lg p-6 mb-6 overflow-x-auto">
            <pre><code>const apiKey = 'sandbox_sk_test_xxxxxxxxxx';

const response = await fetch('https://mockpay.test/api/v1/payment/create', {
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
    </section>

    <section class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Error Responses</h2>
        
        <h3 class="text-xl font-semibold text-gray-900 mb-3">401 Unauthorized</h3>
        <p class="text-gray-700 mb-4">Missing or invalid API key:</p>
        <div class="bg-gray-900 text-gray-100 rounded-lg p-6 mb-6 overflow-x-auto">
            <pre><code>{
    "success": false,
    "error": {
        "code": "UNAUTHORIZED",
        "message": "Invalid or missing API key"
    }
}</code></pre>
        </div>

        <h3 class="text-xl font-semibold text-gray-900 mb-3">403 Forbidden</h3>
        <p class="text-gray-700 mb-4">API key doesn't have permission:</p>
        <div class="bg-gray-900 text-gray-100 rounded-lg p-6 mb-6 overflow-x-auto">
            <pre><code>{
    "success": false,
    "error": {
        "code": "FORBIDDEN",
        "message": "Insufficient permissions for this operation"
    }
}</code></pre>
        </div>
    </section>

    <section class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Best Practices</h2>
        
        <div class="space-y-4">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-green-600 mr-3 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <div>
                    <p class="font-semibold text-gray-900">Store keys in environment variables</p>
                    <p class="text-gray-600">Never hardcode API keys in your source code</p>
                </div>
            </div>

            <div class="flex items-start">
                <svg class="w-6 h-6 text-green-600 mr-3 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <div>
                    <p class="font-semibold text-gray-900">Use different keys for development and testing</p>
                    <p class="text-gray-600">Rotate keys regularly and revoke unused keys</p>
                </div>
            </div>

            <div class="flex items-start">
                <svg class="w-6 h-6 text-green-600 mr-3 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <div>
                    <p class="font-semibold text-gray-900">Never expose Server Keys on client-side</p>
                    <p class="text-gray-600">Server Keys should only be used in backend code</p>
                </div>
            </div>

            <div class="flex items-start">
                <svg class="w-6 h-6 text-green-600 mr-3 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <div>
                    <p class="font-semibold text-gray-900">Use HTTPS for all API calls</p>
                    <p class="text-gray-600">Always use secure connections to protect your API keys</p>
                </div>
            </div>
        </div>
    </section>

    <div class="bg-blue-50 border-l-4 border-blue-600 p-4">
        <p class="text-blue-900">
            <strong>Need help?</strong> Check out our <a href="{{ route('docs.examples') }}" class="underline">code examples</a> or <a href="{{ route('contact') }}" class="underline">contact support</a>.
        </p>
    </div>
</div>
@endsection