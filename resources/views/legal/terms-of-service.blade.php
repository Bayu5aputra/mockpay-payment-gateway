<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service - MockPay</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">MockPay</span>
                </a>

                <!-- Back to Home -->
                <a href="{{ url('/') }}" class="text-gray-600 hover:text-purple-600 transition-colors duration-200 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span class="font-medium">Back to Home</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Terms of Service</h1>
            <p class="text-lg text-gray-600">Last updated: January 27, 2026</p>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12 space-y-8">
            <!-- Introduction -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Agreement to Terms</h2>
                <p class="text-gray-700 leading-relaxed">
                    By accessing and using MockPay's services, you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.
                </p>
            </section>

            <!-- Use of Service -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Use of Service</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    MockPay provides a payment gateway service that allows merchants to accept online payments. By using our service, you agree to:
                </p>
                <ul class="list-disc list-inside space-y-2 text-gray-700 ml-4">
                    <li>Provide accurate, current and complete information during the registration process.</li>
                    <li>Maintain the security of your password and identification.</li>
                    <li>Accept all responsibility for all activities that occur under your account.</li>
                    <li>Notify us immediately of any unauthorized use of your account.</li>
                    <li>Use the service only for lawful purposes and in accordance with these Terms.</li>
                    <li>Not use the service in any way that could damage, disable, overburden, or impair the service.</li>
                </ul>
            </section>

            <!-- Account Registration -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">3. Account Registration</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    To access certain features of the Service, you must register for an account. When you register for an account, you agree to:
                </p>
                <ul class="list-disc list-inside space-y-2 text-gray-700 ml-4">
                    <li>Provide true, accurate, current and complete information about yourself.</li>
                    <li>Maintain and promptly update your account information.</li>
                    <li>Maintain the security and confidentiality of your login credentials.</li>
                    <li>Accept all risks of unauthorized access to your account and the information you provide to us.</li>
                </ul>
            </section>

            <!-- Payment Terms -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Payment Terms</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    MockPay charges fees for the use of its payment processing services. The fees are as follows:
                </p>
                <ul class="list-disc list-inside space-y-2 text-gray-700 ml-4">
                    <li><strong>Transaction Fee:</strong> 2.9% + $0.30 per successful transaction</li>
                    <li><strong>Monthly Fee:</strong> Based on your subscription plan (Free, Professional, or Enterprise)</li>
                    <li><strong>Chargeback Fee:</strong> $15 per chargeback</li>
                    <li><strong>Refund:</strong> Original transaction fee is not refunded</li>
                </ul>
                <p class="text-gray-700 leading-relaxed mt-4">
                    All fees are subject to change with 30 days notice. Settlement of funds will be processed according to your selected payout schedule.
                </p>
            </section>

            <!-- Prohibited Activities -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Prohibited Activities</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    You may not use the service to engage in the following activities:
                </p>
                <ul class="list-disc list-inside space-y-2 text-gray-700 ml-4">
                    <li>Engage in any illegal activities or transactions</li>
                    <li>Process payments for prohibited goods or services</li>
                    <li>Engage in fraudulent or deceptive practices</li>
                    <li>Violate any laws, regulations, or third-party rights</li>
                    <li>Transmit any harmful code or malware</li>
                    <li>Attempt to gain unauthorized access to the service</li>
                    <li>Use the service to harass, abuse, or harm another person</li>
                    <li>Impersonate any person or entity</li>
                </ul>
            </section>

            <!-- Intellectual Property -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Intellectual Property</h2>
                <p class="text-gray-700 leading-relaxed">
                    The Service and its original content, features, and functionality are owned by MockPay and are protected by international copyright, trademark, patent, trade secret, and other intellectual property or proprietary rights laws. You may not reproduce, distribute, modify, create derivative works of, publicly display, publicly perform, republish, download, store, or transmit any of the material on our Service without our prior written consent.
                </p>
            </section>

            <!-- Termination -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Termination</h2>
                <p class="text-gray-700 leading-relaxed">
                    We may terminate or suspend your account and bar access to the Service immediately, without prior notice or liability, under our sole discretion, for any reason whatsoever and without limitation, including but not limited to a breach of the Terms. If you wish to terminate your account, you may simply discontinue using the Service and contact us to request account closure.
                </p>
            </section>

            <!-- Limitation of Liability -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Limitation of Liability</h2>
                <p class="text-gray-700 leading-relaxed">
                    In no event shall MockPay, nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from your access to or use of or inability to access or use the Service.
                </p>
            </section>

            <!-- Disclaimer -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Disclaimer</h2>
                <p class="text-gray-700 leading-relaxed">
                    Your use of the Service is at your sole risk. The Service is provided on an "AS IS" and "AS AVAILABLE" basis. The Service is provided without warranties of any kind, whether express or implied, including, but not limited to, implied warranties of merchantability, fitness for a particular purpose, non-infringement or course of performance.
                </p>
            </section>

            <!-- Governing Law -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">10. Governing Law</h2>
                <p class="text-gray-700 leading-relaxed">
                    These Terms shall be governed and construed in accordance with the laws of Indonesia, without regard to its conflict of law provisions. Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights.
                </p>
            </section>

            <!-- Changes to Terms -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">11. Changes to Terms</h2>
                <p class="text-gray-700 leading-relaxed">
                    We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material, we will provide at least 30 days notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion. By continuing to access or use our Service after any revisions become effective, you agree to be bound by the revised terms.
                </p>
            </section>

            <!-- Contact Us -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">12. Contact Us</h2>
                <p class="text-gray-700 leading-relaxed">
                    If you have any questions about these Terms, please contact us at:
                </p>
                <div class="mt-4 bg-purple-50 border border-purple-200 rounded-lg p-6">
                    <p class="text-gray-700"><strong>Email:</strong> legal@mockpay.com</p>
                    <p class="text-gray-700"><strong>Address:</strong> MockPay Headquarters, 123 Payment Street, Financial District, Jakarta, Indonesia</p>
                    <p class="text-gray-700"><strong>Phone:</strong> +62 21 1234 5678</p>
                </div>
            </section>
        </div>

        <!-- Related Links -->
        <div class="mt-8 flex flex-wrap gap-4 justify-center">
            <a href="{{ route('legal.privacy-policy') }}" class="text-purple-600 hover:text-purple-700 font-medium">Privacy Policy</a>
            <span class="text-gray-400">•</span>
            <a href="{{ route('legal.cookie-policy') }}" class="text-purple-600 hover:text-purple-700 font-medium">Cookie Policy</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-8 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-400">&copy; 2026 MockPay. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
