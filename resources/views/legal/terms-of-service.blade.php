<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service - MockPay</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 antialiased">
    <!-- Top Navigation -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo & Title -->
                <div class="flex items-center space-x-3">
                    <a href="{{ url('/') }}" class="flex items-center space-x-2">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-900">MockPay</span>
                    </a>
                    <span class="text-gray-400">/</span>
                    <span class="text-gray-600 font-medium">Legal</span>
                </div>

                <!-- Right Navigation -->
                <div class="flex items-center space-x-4">
                    <a href="{{ url('/') }}" class="text-gray-600 hover:text-gray-900 font-medium transition-colors duration-200">
                        Home
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all duration-300">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all duration-300">
                            Get Started
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content with Sidebar -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex gap-8">
            <!-- Sidebar Navigation -->
            <aside class="w-64 flex-shrink-0">
                <div class="sticky top-24">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                        <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">LEGAL</h3>
                        <nav class="space-y-1">
                            <a href="{{ route('legal.privacy-policy') }}" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Privacy Policy
                            </a>
                            <a href="{{ route('legal.terms-of-service') }}" class="flex items-center px-3 py-2 text-sm font-semibold rounded-lg bg-purple-50 text-purple-700 border border-purple-200">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Terms of Service
                            </a>
                            <a href="{{ route('legal.cookie-policy') }}" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                                </svg>
                                Cookie Policy
                            </a>
                        </nav>

                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">ON THIS PAGE</h4>
                            <nav class="space-y-2 text-sm">
                                <a href="#acceptance" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">Acceptance of Terms</a>
                                <a href="#service-description" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">Service Description</a>
                                <a href="#account-registration" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">Account Registration</a>
                                <a href="#use-of-service" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">Use of Service</a>
                                <a href="#payment-terms" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">Payment Terms</a>
                                <a href="#prohibited-activities" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">Prohibited Activities</a>
                                <a href="#termination" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">Termination</a>
                                <a href="#governing-law" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">Governing Law</a>
                                <a href="#force-majeure" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">Force Majeure</a>
                                <a href="#liability" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">Limitation of Liability</a>
                                <a href="#changes" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">Changes to Terms</a>
                                <a href="#contact" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">Contact</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 max-w-4xl">
                <!-- Header -->
                <div class="mb-10">
                    <h1 class="text-5xl font-bold text-gray-900 mb-3 tracking-tight">Terms of Service</h1>
                    <p class="text-lg text-gray-600 font-medium">Last updated: January 27, 2026</p>
                </div>

                <!-- Content -->
                <div class="prose prose-lg max-w-none">
                    <!-- Acceptance of Terms -->
                    <section id="acceptance" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Acceptance of Terms</h2>
                        <p class="text-gray-700 leading-relaxed text-base mb-4 text-justify">
                            By accessing, registering for, or using MockPay's services, you unconditionally agree to be bound by these Terms of Service and all applicable laws and regulations. If you do not agree with any part of these terms, you must immediately discontinue use of our services. Your continued use of the platform constitutes ongoing acceptance of these terms and any future modifications.
                        </p>
                        <div class="bg-red-50 border-l-4 border-red-500 p-5 rounded-r-lg">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-red-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                <div class="ml-3">
                                    <p class="text-gray-800 text-base font-semibold mb-2">Critical Disclaimer</p>
                                    <p class="text-gray-700 text-sm leading-relaxed text-justify">
                                        MockPay is exclusively a <strong>testing and development sandbox environment</strong>. No real financial transactions occur through this platform. All payment processing is simulated for development purposes only. Users assume all risks associated with their use of the service. MockPay disclaims all warranties and limits liability as specified herein. By using this service, you explicitly acknowledge and agree to these limitations and disclaimers.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Service Description -->
                    <section id="service-description" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Service Description</h2>
                        <p class="text-gray-700 leading-relaxed text-base mb-6 text-justify">
                            MockPay provides a comprehensive dummy payment gateway platform that simulates real payment processing environments for testing and development purposes only. Our service enables developers to test payment integrations without risking actual financial transactions or exposing sensitive customer data.
                        </p>

                        <div class="space-y-4">
                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-purple-300 transition-colors duration-200">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Simulated Payment Methods</h3>
                                <p class="text-gray-700 text-base leading-relaxed text-justify">We provide virtual credit cards, bank transfers, e-wallets, and other payment methods that simulate real payment processing flows. These test payment methods allow you to validate your integration without using actual payment credentials or processing real transactions. All payment data is simulated and contains no real financial information.</p>
                            </div>

                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-purple-300 transition-colors duration-200">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">API Integration</h3>
                                <p class="text-gray-700 text-base leading-relaxed text-justify">Access to our RESTful API endpoints, comprehensive documentation, code examples in multiple programming languages, and testing tools. Our API is designed to mirror real payment gateway interfaces for testing purposes only. MockPay provides no guarantee that API behavior matches any specific real payment gateway.</p>
                            </div>

                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-purple-300 transition-colors duration-200">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Transaction Dashboard</h3>
                                <p class="text-gray-700 text-base leading-relaxed text-justify">A comprehensive web-based dashboard for monitoring test transactions, viewing detailed transaction logs, managing API credentials, configuring webhook endpoints, and analyzing payment patterns to ensure your integration works correctly in a testing environment.</p>
                            </div>

                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-purple-300 transition-colors duration-200">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Webhook Testing</h3>
                                <p class="text-gray-700 text-base leading-relaxed text-justify">Real-time webhook notifications for simulated payment events, allowing you to test how your application handles various payment states including successful payments, failed transactions, pending status, refunds, and chargebacks in a controlled testing environment only.</p>
                            </div>
                        </div>
                    </section>

                    <!-- Account Registration -->
                    <section id="account-registration" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Account Registration</h2>
                        <p class="text-gray-700 leading-relaxed text-base mb-6 text-justify">
                            To use MockPay's services, you must create an account by providing accurate and complete information. You are solely and exclusively responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account.
                        </p>

                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-semibold text-gray-900 text-lg">Registration Methods</h4>
                                    <p class="text-gray-700 text-base leading-relaxed text-justify">You can register for MockPay using either email and password or through Google Sign-In (OAuth). When using Google Sign-In, you authorize us to access your basic profile information including your name and email address from your Google account. We do not have access to your Google password or other sensitive account information. You are responsible for maintaining the security of your Google account.</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-semibold text-gray-900 text-lg">Account Accuracy</h4>
                                    <p class="text-gray-700 text-base leading-relaxed text-justify">You must provide accurate, current, and complete information during registration and keep your account information updated at all times. Providing false, misleading, or incomplete information is a violation of these terms and may result in immediate account suspension or termination without refund. MockPay reserves the right to verify account information and refuse service based on verification results.</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-pink-500 to-red-500 flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-semibold text-gray-900 text-lg">Account Security</h4>
                                    <p class="text-gray-700 text-base leading-relaxed text-justify">You are solely responsible for maintaining the security of your account credentials, including your password and API keys. You must immediately notify us of any unauthorized use of your account or any other security breach. MockPay is not liable for any loss or damage arising from your failure to protect your account credentials. We strongly recommend changing passwords regularly and using strong, unique passwords.</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-red-500 to-orange-500 flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-semibold text-gray-900 text-lg">Account Responsibility</h4>
                                    <p class="text-gray-700 text-base leading-relaxed text-justify">You are responsible for all activities conducted through your account, whether or not authorized by you. You must ensure that your account is not used for any unlawful or prohibited activities. Any violation of these terms through your account may result in immediate termination without notice. MockPay reserves the right to monitor account activity and take appropriate action for any suspicious or prohibited activities.</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Use of Service -->
                    <section id="use-of-service" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Use of Service</h2>
                        <p class="text-gray-700 leading-relaxed text-base mb-6 text-justify">
                            MockPay is intended solely for testing and development purposes in sandbox environments. You agree to use our services in compliance with all applicable laws and regulations and in accordance with these Terms of Service. Any other use is strictly prohibited.
                        </p>

                        <div class="bg-gradient-to-br from-purple-50 to-indigo-50 border-2 border-purple-200 rounded-xl p-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Acceptable Use Guidelines</h3>
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-purple-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="ml-3 text-gray-700 text-base leading-relaxed text-justify">Use the service exclusively for testing and development purposes in sandbox environments. Do not attempt to process real financial transactions, use actual customer payment information, or connect to production systems. The service is for testing only.</p>
                                </div>
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-purple-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="ml-3 text-gray-700 text-base leading-relaxed text-justify">Protect your API keys and credentials as sensitive information. Never share them publicly, commit them to version control systems, or store them in insecure locations. Regenerate keys immediately if you suspect they have been compromised. MockPay is not responsible for damages from compromised credentials.</p>
                                </div>
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-purple-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="ml-3 text-gray-700 text-base leading-relaxed text-justify">Comply with all API rate limits and usage restrictions. Excessive use that negatively impacts service availability for other users may result in temporary or permanent restrictions on your account. MockPay reserves the right to throttle or limit usage at its discretion.</p>
                                </div>
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-purple-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="ml-3 text-gray-700 text-base leading-relaxed text-justify">Do not use the service for any unlawful purpose or in any way that violates these Terms of Service. Respect the rights of other users and third parties when using our platform. Any illegal or prohibited use will result in immediate termination and may be reported to authorities.</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Payment Terms -->
                    <section id="payment-terms" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Payment Terms</h2>
                        <p class="text-gray-700 leading-relaxed text-base mb-6 text-justify">
                            While MockPay processes only simulated transactions, we offer various subscription plans for extended features and higher usage limits. All fees are in Indonesian Rupiah (IDR) and are subject to applicable taxes. All payments are non-refundable unless otherwise required by law.
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6">
                                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Transaction Fees</h3>
                                <p class="text-gray-700 text-base text-justify mb-3">Standard transaction fee of 2.9% + IDR 2,500 per simulated transaction for paid plans. Free plan includes limited transactions per month. Fees are subject to change with 30 days notice.</p>
                            </div>

                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6">
                                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Subscription Plans</h3>
                                <p class="text-gray-700 text-base text-justify mb-3">Monthly subscription fees vary by plan tier. Starter: Free, Professional: IDR 500,000/month, Enterprise: Custom pricing with additional features and support. All subscriptions automatically renew unless canceled.</p>
                            </div>

                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6">
                                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Chargeback Simulation</h3>
                                <p class="text-gray-700 text-base text-justify mb-3">Testing chargeback scenarios incurs a fee of IDR 100,000 per simulated chargeback to cover administrative costs and system resources. This fee is non-refundable.</p>
                            </div>

                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6">
                                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Refund Policy</h3>
                                <p class="text-gray-700 text-base text-justify mb-3">Subscription fees are non-refundable except as required by Indonesian consumer protection law. You may cancel your subscription at any time, and it will remain active until the end of the current billing period. No prorated refunds for partial months.</p>
                            </div>
                        </div>
                    </section>

                    <!-- Prohibited Activities -->
                    <section id="prohibited-activities" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Prohibited Activities</h2>
                        <p class="text-gray-700 leading-relaxed text-base mb-6 text-justify">
                            You agree not to engage in any of the following prohibited activities when using MockPay. Violation of these restrictions may result in immediate termination of your account, forfeiture of any fees paid, and legal action where applicable.
                        </p>

                        <div class="space-y-3">
                            <div class="flex items-start bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                                <svg class="w-6 h-6 text-red-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <div class="ml-3">
                                    <h4 class="font-bold text-gray-900 text-base">Processing Real Transactions</h4>
                                    <p class="text-gray-700 text-sm mt-1 text-justify">Attempting to process real financial transactions, using actual customer payment information, or connecting the service to production systems. MockPay is for testing only and any attempt to process real transactions is strictly prohibited.</p>
                                </div>
                            </div>

                            <div class="flex items-start bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                                <svg class="w-6 h-6 text-red-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <div class="ml-3">
                                    <h4 class="font-bold text-gray-900 text-base">Unauthorized Access</h4>
                                    <p class="text-gray-700 text-sm mt-1 text-justify">Attempting to access accounts, systems, or data that you are not authorized to access, including bypassing security measures, exploiting vulnerabilities, or using another user's credentials without permission.</p>
                                </div>
                            </div>

                            <div class="flex items-start bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                                <svg class="w-6 h-6 text-red-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <div class="ml-3">
                                    <h4 class="font-bold text-gray-900 text-base">Malicious Code Distribution</h4>
                                    <p class="text-gray-700 text-sm mt-1 text-justify">Uploading, transmitting, or distributing any viruses, malware, ransomware, or other malicious code that could harm our systems, other users, or third-party systems. This includes attempting to disrupt or compromise service integrity.</p>
                                </div>
                            </div>

                            <div class="flex items-start bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                                <svg class="w-6 h-6 text-red-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <div class="ml-3">
                                    <h4 class="font-bold text-gray-900 text-base">Abuse and Harassment</h4>
                                    <p class="text-gray-700 text-sm mt-1 text-justify">Harassing, threatening, or abusing other users or our support staff through any communication channel provided by our platform. This includes excessive, abusive, or threatening communications.</p>
                                </div>
                            </div>

                            <div class="flex items-start bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                                <svg class="w-6 h-6 text-red-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <div class="ml-3">
                                    <h4 class="font-bold text-gray-900 text-base">Intellectual Property Violation</h4>
                                    <p class="text-gray-700 text-sm mt-1 text-justify">Infringing upon copyrights, trademarks, patents, trade secrets, or other intellectual property rights of MockPay or third parties. This includes unauthorized use, reproduction, or distribution of protected materials.</p>
                                </div>
                            </div>

                            <div class="flex items-start bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                                <svg class="w-6 h-6 text-red-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <div class="ml-3">
                                    <h4 class="font-bold text-gray-900 text-base">Service Disruption</h4>
                                    <p class="text-gray-700 text-sm mt-1 text-justify">Interfering with or disrupting the service, servers, or networks connected to the service, including through denial-of-service attacks, excessive automated requests, or any activity designed to overload or disrupt service availability.</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Termination -->
                    <section id="termination" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Account Termination</h2>
                        <p class="text-gray-700 leading-relaxed text-base mb-6 text-justify">
                            We reserve the right to suspend or terminate your account at our sole discretion if you violate these Terms of Service or engage in activities that harm our platform, other users, or third parties. Termination may occur without prior notice in cases of serious violations.
                        </p>

                        <div class="bg-gradient-to-br from-orange-50 to-red-50 border-2 border-orange-200 rounded-xl p-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-5">Termination Process</h3>
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                        <span class="font-bold text-orange-600">1</span>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 mb-1">Voluntary Termination</h4>
                                        <p class="text-gray-700 text-base text-justify">You may terminate your account at any time through your dashboard settings. Upon termination, your access to the service will be immediately revoked. No refunds will be provided for any remaining subscription period.</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                        <span class="font-bold text-orange-600">2</span>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 mb-1">Data Retention</h4>
                                        <p class="text-gray-700 text-base text-justify">After account termination, your data will be retained for 30 days before permanent deletion, unless longer retention is required by law. You may request immediate deletion by contacting our support team, but we reserve the right to retain data as required by Indonesian regulations.</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                        <span class="font-bold text-orange-600">3</span>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 mb-1">Service Suspension</h4>
                                        <p class="text-gray-700 text-base text-justify">We may temporarily suspend your account if we detect suspicious activity or Terms of Service violations. You will be notified and given an opportunity to respond before permanent termination, except in cases of serious violations where immediate termination is necessary.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Governing Law -->
                    <section id="governing-law" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Governing Law & Dispute Resolution</h2>

                        <div class="bg-white border-2 border-gray-200 rounded-xl p-6">
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900 mb-2">Governing Law</h3>
                                        <p class="text-gray-700 text-base">
                                            These Terms shall be governed by and construed in accordance with the laws of the Republic of Indonesia, without regard to its conflict of law provisions. The United Nations Convention on Contracts for the International Sale of Goods shall not apply. Users worldwide agree to submit to the exclusive jurisdiction of the courts located in Jakarta, Indonesia.
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900 mb-2">Dispute Resolution</h3>
                                        <p class="text-gray-700 text-base">
                                            Any dispute, controversy, or claim arising out of or relating to these Terms shall first be attempted to be resolved through good faith negotiations between the parties. If unresolved within 30 days, parties agree to submit to binding arbitration in Jakarta, Indonesia, in accordance with the Indonesian National Board of Arbitration (Badan Arbitrase Nasional Indonesia - BANI) rules. The arbitration shall be conducted in English. Judgment upon the award rendered by the arbitrator(s) may be entered in any court having jurisdiction thereof.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Force Majeure -->
                    <section id="force-majeure" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Force Majeure</h2>

                        <div class="bg-gray-50 border-2 border-gray-200 rounded-xl p-6">
                            <div class="flex items-start">
                                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">Events Beyond Our Control</h3>
                                    <p class="text-gray-700 text-base leading-relaxed">
                                        MockPay shall not be liable for any failure or delay in performance due to circumstances beyond our reasonable control, including but not limited to: acts of God, natural disasters, war, terrorism, riots, government actions, epidemics, pandemics, strikes, labor disputes, power failures, internet disruptions, cyber attacks, infrastructure failures, or any other events that are not within our reasonable control. In such events, MockPay may suspend or terminate service without liability. Subscription periods will not be extended for force majeure events.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Limitation of Liability -->
                    <section id="liability" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Limitation of Liability</h2>

                        <div class="bg-red-50 border-2 border-red-200 rounded-xl p-6 mb-6">
                            <div class="flex items-start">
                                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-3">No Liability for Consequential Damages</h3>
                                    <p class="text-gray-700 text-base leading-relaxed mb-3">
                                        To the maximum extent permitted by applicable law, <strong>MockPay shall not be liable</strong> for any indirect, incidental, special, consequential, or punitive damages, including but not limited to:
                                    </p>
                                    <ul class="list-disc pl-5 text-gray-700 text-base space-y-1">
                                        <li>Loss of profits, revenue, business opportunities, or data</li>
                                        <li>Business interruption or downtime costs</li>
                                        <li>Reputational damage or loss of goodwill</li>
                                        <li>Cost of substitute goods or services</li>
                                        <li>Damages resulting from security breaches, data loss, or unauthorized access</li>
                                        <li>Damages resulting from service interruptions, delays, or failures</li>
                                        <li>Any damages related to your use or inability to use the service</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="bg-yellow-50 border-2 border-yellow-200 rounded-xl p-6">
                            <div class="flex">
                                <svg class="w-6 h-6 text-yellow-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="ml-4">
                                    <p class="text-gray-800 font-bold mb-3">Total Liability Cap</p>
                                    <p class="text-gray-700 text-base leading-relaxed mb-4">
                                        In no event shall MockPay's total liability to you for all claims arising from or related to these Terms or your use of the Service exceed the amount paid by you to MockPay in the six (6) months preceding the claim, or IDR 1,000,000 (One Million Rupiah), whichever is greater. This limitation applies to all claims regardless of the legal theory on which they are based, including contract, tort, strict liability, or any other theory.
                                    </p>
                                    <p class="text-gray-800 font-bold mb-3">Essential Purpose & Disclaimer of Warranties</p>
                                    <p class="text-gray-700 text-base leading-relaxed">
                                        The service is provided "as is" and "as available" without any warranties of any kind, either express or implied. MockPay specifically disclaims all warranties, including but not limited to warranties of merchantability, fitness for a particular purpose, non-infringement, and accuracy. MockPay does not warrant that the service will be uninterrupted, secure, error-free, or meet your specific requirements. These limitations are an essential basis of the bargain between you and MockPay, and the service would not be provided without such limitations.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Changes to Terms -->
                    <section id="changes" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Changes to Terms</h2>

                        <div class="bg-white border-2 border-gray-200 rounded-xl p-6">
                            <div class="flex items-start">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">Modification Rights</h3>
                                    <p class="text-gray-700 text-base leading-relaxed mb-3">
                                        We reserve the right to modify these Terms at any time at our sole discretion. Changes will be effective immediately upon posting on our website. Your continued use of the Service after such changes constitutes your unconditional acceptance of the new Terms. It is your responsibility to regularly review these Terms for any changes.
                                    </p>
                                    <p class="text-gray-700 text-base leading-relaxed">
                                        We will make reasonable efforts to notify users of material changes via email or dashboard notifications, but we are not obligated to do so. If you do not agree to the modified Terms, you must immediately discontinue using the Service. No refunds will be provided for discontinuation due to Terms changes.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Contact -->
                    <section id="contact" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Contact Us</h2>
                        <p class="text-gray-700 leading-relaxed text-base mb-6">
                            If you have any questions about this Privacy Policy or wish to exercise your rights, please contact us through our official channels:
                        </p>
                        <div class="bg-white border-2 border-gray-200 rounded-xl p-8">
                            <div class="space-y-6">
                                <div class="flex items-start">
                                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Privacy Inquiries</p>
                                        <p class="text-lg font-semibold text-gray-900">legal@m.next-it.my.id</p>
                                        <p class="text-sm text-gray-600 mt-1">For terms-of-service questions</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Official Website</p>
                                        <p class="text-lg font-semibold text-gray-900">https://m.next-it.my.id/</p>
                                        <p class="text-sm text-gray-600 mt-1">Visit for latest updates and documentation</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Technical Support</p>
                                        <p class="text-lg font-semibold text-gray-900">support@m.next-it.my.id</p>
                                        <p class="text-sm text-gray-600 mt-1">For technical issues and service-related questions</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <p class="text-sm text-gray-600 text-center">
                                <strong>Important Notice:</strong> By using MockPay's services, you acknowledge and agree that you have read, understood, and consent to all terms in this Privacy Policy. This document is available in English and Indonesian versions. In case of any discrepancy between versions, the English version shall prevail. This Privacy Policy is governed by Indonesian law, and users worldwide agree to its terms by using our services.
                            </p>
                        </div>
                    </section>
                </div>
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-600 text-sm font-medium">&copy; 2026 MockPay. All rights reserved.</p>
                <div class="flex space-x-8 mt-4 md:mt-0">
                    <a href="{{ route('legal.privacy-policy') }}" class="text-gray-600 hover:text-purple-600 text-sm font-medium transition-colors duration-200">Privacy Policy</a>
                    <a href="{{ route('legal.terms-of-service') }}" class="text-gray-600 hover:text-purple-600 text-sm font-medium transition-colors duration-200">Terms of Service</a>
                    <a href="{{ route('legal.cookie-policy') }}" class="text-gray-600 hover:text-purple-600 text-sm font-medium transition-colors duration-200">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
