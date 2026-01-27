<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie Policy - MockPay</title>
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
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Cookie Policy</h1>
            <p class="text-lg text-gray-600">Last updated: January 27, 2026</p>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12 space-y-8">
            <!-- Introduction -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">What Are Cookies</h2>
                <p class="text-gray-700 leading-relaxed">
                    Cookies are small text files that are placed on your computer or mobile device when you visit a website. Cookies are widely used by website owners to make their websites work, or to work more efficiently, as well as to provide reporting information. Cookies set by the website owner (in this case, MockPay) are called "first-party cookies". Cookies set by parties other than the website owner are called "third-party cookies".
                </p>
            </section>

            <!-- Why We Use Cookies -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Why We Use Cookies</h2>
                <p class="text-gray-700 leading-relaxed">
                    We use first-party and third-party cookies for several reasons. Some cookies are required for technical reasons in order for our Website to operate, and we refer to these as "essential" or "strictly necessary" cookies. Other cookies enable us to track and target the interests of our users to enhance the experience on our Website. Third parties serve cookies through our Website for advertising, analytics, and other purposes.
                </p>
            </section>

            <!-- Types of Cookies -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Types of Cookies We Use</h2>

                <!-- Essential Cookies -->
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">1. Essential Cookies</h3>
                    <p class="text-gray-700 leading-relaxed mb-3">
                        These cookies are strictly necessary to provide you with services available through our Website and to use some of its features, such as access to secure areas.
                    </p>
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <table class="w-full text-sm">
                            <tr class="border-b border-purple-200">
                                <td class="py-2 pr-4 font-semibold">Cookie Name:</td>
                                <td class="py-2">mockpay_session</td>
                            </tr>
                            <tr class="border-b border-purple-200">
                                <td class="py-2 pr-4 font-semibold">Purpose:</td>
                                <td class="py-2">Maintain user session</td>
                            </tr>
                            <tr>
                                <td class="py-2 pr-4 font-semibold">Duration:</td>
                                <td class="py-2">Session (until browser closes)</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Performance Cookies -->
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">2. Performance and Analytics Cookies</h3>
                    <p class="text-gray-700 leading-relaxed mb-3">
                        These cookies allow us to count visits and traffic sources so we can measure and improve the performance of our Website. They help us know which pages are the most and least popular and see how visitors move around the Website.
                    </p>
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <table class="w-full text-sm">
                            <tr class="border-b border-purple-200">
                                <td class="py-2 pr-4 font-semibold">Cookie Name:</td>
                                <td class="py-2">_ga, _gid, _gat</td>
                            </tr>
                            <tr class="border-b border-purple-200">
                                <td class="py-2 pr-4 font-semibold">Purpose:</td>
                                <td class="py-2">Google Analytics tracking</td>
                            </tr>
                            <tr>
                                <td class="py-2 pr-4 font-semibold">Duration:</td>
                                <td class="py-2">2 years / 24 hours / 1 minute</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Functionality Cookies -->
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">3. Functionality Cookies</h3>
                    <p class="text-gray-700 leading-relaxed mb-3">
                        These cookies enable the Website to provide enhanced functionality and personalization. They may be set by us or by third-party providers whose services we have added to our pages.
                    </p>
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <table class="w-full text-sm">
                            <tr class="border-b border-purple-200">
                                <td class="py-2 pr-4 font-semibold">Cookie Name:</td>
                                <td class="py-2">user_preferences</td>
                            </tr>
                            <tr class="border-b border-purple-200">
                                <td class="py-2 pr-4 font-semibold">Purpose:</td>
                                <td class="py-2">Remember user preferences and settings</td>
                            </tr>
                            <tr>
                                <td class="py-2 pr-4 font-semibold">Duration:</td>
                                <td class="py-2">1 year</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Targeting Cookies -->
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">4. Targeting and Advertising Cookies</h3>
                    <p class="text-gray-700 leading-relaxed mb-3">
                        These cookies may be set through our Website by our advertising partners. They may be used by those companies to build a profile of your interests and show you relevant advertisements on other sites.
                    </p>
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <table class="w-full text-sm">
                            <tr class="border-b border-purple-200">
                                <td class="py-2 pr-4 font-semibold">Cookie Name:</td>
                                <td class="py-2">_fbp, fr</td>
                            </tr>
                            <tr class="border-b border-purple-200">
                                <td class="py-2 pr-4 font-semibold">Purpose:</td>
                                <td class="py-2">Facebook advertising and tracking</td>
                            </tr>
                            <tr>
                                <td class="py-2 pr-4 font-semibold">Duration:</td>
                                <td class="py-2">3 months</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </section>

            <!-- How to Control Cookies -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">How to Control Cookies</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    You have the right to decide whether to accept or reject cookies. You can exercise your cookie preferences by clicking on the appropriate opt-out links provided in the cookie banner displayed on our Website.
                </p>
                <p class="text-gray-700 leading-relaxed mb-4">
                    You can also set or amend your web browser controls to accept or refuse cookies. If you choose to reject cookies, you may still use our Website though your access to some functionality and areas of our Website may be restricted.
                </p>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h4 class="font-semibold text-gray-800 mb-3">Browser-Specific Instructions:</h4>
                    <ul class="list-disc list-inside space-y-2 text-gray-700 ml-4">
                        <li><strong>Chrome:</strong> Settings → Privacy and security → Cookies and other site data</li>
                        <li><strong>Firefox:</strong> Options → Privacy & Security → Cookies and Site Data</li>
                        <li><strong>Safari:</strong> Preferences → Privacy → Cookies and website data</li>
                        <li><strong>Edge:</strong> Settings → Privacy, search, and services → Cookies and site permissions</li>
                    </ul>
                </div>
            </section>

            <!-- Third-Party Cookies -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Third-Party Cookies</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    In addition to our own cookies, we may also use various third-party cookies to report usage statistics of the Service and deliver advertisements on and through the Service. The specific types of first and third-party cookies served through our Website and the purposes they perform are described below:
                </p>
                <ul class="list-disc list-inside space-y-2 text-gray-700 ml-4">
                    <li><strong>Google Analytics:</strong> Used to analyze how users use the Website</li>
                    <li><strong>Facebook Pixel:</strong> Used for advertising and remarketing</li>
                    <li><strong>Stripe:</strong> Used for payment processing and fraud detection</li>
                </ul>
            </section>

            <!-- Updates to Cookie Policy -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Updates to This Cookie Policy</h2>
                <p class="text-gray-700 leading-relaxed">
                    We may update this Cookie Policy from time to time in order to reflect changes to the cookies we use or for other operational, legal, or regulatory reasons. Please therefore revisit this Cookie Policy regularly to stay informed about our use of cookies and related technologies.
                </p>
            </section>

            <!-- Contact Us -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Contact Us</h2>
                <p class="text-gray-700 leading-relaxed">
                    If you have any questions about our use of cookies or other technologies, please contact us at:
                </p>
                <div class="mt-4 bg-purple-50 border border-purple-200 rounded-lg p-6">
                    <p class="text-gray-700"><strong>Email:</strong> privacy@mockpay.com</p>
                    <p class="text-gray-700"><strong>Address:</strong> MockPay Headquarters, 123 Payment Street, Financial District, Jakarta, Indonesia</p>
                    <p class="text-gray-700"><strong>Phone:</strong> +62 21 1234 5678</p>
                </div>
            </section>
        </div>

        <!-- Related Links -->
        <div class="mt-8 flex flex-wrap gap-4 justify-center">
            <a href="{{ route('legal.privacy-policy') }}" class="text-purple-600 hover:text-purple-700 font-medium">Privacy Policy</a>
            <span class="text-gray-400">•</span>
            <a href="{{ route('legal.terms-of-service') }}" class="text-purple-600 hover:text-purple-700 font-medium">Terms of Service</a>
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
