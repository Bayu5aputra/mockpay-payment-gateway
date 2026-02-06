<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('client.developers.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Developer Tools
            </a>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">API Documentation</h1>
            <p class="text-gray-600">Complete reference for MockPay API endpoints</p>
        </div>

        <!-- API Base URL -->
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl shadow-lg p-6 mb-8 text-white">
            <h3 class="text-lg font-semibold mb-2">Base URL</h3>
            <div class="bg-black/20 backdrop-blur-sm rounded-lg p-4 font-mono">
                https://mockpay.com/api/v1
            </div>
        </div>

        <!-- Endpoints -->
        <div class="space-y-6">
            <!-- Create Transaction -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <span class="bg-white text-green-600 px-3 py-1 rounded-lg font-bold text-sm">POST</span>
                            <span class="text-white font-mono">/transactions</span>
                        </div>
                        <span class="text-green-100 text-sm">Create a new transaction</span>
                    </div>
                </div>

                <div class="p-6">
                    <h4 class="font-semibold text-gray-900 mb-4">Request Body</h4>
                    <div class="bg-gray-900 rounded-lg p-4 mb-4">
                        <pre class="text-green-400 text-sm overflow-x-auto"><code>{
  "order_id": "ORDER-123456",
  "amount": 100000,
  "currency": "IDR",
  "customer_name": "John Doe",
  "customer_email": "john@example.com",
  "customer_phone": "081234567890",
  "payment_method": "bca_va",
  "description": "Payment for Order #123456",
  "items": [
    {
      "name": "Product A",
      "quantity": 1,
      "price": 50000
    },
    {
      "name": "Product B",
      "quantity": 1,
      "price": 50000
    }
  ],
  "callback_url": "https://yourdomain.com/webhook/payment"
}</code></pre>
                    </div>

                    <h4 class="font-semibold text-gray-900 mb-4">Response (200 OK)</h4>
                    <div class="bg-gray-900 rounded-lg p-4">
                        <pre class="text-blue-400 text-sm overflow-x-auto"><code>{
  "success": true,
  "data": {
    "transaction_id": "TRX-20260127-00001",
    "order_id": "ORDER-123456",
    "status": "pending",
    "amount": 100000,
    "payment_method": "bca_va",
    "payment_details": {
      "va_number": "80777123456789",
      "bank_code": "bca",
      "expired_at": "2026-01-27T23:59:59Z"
    },
    "created_at": "2026-01-27T10:00:00Z"
  }
}</code></pre>
                    </div>
                </div>
            </div>

            <!-- Get Transaction -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <span class="bg-white text-blue-600 px-3 py-1 rounded-lg font-bold text-sm">GET</span>
                            <span class="text-white font-mono">/transactions/{transaction_id}</span>
                        </div>
                        <span class="text-blue-100 text-sm">Get transaction details</span>
                    </div>
                </div>

                <div class="p-6">
                    <h4 class="font-semibold text-gray-900 mb-4">Path Parameters</h4>
                    <div class="mb-4">
                        <div class="flex items-start space-x-4">
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm text-gray-800">transaction_id</code>
                            <div>
                                <p class="text-sm text-gray-600">The unique transaction identifier</p>
                                <p class="text-xs text-gray-500 mt-1">Example: TRX-20260127-00001</p>
                            </div>
                        </div>
                    </div>

                    <h4 class="font-semibold text-gray-900 mb-4">Response (200 OK)</h4>
                    <div class="bg-gray-900 rounded-lg p-4">
                        <pre class="text-blue-400 text-sm overflow-x-auto"><code>{
  "success": true,
  "data": {
    "transaction_id": "TRX-20260127-00001",
    "order_id": "ORDER-123456",
    "status": "settlement",
    "amount": 100000,
    "payment_method": "bca_va",
    "customer_name": "John Doe",
    "customer_email": "john@example.com",
    "paid_at": "2026-01-27T12:30:00Z",
    "created_at": "2026-01-27T10:00:00Z"
  }
}</code></pre>
                    </div>
                </div>
            </div>

            <!-- Cancel Transaction -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <span class="bg-white text-red-600 px-3 py-1 rounded-lg font-bold text-sm">DELETE</span>
                            <span class="text-white font-mono">/transactions/{transaction_id}</span>
                        </div>
                        <span class="text-red-100 text-sm">Cancel a transaction</span>
                    </div>
                </div>

                <div class="p-6">
                    <h4 class="font-semibold text-gray-900 mb-4">Response (200 OK)</h4>
                    <div class="bg-gray-900 rounded-lg p-4">
                        <pre class="text-blue-400 text-sm overflow-x-auto"><code>{
  "success": true,
  "message": "Transaction cancelled successfully",
  "data": {
    "transaction_id": "TRX-20260127-00001",
    "status": "cancel",
    "cancelled_at": "2026-01-27T14:00:00Z"
  }
}</code></pre>
                    </div>
                </div>
            </div>
        </div>

        <!-- Authentication -->
        <div class="bg-white rounded-xl shadow-md p-6 mt-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Authentication</h2>
            <p class="text-gray-600 mb-4">All API requests require authentication using your API key. Include it in the request header:</p>
            <div class="bg-gray-900 rounded-lg p-4">
                <pre class="text-green-400 text-sm"><code>Authorization: Bearer your-api-key-here</code></pre>
            </div>
        </div>

        <!-- Status Codes -->
        <div class="bg-white rounded-xl shadow-md p-6 mt-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">HTTP Status Codes</h2>
            <div class="space-y-3">
                <div class="flex items-start space-x-4">
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-lg font-bold text-sm w-16 text-center">200</span>
                    <p class="text-gray-600">Success - The request was successful</p>
                </div>
                <div class="flex items-start space-x-4">
                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-lg font-bold text-sm w-16 text-center">400</span>
                    <p class="text-gray-600">Bad Request - Invalid request parameters</p>
                </div>
                <div class="flex items-start space-x-4">
                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-lg font-bold text-sm w-16 text-center">401</span>
                    <p class="text-gray-600">Unauthorized - Invalid or missing API key</p>
                </div>
                <div class="flex items-start space-x-4">
                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-lg font-bold text-sm w-16 text-center">404</span>
                    <p class="text-gray-600">Not Found - Resource not found</p>
                </div>
                <div class="flex items-start space-x-4">
                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-lg font-bold text-sm w-16 text-center">500</span>
                    <p class="text-gray-600">Server Error - Internal server error</p>
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>
</x-app-layout>
