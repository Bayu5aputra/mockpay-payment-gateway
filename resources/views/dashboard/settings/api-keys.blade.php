<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-6xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">API Keys</h1>
            <p class="text-gray-600">Manage your API keys for authentication</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-green-800 font-medium">{{ session('success') }}</p>
                </div>
            </div>

            @if(session('new_api_key'))
                <div class="mt-4 bg-white border border-green-200 rounded-lg p-4">
                    <p class="text-sm text-gray-700 mb-2 font-semibold">Your new API Key (save this, it won't be shown again):</p>
                    <div class="flex items-center space-x-2">
                        <code id="newApiKey" class="flex-1 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-900">{{ session('new_api_key') }}</code>
                        <button onclick="copyToClipboard('newApiKey')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium">
                            Copy
                        </button>
                    </div>
                </div>
            @endif
        @endif

    <!-- Create New API Key -->
    <div class="bg-white rounded-xl shadow-md p-8 mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Create New API Key</h2>

        <form action="{{ route('dashboard.api-keys.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Key Name</label>
                    <input type="text" id="name" name="name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="e.g., Production API Key">
                </div>

                <div>
                    <label for="environment" class="block text-sm font-semibold text-gray-700 mb-2">Environment</label>
                    <select id="environment" name="environment" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <option value="sandbox">Sandbox (Testing)</option>
                        <option value="production">Production (Live)</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold px-8 py-3 rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                Generate API Key
            </button>
        </form>
    </div>

    <!-- Existing API Keys -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-900">Your API Keys</h3>
        </div>

        <div class="divide-y divide-gray-200">
            @forelse($apiKeys as $apiKey)
            <div class="p-6 hover:bg-gray-50 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-2">
                            <h4 class="text-lg font-semibold text-gray-900">{{ $apiKey->key_name }}</h4>
                            @if($apiKey->environment === 'production')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Production</span>
                            @else
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Sandbox</span>
                            @endif
                            @if($apiKey->is_active)
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                            @else
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Inactive</span>
                            @endif
                        </div>

                        <div class="flex items-center space-x-2 mb-3">
                            <code id="apiKey{{ $apiKey->id }}" class="bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-900">
                                {{ $apiKey->getMaskedKey() }}
                            </code>
                            <button onclick="copyToClipboard('apiKey{{ $apiKey->id }}')" class="px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 text-sm font-medium">
                                Copy
                            </button>
                        </div>

                        <div class="flex items-center space-x-6 text-sm text-gray-600">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Created {{ $apiKey->created_at->diffForHumans() }}
                            </div>
                            @if($apiKey->last_used_at)
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Last used {{ $apiKey->last_used_at->diffForHumans() }}
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">
                        <form action="{{ route('dashboard.api-keys.regenerate', $apiKey->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" onclick="return confirm('This will invalidate the current key. Continue?')" class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 text-sm font-medium">
                                Regenerate
                            </button>
                        </form>

                        <form action="{{ route('dashboard.api-keys.destroy', $apiKey->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this API key?')" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-medium">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-12 text-center">
                <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No API Keys Yet</h3>
                <p class="text-gray-600">Create your first API key to start making requests</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Security Notice -->
    <div class="bg-amber-50 border border-amber-200 rounded-lg p-6 mt-8">
        <div class="flex items-start">
            <svg class="w-6 h-6 text-amber-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <div>
                <h4 class="text-sm font-semibold text-amber-900 mb-2">Security Best Practices</h4>
                <ul class="text-sm text-amber-800 space-y-1">
                    <li>• Keep your API keys secure and never share them publicly</li>
                    <li>• Use different keys for development and production environments</li>
                    <li>• Rotate your keys regularly for enhanced security</li>
                    <li>• Delete unused API keys immediately</li>
                </ul>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    function copyToClipboard(elementId) {
        const element = document.getElementById(elementId);
        const text = element.textContent;

        navigator.clipboard.writeText(text).then(() => {
            const originalText = event.target.textContent;
            event.target.textContent = 'Copied!';
            event.target.classList.add('bg-green-600');

            setTimeout(() => {
                event.target.textContent = originalText;
                event.target.classList.remove('bg-green-600');
            }, 2000);
        });
    }
</script>
@endpush

</x-app-layout>
