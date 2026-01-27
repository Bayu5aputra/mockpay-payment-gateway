<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie Policy - MockPay</title>
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
                            <a href="{{ route('legal.terms-of-service') }}" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Terms of Service
                            </a>
                            <a href="{{ route('legal.cookie-policy') }}" class="flex items-center px-3 py-2 text-sm font-semibold rounded-lg bg-purple-50 text-purple-700 border border-purple-200">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                                </svg>
                                Cookie Policy
                            </a>
                        </nav>

                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">ON THIS PAGE</h4>
                            <nav class="space-y-2 text-sm">
                                <a href="#what-are-cookies" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">What Are Cookies</a>
                                <a href="#why-we-use" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">Why We Use Cookies</a>
                                <a href="#types-of-cookies" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">Types of Cookies</a>
                                <a href="#how-to-control" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">How to Control Cookies</a>
                                <a href="#third-party" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">Third-Party Cookies</a>
                                <a href="#contact" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">Contact Us</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 max-w-4xl">
                <!-- Header -->
                <div class="mb-10">
                    <h1 class="text-5xl font-bold text-gray-900 mb-3 tracking-tight">Cookie Policy</h1>
                    <p class="text-lg text-gray-600 font-medium">Last updated: January 27, 2026</p>
                </div>

                <!-- Content -->
                <div class="prose prose-lg max-w-none">
                    <!-- What Are Cookies -->
                    <section id="what-are-cookies" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">What Are Cookies</h2>
                        <p class="text-gray-700 leading-relaxed text-base mb-4">
                            Cookies are small text files that are placed on your computer or mobile device when you visit our website. They are widely used by website owners to make their websites work, or work more efficiently, as well as to provide reporting information.
                        </p>
                        <p class="text-gray-700 leading-relaxed text-base">
                            Cookies set by the website owner (in this case, MockPay) are called "first-party cookies". Cookies set by parties other than the website owner are called "third-party cookies". Third-party cookies enable third-party features or functionality to be provided on or through the website (e.g., analytics, interactive content).
                        </p>
                    </section>

                    <!-- Why We Use Cookies -->
                    <section id="why-we-use" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Why We Use Cookies</h2>
                        <p class="text-gray-700 leading-relaxed text-base mb-6">
                            We use first-party and third-party cookies for several reasons. Some cookies are required for technical reasons for our Website to operate, and we refer to these as "essential" or "strictly necessary" cookies. Other cookies enable us to track and target the interests of our users to enhance the experience on our Website.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6">
                                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Security</h3>
                                <p class="text-gray-700 text-base">Protect your account and prevent unauthorized access</p>
                            </div>

                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6">
                                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Performance</h3>
                                <p class="text-gray-700 text-base">Improve website speed and performance</p>
                            </div>

                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6">
                                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Analytics</h3>
                                <p class="text-gray-700 text-base">Understand how visitors use our website and services</p>
                            </div>

                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6">
                                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Personalization</h3>
                                <p class="text-gray-700 text-base">Remember your preferences and settings</p>
                            </div>
                        </div>
                    </section>

                    <!-- Types of Cookies -->
                    <section id="types-of-cookies" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Types of Cookies We Use</h2>

                        <!-- Essential Cookies -->
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">1. Essential Cookies</h3>
                            <p class="text-gray-700 leading-relaxed text-base mb-4">
                                These cookies are strictly necessary to provide you with services available through our Website and to use some of its features, such as access to secure areas.
                            </p>
                            <div class="bg-purple-50 border-2 border-purple-200 rounded-xl p-6">
                                <table class="w-full text-sm">
                                    <tbody>
                                        <tr class="border-b border-purple-200">
                                            <td class="py-3 pr-4 font-semibold text-gray-900">Cookie Name:</td>
                                            <td class="py-3 text-gray-700">mockpay_session</td>
                                        </tr>
                                        <tr class="border-b border-purple-200">
                                            <td class="py-3 pr-4 font-semibold text-gray-900">Purpose:</td>
                                            <td class="py-3 text-gray-700">Maintain user session and authentication for merchant dashboard</td>
                                        </tr>
                                        <tr class="border-b border-purple-200">
                                            <td class="py-3 pr-4 font-semibold text-gray-900">Duration:</td>
                                            <td class="py-3 text-gray-700">Session (until browser closed)</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 pr-4 font-semibold text-gray-900">Type:</td>
                                            <td class="py-3 text-gray-700">First-Party Cookie</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Performance Cookies -->
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">2. Performance and Analytics Cookies</h3>
                            <p class="text-gray-700 leading-relaxed text-base mb-4">
                                These cookies allow us to count visits and traffic sources so we can measure and improve the performance of our Website. They help us know which pages are the most and least popular and see how visitors move around the Website.
                            </p>
                            <div class="bg-blue-50 border-2 border-blue-200 rounded-xl p-6">
                                <table class="w-full text-sm">
                                    <tbody>
                                        <tr class="border-b border-blue-200">
                                            <td class="py-3 pr-4 font-semibold text-gray-900">Cookie Name:</td>
                                            <td class="py-3 text-gray-700">_ga, _gid, _gat</td>
                                        </tr>
                                        <tr class="border-b border-blue-200">
                                            <td class="py-3 pr-4 font-semibold text-gray-900">Purpose:</td>
                                            <td class="py-3 text-gray-700">Google Analytics tracking to understand user behavior and payment simulation patterns</td>
                                        </tr>
                                        <tr class="border-b border-blue-200">
                                            <td class="py-3 pr-4 font-semibold text-gray-900">Duration:</td>
                                            <td class="py-3 text-gray-700">2 years / 24 hours / 1 minute</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 pr-4 font-semibold text-gray-900">Type:</td>
                                            <td class="py-3 text-gray-700">Third-Party Cookie (Google)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Functionality Cookies -->
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">3. Functionality Cookies</h3>
                            <p class="text-gray-700 leading-relaxed text-base mb-4">
                                These cookies enable the Website to provide enhanced functionality and personalization. They may be set by us or by third-party providers whose services we have added to our pages.
                            </p>
                            <div class="bg-green-50 border-2 border-green-200 rounded-xl p-6">
                                <table class="w-full text-sm">
                                    <tbody>
                                        <tr class="border-b border-green-200">
                                            <td class="py-3 pr-4 font-semibold text-gray-900">Cookie Name:</td>
                                            <td class="py-3 text-gray-700">user_preferences, language_preference, payment_method_selection</td>
                                        </tr>
                                        <tr class="border-b border-green-200">
                                            <td class="py-3 pr-4 font-semibold text-gray-900">Purpose:</td>
                                            <td class="py-3 text-gray-700">Remember user preferences, language settings, and preferred payment methods for testing</td>
                                        </tr>
                                        <tr class="border-b border-green-200">
                                            <td class="py-3 pr-4 font-semibold text-gray-900">Duration:</td>
                                            <td class="py-3 text-gray-700">1 year</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 pr-4 font-semibold text-gray-900">Type:</td>
                                            <td class="py-3 text-gray-700">First-Party Cookie</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Targeting Cookies -->
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">4. Targeting and Advertising Cookies</h3>
                            <p class="text-gray-700 leading-relaxed text-base mb-4">
                                These cookies may be set through our site by our advertising partners. They may be used by those companies to build a profile of your interests and show you relevant advertisements on other sites.
                            </p>
                            <div class="bg-yellow-50 border-2 border-yellow-200 rounded-xl p-6">
                                <table class="w-full text-sm">
                                    <tbody>
                                        <tr class="border-b border-yellow-200">
                                            <td class="py-3 pr-4 font-semibold text-gray-900">Cookie Name:</td>
                                            <td class="py-3 text-gray-700">_fbp, fr (Facebook Pixel)</td>
                                        </tr>
                                        <tr class="border-b border-yellow-200">
                                            <td class="py-3 pr-4 font-semibold text-gray-900">Purpose:</td>
                                            <td class="py-3 text-gray-700">Facebook advertising and remarketing for MockPay services</td>
                                        </tr>
                                        <tr class="border-b border-yellow-200">
                                            <td class="py-3 pr-4 font-semibold text-gray-900">Duration:</td>
                                            <td class="py-3 text-gray-700">3 months</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 pr-4 font-semibold text-gray-900">Type:</td>
                                            <td class="py-3 text-gray-700">Third-Party Cookie (Facebook)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>

                    <!-- How to Control Cookies -->
                    <section id="how-to-control" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">How to Control Cookies</h2>
                        <p class="text-gray-700 leading-relaxed text-base mb-4">
                            You have the right to decide whether to accept or reject cookies. You can exercise your cookie preferences by clicking on the appropriate opt-out links provided in the cookie banner displayed on our Website.
                        </p>
                        <p class="text-gray-700 leading-relaxed text-base mb-6">
                            You can also set or amend your web browser controls to accept or refuse cookies. If you choose to reject cookies, you may still use our Website though your access to some functionality and areas of our Website may be restricted.
                        </p>

                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-xl p-8">
                            <h4 class="text-xl font-semibold text-gray-800 mb-4">Browser-Specific Instructions:</h4>
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-gray-900 mb-1">Google Chrome</h5>
                                        <p class="text-sm text-gray-700">Settings → Privacy and security → Cookies and other site data</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-gray-900 mb-1">Mozilla Firefox</h5>
                                        <p class="text-sm text-gray-700">Options → Privacy & Security → Cookies and Site Data</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-gray-900 mb-1">Apple Safari</h5>
                                        <p class="text-sm text-gray-700">Preferences → Privacy → Cookies and website data</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-6 h-6 text-blue-700" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-gray-900 mb-1">Microsoft Edge</h5>
                                        <p class="text-sm text-gray-700">Settings → Privacy, search, and services → Cookies and site permissions</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Third-Party Cookies -->
                    <section id="third-party" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Third-Party Cookies</h2>
                        <p class="text-gray-700 leading-relaxed text-base mb-6">
                            In addition to our own cookies, we may also use various third-party cookies to report usage statistics of the Service and deliver advertisements on and through the Service. The specific types of first-party and third-party cookies served through our Website and the purposes they perform are described below:
                        </p>

                        <div class="space-y-6">
                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-purple-300 transition-colors duration-200">
                                <div class="flex items-start">
                                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-gray-900 mb-2">Google Analytics</h3>
                                        <p class="text-gray-700 text-base mb-2">Used to analyze how users interact with our Website and provide insights into visitor behavior for payment gateway simulation improvements.</p>
                                        <a href="https://policies.google.com/privacy" target="_blank" class="text-purple-600 hover:text-purple-700 text-sm font-medium">
                                            Google Privacy Policy →
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-purple-300 transition-colors duration-200">
                                <div class="flex items-start">
                                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-gray-900 mb-2">Facebook Pixel</h3>
                                        <p class="text-gray-700 text-base mb-2">Used for advertising and remarketing, tracking conversions from Facebook ads to acquire new merchants for our dummy payment gateway platform.</p>
                                        <a href="https://www.facebook.com/privacy/explanation" target="_blank" class="text-purple-600 hover:text-purple-700 text-sm font-medium">
                                            Facebook Data Policy →
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-purple-300 transition-colors duration-200">
                                <div class="flex items-start">
                                    <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-gray-900 mb-2">Stripe</h3>
                                        <p class="text-gray-700 text-base mb-2">Used for simulated payment processing and fraud detection in test transactions. These cookies help maintain security in our testing environment.</p>
                                        <a href="https://stripe.com/privacy" target="_blank" class="text-purple-600 hover:text-purple-700 text-sm font-medium">
                                            Stripe Privacy Policy →
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-purple-300 transition-colors duration-200">
                                <div class="flex items-start">
                                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-gray-900 mb-2">Intercom</h3>
                                        <p class="text-gray-700 text-base mb-2">Used for customer support and in-app messaging to assist merchants with their payment integration testing and API usage.</p>
                                        <a href="https://www.intercom.com/legal/privacy" target="_blank" class="text-purple-600 hover:text-purple-700 text-sm font-medium">
                                            Intercom Privacy Policy →
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-purple-300 transition-colors duration-200">
                                <div class="flex items-start">
                                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 0C8.318 0 4.5 1.867 4.5 5.25c0 3.383 3.818 5.25 7.5 5.25s7.5-1.867 7.5-5.25C19.5 1.867 15.682 0 12 0zm0 8.25a3 3 0 110-6 3 3 0 010 6zm.75 6.75h-1.5c-4.139 0-7.5 2.186-7.5 5.25v3h16.5v-3c0-3.064-3.361-5.25-7.5-5.25z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-gray-900 mb-2">Google Sign-In</h3>
                                        <p class="text-gray-700 text-base mb-2">Used for OAuth authentication when merchants choose to sign up or log in using their Google account, as described in our Terms of Service.</p>
                                        <a href="https://policies.google.com/privacy" target="_blank" class="text-purple-600 hover:text-purple-700 text-sm font-medium">
                                            Google Privacy Policy →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Updates -->
                    <section id="updates" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Cookie Policy Updates</h2>
                        <p class="text-gray-700 leading-relaxed text-base mb-4">
                            We may update this Cookie Policy from time to time to reflect changes to the cookies we use or for other operational, legal, or regulatory reasons.
                        </p>
                        <p class="text-gray-700 leading-relaxed text-base">
                            Therefore, please revisit this Cookie Policy regularly to stay informed about our use of cookies and related technologies. The date at the top of this Cookie Policy indicates when it was last updated.
                        </p>
                    </section>

                    <!-- Contact -->
                    <section id="contact" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Contact Us</h2>
                        <p class="text-gray-700 leading-relaxed text-base mb-6">
                            If you have any questions about our use of cookies or other technologies, please contact us at:
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
                                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Email</p>
                                        <p class="text-lg font-semibold text-gray-900">privacy@mockpay.com</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Address</p>
                                        <p class="text-lg font-semibold text-gray-900">MockPay Headquarters</p>
                                        <p class="text-base text-gray-600">Jl. Sudirman No. 123, Jakarta Pusat 10220, Indonesia</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Phone</p>
                                        <p class="text-lg font-semibold text-gray-900">+62 21 1234 5678</p>
                                    </div>
                                </div>
                            </div>
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
