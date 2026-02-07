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
<body class="antialiased bg-[#eae6df]">
    <!-- Navigation -->
    <nav class="fixed w-full bg-[#f8f4ef] border-b border-white/70 shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <div class="w-10 h-10 bg-slate-900 rounded-xl flex items-center justify-center">
                            <img src="{{ asset('logo.png') }}" alt="MockPay" class="w-6 h-6 object-contain">
                        </div>
                        <span class="ml-2 text-xl font-bold text-slate-900">MockPay</span>
                    </a>
                    <span class="ml-4 text-slate-400">/</span>
                    <span class="ml-4 text-slate-600 font-medium">Documentation</span>
                </div>
                
                <div class="flex items-center space-x-4">
                    @auth
                        @if(Auth::guard('merchant')->check())
                            <a href="{{ route('dashboard.index') }}" class="text-slate-700 hover:text-slate-900 font-medium transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('client.dashboard') }}" class="text-slate-700 hover:text-slate-900 font-medium transition-colors">Dashboard</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="text-slate-700 hover:text-slate-900 font-medium transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 transition-colors">Sign Up</a>
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
                        <div class="rounded-[22px] bg-[#f8f4ef] border border-white/70 p-5 shadow-sm">
                            <h3 class="text-xs uppercase tracking-[0.25em] text-slate-500 mb-4">Getting Started</h3>
                            <ul class="space-y-2">
                                <li><a href="{{ route('docs.index') }}" class="text-sm text-slate-600 hover:text-slate-900 transition-colors">Overview</a></li>
                                <li><a href="{{ route('docs.getting-started') }}" class="text-sm text-slate-600 hover:text-slate-900 transition-colors">Quick Start</a></li>
                                <li><a href="{{ route('docs.authentication') }}" class="text-sm text-slate-600 hover:text-slate-900 transition-colors">Authentication</a></li>
                            </ul>
                        </div>
                        <div class="rounded-[22px] bg-[#f8f4ef] border border-white/70 p-5 shadow-sm">
                            <h3 class="text-xs uppercase tracking-[0.25em] text-slate-500 mb-4">API Reference</h3>
                            <ul class="space-y-2">
                                <li><a href="{{ route('docs.api-reference') }}" class="text-sm text-slate-600 hover:text-slate-900 transition-colors">Endpoints</a></li>
                                <li><a href="{{ route('docs.payment-methods') }}" class="text-sm text-slate-600 hover:text-slate-900 transition-colors">Payment Methods</a></li>
                                <li><a href="{{ route('docs.webhooks') }}" class="text-sm text-slate-600 hover:text-slate-900 transition-colors">Webhooks</a></li>
                            </ul>
                        </div>
                        <div class="rounded-[22px] bg-[#f8f4ef] border border-white/70 p-5 shadow-sm">
                            <h3 class="text-xs uppercase tracking-[0.25em] text-slate-500 mb-4">Resources</h3>
                            <ul class="space-y-2">
                                <li><a href="{{ route('docs.examples') }}" class="text-sm text-slate-600 hover:text-slate-900 transition-colors">Code Examples</a></li>
                                <li><a href="{{ route('docs.testing') }}" class="text-sm text-slate-600 hover:text-slate-900 transition-colors">Testing Guide</a></li>
                                <li><a href="{{ route('docs.troubleshooting') }}" class="text-sm text-slate-600 hover:text-slate-900 transition-colors">Troubleshooting</a></li>
                                <li><a href="{{ route('docs.faq') }}" class="text-sm text-slate-600 hover:text-slate-900 transition-colors">FAQ</a></li>
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
