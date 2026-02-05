<x-app-layout>
    <div class="p-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Webhooks</h1>
            <p class="text-gray-600">Configure webhook endpoints for real-time notifications</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <p class="text-red-800 font-medium">{{ session('error') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Webhook Endpoint</h2>
            <form method="POST" action="{{ route('dashboard.settings.webhooks.update') }}" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Webhook URL</label>
                    <input type="url" name="webhook_url" value="{{ old('webhook_url', $merchant->webhook_url) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        placeholder="https://example.com/webhook">
                </div>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700">
                    Save Webhook URL
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Webhook Secret</h2>
            <div class="flex items-center space-x-3">
                <code class="flex-1 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-900">
                    {{ $merchant->webhook_secret ? substr($merchant->webhook_secret, 0, 8) . '••••••••••••' : 'Not set' }}
                </code>
                <form method="POST" action="{{ route('dashboard.settings.webhooks.generate-secret') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 text-sm font-medium">
                        Generate
                    </button>
                </form>
            </div>
            @if(session('new_secret'))
                <p class="mt-3 text-sm text-gray-700">New secret: <span class="font-mono">{{ session('new_secret') }}</span></p>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Test Webhook</h2>
            <form method="POST" action="{{ route('dashboard.settings.webhooks.test') }}">
                @csrf
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg hover:from-green-700 hover:to-green-800">
                    Send Test Webhook
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
