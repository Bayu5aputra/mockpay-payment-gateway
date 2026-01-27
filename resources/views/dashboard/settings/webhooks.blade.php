<x-app-layout>
    <div class="p-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Webhooks</h1>
            <p class="text-gray-600">Configure webhook endpoints for real-time notifications</p>
        </div>

        <!-- Coming Soon Message -->
        <div class="bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl shadow-lg p-12 text-center text-white">
            <svg class="w-24 h-24 mx-auto mb-6 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            <h2 class="text-3xl font-bold mb-4">Webhook Configuration Coming Soon</h2>
            <p class="text-purple-100 text-lg mb-8">
                We're working on an amazing webhook management interface. Stay tuned!
            </p>
            <a href="{{ route('dashboard.developers.index') }}" class="inline-flex items-center bg-white text-purple-600 px-8 py-3 rounded-lg font-bold hover:bg-purple-50 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Developer Tools
            </a>
        </div>
    </div>
</x-app-layout>
