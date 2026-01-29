<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Documentation') - MockPay</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-900">MockPay</span>
                    </a>
                    <span class="text-gray-400">/</span>
                    <span class="text-gray-600 font-medium">Documentation</span>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">
                        Home
                    </a>
                    @auth
                        <a href="{{ route('dashboard.index') }}" class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white text-sm font-semibold rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-all">
                            Get Started Free
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white text-sm font-semibold rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-all">
                            Get Started Free
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    
    <div class="min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex gap-8">
                <aside class="hidden lg:block w-64 flex-shrink-0">
                    <div class="sticky top-24 space-y-6">
                        <div>
                            <a href="{{ route('docs.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('docs.index') ? 'text-purple-600 bg-purple-50' : 'text-gray-700 hover:bg-gray-100' }}">
                                Introduction
                            </a>
                        </div>

                        <div>
                            <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                                Getting Started
                            </h3>
                            <nav class="space-y-1">
                                <a href="{{ route('docs.getting-started') }}" class="block px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('docs.getting-started') ? 'text-purple-600 bg-purple-50' : 'text-gray-700 hover:bg-gray-100' }}">
                                    Quick Start
                                </a>
                                <a href="{{ route('docs.authentication') }}" class="block px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('docs.authentication') ? 'text-purple-600 bg-purple-50' : 'text-gray-700 hover:bg-gray-100' }}">
                                    Authentication
                                </a>
                            </nav>
                        </div>

                        <div>
                            <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                                API
                            </h3>
                            <nav class="space-y-1">
                                <a href="{{ route('docs.api-reference') }}" class="block px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('docs.api-reference') ? 'text-purple-600 bg-purple-50' : 'text-gray-700 hover:bg-gray-100' }}">
                                    API Reference
                                </a>
                                <a href="{{ route('docs.payment-methods') }}" class="block px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('docs.payment-methods') ? 'text-purple-600 bg-purple-50' : 'text-gray-700 hover:bg-gray-100' }}">
                                    Payment Methods
                                </a>
                                <a href="{{ route('docs.webhooks') }}" class="block px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('docs.webhooks') ? 'text-purple-600 bg-purple-50' : 'text-gray-700 hover:bg-gray-100' }}">
                                    Webhooks
                                </a>
                            </nav>
                        </div>

                        <div>
                            <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                                Testing
                            </h3>
                            <nav class="space-y-1">
                                <a href="{{ route('docs.testing') }}" class="block px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('docs.testing') ? 'text-purple-600 bg-purple-50' : 'text-gray-700 hover:bg-gray-100' }}">
                                    Testing Guide
                                </a>
                                <a href="{{ route('docs.troubleshooting') }}" class="block px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('docs.troubleshooting') ? 'text-purple-600 bg-purple-50' : 'text-gray-700 hover:bg-gray-100' }}">
                                    Troubleshooting
                                </a>
                            </nav>
                        </div>

                        <div>
                            <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                                Resources
                            </h3>
                            <nav class="space-y-1">
                                <a href="{{ route('docs.faq') }}" class="block px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('docs.faq') ? 'text-purple-600 bg-purple-50' : 'text-gray-700 hover:bg-gray-100' }}">
                                    FAQ
                                </a>
                                <a href="{{ route('docs.examples') }}" class="block px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('docs.examples') ? 'text-purple-600 bg-purple-50' : 'text-gray-700 hover:bg-gray-100' }}">
                                    Code Examples
                                </a>
                            </nav>
                        </div>
                    </div>
                </aside>

                <main class="flex-1 min-w-0">
                    @yield('doc-content')
                </main>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>
</html>