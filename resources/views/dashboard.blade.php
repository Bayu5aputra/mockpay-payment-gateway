<x-app-layout>
    <div class="p-8">
        <!-- Welcome Banner -->
        <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-2xl shadow-xl p-8 mb-8 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
                    <p class="text-purple-100 text-lg">Here's what's happening with your payment gateway today.</p>
                </div>
                <div class="hidden lg:block">
                    @if(Auth::user()->avatar_url)
                        <img
                            src="{{ Auth::user()->avatar_url }}"
                            alt="{{ Auth::user()->name }}"
                            class="w-20 h-20 rounded-full border-4 border-white shadow-lg object-cover"
                            onerror="this.classList.add('hidden'); this.nextElementSibling?.classList.remove('hidden');"
                        >
                        <div class="hidden w-20 h-20 rounded-full bg-white/20 flex items-center justify-center text-3xl font-bold border-4 border-white shadow-lg">
                            {{ Auth::user()->initials }}
                        </div>
                    @else
                        <div class="w-20 h-20 rounded-full bg-white/20 flex items-center justify-center text-3xl font-bold border-4 border-white shadow-lg">
                            {{ Auth::user()->initials }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Balance -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-green-600 bg-green-50 px-3 py-1 rounded-full">+12.5%</span>
                </div>
                <h3 class="text-gray-500 text-sm font-medium mb-1">Total Balance</h3>
                <p class="text-2xl font-bold text-gray-800">$45,231.89</p>
            </div>

            <!-- Total Transactions -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-green-600 bg-green-50 px-3 py-1 rounded-full">+8.2%</span>
                </div>
                <h3 class="text-gray-500 text-sm font-medium mb-1">Total Transactions</h3>
                <p class="text-2xl font-bold text-gray-800">1,234</p>
            </div>

            <!-- Pending Payments -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-amber-600 bg-amber-50 px-3 py-1 rounded-full">23</span>
                </div>
                <h3 class="text-gray-500 text-sm font-medium mb-1">Pending Payments</h3>
                <p class="text-2xl font-bold text-gray-800">$12,456.00</p>
            </div>

            <!-- Success Rate -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-green-600 bg-green-50 px-3 py-1 rounded-full">+2.4%</span>
                </div>
                <h3 class="text-gray-500 text-sm font-medium mb-1">Success Rate</h3>
                <p class="text-2xl font-bold text-gray-800">98.5%</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Recent Transactions -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-gray-800">Recent Transactions</h3>
                            <a href="#" class="text-sm font-medium text-purple-600 hover:text-purple-700">View All</a>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <!-- Transaction Item 1 -->
                        <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">Payment from John Doe</p>
                                        <p class="text-sm text-gray-500">Invoice #INV-001234</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-green-600">+$1,250.00</p>
                                    <p class="text-sm text-gray-500">2 hours ago</p>
                                </div>
                            </div>
                        </div>

                        <!-- Transaction Item 2 -->
                        <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">Refund to Jane Smith</p>
                                        <p class="text-sm text-gray-500">Order #ORD-567890</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-red-600">-$340.00</p>
                                    <p class="text-sm text-gray-500">5 hours ago</p>
                                </div>
                            </div>
                        </div>

                        <!-- Transaction Item 3 -->
                        <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">Payment from Acme Corp</p>
                                        <p class="text-sm text-gray-500">Invoice #INV-001235</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-green-600">+$5,480.00</p>
                                    <p class="text-sm text-gray-500">1 day ago</p>
                                </div>
                            </div>
                        </div>

                        <!-- Transaction Item 4 -->
                        <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">Pending from Tech Solutions</p>
                                        <p class="text-sm text-gray-500">Invoice #INV-001236</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-amber-600">$2,150.00</p>
                                    <p class="text-sm text-gray-500">2 days ago</p>
                                </div>
                            </div>
                        </div>

                        <!-- Transaction Item 5 -->
                        <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">Payment from Global Inc</p>
                                        <p class="text-sm text-gray-500">Invoice #INV-001237</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-green-600">+$8,920.00</p>
                                    <p class="text-sm text-gray-500">3 days ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Account Info -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <button class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold py-3 px-4 rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span>Create Payment Link</span>
                        </button>
                        <button class="w-full bg-white border-2 border-purple-600 text-purple-600 font-semibold py-3 px-4 rounded-lg hover:bg-purple-50 transition-all duration-300 flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>Generate Invoice</span>
                        </button>
                        <button class="w-full bg-white border-2 border-gray-300 text-gray-700 font-semibold py-3 px-4 rounded-lg hover:bg-gray-50 transition-all duration-300 flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>Download Report</span>
                        </button>
                    </div>
                </div>

                <!-- Account Info -->
                <div class="bg-gradient-to-br from-purple-50 to-indigo-50 rounded-xl shadow-md p-6 border border-purple-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Account Information</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Account Status</span>
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Active</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Plan</span>
                            <span class="text-sm font-semibold text-gray-800">Professional</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">API Calls (Today)</span>
                            <span class="text-sm font-semibold text-gray-800">1,234 / 10,000</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 h-2 rounded-full" style="width: 12.34%"></div>
                        </div>
                    </div>
                    <button class="w-full mt-4 bg-white text-purple-600 font-semibold py-2 px-4 rounded-lg hover:bg-purple-50 transition-all duration-300 text-sm border border-purple-200">
                        Upgrade Plan
                    </button>
                </div>

                <!-- Support Card -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">Need Help?</h4>
                            <p class="text-sm text-gray-600 mb-3">Our support team is here 24/7 to assist you.</p>
                            <a href="#" class="text-sm font-medium text-purple-600 hover:text-purple-700">Contact Support →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
