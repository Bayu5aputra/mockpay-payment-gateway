<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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
    @php
        $isMerchant = Auth::guard('merchant')->check();
        $isClient = Auth::guard('web')->check();
        $authUser = Auth::guard('merchant')->user() ?? Auth::guard('web')->user();
        $clientUser = $isClient ? Auth::guard('web')->user() : null;
    @endphp
    <body class="font-sans antialiased {{ $isClient ? 'bg-[#eae6df]' : 'bg-gray-50' }}" style="font-family: 'Google Sans', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;">
        <div class="min-h-screen flex" x-data="{ sidebarCollapsed: @json($isClient) }">
            <!-- Sidebar -->
            <aside :class="sidebarCollapsed ? 'w-20' : 'w-64'" class="fixed h-full z-10 transition-all duration-300 border-r {{ $isClient ? 'bg-slate-950 text-white border-slate-800 shadow-[0_25px_60px_rgba(15,23,42,0.45)] rounded-r-[32px]' : 'bg-white shadow-lg border-slate-200' }}">
                <!-- Logo -->
                @if ($isClient)
                    <div class="h-20 flex items-center justify-center">
                        <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-[#ff7a59] via-[#ff6ea9] to-[#ff4fa3] shadow-[0_20px_40px_rgba(255,79,163,0.35)] flex items-center justify-center">
                            <img src="{{ asset('logo.png') }}" alt="MockPay" class="w-9 h-9 object-contain">
                        </div>
                    </div>
                @else
                    <div class="h-20 flex items-center justify-center border-b border-gray-200 bg-gradient-to-r from-purple-600 to-indigo-600">
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('logo.png') }}" alt="MockPay" class="w-8 h-8 object-contain">
                            <span class="text-2xl font-bold text-white" x-show="!sidebarCollapsed" x-cloak>MockPay</span>
                        </div>
                    </div>
                @endif

                <!-- Navigation -->
                <nav class="{{ $isClient ? 'mt-2 px-2 space-y-2' : 'mt-6 px-4 space-y-1' }}">
                    @if ($isMerchant)
                        <a href="{{ route('dashboard.index') }}" title="Dashboard" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl {{ request()->routeIs('dashboard.index') ? 'bg-purple-50 text-purple-600' : 'text-gray-700 hover:bg-gray-100' }} transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span class="font-medium" x-show="!sidebarCollapsed" x-cloak>Dashboard</span>
                        </a>

                        <a href="{{ route('dashboard.transactions.index') }}" title="Transactions" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl {{ request()->routeIs('dashboard.transactions.*') ? 'bg-purple-50 text-purple-600' : 'text-gray-700 hover:bg-gray-100' }} transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-medium" x-show="!sidebarCollapsed" x-cloak>Transactions</span>
                        </a>

                        <a href="{{ route('dashboard.settlements.index') }}" title="Settlements" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl {{ request()->routeIs('dashboard.settlements.*') ? 'bg-purple-50 text-purple-600' : 'text-gray-700 hover:bg-gray-100' }} transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span class="font-medium" x-show="!sidebarCollapsed" x-cloak>Settlements</span>
                        </a>

                        <a href="{{ route('dashboard.customers.index') }}" title="Customers" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl {{ request()->routeIs('dashboard.customers.*') ? 'bg-purple-50 text-purple-600' : 'text-gray-700 hover:bg-gray-100' }} transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span class="font-medium" x-show="!sidebarCollapsed" x-cloak>Customers</span>
                        </a>

                        <a href="{{ route('dashboard.invitations.index') }}" title="Invitations" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl {{ request()->routeIs('dashboard.invitations.*') ? 'bg-purple-50 text-purple-600' : 'text-gray-700 hover:bg-gray-100' }} transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="font-medium" x-show="!sidebarCollapsed" x-cloak>Invitations</span>
                        </a>

                        <a href="{{ route('dashboard.upgrade-requests.index') }}" title="Upgrade Requests" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl {{ request()->routeIs('dashboard.upgrade-requests.*') ? 'bg-purple-50 text-purple-600' : 'text-gray-700 hover:bg-gray-100' }} transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-medium" x-show="!sidebarCollapsed" x-cloak>Upgrade Requests</span>
                        </a>

                        <a href="{{ route('dashboard.settings.index') }}" title="Settings" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl {{ request()->routeIs('dashboard.settings.*') ? 'bg-purple-50 text-purple-600' : 'text-gray-700 hover:bg-gray-100' }} transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="font-medium" x-show="!sidebarCollapsed" x-cloak>Settings</span>
                        </a>
                    @elseif ($isClient)
                        <a href="{{ route('client.dashboard') }}" title="Dashboard" class="group relative flex items-center rounded-2xl transition-colors duration-200 {{ request()->routeIs('client.dashboard') ? 'bg-white/15 text-white shadow-[0_12px_30px_rgba(15,23,42,0.35)]' : 'text-white/70 hover:bg-white/10 hover:text-white' }}" :class="sidebarCollapsed ? 'justify-center px-0 py-3' : 'gap-3 px-3 py-2.5'">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span class="text-sm font-medium" x-show="!sidebarCollapsed" x-cloak>Dashboard</span>
                        </a>

                        <a href="{{ route('docs.index') }}" title="Documentation" class="group flex items-center rounded-2xl transition-colors duration-200 text-white/70 hover:bg-white/10 hover:text-white" :class="sidebarCollapsed ? 'justify-center px-0 py-3' : 'gap-3 px-3 py-2.5'">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <span class="text-sm font-medium" x-show="!sidebarCollapsed" x-cloak>Documentation</span>
                        </a>

                        <a href="{{ route('client.developers.index') }}" title="Developer Tools" class="group flex items-center rounded-2xl transition-colors duration-200 {{ request()->routeIs('client.developers.*') ? 'bg-white/15 text-white shadow-[0_12px_30px_rgba(15,23,42,0.35)]' : 'text-white/70 hover:bg-white/10 hover:text-white' }}" :class="sidebarCollapsed ? 'justify-center px-0 py-3' : 'gap-3 px-3 py-2.5'">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                            </svg>
                            <span class="text-sm font-medium" x-show="!sidebarCollapsed" x-cloak>Developer Tools</span>
                        </a>

                        <a href="{{ route('client.api-keys.index') }}" title="API Keys" class="group flex items-center rounded-2xl transition-colors duration-200 {{ request()->routeIs('client.api-keys.*') ? 'bg-white/15 text-white shadow-[0_12px_30px_rgba(15,23,42,0.35)]' : 'text-white/70 hover:bg-white/10 hover:text-white' }}" :class="sidebarCollapsed ? 'justify-center px-0 py-3' : 'gap-3 px-3 py-2.5'">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                            <span class="text-sm font-medium" x-show="!sidebarCollapsed" x-cloak>API Keys</span>
                        </a>

                        <a href="{{ route('client.settings.webhooks') }}" title="Webhooks" class="group flex items-center rounded-2xl transition-colors duration-200 {{ request()->routeIs('client.settings.webhooks') ? 'bg-white/15 text-white shadow-[0_12px_30px_rgba(15,23,42,0.35)]' : 'text-white/70 hover:bg-white/10 hover:text-white' }}" :class="sidebarCollapsed ? 'justify-center px-0 py-3' : 'gap-3 px-3 py-2.5'">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <span class="text-sm font-medium" x-show="!sidebarCollapsed" x-cloak>Webhooks</span>
                        </a>

                        <a href="{{ route('pricing') }}" title="Pricing" class="group flex items-center rounded-2xl transition-colors duration-200 text-white/70 hover:bg-white/10 hover:text-white" :class="sidebarCollapsed ? 'justify-center px-0 py-3' : 'gap-3 px-3 py-2.5'">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm font-medium" x-show="!sidebarCollapsed" x-cloak>Pricing</span>
                        </a>

                        <a href="{{ route('contact') }}" title="Contact" class="group flex items-center rounded-2xl transition-colors duration-200 text-white/70 hover:bg-white/10 hover:text-white" :class="sidebarCollapsed ? 'justify-center px-0 py-3' : 'gap-3 px-3 py-2.5'">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m8 0H8m8 0a2 2 0 012 2v3.5"></path>
                            </svg>
                            <span class="text-sm font-medium" x-show="!sidebarCollapsed" x-cloak>Contact</span>
                        </a>

                        <a href="{{ route('client.upgrade-requests.index') }}" title="Upgrade Plan" class="group flex items-center rounded-2xl transition-colors duration-200 {{ request()->routeIs('client.upgrade-requests.*') ? 'bg-white/15 text-white shadow-[0_12px_30px_rgba(15,23,42,0.35)]' : 'text-white/70 hover:bg-white/10 hover:text-white' }}" :class="sidebarCollapsed ? 'justify-center px-0 py-3' : 'gap-3 px-3 py-2.5'">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm font-medium" x-show="!sidebarCollapsed" x-cloak>Upgrade Plan</span>
                        </a>
                    @endif
                </nav>

                <!-- Bottom Section -->
                <div class="absolute bottom-0 left-0 right-0 p-4 border-t {{ $isClient ? 'border-white/10' : 'border-gray-200' }}">
                    @if ($isClient)
                        @php
                            $clientPlan = strtolower($clientUser?->effectivePlan() ?? '');
                        @endphp
                        @if (!in_array($clientPlan, ['pro', 'enterprise'], true))
                            <div class="rounded-2xl bg-white/10 p-4" x-show="!sidebarCollapsed" x-cloak>
                                <div class="flex items-center space-x-2 mb-2 text-white">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    <span class="font-semibold text-sm">Upgrade to Pro</span>
                                </div>
                                <p class="text-xs text-white/70 mb-3">Get unlimited access to all features</p>
                                <a href="{{ route('client.upgrade-requests.create') }}" class="block text-center w-full bg-white text-slate-900 text-sm font-semibold py-2 rounded-lg hover:bg-white/90 transition-all duration-300">
                                    Upgrade Now
                                </a>
                            </div>
                        @endif
                    @elseif ($isMerchant)
                        <div class="bg-emerald-50 rounded-xl p-4" x-show="!sidebarCollapsed" x-cloak>
                            <div class="flex items-center space-x-2 mb-2">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 12a10 10 0 0119.736-2.846M4.263 9.154A10 10 0 1021.736 14.846"></path>
                                </svg>
                                <span class="font-semibold text-emerald-900 text-sm">Upgrade Requests</span>
                            </div>
                            <p class="text-xs text-emerald-700 mb-3">Kelola pengajuan upgrade client</p>
                            <a href="{{ route('dashboard.upgrade-requests.index') }}" class="block text-center w-full bg-emerald-600 text-white text-sm font-semibold py-2 rounded-lg hover:bg-emerald-700 transition-all duration-300">
                                Lihat Permintaan
                            </a>
                        </div>
                    @endif
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 transition-all duration-300" :class="sidebarCollapsed ? 'ml-20' : 'ml-64'">
                <!-- Top Navbar -->
                <header class="relative h-20 fixed top-0 right-0 z-10 transition-all duration-300 {{ $isClient ? '' : 'bg-white shadow-sm' }}" :class="sidebarCollapsed ? 'left-20' : 'left-64'">
                    <div class="h-full flex items-center {{ $isClient ? 'px-4' : 'px-0' }}">
                        <div class="{{ $isClient ? 'h-16 w-full rounded-[28px] bg-white/90 backdrop-blur border border-white/70 shadow-[0_10px_30px_rgba(15,23,42,0.08)] px-6' : 'h-full w-full px-8' }} flex items-center justify-between">
                        <!-- Search Bar -->
                        <div class="flex-1 max-w-2xl flex items-center gap-3">
                            <button type="button" @click="sidebarCollapsed = !sidebarCollapsed" class="p-2 rounded-xl border {{ $isClient ? 'border-slate-200 bg-white/80 hover:bg-white' : 'border-gray-200 hover:bg-gray-100' }} transition-colors duration-200">
                                <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            <div class="relative flex-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" class="block w-full pl-10 pr-3 py-2 border {{ $isClient ? 'border-slate-200 bg-white/95 shadow-sm focus:ring-slate-900/20' : 'border-gray-300 bg-white focus:ring-purple-600' }} rounded-full leading-5 placeholder-slate-400 focus:outline-none focus:placeholder-slate-400 focus:ring-2 focus:border-transparent sm:text-sm" placeholder="Search transactions, invoices...">
                            </div>
                        </div>

                        <!-- Right Section -->
                        <div class="flex items-center space-x-4 ml-6">
                            <!-- Notifications -->
                            <button class="relative p-2 text-gray-400 hover:text-gray-600 rounded-full {{ $isClient ? 'hover:bg-slate-100' : 'hover:bg-gray-100' }} transition-colors duration-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                <span class="absolute top-1 right-1 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                            </button>

                            <!-- Profile Dropdown -->
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none">
                                    @if($authUser && $authUser->avatar_url)
                                        <img
                                            src="{{ $authUser->avatar_url }}"
                                            alt="{{ $authUser->name }}"
                                            class="w-10 h-10 rounded-full object-cover"
                                            onerror="this.classList.add('hidden'); this.nextElementSibling?.classList.remove('hidden');"
                                        >
                                        <div class="hidden w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-indigo-500 flex items-center justify-center text-white font-semibold">
                                            {{ $authUser->initials }}
                                        </div>
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-indigo-500 flex items-center justify-center text-white font-semibold">
                                            {{ $authUser?->initials ?? '?' }}
                                        </div>
                                    @endif
                                    <div class="text-left hidden md:block">
                                        <p class="text-sm font-semibold text-gray-700">{{ $authUser?->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $authUser?->email }}</p>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <!-- Dropdown Menu -->
                                <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-20 border border-gray-200">
                                    @if ($isMerchant)
                                        <a href="{{ route('dashboard.merchant.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-colors duration-200">
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                                <span>Profile</span>
                                            </div>
                                        </a>
                                    @endif
                                    @if ($isMerchant)
                                    <a href="{{ route('dashboard.settings.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-colors duration-200">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span>Settings</span>
                                        </div>
                                    </a>
                                    @endif
                                    <div class="border-t border-gray-200 my-1"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                                </svg>
                                                <span>Logout</span>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="pt-20">
                    @isset($slot)
                        {{ $slot }}
                    @else
                        @yield('content')
                    @endisset
                </main>
            </div>
        </div>

        <!-- Alpine.js for dropdown -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </body>
</html>
