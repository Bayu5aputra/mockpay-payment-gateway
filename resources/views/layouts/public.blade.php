<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MockPay') }} - @yield('title', 'Dummy Payment Gateway for Developers')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/landing.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="font-sans antialiased bg-white text-gray-900">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-black/90 backdrop-blur-md border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white">MockPay</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}"
                        class="text-sm font-medium {{ request()->routeIs('home') ? 'text-purple-400' : 'text-gray-300 hover:text-white' }} transition-colors">
                        Home
                    </a>
                    <a href="{{ route('docs.index') }}"
                        class="text-sm font-medium {{ request()->routeIs('docs.*') ? 'text-purple-400' : 'text-gray-300 hover:text-white' }} transition-colors">
                        Documentation
                    </a>
                    <a href="{{ route('pricing') }}"
                        class="text-sm font-medium {{ request()->routeIs('pricing') ? 'text-purple-400' : 'text-gray-300 hover:text-white' }} transition-colors">
                        Pricing
                    </a>
                    <a href="{{ route('contact') }}"
                        class="text-sm font-medium {{ request()->routeIs('contact') ? 'text-purple-400' : 'text-gray-300 hover:text-white' }} transition-colors">
                        Contact
                    </a>
                </div>

                <!-- Auth Links -->
                <div class="hidden md:flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="text-sm font-medium text-gray-300 hover:text-white transition-colors">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm font-medium text-gray-300 hover:text-white transition-colors">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}"
                            class="btn-primary inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 text-white text-sm font-medium rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                            Get Started Free
                        </a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="text-gray-300 hover:text-white" x-data
                        @click="$dispatch('toggle-mobile-menu')">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-data="{ open: false }" @toggle-mobile-menu.window="open = !open" x-show="open" x-cloak
            class="md:hidden border-t border-gray-800 bg-black">
            <div class="px-4 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}"
                    class="block px-3 py-2 text-base font-medium {{ request()->routeIs('home') ? 'text-purple-400 bg-gray-900' : 'text-gray-300 hover:text-white hover:bg-gray-900' }} rounded-lg transition-colors">
                    Home
                </a>
                <a href="{{ route('docs.index') }}"
                    class="block px-3 py-2 text-base font-medium {{ request()->routeIs('docs.*') ? 'text-purple-400 bg-gray-900' : 'text-gray-300 hover:text-white hover:bg-gray-900' }} rounded-lg transition-colors">
                    Documentation
                </a>
                <a href="{{ route('pricing') }}"
                    class="block px-3 py-2 text-base font-medium {{ request()->routeIs('pricing') ? 'text-purple-400 bg-gray-900' : 'text-gray-300 hover:text-white hover:bg-gray-900' }} rounded-lg transition-colors">
                    Pricing
                </a>
                <a href="{{ route('contact') }}"
                    class="block px-3 py-2 text-base font-medium {{ request()->routeIs('contact') ? 'text-purple-400 bg-gray-900' : 'text-gray-300 hover:text-white hover:bg-gray-900' }} rounded-lg transition-colors">
                    Contact
                </a>
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="block px-3 py-2 text-base font-medium text-gray-300 hover:text-white hover:bg-gray-900 rounded-lg transition-colors">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="block px-3 py-2 text-base font-medium text-gray-300 hover:text-white hover:bg-gray-900 rounded-lg transition-colors">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}"
                        class="block px-3 py-2 text-base font-medium text-white bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg transition-colors">
                        Get Started Free
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="col-span-1">
                    <div class="flex items-center space-x-3 mb-4">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white">MockPay</span>
                    </div>
                    <p class="text-sm text-gray-400">
                        Dummy payment gateway for developers. Test your integrations safely.
                    </p>
                </div>

                <!-- Product -->
                <div>
                    <h3 class="text-white font-semibold mb-4">Product</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('docs.index') }}"
                                class="text-sm hover:text-white transition-colors">Documentation</a></li>
                        <li><a href="{{ route('pricing') }}"
                                class="text-sm hover:text-white transition-colors">Pricing</a></li>
                        <li><a href="#" class="text-sm hover:text-white transition-colors">API Reference</a></li>
                        <li><a href="#" class="text-sm hover:text-white transition-colors">Status</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h3 class="text-white font-semibold mb-4">Company</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-sm hover:text-white transition-colors">About</a></li>
                        <li><a href="{{ route('contact') }}"
                                class="text-sm hover:text-white transition-colors">Contact</a></li>
                        <li><a href="#" class="text-sm hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="text-sm hover:text-white transition-colors">Careers</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Legal</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('legal.privacy-policy') }}"
                                class="text-gray-400 hover:text-white transition-colors duration-200">Privacy Policy</a>
                        </li>
                        <li><a href="{{ route('legal.terms-of-service') }}"
                                class="text-gray-400 hover:text-white transition-colors duration-200">Terms of
                                Service</a></li>
                        <li><a href="{{ route('legal.cookie-policy') }}"
                                class="text-gray-400 hover:text-white transition-colors duration-200">Cookie Policy</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm text-gray-400">
                    © {{ date('Y') }} MockPay. All rights reserved.
                </p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <span class="sr-only">GitHub</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <span class="sr-only">Twitter</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>
