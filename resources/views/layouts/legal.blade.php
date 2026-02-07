<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Legal - MockPay')</title>

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
        /* Language toggle styles */
        .lang-en, .lang-id { display: none; }
        [data-lang="en"] .lang-en { display: block; }
        [data-lang="id"] .lang-id { display: block; }
        [data-lang="en"] .lang-en-inline { display: inline; }
        [data-lang="id"] .lang-id-inline { display: inline; }
        .lang-en-inline, .lang-id-inline { display: none; }
    </style>

    @stack('styles')
</head>
<body class="antialiased bg-[#eae6df]" data-lang="en">
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
                    <span class="ml-4 text-slate-600 font-medium">Legal</span>
                </div>
                
                <div class="flex items-center space-x-4">
                    <!-- Language Toggle -->
                    <div class="flex items-center bg-slate-100 rounded-full p-1">
                        <button type="button" id="lang-en-btn" onclick="setLanguage('en')" class="px-3 py-1 text-xs font-semibold rounded-full transition-all bg-slate-900 text-white">
                            EN
                        </button>
                        <button type="button" id="lang-id-btn" onclick="setLanguage('id')" class="px-3 py-1 text-xs font-semibold rounded-full transition-all text-slate-600 hover:text-slate-900">
                            ID
                        </button>
                    </div>
                    
                    <a href="{{ route('home') }}" class="text-slate-700 hover:text-slate-900 font-medium transition-colors">Home</a>
                    @auth
                        @if(Auth::guard('merchant')->check())
                            <a href="{{ route('dashboard.index') }}" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('client.dashboard') }}" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 transition-colors">Dashboard</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 transition-colors">Get Started</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content with Sidebar -->
    <div class="pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex gap-8">
                <!-- Sidebar Navigation -->
                <aside class="hidden lg:block w-64 flex-shrink-0">
                    <div class="sticky top-24 space-y-6">
                        <div class="rounded-[22px] bg-[#f8f4ef] border border-white/70 p-5 shadow-sm">
                            <h3 class="text-xs uppercase tracking-[0.25em] text-slate-500 mb-4">Legal</h3>
                            <nav class="space-y-2">
                                <a href="{{ route('legal.privacy-policy') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors @if(request()->routeIs('legal.privacy-policy')) bg-slate-900 text-white @else text-slate-600 hover:bg-slate-100 hover:text-slate-900 @endif">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    <span class="lang-en-inline">Privacy Policy</span>
                                    <span class="lang-id-inline">Kebijakan Privasi</span>
                                </a>
                                <a href="{{ route('legal.terms-of-service') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors @if(request()->routeIs('legal.terms-of-service')) bg-slate-900 text-white @else text-slate-600 hover:bg-slate-100 hover:text-slate-900 @endif">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span class="lang-en-inline">Terms of Service</span>
                                    <span class="lang-id-inline">Syarat & Ketentuan</span>
                                </a>
                                <a href="{{ route('legal.cookie-policy') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors @if(request()->routeIs('legal.cookie-policy')) bg-slate-900 text-white @else text-slate-600 hover:bg-slate-100 hover:text-slate-900 @endif">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                                    </svg>
                                    <span class="lang-en-inline">Cookie Policy</span>
                                    <span class="lang-id-inline">Kebijakan Cookie</span>
                                </a>
                            </nav>
                        </div>

                        @hasSection('page-navigation')
                        <div class="rounded-[22px] bg-[#f8f4ef] border border-white/70 p-5 shadow-sm">
                            <h3 class="text-xs uppercase tracking-[0.25em] text-slate-500 mb-4">
                                <span class="lang-en-inline">On This Page</span>
                                <span class="lang-id-inline">Di Halaman Ini</span>
                            </h3>
                            @yield('page-navigation')
                        </div>
                        @endif
                    </div>
                </aside>

                <!-- Content -->
                <main class="flex-1 min-w-0">
                    <div class="rounded-[28px] bg-white/90 border border-white/70 shadow-[0_25px_60px_rgba(15,23,42,0.08)] p-8 lg:p-10">
                        @yield('legal-content')
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-[#f8f4ef] border-t border-white/70 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-slate-600 text-sm font-medium">&copy; {{ date('Y') }} MockPay. All rights reserved.</p>
                <div class="flex space-x-8 mt-4 md:mt-0">
                    <a href="{{ route('legal.privacy-policy') }}" class="text-slate-600 hover:text-slate-900 text-sm font-medium transition-colors">
                        <span class="lang-en-inline">Privacy Policy</span>
                        <span class="lang-id-inline">Kebijakan Privasi</span>
                    </a>
                    <a href="{{ route('legal.terms-of-service') }}" class="text-slate-600 hover:text-slate-900 text-sm font-medium transition-colors">
                        <span class="lang-en-inline">Terms of Service</span>
                        <span class="lang-id-inline">Syarat & Ketentuan</span>
                    </a>
                    <a href="{{ route('legal.cookie-policy') }}" class="text-slate-600 hover:text-slate-900 text-sm font-medium transition-colors">
                        <span class="lang-en-inline">Cookie Policy</span>
                        <span class="lang-id-inline">Kebijakan Cookie</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function setLanguage(lang) {
            document.body.setAttribute('data-lang', lang);
            localStorage.setItem('mockpay-legal-lang', lang);
            
            // Update toggle buttons
            const enBtn = document.getElementById('lang-en-btn');
            const idBtn = document.getElementById('lang-id-btn');
            
            if (lang === 'en') {
                enBtn.classList.add('bg-slate-900', 'text-white');
                enBtn.classList.remove('text-slate-600', 'hover:text-slate-900');
                idBtn.classList.remove('bg-slate-900', 'text-white');
                idBtn.classList.add('text-slate-600', 'hover:text-slate-900');
            } else {
                idBtn.classList.add('bg-slate-900', 'text-white');
                idBtn.classList.remove('text-slate-600', 'hover:text-slate-900');
                enBtn.classList.remove('bg-slate-900', 'text-white');
                enBtn.classList.add('text-slate-600', 'hover:text-slate-900');
            }
        }
        
        // Load saved language preference
        document.addEventListener('DOMContentLoaded', function() {
            const savedLang = localStorage.getItem('mockpay-legal-lang') || 'en';
            setLanguage(savedLang);
        });
    </script>

    @stack('scripts')
</body>
</html>
