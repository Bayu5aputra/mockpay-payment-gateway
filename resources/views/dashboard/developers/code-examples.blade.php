<x-app-layout>
    <div class="p-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('client.developers.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Developer Tools
            </a>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Code Examples</h1>
            <p class="text-gray-600">Ready-to-use code snippets in multiple programming languages</p>
        </div>

        <!-- Language Tabs -->
        <div x-data="{ activeTab: 'php' }" class="space-y-6">
            <!-- Tab Buttons -->
            <div class="flex flex-wrap gap-3">
                <button @click="activeTab = 'php'" :class="activeTab === 'php' ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'" class="px-6 py-3 rounded-lg font-semibold shadow-md transition-all duration-200 flex items-center space-x-2">
                    <span class="text-2xl">🐘</span>
                    <span>PHP</span>
                </button>
                <button @click="activeTab = 'javascript'" :class="activeTab === 'javascript' ? 'bg-gradient-to-r from-yellow-500 to-amber-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'" class="px-6 py-3 rounded-lg font-semibold shadow-md transition-all duration-200 flex items-center space-x-2">
                    <span class="text-2xl">⚡</span>
                    <span>JavaScript</span>
                </button>
                <button @click="activeTab = 'python'" :class="activeTab === 'python' ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'" class="px-6 py-3 rounded-lg font-semibold shadow-md transition-all duration-200 flex items-center space-x-2">
                    <span class="text-2xl">🐍</span>
                    <span>Python</span>
                </button>
            </div>

            <!-- PHP Examples -->
            <div x-show="activeTab === 'php'" x-cloak class="space-y-6">
                @foreach($examples['php']['examples'] as $key => $example)
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-white">{{ $example['title'] }}</h3>
                            <button onclick="copyCode('php-{{ $key }}')" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                Copy Code
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="bg-gray-900 rounded-lg overflow-hidden">
                            <pre class="p-4 overflow-x-auto"><code id="php-{{ $key }}" class="text-green-400 text-sm">{{ $example['code'] }}</code></pre>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- JavaScript Examples -->
            <div x-show="activeTab === 'javascript'" x-cloak class="space-y-6">
                @foreach($examples['javascript']['examples'] as $key => $example)
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-yellow-500 to-amber-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-white">{{ $example['title'] }}</h3>
                            <button onclick="copyCode('js-{{ $key }}')" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                Copy Code
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="bg-gray-900 rounded-lg overflow-hidden">
                            <pre class="p-4 overflow-x-auto"><code id="js-{{ $key }}" class="text-yellow-400 text-sm">{{ $example['code'] }}</code></pre>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Python Examples -->
            <div x-show="activeTab === 'python'" x-cloak class="space-y-6">
                @foreach($examples['python']['examples'] as $key => $example)
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-white">{{ $example['title'] }}</h3>
                            <button onclick="copyCode('python-{{ $key }}')" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                Copy Code
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="bg-gray-900 rounded-lg overflow-hidden">
                            <pre class="p-4 overflow-x-auto"><code id="python-{{ $key }}" class="text-blue-400 text-sm">{{ $example['code'] }}</code></pre>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Installation Instructions -->
        <div class="bg-white rounded-xl shadow-md p-6 mt-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Installation & Setup</h2>

            <div class="space-y-6">
                <!-- PHP -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                        <span class="text-2xl mr-2">🐘</span>
                        PHP Setup
                    </h3>
                    <p class="text-gray-600 mb-3">Install using Composer:</p>
                    <div class="bg-gray-900 rounded-lg p-4">
                        <code class="text-green-400 text-sm">composer require guzzlehttp/guzzle</code>
                    </div>
                </div>

                <!-- JavaScript -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                        <span class="text-2xl mr-2">⚡</span>
                        JavaScript Setup
                    </h3>
                    <p class="text-gray-600 mb-3">Install using npm:</p>
                    <div class="bg-gray-900 rounded-lg p-4">
                        <code class="text-yellow-400 text-sm">npm install axios</code>
                    </div>
                </div>

                <!-- Python -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                        <span class="text-2xl mr-2">🐍</span>
                        Python Setup
                    </h3>
                    <p class="text-gray-600 mb-3">Install using pip:</p>
                    <div class="bg-gray-900 rounded-lg p-4">
                        <code class="text-blue-400 text-sm">pip install requests</code>
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
                // Show success notification
                const btn = event.target;
                const originalText = btn.textContent;
                btn.textContent = 'Copied!';
                btn.classList.add('bg-green-500');

                setTimeout(() => {
                    btn.textContent = originalText;
                    btn.classList.remove('bg-green-500');
                }, 2000);
            });
        }
    </script>
    @endpush
</x-app-layout>
