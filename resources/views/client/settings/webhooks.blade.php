<x-app-layout>
    <div class="p-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Webhook Settings</h1>
            <p class="text-gray-600">Set the endpoint to receive transaction notifications from MockPay.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow p-6 space-y-6">
            <form method="POST" action="{{ route('client.settings.webhooks.update') }}" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Webhook URL</label>
                    <input type="url" name="webhook_url" value="{{ $user->webhook_url }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="https://example.com/webhook">
                </div>
                <button class="px-6 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700">
                    Save Webhook
                </button>
            </form>

            <div class="border-t pt-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-700 font-medium">Webhook Secret</p>
                        <p class="text-xs text-gray-500">Use this to verify webhook signatures.</p>
                        <p class="mt-2 font-mono text-sm text-gray-700">{{ $user->webhook_secret ?? '-' }}</p>
                    </div>
                    <form method="POST" action="{{ route('client.settings.webhooks.generate-secret') }}">
                        @csrf
                        <button class="px-4 py-2 bg-gray-900 text-white rounded-lg text-sm">Generate</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
