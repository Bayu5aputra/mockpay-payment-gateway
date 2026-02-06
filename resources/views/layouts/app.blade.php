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
    <body class="font-sans antialiased {{ ($isClient || $isMerchant) ? 'bg-[#eae6df]' : 'bg-gray-50' }}" style="font-family: 'Google Sans', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;">
        <div class="min-h-screen">

            <!-- Main Content -->
            <div class="transition-all duration-300">
                <!-- Top Navbar -->
                @if ($isClient)
                    <header class="relative h-20 fixed top-0 right-0 left-0 z-10 transition-all duration-300">
                        <div class="h-full bg-[#0b0b0c] text-white shadow-[0_20px_40px_rgba(0,0,0,0.35)]">
                            <div class="h-full max-w-7xl mx-auto px-6 flex items-center justify-between gap-6">
                                <div class="flex items-center gap-5 min-w-0">
                                    <div class="flex items-center gap-2">
                                        <span class="text-lg font-semibold tracking-wide">MockPay</span>
                                    </div>
                                    <nav class="hidden lg:flex items-center gap-5 text-sm text-white/70">
                                        <a href="{{ route('client.dashboard') }}" class="hover:text-white {{ request()->routeIs('client.dashboard') ? 'text-white' : '' }}">Dashboard</a>
                                        <a href="{{ route('client.settings.webhooks') }}" class="hover:text-white">Webhooks</a>
                                        <a href="{{ route('client.api-keys.index') }}" class="hover:text-white">API Keys</a>
                                        <a href="{{ route('client.developers.index') }}" class="hover:text-white">Developer Tools</a>
                                        <a href="{{ route('docs.index') }}" class="hover:text-white">Documentation</a>
                                    </nav>
                                </div>

                                <div class="flex items-center gap-3 shrink-0">
                                    <div class="relative hidden md:block w-72">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                        </div>
                                        <input type="text" class="block w-full pl-10 pr-4 py-2 rounded-full bg-white/10 border border-white/10 text-sm text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/20" placeholder="Search">
                                    </div>
                                    <button class="relative p-2 text-white/70 hover:text-white rounded-full hover:bg-white/10 transition-colors duration-200">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                        </svg>
                                        <span class="absolute top-1 right-1 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-[#0b0b0c]"></span>
                                    </button>

                                    <div x-data="{ open: false }" class="relative">
                                        @php
                                            $clientPlanLabel = $isClient ? ucfirst(strtolower($clientUser?->effectivePlan() ?? 'free')) : null;
                                            $isFreePlan = $isClient && $clientPlanLabel === 'Free';
                                        @endphp
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
                                                <p class="text-sm font-semibold text-white">{{ $authUser?->name }}</p>
                                                <p class="text-xs text-white/60">{{ $authUser?->email }}</p>
                                            </div>
                                            <svg class="w-4 h-4 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>

                                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-20 border border-gray-200">
                                            @if ($isClient)
                                                <div class="px-4 py-2 text-xs text-gray-500">
                                                    Account: <span class="font-semibold text-gray-700">{{ $clientPlanLabel }}</span>
                                                </div>
                                                @if ($isFreePlan)
                                                    <a href="{{ route('client.upgrade-requests.create') }}" class="block px-4 py-2 text-sm text-purple-600 hover:bg-purple-50 hover:text-purple-700 transition-colors duration-200">
                                                        Upgrade to Pro
                                                    </a>
                                                @endif
                                                <div class="border-t border-gray-200 my-1"></div>
                                            @endif
                                            <a href="{{ route('client.settings.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                                Profile Settings
                                            </a>
                                            <div class="border-t border-gray-200 my-1"></div>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                                    Logout
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                @elseif ($isMerchant)
                    <header class="relative h-20 fixed top-0 right-0 left-0 z-10 transition-all duration-300">
                        <div class="h-full bg-[#0b0b0c] text-white shadow-[0_20px_40px_rgba(0,0,0,0.35)]">
                            <div class="h-full max-w-7xl mx-auto px-6 flex items-center justify-between gap-6">
                                <div class="flex items-center gap-6 min-w-0">
                                    <div class="flex items-center gap-2">
                                        <span class="text-lg font-semibold tracking-wide">MockPay</span>
                                    </div>
                                    <nav class="hidden lg:flex items-center gap-5 text-sm text-white/70">
                                        @auth('merchant')
                                            <a href="{{ route('dashboard.index') }}" class="hover:text-white {{ request()->routeIs('dashboard.index') ? 'text-white' : '' }}">Dashboard</a>
                                            <a href="{{ route('dashboard.upgrade-requests.index') }}" class="hover:text-white {{ request()->routeIs('dashboard.upgrade-requests.*') ? 'text-white' : '' }}">Upgrade Requests</a>
                                        @endauth
                                        @auth('web')
                                            <a href="{{ route('client.dashboard') }}" class="hover:text-white {{ request()->routeIs('client.dashboard') ? 'text-white' : '' }}">Dashboard</a>
                                            <a href="{{ route('client.transactions.index') }}" class="hover:text-white {{ request()->routeIs('client.transactions.*') ? 'text-white' : '' }}">Transactions</a>
                                            <a href="{{ route('client.api-keys.index') }}" class="hover:text-white {{ request()->routeIs('client.api-keys.*') ? 'text-white' : '' }}">API Keys</a>
                                            <a href="{{ route('client.developers.index') }}" class="hover:text-white {{ request()->routeIs('client.developers.*') ? 'text-white' : '' }}">Developer Tools</a>
                                            <a href="{{ route('client.settings.webhooks') }}" class="hover:text-white {{ request()->routeIs('client.settings.*') ? 'text-white' : '' }}">Settings</a>
                                            <a href="{{ route('client.upgrade-requests.index') }}" class="hover:text-white {{ request()->routeIs('client.upgrade-requests.*') ? 'text-white' : '' }}">Upgrade</a>
                                        @endauth
                                    </nav>
                                </div>

                                <div class="flex items-center gap-3 shrink-0">
                                    <button class="relative p-2 text-white/70 hover:text-white rounded-full hover:bg-white/10 transition-colors duration-200">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                        </svg>
                                        <span class="absolute top-1 right-1 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-[#0b0b0c]"></span>
                                    </button>
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
                                                <p class="text-sm font-semibold text-white">{{ $authUser?->name }}</p>
                                                <p class="text-xs text-white/60">{{ $authUser?->email }}</p>
                                            </div>
                                            <svg class="w-4 h-4 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>

                                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-52 bg-white rounded-lg shadow-lg py-1 z-20 border border-gray-200">
                                            @auth('merchant')
                                                <a href="{{ route('dashboard.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                                    Dashboard
                                                </a>
                                            @endauth
                                            @auth('web')
                                                <a href="{{ route('client.settings.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                                    Profile
                                                </a>
                                                <a href="{{ route('client.settings.webhooks') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                                    Settings
                                                </a>
                                            @endauth
                                            <div class="border-t border-gray-200 my-1"></div>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                                    Logout
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                @endif

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
