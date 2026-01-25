@extends('layouts.public')

@section('title', 'Dummy Payment Gateway for Developers')

@section('content')
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-purple-50 via-white to-indigo-50 pt-20 pb-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid items-center gap-12 lg:grid-cols-2">
                <!-- Left Column -->
                <div class="text-center lg:text-left">
                    <div class="mb-6 inline-flex items-center rounded-full bg-purple-100 px-4 py-2 text-sm font-medium text-purple-700">
                        <svg class="mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
                        </svg>
                        Free for Testing & Development
                    </div>

                    <h1 class="mb-6 text-5xl font-bold leading-tight text-gray-900 lg:text-6xl">
                        Test Your Payment Integrations
                        <span class="bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent"> Safely</span>
                    </h1>

                    <p class="mb-8 text-xl leading-relaxed text-gray-600">
                        MockPay is a realistic dummy payment gateway designed for developers. Test all Indonesian payment methods without real money involved.
                    </p>

                    <div class="flex flex-col justify-center gap-4 sm:flex-row lg:justify-start">
                        <a href="{{ route('register') }}" class="inline-flex transform items-center justify-center rounded-lg bg-gradient-to-r from-purple-600 to-indigo-600 px-8 py-4 font-semibold text-white shadow-lg transition-all duration-200 hover:-translate-y-0.5 hover:from-purple-700 hover:to-indigo-700 hover:shadow-xl">
                            Get Started for Free
                            <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                        <a href="{{ route('docs.index') }}" class="inline-flex items-center justify-center rounded-lg border-2 border-gray-300 px-8 py-4 font-semibold text-gray-700 transition-all duration-200 hover:border-purple-600 hover:text-purple-600">
                            View Documentation
                            <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="mt-12 grid grid-cols-3 gap-6">
                        <div class="text-center lg:text-left">
                            <div class="text-3xl font-bold text-gray-900">15+</div>
                            <div class="text-sm text-gray-600">Payment Methods</div>
                        </div>
                        <div class="text-center lg:text-left">
                            <div class="text-3xl font-bold text-gray-900">100%</div>
                            <div class="text-sm text-gray-600">Free Forever</div>
                        </div>
                        <div class="text-center lg:text-left">
                            <div class="text-3xl font-bold text-gray-900">24/7</div>
                            <div class="text-sm text-gray-600">Available</div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Visual -->
                <div class="hidden lg:block">
                    <div class="relative">
                        <!-- Mock Dashboard Preview -->
                        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-2xl">
                            <div class="mb-4 flex items-center space-x-2">
                                <div class="h-3 w-3 rounded-full bg-red-400"></div>
                                <div class="h-3 w-3 rounded-full bg-yellow-400"></div>
                                <div class="h-3 w-3 rounded-full bg-green-400"></div>
                            </div>
                            <div class="space-y-4">
                                <div class="h-8 w-3/4 rounded bg-gradient-to-r from-purple-200 to-indigo-200"></div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="h-24 rounded-lg bg-purple-100"></div>
                                    <div class="h-24 rounded-lg bg-indigo-100"></div>
                                </div>
                                <div class="h-32 rounded-lg bg-gray-100"></div>
                            </div>
                        </div>

                        <!-- Floating Elements -->
                        <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-purple-500 opacity-20 blur-2xl"></div>
                        <div class="absolute -bottom-6 -left-6 h-32 w-32 rounded-full bg-indigo-500 opacity-20 blur-2xl"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-white py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-4xl font-bold text-gray-900">Why Choose MockPay?</h2>
                <p class="mx-auto max-w-2xl text-xl text-gray-600">
                    Everything you need to test and develop payment integrations
                </p>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Feature 1 -->
                <div class="rounded-xl border border-gray-200 bg-white p-8 transition-all duration-200 hover:border-purple-300 hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-purple-100 text-purple-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-900">Realistic Simulation</h3>
                    <p class="text-gray-600">
                        Simulate all payment methods exactly like real payment gateways. Perfect for development and testing.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="rounded-xl border border-gray-200 bg-white p-8 transition-all duration-200 hover:border-purple-300 hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-900">Complete REST API</h3>
                    <p class="text-gray-600">
                        Full-featured API matching specifications of popular payment gateways like Midtrans and Xendit.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="rounded-xl border border-gray-200 bg-white p-8 transition-all duration-200 hover:border-purple-300 hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-purple-100 text-purple-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-900">Webhook System</h3>
                    <p class="text-gray-600">
                        Real-time webhook notifications with automatic retry logic. Test your webhook handlers easily.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="rounded-xl border border-gray-200 bg-white p-8 transition-all duration-200 hover:border-purple-300 hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-900">Dashboard Analytics</h3>
                    <p class="text-gray-600">
                        Track test transactions, view detailed analytics, and monitor your integration performance.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="rounded-xl border border-gray-200 bg-white p-8 transition-all duration-200 hover:border-purple-300 hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-purple-100 text-purple-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-900">Sandbox & Production</h3>
                    <p class="text-gray-600">
                        Separate sandbox and production environments. Switch seamlessly when you're ready to go live.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="rounded-xl border border-gray-200 bg-white p-8 transition-all duration-200 hover:border-purple-300 hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-900">Zero Cost</h3>
                    <p class="text-gray-600">
                        Completely free for testing and development. No credit card required. Upgrade when you need more features.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Payment Methods Showcase -->
    <section class="bg-gray-50 py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-4xl font-bold text-gray-900">All Indonesian Payment Methods</h2>
                <p class="mx-auto max-w-2xl text-xl text-gray-600">
                    Test with all major payment methods used in Indonesia
                </p>
            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                <!-- Bank Transfer -->
                <div class="rounded-xl border border-gray-200 bg-white p-6">
                    <div class="mb-4 flex items-center space-x-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900">Bank Transfer</h3>
                    </div>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <svg class="mr-2 h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            BCA Virtual Account
                        </li>
                        <li class="flex items-center">
                            <svg class="mr-2 h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Mandiri VA
                        </li>
                        <li class="flex items-center">
                            <svg class="mr-2 h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            BNI, BRI, Permata
                        </li>
                    </ul>
                </div>

                <!-- E-Wallets -->
                <div class="rounded-xl border border-gray-200 bg-white p-6">
                    <div class="mb-4 flex items-center space-x-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-green-100 text-green-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900">E-Wallets</h3>
                    </div>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <svg class="mr-2 h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            GoPay
                        </li>
                        <li class="flex items-center">
                            <svg class="mr-2 h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            OVO, DANA
                        </li>
                        <li class="flex items-center">
                            <svg class="mr-2 h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            ShopeePay, LinkAja
                        </li>
                    </ul>
                </div>

                <!-- Credit Cards -->
                <div class="rounded-xl border border-gray-200 bg-white p-6">
                    <div class="mb-4 flex items-center space-x-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-purple-100 text-purple-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900">Credit Cards</h3>
                    </div>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <svg class="mr-2 h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Visa, Mastercard
                        </li>
                        <li class="flex items-center">
                            <svg class="mr-2 h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            JCB, Amex
                        </li>
                        <li class="flex items-center">
                            <svg class="mr-2 h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            3DS Simulation
                        </li>
                    </ul>
                </div>

                <!-- Other Methods -->
                <div class="rounded-xl border border-gray-200 bg-white p-6">
                    <div class="mb-4 flex items-center space-x-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900">Other Methods</h3>
                    </div>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <svg class="mr-2 h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            QRIS
                        </li>
                        <li class="flex items-center">
                            <svg class="mr-2 h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Alfamart
                        </li>
                        <li class="flex items-center">
                            <svg class="mr-2 h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Indomaret
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="bg-white py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-4xl font-bold text-gray-900">How It Works</h2>
                <p class="mx-auto max-w-2xl text-xl text-gray-600">
                    Get started in minutes with our simple integration process
                </p>
            </div>

            <div class="grid gap-8 md:grid-cols-5">
                <!-- Step 1 -->
                <div class="text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-purple-600 to-indigo-600 text-2xl font-bold text-white">
                        1
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Register Account</h3>
                    <p class="text-sm text-gray-600">Create your free merchant account in seconds</p>
                </div>

                <!-- Step 2 -->
                <div class="text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-purple-600 to-indigo-600 text-2xl font-bold text-white">
                        2
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Get API Keys</h3>
                    <p class="text-sm text-gray-600">Receive sandbox and production API keys</p>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-purple-600 to-indigo-600 text-2xl font-bold text-white">
                        3
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Integrate API</h3>
                    <p class="text-sm text-gray-600">Use our API just like real payment gateways</p>
                </div>

                <!-- Step 4 -->
                <div class="text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-purple-600 to-indigo-600 text-2xl font-bold text-white">
                        4
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Test & Simulate</h3>
                    <p class="text-sm text-gray-600">Simulate payments without real money</p>
                </div>

                <!-- Step 5 -->
                <div class="text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-purple-600 to-indigo-600 text-2xl font-bold text-white">
                        5
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Go Live</h3>
                    <p class="text-sm text-gray-600">Switch to production when ready</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-br from-purple-600 to-indigo-600 py-20">
        <div class="mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
            <h2 class="mb-6 text-4xl font-bold text-white">
                Ready to Start Testing?
            </h2>
            <p class="mb-8 text-xl text-purple-100">
                Join thousands of developers testing their payment integrations with MockPay
            </p>
            <div class="flex flex-col justify-center gap-4 sm:flex-row">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-lg bg-white px-8 py-4 font-semibold text-purple-600 shadow-lg transition-all duration-200 hover:bg-gray-100 hover:shadow-xl">
                    Get Started for Free
                    <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                <a href="{{ route('docs.index') }}" class="inline-flex items-center justify-center rounded-lg border-2 border-white px-8 py-4 font-semibold text-white transition-all duration-200 hover:bg-white hover:text-purple-600">
                    Read Documentation
                </a>
            </div>
            <p class="mt-6 text-sm text-purple-100">
                No credit card required • Free forever • 5-minute setup
            </p>
        </div>
    </section>
@endsection