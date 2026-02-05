<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
                <div class="flex flex-col gap-3">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Security</p>
                    <h1 class="text-4xl font-semibold text-slate-900">API Keys</h1>
                    <p class="text-sm text-slate-600 max-w-2xl">Generate and manage your API keys for MockPay integration. Use different keys for sandbox and production environments.</p>
                </div>

                @if(session('success'))
                    <div class="rounded-2xl border border-emerald-200 bg-emerald-50/80 p-4">
                        <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
                        @if(session('new_api_key'))
                            <div class="mt-2 text-sm text-emerald-700">
                                New API Key: <span class="font-mono">{{ session('new_api_key') }}</span>
                            </div>
                        @endif
                    </div>
                @endif
                @if(session('error'))
                    <div class="rounded-2xl border border-rose-200 bg-rose-50/80 p-4">
                        <p class="text-rose-800 font-medium">{{ session('error') }}</p>
                    </div>
                @endif

                <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                    <form method="POST" action="{{ route('client.api-keys.store') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Key Name</label>
                            <input type="text" name="name" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-900/20" placeholder="My Project Key" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Environment</label>
                            <select name="environment" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-900/20">
                                <option value="sandbox">Sandbox</option>
                                <option value="production">Production</option>
                            </select>
                        </div>
                        <button class="px-6 py-2 rounded-2xl bg-slate-900 text-white text-sm font-semibold hover:bg-slate-800 transition">
                            Generate Key
                        </button>
                    </form>
                </div>

                <div class="rounded-[28px] bg-white shadow-sm border border-white/70 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-slate-50/70 border-b border-slate-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Key</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Environment</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Last Used</th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @forelse($apiKeys as $apiKey)
                                    <tr class="hover:bg-slate-50/70 transition-colors">
                                        <td class="px-6 py-4 text-slate-900 font-medium">{{ $apiKey->key_name }}</td>
                                        <td class="px-6 py-4 font-mono text-slate-700">{{ $apiKey->getMaskedKey() }}</td>
                                        <td class="px-6 py-4 text-slate-600">{{ ucfirst($apiKey->environment) }}</td>
                                        <td class="px-6 py-4 text-slate-600">{{ $apiKey->last_used_at?->format('Y-m-d H:i') ?? '-' }}</td>
                                        <td class="px-6 py-4 text-right space-x-2">
                                            <form method="POST" action="{{ route('client.api-keys.regenerate', $apiKey->id) }}" class="inline">
                                                @csrf
                                                <button class="text-slate-700 hover:text-slate-900 font-medium">Rotate</button>
                                            </form>
                                            <form method="POST" action="{{ route('client.api-keys.destroy', $apiKey->id) }}" class="inline" onsubmit="return confirm('Delete this API key?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-rose-600 hover:text-rose-700 font-medium">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-6 text-center text-slate-500">No API keys yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
