<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Documentation') - {{ config('app.name', 'MockPay') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .prose h1 {
            @apply text-4xl font-bold text-gray-900 mb-4;
        }
        .prose h2 {
            @apply text-3xl font-bold text-gray-900 mt-12 mb-4;
        }
        .prose h3 {
            @apply text-2xl font-semibold text-gray-900 mt-8 mb-3;
        }
        .prose p {
            @apply text-gray-600 mb-4 leading-relaxed;
        }
        .prose a {
            @apply text-purple-600 hover:text-purple-700 font-medium;
        }
        .prose ul, .prose ol {
            @apply my-4 pl-6;
        }
        .prose li {
            @apply text-gray-600 mb-2;
        }
        .prose code {
            @apply bg-gray-100 text-purple-600 px-2 py-1 rounded text-sm;
        }
        .prose pre {
            @apply bg-gray-900 text-gray-100 p-6 rounded-lg overflow-x-auto my-6;
        }
        .prose pre code {
            @apply bg-transparent text-gray-100 p-0;
        }
        .prose .lead {
            @apply text-xl text-gray-600 mb-8;
        }
    </style>

    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-900">MockPay</span>
                    </a>
                    <span class="ml-4 text-sm text-gray-500">/ Documentation</span>
                </div>

                <!-- Actions -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">
                        Home
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white text-sm font-medium rounded-lg hover:from-purple-700 hover:to-indigo-700">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white text-sm font-medium rounded-lg hover:from-purple-700 hover:to-indigo-700">
                            Get Started Free
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar -->
            <aside class="lg:w-64 flex-shrink-0">
                <nav class="sticky top-24 space-y-1">
                    <a href="{{ route('docs.index') }}" class="block px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('docs.index') ? 'bg-purple-50 text-purple-600' : 'text-gray-700 hover:bg-gray-100' }}">
                        Introduction
                    </a>
                    
                    <div class="pt-4">
                        <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Getting Started
                        </h3>
                        <a href="{{ route('docs.getting-started') }}" class="block px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('docs.getting-started') ? 'bg-purple-50 text-purple-600' : 'text-gray-700 hover:bg-gray-100' }}">
                            Quick Start
                        </a>
                        <a href="{{ route('docs.authentication') }}" class="block px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('docs.authentication') ? 'bg-purple-50 text-purple-600' : 'text-gray-700 hover:bg-gray-100' }}">
                            Authentication
                        </a>
                    </div>

                    <div class="pt-4">
                        <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            API
                        </h3>
                        <a href="{{ route('docs.api-reference') }}" class="block px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('docs.api-reference') ? 'bg-purple-50 text-purple-600' : 'text-gray-700 hover:bg-gray-100' }}">
                            API Reference
                        </a>
                        <a href="{{ route('docs.payment-methods') }}" class="block px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('docs.payment-methods') ? 'bg-purple-50 text-purple-600' : 'text-gray-700 hover:bg-gray-100' }}">
                            Payment Methods
                        </a>
                        <a href="{{ route('docs.webhooks') }}" class="block px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('docs.webhooks') ? 'bg-purple-50 text-purple-600' : 'text-gray-700 hover:bg-gray-100' }}">
                            Webhooks
                        </a>
                    </div>

                    <div class="pt-4">
                        <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Testing
                        </h3>
                        <a href="{{ route('docs.testing') }}" class="block px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('docs.testing') ? 'bg-purple-50 text-purple-600' : 'text-gray-700 hover:bg-gray-100' }}">
                            Testing Guide
                        </a>
                        <a href="{{ route('docs.troubleshooting') }}" class="block px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('docs.troubleshooting') ? 'bg-purple-50 text-purple-600' : 'text-gray-700 hover:bg-gray-100' }}">
                            Troubleshooting
                        </a>
                    </div>
                </nav>
            </aside>

            <!-- Content -->
            <main class="flex-1 min-w-0">
                <div class="bg-white rounded-lg shadow-sm p-8">
                    @yield('doc-content')
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>