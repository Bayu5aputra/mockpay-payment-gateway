# 3. resources/views/dashboard/transactions/show.blade.php
<x-app-layout>
    <div class="p-8">
        <!-- Back Button -->
        <a href="{{ route('dashboard.transactions.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Transactions
        </a>

        <!-- Transaction Header -->
        <div class="bg-white rounded-xl shadow-md p-8 mb-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Transaction Details</h1>
                    <p class="text-gray-600">TRX-20260129-00001</p>
                </div>
                <span class="px-6 py-3 text-sm font-semibold rounded-full bg-green-100 text-green-800">Settlement</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Amount</p>
                    <p class="text-2xl font-bold text-gray-900">Rp 1,500,000</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Payment Method</p>
                    <p class="text-lg font-semibold text-gray-900">BCA Virtual Account</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Created At</p>
                    <p class="text-lg font-semibold text-gray-900">Jan 29, 2026 10:30 AM</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Customer Information -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Customer Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Name</p>
                            <p class="text-base font-semibold text-gray-900">John Doe</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Email</p>
                            <p class="text-base font-semibold text-gray-900">john.doe@example.com</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Phone</p>
                            <p class="text-base font-semibold text-gray-900">+62 812-3456-7890</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Customer ID</p>
                            <p class="text-base font-semibold text-gray-900">CUST-00123</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Payment Details</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-3 border-b border-gray-200">
                            <span class="text-gray-600">Order ID</span>
                            <span class="font-semibold text-gray-900">ORD-123456</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-200">
                            <span class="text-gray-600">VA Number</span>
                            <span class="font-mono font-semibold text-gray-900">80777123456789</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-200">
                            <span class="text-gray-600">Bank</span>
                            <span class="font-semibold text-gray-900">Bank Central Asia (BCA)</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-200">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-semibold text-gray-900">Rp 1,500,000</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-200">
                            <span class="text-gray-600">Admin Fee</span>
                            <span class="font-semibold text-gray-900">Rp 4,000</span>
                        </div>
                        <div class="flex justify-between items-center py-3">
                            <span class="text-lg font-bold text-gray-900">Total</span>
                            <span class="text-lg font-bold text-gray-900">Rp 1,504,000</span>
                        </div>
                    </div>
                </div>

                <!-- Items -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Items</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-semibold text-gray-900">Product Name A</p>
                                <p class="text-sm text-gray-600">Quantity: 2</p>
                            </div>
                            <p class="font-semibold text-gray-900">Rp 750,000</p>
                        </div>
                        <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-semibold text-gray-900">Product Name B</p>
                                <p class="text-sm text-gray-600">Quantity: 1</p>
                            </div>
                            <p class="font-semibold text-gray-900">Rp 750,000</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Timeline -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Transaction Timeline</h2>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900">Payment Success</p>
                                <p class="text-sm text-gray-600">Jan 29, 2026 10:35 AM</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900">Waiting Payment</p>
                                <p class="text-sm text-gray-600">Jan 29, 2026 10:30 AM</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900">Transaction Created</p>
                                <p class="text-sm text-gray-600">Jan 29, 2026 10:30 AM</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Actions</h2>
                    <div class="space-y-3">
                        <button class="w-full px-4 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Download Invoice
                        </button>
                        <button class="w-full px-4 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                            </svg>
                            Print Receipt
                        </button>
                        <button class="w-full px-4 py-3 border border-red-300 text-red-600 rounded-lg hover:bg-red-50 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 11l3-3m0 0l3 3m-3-3v8m0-13a9 9 0 110 18 9 9 0 010-18z"></path>
                            </svg>
                            Request Refund
                        </button>
                    </div>
                </div>

                <!-- Support -->
                <div class="bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl shadow-md p-6 text-white">
                    <h3 class="text-lg font-bold mb-2">Need Help?</h3>
                    <p class="text-purple-100 text-sm mb-4">Contact our support team for assistance</p>
                    <button class="w-full px-4 py-2 bg-white text-purple-600 rounded-lg hover:bg-purple-50 font-semibold">
                        Contact Support
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>