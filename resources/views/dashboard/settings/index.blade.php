<x-app-layout>
    <div class="p-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Settings</h1>
            <p class="text-gray-600">Manage your account and application settings</p>
        </div>

        <!-- Settings Navigation -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Profile Settings -->
            <a href="{{ route('dashboard.settings.profile') }}" class="block bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all duration-200 hover:-translate-y-1">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Profile</h3>
                        <p class="text-sm text-gray-600">Personal information</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600">Update your name, email, and profile picture</p>
            </a>

            <!-- API Keys -->
            <a href="{{ route('dashboard.api-keys.index') }}" class="block bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all duration-200 hover:-translate-y-1">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">API Keys</h3>
                        <p class="text-sm text-gray-600">Authentication keys</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600">Manage your API keys for authentication</p>
            </a>

            <!-- Payment Methods -->
            <a href="{{ route('dashboard.settings.payment-methods') }}" class="block bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all duration-200 hover:-translate-y-1">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Payment Methods</h3>
                        <p class="text-sm text-gray-600">Accepted methods</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600">Configure available payment channels</p>
            </a>

            <!-- Bank Account -->
            <a href="{{ route('dashboard.settings.bank-account') }}" class="block bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all duration-200 hover:-translate-y-1">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Bank Account</h3>
                        <p class="text-sm text-gray-600">Settlement account</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600">Add bank account for settlements</p>
            </a>

            <!-- Webhooks -->
            <a href="{{ route('dashboard.settings.webhooks') }}" class="block bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all duration-200 hover:-translate-y-1">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Webhooks</h3>
                        <p class="text-sm text-gray-600">Event notifications</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600">Configure webhook endpoints</p>
            </a>

            <!-- Security -->
            <a href="#" class="block bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all duration-200 hover:-translate-y-1">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Security</h3>
                        <p class="text-sm text-gray-600">Password & 2FA</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600">Manage password and security settings</p>
            </a>
        </div>

        <!-- Account Information -->
        <div class="mt-8 bg-white rounded-xl shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Account Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Account ID</p>
                    <p class="text-lg font-semibold text-gray-900">{{ Auth::user()->id }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Member Since</p>
                    <p class="text-lg font-semibold text-gray-900">{{ Auth::user()->created_at->format('F Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Account Status</p>
                    <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold">Active</span>
                </div>
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="mt-8 bg-red-50 border border-red-200 rounded-xl p-8">
            <h2 class="text-2xl font-bold text-red-900 mb-4">Danger Zone</h2>
            <p class="text-red-700 mb-6">Once you delete your account, there is no going back. Please be certain.</p>
            <button class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 font-semibold">
                Delete Account
            </button>
        </div>
    </div>
</x-app-layout>