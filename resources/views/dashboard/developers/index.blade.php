<x-app-layout>
    <div class="p-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Platform Tools</h1>
            <p class="text-gray-600">Monitor platform usage, webhook delivery, and API key activity. Client integrations are managed by each client.</p>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Transactions Today</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['transactions_today']) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Success Rate</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['success_rate'], 2) }}%</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-amber-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Webhook Deliveries Today</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['webhooks_today']) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Active API Keys</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['active_api_keys']) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-2">What are Platform Tools?</h2>
            <p class="text-gray-600">
                These tools help admins monitor platform activity, webhook delivery, and API key usage.
                Client teams handle their own integrations and simulation outcomes in the client dashboard.
            </p>
        </div>

        <!-- Developer Tools Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- API Documentation -->
            <a href="{{ route('dashboard.developers.api-docs') }}" class="group block bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                <div class="p-8 relative">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">API Documentation</h3>
                        <p class="text-blue-100">Complete API reference with examples and responses</p>
                    </div>
                </div>
            </a>

            <!-- Code Examples -->
            <a href="{{ route('dashboard.developers.code-examples') }}" class="group block bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                <div class="p-8 relative">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Code Examples</h3>
                        <p class="text-purple-100">Ready-to-use code snippets in multiple languages</p>
                    </div>
                </div>
            </a>

            <!-- Payment Simulator -->
            <a href="{{ route('dashboard.developers.simulator') }}" class="group block bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                <div class="p-8 relative">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Payment Simulator</h3>
                        <p class="text-green-100">Test payment flows without real transactions</p>
                    </div>
                </div>
            </a>

            <!-- Webhook Logs -->
            <a href="{{ route('dashboard.developers.logs') }}" class="group block bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                <div class="p-8 relative">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Webhook Logs</h3>
                        <p class="text-amber-100">Monitor webhook delivery for client transactions</p>
                    </div>
                </div>
            </a>

            <!-- Webhooks -->
            <a href="{{ route('dashboard.settings.webhooks') }}" class="group block bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                <div class="p-8 relative">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Webhooks</h3>
                        <p class="text-cyan-100">Configure webhook endpoints and notifications</p>
                    </div>
                </div>
            </a>

            <!-- API Keys -->
            <a href="{{ route('dashboard.api-keys.index') }}" class="group block bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                <div class="p-8 relative">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">API Keys</h3>
                        <p class="text-pink-100">Manage your API keys and authentication</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Getting Started Guide -->
        <div class="bg-white rounded-xl shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Client Quick Start</h2>

            <div class="space-y-6">
                <!-- Step 1 -->
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                        1
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Get an API Key</h3>
                        <p class="text-gray-600">Clients generate API keys from the Client Dashboard to authenticate requests.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                        2
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Choose a Language</h3>
                        <p class="text-gray-600">Share code examples with client teams for faster integration.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center text-white font-bold">
                        3
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Test the Integration</h3>
                        <p class="text-gray-600">Clients use simulators to set outcomes and validate their flows.</p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-amber-500 to-amber-600 rounded-full flex items-center justify-center text-white font-bold">
                        4
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Monitor & Debug</h3>
                        <p class="text-gray-600">Use logs to verify webhook delivery and API usage across tenants.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
