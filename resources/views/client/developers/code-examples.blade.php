<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
                <div class="flex flex-col gap-3">
                    <a href="{{ route('client.developers.index') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-slate-900">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Developer Tools
                    </a>
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Examples</p>
                        <h1 class="text-4xl font-semibold text-slate-900 mt-2">Code Examples</h1>
                        <p class="text-sm text-slate-600 mt-2">Ready-to-use requests with your tenant keys.</p>
                    </div>
                </div>

                <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4">Your API Keys</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-slate-700">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Sandbox Key</p>
                            <p class="font-mono text-slate-900 mt-2 break-all">{{ $sandboxKey?->getFullKey() ?? 'Not generated yet' }}</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Production Key</p>
                            <p class="font-mono text-slate-900 mt-2 break-all">{{ $productionKey?->getFullKey() ?? 'Not generated yet' }}</p>
                        </div>
                    </div>
                </div>

                <div x-data="{ activeTab: 'php' }" class="space-y-6">
                    <div class="flex flex-wrap gap-3">
                        <button @click="activeTab = 'php'" :class="activeTab === 'php' ? 'bg-slate-900 text-white' : 'bg-white text-slate-700 hover:bg-slate-50'" class="px-6 py-3 rounded-2xl font-semibold shadow-sm transition-all duration-200">
                            PHP
                        </button>
                        <button @click="activeTab = 'javascript'" :class="activeTab === 'javascript' ? 'bg-slate-900 text-white' : 'bg-white text-slate-700 hover:bg-slate-50'" class="px-6 py-3 rounded-2xl font-semibold shadow-sm transition-all duration-200">
                            JavaScript
                        </button>
                        <button @click="activeTab = 'python'" :class="activeTab === 'python' ? 'bg-slate-900 text-white' : 'bg-white text-slate-700 hover:bg-slate-50'" class="px-6 py-3 rounded-2xl font-semibold shadow-sm transition-all duration-200">
                            Python
                        </button>
                    </div>

                    <div x-show="activeTab === 'php'" x-cloak class="space-y-6">
                        @foreach($examples['php']['examples'] as $key => $example)
                            <div class="bg-white rounded-[28px] shadow-sm border border-white/70 overflow-hidden">
                                <div class="bg-slate-900 px-6 py-4 flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-white">{{ $example['title'] }}</h3>
                                    <button onclick="copyCode('php-{{ $key }}')" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-xl text-xs font-semibold transition-colors">Copy</button>
                                </div>
                                <div class="p-6">
                                    <div class="bg-slate-900 rounded-2xl overflow-hidden">
                                        <pre class="p-4 overflow-x-auto"><code id="php-{{ $key }}" class="text-emerald-300 text-xs">{{ $example['code'] }}</code></pre>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div x-show="activeTab === 'javascript'" x-cloak class="space-y-6">
                        @foreach($examples['javascript']['examples'] as $key => $example)
                            <div class="bg-white rounded-[28px] shadow-sm border border-white/70 overflow-hidden">
                                <div class="bg-slate-900 px-6 py-4 flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-white">{{ $example['title'] }}</h3>
                                    <button onclick="copyCode('js-{{ $key }}')" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-xl text-xs font-semibold transition-colors">Copy</button>
                                </div>
                                <div class="p-6">
                                    <div class="bg-slate-900 rounded-2xl overflow-hidden">
                                        <pre class="p-4 overflow-x-auto"><code id="js-{{ $key }}" class="text-amber-300 text-xs">{{ $example['code'] }}</code></pre>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div x-show="activeTab === 'python'" x-cloak class="space-y-6">
                        @foreach($examples['python']['examples'] as $key => $example)
                            <div class="bg-white rounded-[28px] shadow-sm border border-white/70 overflow-hidden">
                                <div class="bg-slate-900 px-6 py-4 flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-white">{{ $example['title'] }}</h3>
                                    <button onclick="copyCode('python-{{ $key }}')" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-xl text-xs font-semibold transition-colors">Copy</button>
                                </div>
                                <div class="p-6">
                                    <div class="bg-slate-900 rounded-2xl overflow-hidden">
                                        <pre class="p-4 overflow-x-auto"><code id="python-{{ $key }}" class="text-sky-300 text-xs">{{ $example['code'] }}</code></pre>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4">Webhook Signature Example</h2>
                    <p class="text-xs text-slate-500 mb-3">Use your current webhook secret:</p>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-xs font-mono text-slate-900 break-all mb-4">
                        {{ $webhookSecret ?? 'Not generated yet' }}
                    </div>
                    <div class="rounded-2xl bg-slate-900 text-slate-100 px-4 py-3 text-xs font-mono whitespace-pre-wrap">
$signature = hash_hmac('sha256', $payload, $webhookSecret);
if ($signature === $_SERVER['HTTP_X_MOCKPAY_SIGNATURE']) {
    // Webhook is authentic
}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function copyCode(elementId) {
            const codeElement = document.getElementById(elementId);
            const code = codeElement.textContent;

            navigator.clipboard.writeText(code).then(() => {
                const btn = event.target;
                const originalText = btn.textContent;
                btn.textContent = 'Copied';
                btn.classList.add('bg-emerald-500');

                setTimeout(() => {
                    btn.textContent = originalText;
                    btn.classList.remove('bg-emerald-500');
                }, 2000);
            });
        }
    </script>
    @endpush
</x-app-layout>
