<x-app-layout>
    <div class="p-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('dashboard.settings.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Settings
            </a>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Bank Account</h1>
            <p class="text-gray-600">Add bank account for settlement disbursement</p>
        </div>

        <!-- Current Bank Accounts -->
        <div class="bg-white rounded-xl shadow-md p-8 mb-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Your Bank Accounts</h2>
                <button class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 font-semibold">
                    Add Bank Account
                </button>
            </div>

            <div class="space-y-4">
                <!-- Bank Account Card 1 -->
                <div class="border-2 border-gray-200 rounded-xl p-6 hover:border-purple-500 transition-colors">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Bank Central Asia (BCA)</h3>
                                <p class="text-gray-600 font-mono">1234567890</p>
                                <p class="text-sm text-gray-600">John Doe</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold">Primary</span>
                            <button class="p-2 text-gray-600 hover:text-red-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Bank Account Card 2 -->
                <div class="border-2 border-gray-200 rounded-xl p-6 hover:border-purple-500 transition-colors">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Bank Mandiri</h3>
                                <p class="text-gray-600 font-mono">9876543210</p>
                                <p class="text-sm text-gray-600">John Doe</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button class="px-4 py-2 border border-purple-600 text-purple-600 rounded-lg hover:bg-purple-50 font-semibold">Set as Primary</button>
                            <button class="p-2 text-gray-600 hover:text-red-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Empty State (Commented) -->
                <!-- <div class="text-center py-12">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No Bank Account Added</h3>
                    <p class="text-gray-600 mb-6">Add your bank account to receive settlement disbursement</p>
                    <button class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 font-semibold">
                        Add Your First Bank Account
                    </button>
                </div> -->
            </div>
        </div>

        <!-- Add Bank Account Form -->
        <div class="bg-white rounded-xl shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Add New Bank Account</h2>
            <form class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Bank Name</label>
                    <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <option value="">Select Bank</option>
                        <option value="bca">Bank Central Asia (BCA)</option>
                        <option value="mandiri">Bank Mandiri</option>
                        <option value="bni">Bank Negara Indonesia (BNI)</option>
                        <option value="bri">Bank Rakyat Indonesia (BRI)</option>
                        <option value="cimb">CIMB Niaga</option>
                        <option value="permata">Bank Permata</option>
                        <option value="danamon">Bank Danamon</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Account Number</label>
                    <input type="text" placeholder="Enter account number" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Account Holder Name</label>
                    <input type="text" placeholder="Enter account holder name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>

                <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-amber-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <div>
                            <h4 class="text-sm font-semibold text-amber-900 mb-1">Important Notice</h4>
                            <p class="text-sm text-amber-800">Make sure the account holder name matches your registered business name for verification purposes.</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700">
                        Add Bank Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>