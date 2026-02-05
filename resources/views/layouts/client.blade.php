<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'MockPay'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="font-sans antialiased bg-[#eae6df]" style="font-family: 'Google Sans', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;">
    <div class="min-h-screen flex" x-data="{ sidebarCollapsed: true }">
        <!-- Sidebar -->
        <aside :class="sidebarCollapsed ? 'w-20' : 'w-64'" class="fixed h-full z-10 transition-all duration-300 border-r bg-slate-950 text-white border-slate-800 shadow-[0_25px_60px_rgba(15,23,42,0.45)] rounded-r-[32px]">
            <!-- Logo -->
            <div class="h-20 flex items-center justify-center">
                <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-[#ff7a59] via-[#ff6ea9] to-[#ff4fa3] shadow-[0_20px_40px_rgba(255,79,163,0.35)] flex items-center justify-center">
                    <img src="{{ asset('logo.png') }}" alt="MockPay" class="w-9 h-9 object-contain">
                </div>
            </div>

            <!-- Navigation -->
            <nav class="mt-2 px-2 space-y-2">
                <a href="{{ route('client.dashboard') }}"
                    title="Dashboard" class="group relative flex items-center rounded-2xl transition-colors duration-200 {{ request()->routeIs('client.dashboard') ? 'bg-white/15 text-white shadow-[0_12px_30px_rgba(15,23,42,0.35)]' : 'text-white/70 hover:bg-white/10 hover:text-white' }}" :class="sidebarCollapsed ? 'justify-center px-0 py-3' : 'gap-3 px-3 py-2.5'">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span class="text-sm font-medium" x-show="!sidebarCollapsed" x-cloak>Dashboard</span>
                </a>

                <a href="{{ route('docs.index') }}"
                    title="Documentation" class="group flex items-center rounded-2xl transition-colors duration-200 text-white/70 hover:bg-white/10 hover:text-white" :class="sidebarCollapsed ? 'justify-center px-0 py-3' : 'gap-3 px-3 py-2.5'">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    <span class="text-sm font-medium" x-show="!sidebarCollapsed" x-cloak>Documentation</span>
                </a>

                <a href="{{ route('pricing') }}"
                    title="Pricing" class="group flex items-center rounded-2xl transition-colors duration-200 text-white/70 hover:bg-white/10 hover:text-white" :class="sidebarCollapsed ? 'justify-center px-0 py-3' : 'gap-3 px-3 py-2.5'">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    <span class="text-sm font-medium" x-show="!sidebarCollapsed" x-cloak>Pricing</span>
                </a>

                <a href="{{ route('contact') }}"
                    title="Contact" class="group flex items-center rounded-2xl transition-colors duration-200 text-white/70 hover:bg-white/10 hover:text-white" :class="sidebarCollapsed ? 'justify-center px-0 py-3' : 'gap-3 px-3 py-2.5'">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m8 0H8m8 0a2 2 0 012 2v3.5">
                        </path>
                    </svg>
                    <span class="text-sm font-medium" x-show="!sidebarCollapsed" x-cloak>Contact</span>
                </a>
                <a href="{{ route('client.settings.profile') }}"
                    title="Profile Settings" class="group flex items-center rounded-2xl transition-colors duration-200 {{ request()->routeIs('client.settings.profile') ? 'bg-white/15 text-white shadow-[0_12px_30px_rgba(15,23,42,0.35)]' : 'text-white/70 hover:bg-white/10 hover:text-white' }}" :class="sidebarCollapsed ? 'justify-center px-0 py-3' : 'gap-3 px-3 py-2.5'">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="text-sm font-medium" x-show="!sidebarCollapsed" x-cloak>Profile Settings</span>
                </a>
            </nav>

            <!-- Bottom Section -->
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200">
                @php
                    $clientPlan = strtolower(Auth::guard('web')->user()?->effectivePlan() ?? '');
                @endphp
                @if (!in_array($clientPlan, ['pro', 'enterprise'], true))
                    <div class="rounded-2xl bg-white/10 p-4 mb-4" x-show="!sidebarCollapsed" x-cloak>
                        <div class="flex items-center space-x-2 mb-2 text-white">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <span class="font-semibold text-sm">Upgrade to Pro</span>
                        </div>
                        <p class="text-xs text-white/70 mb-3">Get unlimited access to all features</p>
                        <a href="{{ route('client.upgrade-requests.create') }}"
                            class="block text-center w-full bg-white text-slate-900 text-sm font-semibold py-2 rounded-lg hover:bg-white/90 transition-all duration-300">
                            Upgrade Now
                        </a>
                    </div>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full bg-white/5 text-white/80 text-sm font-semibold py-2 rounded-lg hover:bg-white/10 transition-all duration-300">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 transition-all duration-300" :class="sidebarCollapsed ? 'ml-20' : 'ml-64'">
            <header class="relative h-20 fixed top-0 right-0 z-10 transition-all duration-300" :class="sidebarCollapsed ? 'left-20' : 'left-64'">
                <div class="h-full flex items-center px-4">
                    <div class="h-16 w-full rounded-[28px] bg-white/90 backdrop-blur border border-white/70 shadow-[0_10px_30px_rgba(15,23,42,0.08)] px-6 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <button type="button" @click="sidebarCollapsed = !sidebarCollapsed" class="p-2 rounded-xl border border-slate-200 bg-white/80 hover:bg-white transition-colors duration-200">
                            <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <div class="text-sm text-gray-500">Client Dashboard</div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-semibold text-gray-700">{{ Auth::guard('web')->user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::guard('web')->user()->email }}</p>
                    </div>
                    </div>
                </div>
            </header>

            <main class="pt-20">
                @yield('content')
            </main>
        </div>
    </div>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>
