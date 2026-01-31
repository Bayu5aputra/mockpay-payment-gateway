<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Documentation - MockPay')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700;9..40,800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }
        code, pre, .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }
    </style>

    @stack('styles')
</head>
<body class="antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="fixed w-full bg-white shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                        <span class="ml-2 text-xl font-bold text-gray-900">MockPay</span>
                    </a>
                    <span class="ml-4 text-gray-400">/</span>
                    <span class="ml-4 text-gray-600 font-medium">Documentation</span>
                </div>
                
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-purple-600 font-medium">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-purple-600 font-medium">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-indigo-700">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex gap-8">
                <!-- Sidebar -->
                <aside class="hidden lg:block w-64 flex-shrink-0">
                    <div class="sticky top-24 space-y-6">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 mb-3">Getting Started</h3>
                            <ul class="space-y-2">
                                <li><a href="{{ route('docs.index') }}" class="text-sm text-gray-600 hover:text-purple-600">Overview</a></li>
                                <li><a href="{{ route('docs.getting-started') }}" class="text-sm text-gray-600 hover:text-purple-600">Quick Start</a></li>
                                <li><a href="{{ route('docs.authentication') }}" class="text-sm text-gray-600 hover:text-purple-600">Authentication</a></li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 mb-3">API Reference</h3>
                            <ul class="space-y-2">
                                <li><a href="{{ route('docs.api-reference') }}" class="text-sm text-gray-600 hover:text-purple-600">Endpoints</a></li>
                                <li><a href="{{ route('docs.payment-methods') }}" class="text-sm text-gray-600 hover:text-purple-600">Payment Methods</a></li>
                                <li><a href="{{ route('docs.webhooks') }}" class="text-sm text-gray-600 hover:text-purple-600">Webhooks</a></li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 mb-3">Resources</h3>
                            <ul class="space-y-2">
                                <li><a href="{{ route('docs.examples') }}" class="text-sm text-gray-600 hover:text-purple-600">Code Examples</a></li>
                                <li><a href="{{ route('docs.testing') }}" class="text-sm text-gray-600 hover:text-purple-600">Testing Guide</a></li>
                                <li><a href="{{ route('docs.troubleshooting') }}" class="text-sm text-gray-600 hover:text-purple-600">Troubleshooting</a></li>
                                <li><a href="{{ route('docs.faq') }}" class="text-sm text-gray-600 hover:text-purple-600">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                </aside>

                <!-- Content -->
                <main class="flex-1 min-w-0">
                    @yield('doc-content')
                </main>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>