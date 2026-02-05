<x-app-layout>
    <div class="p-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">API Keys</h1>
            <p class="text-gray-600">Generate and manage your API keys for MockPay integration.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
                @if(session('new_api_key'))
                    <div class="mt-2 text-sm text-green-700">
                        New API Key: <span class="font-mono">{{ session('new_api_key') }}</span>
                    </div>
                @endif
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <p class="text-red-800 font-medium">{{ session('error') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <form method="POST" action="{{ route('client.api-keys.store') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Key Name</label>
                    <input type="text" name="name" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="My Project Key" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Environment</label>
                    <select name="environment" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        <option value="sandbox">Sandbox</option>
                        <option value="production">Production</option>
                    </select>
                </div>
                <button class="px-6 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700">
                    Generate Key
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Key</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Environment</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Last Used</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($apiKeys as $apiKey)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-gray-900 font-medium">{{ $apiKey->key_name }}</td>
                                <td class="px-6 py-4 font-mono text-gray-700">{{ $apiKey->getMaskedKey() }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ ucfirst($apiKey->environment) }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $apiKey->last_used_at?->format('Y-m-d H:i') ?? '-' }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <form method="POST" action="{{ route('client.api-keys.regenerate', $apiKey->id) }}" class="inline">
                                        @csrf
                                        <button class="text-purple-600 hover:text-purple-700 font-medium">Rotate</button>
                                    </form>
                                    <form method="POST" action="{{ route('client.api-keys.destroy', $apiKey->id) }}" class="inline" onsubmit="return confirm('Delete this API key?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:text-red-700 font-medium">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-6 text-center text-gray-500">No API keys yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
