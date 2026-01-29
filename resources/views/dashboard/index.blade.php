# 1. resources/views/dashboard/index.blade.php
<x-app-layout>
    <div class="p-8">
        <!-- Welcome Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Welcome back, {{ Auth::user()->name }}!</h1>
            <p class="text-gray-600">Here's what's happening with your payments today.</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Transactions -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Transactions</p>
                        <p class="text-3xl font-bold text-gray-900">1,234</p>
                        <p class="text-sm text-green-600 mt-2">+12% from last month</p>
                    </div>
                    <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Successful Payments -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Successful Payments</p>
                        <p class="text-3xl font-bold text-gray-900">1,156</p>
                        <p class="text-sm text-green-600 mt-2">93.7% success rate</p>
                    </div>
                    <div class="w-14 h-14 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Revenue</p>
                        <p class="text-3xl font-bold text-gray-900">Rp 45.2M</p>
                        <p class="text-sm text-green-600 mt-2">+18% from last month</p>
                    </div>
                    <div class="w-14 h-14 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Settlements -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-amber-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Pending Settlements</p>
                        <p class="text-3xl font-bold text-gray-900">Rp 8.5M</p>
                        <p class="text-sm text-gray-600 mt-2">23 transactions</p>
                    </div>
                    <div class="w-14 h-14 bg-amber-100 rounded-lg flex items-center justify-center">
                        <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Recent Transactions -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <!-- Transaction Chart -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Transaction Overview</h2>
                    <div class="flex space-x-2">
                        <button class="px-4 py-2 bg-purple-600 text-white rounded-lg text-sm font-medium">7 Days</button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200">30 Days</button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200">90 Days</button>
                    </div>
                </div>
                <div class="h-80 flex items-end justify-between space-x-2">
                    <div class="flex-1 bg-gradient-to-t from-blue-500 to-blue-400 rounded-t-lg" style="height: 65%"></div>
                    <div class="flex-1 bg-gradient-to-t from-purple-500 to-purple-400 rounded-t-lg" style="height: 45%"></div>
                    <div class="flex-1 bg-gradient-to-t from-blue-500 to-blue-400 rounded-t-lg" style="height: 85%"></div>
                    <div class="flex-1 bg-gradient-to-t from-purple-500 to-purple-400 rounded-t-lg" style="height: 55%"></div>
                    <div class="flex-1 bg-gradient-to-t from-blue-500 to-blue-400 rounded-t-lg" style="height: 75%"></div>
                    <div class="flex-1 bg-gradient-to-t from-purple-500 to-purple-400 rounded-t-lg" style="height: 95%"></div>
                    <div class="flex-1 bg-gradient-to-t from-blue-500 to-blue-400 rounded-t-lg" style="height: 70%"></div>
                </div>
                <div class="flex items-center justify-center space-x-6 mt-6">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600">Successful</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-purple-500 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600">Pending</span>
                    </div>
                </div>
            </div>

            <!-- Payment Methods Distribution -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Payment Methods</h2>
                <div class="space-y-4">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Virtual Account</span>
                            <span class="text-sm font-bold text-gray-900">45%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 45%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">E-Wallet</span>
                            <span class="text-sm font-bold text-gray-900">30%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 30%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Credit Card</span>
                            <span class="text-sm font-bold text-gray-900">20%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-500 h-2 rounded-full" style="width: 20%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">QRIS</span>
                            <span class="text-sm font-bold text-gray-900">5%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-amber-500 h-2 rounded-full" style="width: 5%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">Recent Transactions</h2>
                <a href="#" class="text-purple-600 hover:text-purple-700 font-medium text-sm">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Transaction ID</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Method</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">TRX-20260129-00001</td>
                            <td class="px-6 py-4 text-sm text-gray-900">John Doe</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">Rp 500,000</td>
                            <td class="px-6 py-4 text-sm text-gray-600">BCA VA</td>
                            <td class="px-6 py-4"><span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Success</span></td>
                            <td class="px-6 py-4 text-sm text-gray-600">Jan 29, 2026 10:30</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">TRX-20260129-00002</td>
                            <td class="px-6 py-4 text-sm text-gray-900">Jane Smith</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">Rp 750,000</td>
                            <td class="px-6 py-4 text-sm text-gray-600">GoPay</td>
                            <td class="px-6 py-4"><span class="px-3 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">Pending</span></td>
                            <td class="px-6 py-4 text-sm text-gray-600">Jan 29, 2026 09:15</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">TRX-20260129-00003</td>
                            <td class="px-6 py-4 text-sm text-gray-900">Bob Wilson</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">Rp 1,250,000</td>
                            <td class="px-6 py-4 text-sm text-gray-600">Credit Card</td>
                            <td class="px-6 py-4"><span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Success</span></td>
                            <td class="px-6 py-4 text-sm text-gray-600">Jan 29, 2026 08:45</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">TRX-20260129-00004</td>
                            <td class="px-6 py-4 text-sm text-gray-900">Alice Brown</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">Rp 350,000</td>
                            <td class="px-6 py-4 text-sm text-gray-600">QRIS</td>
                            <td class="px-6 py-4"><span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Success</span></td>
                            <td class="px-6 py-4 text-sm text-gray-600">Jan 28, 2026 16:20</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">TRX-20260128-00005</td>
                            <td class="px-6 py-4 text-sm text-gray-900">Charlie Davis</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">Rp 2,000,000</td>
                            <td class="px-6 py-4 text-sm text-gray-600">Mandiri VA</td>
                            <td class="px-6 py-4"><span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Expired</span></td>
                            <td class="px-6 py-4 text-sm text-gray-600">Jan 28, 2026 14:30</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <a href="{{ route('dashboard.developers.index') }}" class="block bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white hover:shadow-xl transition-all duration-200 hover:-translate-y-1">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg">Developer Tools</h3>
                        <p class="text-blue-100 text-sm">API docs & testing</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('dashboard.api-keys.index') }}" class="block bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white hover:shadow-xl transition-all duration-200 hover:-translate-y-1">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg">API Keys</h3>
                        <p class="text-purple-100 text-sm">Manage your keys</p>
                    </div>
                </div>
            </a>

            <a href="#" class="block bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white hover:shadow-xl transition-all duration-200 hover:-translate-y-1">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg">Calculator</h3>
                        <p class="text-green-100 text-sm">Fee calculator</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>