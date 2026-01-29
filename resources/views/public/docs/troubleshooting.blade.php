{{-- resources/views/public/docs/troubleshooting.blade.php --}}
@extends('layouts.public')

@section('title', 'Troubleshooting - MockPay Documentation')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="{{ route('docs.index') }}" class="text-blue-600 hover:text-blue-800">Documentation</a></li>
                <li class="text-gray-500">/</li>
                <li class="text-gray-900 font-semibold">Troubleshooting</li>
            </ol>
        </nav>

        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-6">Troubleshooting</h1>
            <p class="text-gray-700 mb-8">Common issues and solutions</p>

            <div class="space-y-8">
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-3">Authentication Errors (401)</h2>
                    <p class="text-gray-700 mb-3"><strong>Problem:</strong> Receiving "Unauthorized" or "Invalid API key" errors</p>
                    <p class="text-gray-700 mb-3"><strong>Solutions:</strong></p>
                    <ul class="list-disc list-inside space-y-2 ml-4 text-gray-700">
                        <li>Verify you're using the correct API key format: <code class="bg-gray-100 px-2 py-1 rounded text-sm">sandbox_sk_test_...</code></li>
                        <li>Check that the Authorization header is properly formatted: <code class="bg-gray-100 px-2 py-1 rounded text-sm">Bearer YOUR_API_KEY</code></li>
                        <li>Ensure your API key hasn't been revoked or regenerated</li>
                        <li>Verify you're using the Server Key, not the Client Key for API calls</li>
                    </ul>
                </div>

                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-3">Webhook Not Received</h2>
                    <p class="text-gray-700 mb-3"><strong>Problem:</strong> Webhooks are not being delivered to your endpoint</p>
                    <p class="text-gray-700 mb-3"><strong>Solutions:</strong></p>
                    <ul class="list-disc list-inside space-y-2 ml-4 text-gray-700">
                        <li>Verify your webhook URL is publicly accessible (not localhost)</li>
                        <li>Check that your endpoint accepts POST requests</li>
                        <li>Ensure your server responds with 200 OK status</li>
                        <li>For local development, use ngrok or similar tunneling tools</li>
                        <li>Check webhook logs in your dashboard</li>
                    </ul>
                </div>

                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-3">Payment Not Processing</h2>
                    <p class="text-gray-700 mb-3"><strong>Problem:</strong> Payment stuck in pending status</p>
                    <p class="text-gray-700 mb-3"><strong>Solutions:</strong></p>
                    <ul class="list-disc list-inside space-y-2 ml-4 text-gray-700">
                        <li>Use the simulation tools to complete test payments</li>
                        <li>Check transaction expiry time (default 24 hours)</li>
                        <li>Verify the payment URL is accessible</li>
                        <li>Check if the transaction was cancelled</li>
                    </ul>
                </div>

                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-3">Invalid Request (400)</h2>
                    <p class="text-gray-700 mb-3"><strong>Problem:</strong> Receiving "Bad Request" or validation errors</p>
                    <p class="text-gray-700 mb-3"><strong>Solutions:</strong></p>
                    <ul class="list-disc list-inside space-y-2 ml-4 text-gray-700">
                        <li>Check the request payload matches the API documentation</li>
                        <li>Ensure all required fields are included</li>
                        <li>Verify data types (amount should be integer, not string)</li>
                        <li>Check for special characters in customer data</li>
                        <li>Review the error message for specific field errors</li>
                    </ul>
                </div>

                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-3">Rate Limit Exceeded (429)</h2>
                    <p class="text-gray-700 mb-3"><strong>Problem:</strong> Too many requests error</p>
                    <p class="text-gray-700 mb-3"><strong>Solutions:</strong></p>
                    <ul class="list-disc list-inside space-y-2 ml-4 text-gray-700">
                        <li>Implement exponential backoff in your retry logic</li>
                        <li>Reduce the frequency of API calls</li>
                        <li>Use webhooks instead of polling for status updates</li>
                        <li>Contact support if you need higher rate limits</li>
                    </ul>
                </div>

                <div class="pb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-3">3D Secure Issues</h2>
                    <p class="text-gray-700 mb-3"><strong>Problem:</strong> 3D Secure authentication not working</p>
                    <p class="text-gray-700 mb-3"><strong>Solutions:</strong></p>
                    <ul class="list-disc list-inside space-y-2 ml-4 text-gray-700">
                        <li>Use test card 4111111111110000 for 3DS testing</li>
                        <li>Use OTP: 112233 for test 3DS authentication</li>
                        <li>Ensure redirect URLs are properly configured</li>
                        <li>Check that your callback URL is accessible</li>
                    </ul>
                </div>
            </div>

            <div class="mt-8 bg-blue-50 border-l-4 border-blue-600 p-4">
                <p class="text-blue-900">
                    <strong>Still having issues?</strong> Contact our support team at 
                    <a href="mailto:support@mockpay.test" class="underline">support@mockpay.test</a> or 
                    <a href="{{ route('contact') }}" class="underline">submit a support ticket</a>.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection