<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - MockPay</title>
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
                            <a href="{{ route('legal.privacy-policy') }}" class="flex items-center px-3 py-2 text-sm font-semibold rounded-lg bg-purple-50 text-purple-700 border border-purple-200">
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
                                <a href="#introduction" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">Introduction</a>
                                <a href="#information-we-collect" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">Information We Collect</a>
                                <a href="#how-we-use" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">How We Use Your Data</a>
                                <a href="#data-security" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">Data Security</a>
                                <a href="#limitation-of-liability" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">Limitation of Liability</a>
                                <a href="#data-retention" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">Data Retention</a>
                                <a href="#your-rights" class="block text-gray-600 hover:text-purple-600 transition-colors duration-200">Your Rights</a>
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
                    <h1 class="text-5xl font-bold text-gray-900 mb-3 tracking-tight">Privacy Policy</h1>
                    <p class="text-lg text-gray-600 font-medium">Last updated: January 27, 2026</p>
                </div>

                <!-- Content -->
                <div class="prose prose-lg max-w-none">
                    <!-- Introduction -->
                    <section id="introduction" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Introduction</h2>
                        <p class="text-gray-700 leading-relaxed text-base mb-4">
                            Welcome to MockPay. We respect your privacy and are committed to protecting your personal data. This privacy policy explains how we collect, use, and safeguard your information when you use our dummy payment gateway service for testing and development purposes.
                        </p>
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-5 rounded-r-lg">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="ml-3">
                                    <p class="text-gray-800 text-base font-semibold mb-2">Important Notice</p>
                                    <p class="text-gray-700 text-sm leading-relaxed">
                                        MockPay is a <strong>sandbox payment gateway for testing purposes only</strong>. No real money is processed through this system. All transactions are simulated for development and testing environments. By using our service, you acknowledge and agree to this Privacy Policy.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Information We Collect -->
                    <section id="information-we-collect" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Information We Collect</h2>
                        <p class="text-gray-700 leading-relaxed text-base mb-6">
                            We collect different types of information to provide and improve our testing service:
                        </p>

                        <div class="space-y-4">
                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-purple-300 transition-colors duration-200">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Account Information</h3>
                                <p class="text-gray-700 text-base leading-relaxed">Name, email address, company name, and password for account creation and authentication. You are solely responsible for maintaining the security of your password.</p>
                            </div>

                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-purple-300 transition-colors duration-200">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">API Credentials</h3>
                                <p class="text-gray-700 text-base leading-relaxed">Merchant ID, API keys, and webhook URLs for testing integration with your applications. API keys must be treated as sensitive credentials.</p>
                            </div>

                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-purple-300 transition-colors duration-200">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Test Transaction Data</h3>
                                <p class="text-gray-700 text-base leading-relaxed">Simulated payment information including dummy card numbers, virtual account details, and transaction amounts used for testing. No real financial data is processed.</p>
                            </div>

                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-purple-300 transition-colors duration-200">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Usage Data</h3>
                                <p class="text-gray-700 text-base leading-relaxed">Information about how you interact with our service, including API calls, dashboard usage, and feature utilization for service improvement.</p>
                            </div>

                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-purple-300 transition-colors duration-200">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Technical Information</h3>
                                <p class="text-gray-700 text-base leading-relaxed">IP address, browser type, device information, and operating system for security monitoring and service improvement purposes.</p>
                            </div>
                        </div>
                    </section>

                    <!-- How We Use -->
                    <section id="how-we-use" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">How We Use Your Data</h2>
                        <p class="text-gray-700 leading-relaxed text-base mb-6">
                            We use the collected information for the following purposes:
                        </p>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mt-1">
                                    <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-bold text-gray-900 mb-1">Service Provision</h3>
                                    <p class="text-gray-700 text-base leading-relaxed">To provide access to our dummy payment gateway and simulate payment processing for your testing needs in development environments.</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mt-1">
                                    <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-bold text-gray-900 mb-1">Account Management</h3>
                                    <p class="text-gray-700 text-base leading-relaxed">To create and manage your account, authenticate users, and provide customer support for testing-related inquiries.</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mt-1">
                                    <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-bold text-gray-900 mb-1">Service Improvement</h3>
                                    <p class="text-gray-700 text-base leading-relaxed">To analyze usage patterns and improve our testing platform's features, performance, and reliability for all users.</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mt-1">
                                    <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-bold text-gray-900 mb-1">Security & Fraud Prevention</h3>
                                    <p class="text-gray-700 text-base leading-relaxed">To protect against unauthorized access, abuse, and ensure the security of our testing environment and all user accounts.</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mt-1">
                                    <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-bold text-gray-900 mb-1">Communication</h3>
                                    <p class="text-gray-700 text-base leading-relaxed">To send you important updates, technical notices, service announcements, and respond to your testing-related inquiries.</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Data Security -->
                    <section id="data-security" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Data Security</h2>
                        <p class="text-gray-700 leading-relaxed text-base mb-6">
                            We implement industry-standard security measures to protect your data. However, users must understand their responsibilities:
                        </p>
                        <div class="bg-gradient-to-br from-purple-50 to-indigo-50 border-2 border-purple-200 rounded-xl p-8 mb-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="flex items-start">
                                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 mb-1">SSL/TLS Encryption</h3>
                                        <p class="text-sm text-gray-700">All data transmission is encrypted using industry-standard protocols to prevent interception during transit.</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 mb-1">Secure Storage</h3>
                                        <p class="text-sm text-gray-700">Data is stored in secure databases with restricted access controls and regular security audits.</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 mb-1">API Key Protection</h3>
                                        <p class="text-sm text-gray-700">API keys are encrypted and can be regenerated at any time. Users must protect their keys as sensitive credentials.</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 mb-1">Regular Monitoring</h3>
                                        <p class="text-sm text-gray-700">Continuous monitoring for suspicious activities and security threats to maintain system integrity.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-red-50 border-2 border-red-200 rounded-xl p-6">
                            <div class="flex items-start">
                                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-3">User Security Responsibilities</h3>
                                    <p class="text-gray-700 text-base leading-relaxed mb-3">
                                        While we implement security measures, <strong>users are solely responsible</strong> for:
                                    </p>
                                    <ul class="list-disc pl-5 text-gray-700 text-base space-y-2">
                                        <li>Maintaining password confidentiality and changing passwords regularly (recommended every 90 days)</li>
                                        <li>Protecting API keys from unauthorized access or disclosure</li>
                                        <li>Implementing security measures in their own applications and systems</li>
                                        <li>Immediately reporting suspected security breaches to MockPay</li>
                                        <li>Using strong, unique passwords and enabling additional security features when available</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Limitation of Liability -->
                    <section id="limitation-of-liability" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Limitation of Liability & Disclaimers</h2>

                        <div class="bg-yellow-50 border-2 border-yellow-200 rounded-xl p-6 mb-6">
                            <div class="flex items-start">
                                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-3">Important Security Disclaimer</h3>
                                    <p class="text-gray-700 text-base leading-relaxed mb-3">
                                        While we implement industry-standard security measures, <strong>MockPay shall not be held liable</strong> for any data breaches, unauthorized access, or data loss resulting from:
                                    </p>
                                    <ul class="list-disc pl-5 text-gray-700 text-base space-y-2">
                                        <li>User negligence in protecting account credentials and passwords</li>
                                        <li>Failure to regularly update and strengthen passwords as recommended</li>
                                        <li>Sharing of API keys, passwords, or credentials with third parties</li>
                                        <li>Security vulnerabilities in user's own systems, applications, or networks</li>
                                        <li>Force majeure events including but not limited to natural disasters, cyber attacks, or infrastructure failures beyond our control</li>
                                        <li>User failure to implement recommended security practices and protocols</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border-2 border-gray-200 rounded-xl p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">User Security Obligations</h3>
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mt-1">
                                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-bold text-gray-900 mb-1">Password Management</h4>
                                        <p class="text-gray-700 text-base leading-relaxed">
                                            Users are <strong>solely and exclusively responsible</strong> for maintaining the confidentiality and security of their passwords. MockPay strongly recommends changing passwords at minimum every 90 days, using strong passwords with minimum 12 characters including uppercase, lowercase, numbers, and special characters, and never reusing passwords across different services.
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mt-1">
                                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-bold text-gray-900 mb-1">API Key Security</h4>
                                        <p class="text-gray-700 text-base leading-relaxed">
                                            API keys must be protected as highly sensitive credentials equivalent to passwords. MockPay is not responsible for any damages, losses, or security incidents resulting from compromised API keys. Users must immediately regenerate API keys through their dashboard if compromise is suspected or detected. API keys should never be committed to version control systems, shared in public forums, or stored in insecure locations.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Data Retention -->
                    <section id="data-retention" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Data Retention & Deletion</h2>
                        <div class="bg-white border-2 border-gray-200 rounded-xl p-6">
                            <p class="text-gray-700 leading-relaxed text-base mb-4">
                                We retain your data only for as long as necessary to provide our services and as required by applicable Indonesian laws and regulations, including but not limited to:
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                                <div class="flex items-start">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900">Retention Period</h4>
                                        <p class="text-gray-700 text-sm mt-1">Account data: Minimum 5 years after account termination as required by Indonesian financial regulations and tax laws. Transaction logs: 7 years for compliance and audit purposes.</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900">Deletion Rights & Limitations</h4>
                                        <p class="text-gray-700 text-sm mt-1">While you may request account deletion, we reserve the right to retain certain data as required by law, regulatory requirements, or legitimate business purposes. Data necessary for compliance with Indonesian regulations will be retained for the legally mandated period regardless of deletion requests.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <p class="text-sm text-gray-600">
                                    <strong>Note:</strong> MockPay operates under Indonesian jurisdiction. Data retention practices comply with Indonesian Law No. 8 of 1997 on Documents, Government Regulation No. 80 of 2019 on Electronic Trading, and other applicable regulations. International users acknowledge and agree to these retention practices.
                                </p>
                            </div>
                        </div>
                    </section>

                    <!-- Your Rights -->
                    <section id="your-rights" class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5 tracking-tight">Your Rights</h2>
                        <p class="text-gray-700 leading-relaxed text-base mb-6">
                            You have the following rights regarding your personal data, subject to applicable laws and our legitimate business interests:
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6">
                                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Access Your Data</h3>
                                <p class="text-gray-700 text-base">Request a copy of your personal information stored in our system, subject to verification and applicable fees for excessive requests.</p>
                            </div>

                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6">
                                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 01-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Correct Your Data</h3>
                                <p class="text-gray-700 text-base">Update or correct any inaccurate or incomplete information in your account profile and settings.</p>
                            </div>

                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6">
                                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Delete Your Data</h3>
                                <p class="text-gray-700 text-base">Request deletion of your account and associated data, subject to legal retention requirements and our Terms of Service.</p>
                            </div>

                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6">
                                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Export Your Data</h3>
                                <p class="text-gray-700 text-base">Download your data in a portable format for personal use, subject to reasonable limitations and verification.</p>
                            </div>
                        </div>

                        <div class="mt-6 bg-gray-50 border border-gray-200 rounded-lg p-5">
                            <p class="text-sm text-gray-600">
                <strong>Important:</strong> Exercise of these rights is subject to verification of identity, compliance with applicable laws, and MockPay's legitimate business interests. Certain rights may be limited by legal requirements, ongoing contractual obligations, or the need to protect the rights and safety of others. Response to requests will be provided within 30 days, subject to complexity and verification requirements.
                            </p>
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
                                        <p class="text-sm text-gray-600 mt-1">For privacy-related questions and data rights requests</p>
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
