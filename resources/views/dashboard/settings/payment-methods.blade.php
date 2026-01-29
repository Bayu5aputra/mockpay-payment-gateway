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
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Payment Methods</h1>
            <p class="text-gray-600">Configure available payment channels for your customers</p>
        </div>

        <!-- Virtual Account -->
        <div class="bg-white rounded-xl shadow-md p-8 mb-6">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Virtual Account</h2>
                        <p class="text-gray-600">Bank transfer via virtual account</p>
                    </div>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" checked class="sr-only peer">
                    <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-600"></div>
                </label>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-blue-500 cursor-pointer transition-colors">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-bold text-gray-900">BCA</span>
                        <input type="checkbox" checked class="w-5 h-5 text-blue-600 rounded">
                    </div>
                    <p class="text-sm text-gray-600">Fee: Rp 4,000</p>
                </div>

                <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-blue-500 cursor-pointer transition-colors">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-bold text-gray-900">Mandiri</span>
                        <input type="checkbox" checked class="w-5 h-5 text-blue-600 rounded">
                    </div>
                    <p class="text-sm text-gray-600">Fee: Rp 4,000</p>
                </div>

                <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-blue-500 cursor-pointer transition-colors">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-bold text-gray-900">BNI</span>
                        <input type="checkbox" checked class="w-5 h-5 text-blue-600 rounded">
                    </div>
                    <p class="text-sm text-gray-600">Fee: Rp 4,000</p>
                </div>

                <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-blue-500 cursor-pointer transition-colors">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-bold text-gray-900">BRI</span>
                        <input type="checkbox" checked class="w-5 h-5 text-blue-600 rounded">
                    </div>
                    <p class="text-sm text-gray-600">Fee: Rp 4,000</p>
                </div>
            </div>
        </div>

        <!-- E-Wallet -->
        <div class="bg-white rounded-xl shadow-md p-8 mb-6">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">E-Wallet</h2>
                        <p class="text-gray-600">Digital wallet payments</p>
                    </div>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" checked class="sr-only peer">
                    <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-600"></div>
                </label>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-green-500 cursor-pointer transition-colors">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-bold text-gray-900">GoPay</span>
                        <input type="checkbox" checked class="w-5 h-5 text-green-600 rounded">
                    </div>
                    <p class="text-sm text-gray-600">Fee: 2%</p>
                </div>

                <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-green-500 cursor-pointer transition-colors">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-bold text-gray-900">OVO</span>
                        <input type="checkbox" checked class="w-5 h-5 text-green-600 rounded">
                    </div>
                    <p class="text-sm text-gray-600">Fee: 2%</p>
                </div>

                <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-green-500 cursor-pointer transition-colors">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-bold text-gray-900">DANA</span>
                        <input type="checkbox" checked class="w-5 h-5 text-green-600 rounded">
                    </div>
                    <p class="text-sm text-gray-600">Fee: 2%</p>
                </div>

                <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-green-500 cursor-pointer transition-colors">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-bold text-gray-900">ShopeePay</span>
                        <input type="checkbox" class="w-5 h-5 text-green-600 rounded">
                    </div>
                    <p class="text-sm text-gray-600">Fee: 2%</p>
                </div>

                <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-green-500 cursor-pointer transition-colors">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-bold text-gray-900">LinkAja</span>
                        <input type="checkbox" class="w-5 h-5 text-green-600 rounded">
                    </div>
                    <p class="text-sm text-gray-600">Fee: 2%</p>
                </div>
            </div>
        </div>

        <!-- Credit Card -->
        <div class="bg-white rounded-xl shadow-md p-8 mb-6">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Credit Card</h2>
                        <p class="text-gray-600">Card payments with 3DS verification</p>
                    </div>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" checked class="sr-only peer">
                    <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-600"></div>
                </label>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-purple-500 cursor-pointer transition-colors">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-bold text-gray-900">Visa</span>
                        <input type="checkbox" checked class="w-5 h-5 text-purple-600 rounded">
                    </div>
                    <p class="text-sm text-gray-600">Fee: 2.9% + Rp 2,000</p>
                </div>

                <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-purple-500 cursor-pointer transition-colors">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-bold text-gray-900">Mastercard</span>
                        <input type="checkbox" checked class="w-5 h-5 text-purple-600 rounded">
                    </div>
                    <p class="text-sm text-gray-600">Fee: 2.9% + Rp 2,000</p>
                </div>

                <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-purple-500 cursor-pointer transition-colors">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-bold text-gray-900">JCB</span>
                        <input type="checkbox" class="w-5 h-5 text-purple-600 rounded">
                    </div>
                    <p class="text-sm text-gray-600">Fee: 2.9% + Rp 2,000</p>
                </div>

                <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-purple-500 cursor-pointer transition-colors">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-bold text-gray-900">Amex</span>
                        <input type="checkbox" class="w-5 h-5 text-purple-600 rounded">
                    </div>
                    <p class="text-sm text-gray-600">Fee: 2.9% + Rp 2,000</p>
                </div>
            </div>
        </div>

        <!-- QRIS -->
        <div class="bg-white rounded-xl shadow-md p-8 mb-6">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">QRIS</h2>
                        <p class="text-gray-600">QR code payment standard</p>
                    </div>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" checked class="sr-only peer">
                    <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-600"></div>
                </label>
            </div>

            <div class="bg-gray-50 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-semibold text-gray-900">Transaction Fee</p>
                        <p class="text-sm text-gray-600">0.7% per transaction</p>
                    </div>
                    <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold">Active</span>
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="flex justify-end">
            <button class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 font-semibold shadow-lg">
                Save Changes
            </button>
        </div>
    </div>
</x-app-layout>