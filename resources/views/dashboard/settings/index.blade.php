<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-6xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Settings</h1>
            <p class="text-gray-600">Manage your account and application settings</p>
        </div>

        <!-- Settings Navigation -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Profile Settings -->
            <a href="{{ route('dashboard.merchant.profile') }}" class="block bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all duration-200 hover:-translate-y-1">
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
            <a href="{{ route('dashboard.settlements.bank-account') }}" class="block bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all duration-200 hover:-translate-y-1">
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

            <!-- Security -->
            <a href="{{ route('dashboard.settings.notifications') }}" class="block bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all duration-200 hover:-translate-y-1">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Notifications</h3>
                        <p class="text-sm text-gray-600">Email & webhook alerts</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600">Configure notification preferences</p>
            </a>

            <!-- Company Settings -->
            <a href="{{ route('dashboard.merchant.company') }}" class="block bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all duration-200 hover:-translate-y-1">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Company</h3>
                        <p class="text-sm text-gray-600">Business details</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600">Update company profile and address</p>
            </a>
        </div>

        <!-- Account Information -->
        <div class="mt-8 bg-white rounded-xl shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Account Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Account ID</p>
                    <p class="text-lg font-semibold text-gray-900">{{ Auth::guard('merchant')->id() }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Member Since</p>
                    <p class="text-lg font-semibold text-gray-900">{{ Auth::guard('merchant')->user()->created_at->format('F Y') }}</p>
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
        </div>
    </div>
</x-app-layout>
