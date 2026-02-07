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
            .no-scrollbar::-webkit-scrollbar { display: none; }
            .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
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
                            <div class="h-full max-w-7xl mx-auto px-4 flex items-center justify-between gap-4">
                                <div class="flex items-center gap-4 min-w-0">
                                    <div class="flex items-center gap-2 shrink-0">
                                        <span class="text-lg font-semibold tracking-wide">MockPay</span>
                                    </div>
                                    <nav class="hidden lg:flex items-center gap-4 text-[13px] text-white/70 whitespace-nowrap">
                                        <a href="{{ route('client.dashboard') }}" class="hover:text-white {{ request()->routeIs('client.dashboard') ? 'text-white' : '' }}">Dashboard</a>
                                        <a href="{{ route('client.transactions.index') }}" class="hover:text-white {{ request()->routeIs('client.transactions.*') ? 'text-white' : '' }}">Transactions</a>
                                        <a href="{{ route('client.settings.webhooks') }}" class="hover:text-white {{ request()->routeIs('client.settings.*') ? 'text-white' : '' }}">Webhooks</a>
                                        <a href="{{ route('client.api-keys.index') }}" class="hover:text-white {{ request()->routeIs('client.api-keys.*') ? 'text-white' : '' }}">API Keys</a>
                                        <a href="{{ route('client.developers.index') }}" class="hover:text-white {{ request()->routeIs('client.developers.*') ? 'text-white' : '' }}">Dev Tools</a>
                                        <a href="{{ route('client.upgrade-requests.index') }}" class="hover:text-white {{ request()->routeIs('client.upgrade-requests.*') ? 'text-white' : '' }}">Upgrade</a>
                                        <a href="{{ route('docs.index') }}" class="hover:text-white {{ request()->routeIs('docs.*') ? 'text-white' : '' }}">Docs</a>
                                    </nav>
                                </div>

                                <div class="flex items-center gap-2 shrink-0">
                                    <div class="relative hidden md:block w-48">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                        </div>
                                        <input type="text" class="block w-full pl-9 pr-3 py-1.5 rounded-full bg-white/10 border border-white/10 text-sm text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/20" placeholder="Search">
                                    </div>
                                    
                                    <!-- Notification Bell Dropdown -->
                                    <div x-data="notificationDropdown()" x-init="init()" class="relative">
                                        <button @click="toggle()" class="relative p-2 text-white/70 hover:text-white rounded-full hover:bg-white/10 transition-colors duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                            </svg>
                                            <span x-show="unreadCount > 0" x-text="unreadCount > 9 ? '9+' : unreadCount" class="absolute -top-0.5 -right-0.5 flex items-center justify-center min-w-[18px] h-[18px] text-[10px] font-bold text-white bg-red-500 rounded-full px-1"></span>
                                        </button>

                                        <!-- Dropdown Panel -->
                                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden z-50" style="display: none;">
                                            <div class="px-4 py-3 bg-[#0b0b0c] flex items-center justify-between">
                                                <h3 class="text-sm font-semibold text-white">Notifikasi</h3>
                                                <button x-show="unreadCount > 0" @click="markAllAsRead()" class="text-xs text-white/80 hover:text-white">Tandai semua dibaca</button>
                                            </div>
                                            
                                            <div class="max-h-80 overflow-y-auto no-scrollbar">
                                                <template x-if="loading">
                                                    <div class="px-4 py-8 text-center text-gray-400">
                                                        <svg class="animate-spin h-6 w-6 mx-auto mb-2" fill="none" viewBox="0 0 24 24">
                                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                        </svg>
                                                        Memuat...
                                                    </div>
                                                </template>
                                                
                                                <template x-if="!loading && notifications.length === 0">
                                                    <div class="px-4 py-8 text-center text-gray-400">
                                                        <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                                        </svg>
                                                        <p class="text-sm">Belum ada notifikasi</p>
                                                    </div>
                                                </template>
                                                
                                                <template x-for="notification in notifications" :key="notification.id">
                                                    <a :href="notification.url || '#'" @click="markAsRead(notification.id)" :class="{'bg-slate-50': !notification.read}" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100 last:border-0 transition-colors">
                                                        <div class="flex items-start gap-3">
                                                            <div :class="{
                                                                'bg-green-100 text-green-600': notification.color === 'green',
                                                                'bg-red-100 text-red-600': notification.color === 'red',
                                                                'bg-blue-100 text-blue-600': notification.color === 'blue',
                                                                'bg-yellow-100 text-yellow-600': notification.color === 'yellow',
                                                                'bg-gray-100 text-gray-600': notification.color === 'gray'
                                                            }" class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">
                                                                <template x-if="notification.icon === 'check-circle'">
                                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                </template>
                                                                <template x-if="notification.icon === 'x-circle'">
                                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                </template>
                                                                <template x-if="notification.icon === 'credit-card'">
                                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                                                </template>
                                                                <template x-if="notification.icon === 'currency-dollar'">
                                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                </template>
                                                                <template x-if="notification.icon === 'clock'">
                                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                </template>
                                                                <template x-if="notification.icon === 'exclamation-triangle' || notification.icon === 'exclamation-circle'">
                                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                                                </template>
                                                                <template x-if="!['check-circle','x-circle','credit-card','currency-dollar','clock','exclamation-triangle','exclamation-circle'].includes(notification.icon)">
                                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                                                </template>
                                                            </div>
                                                            <div class="flex-1 min-w-0">
                                                                <p class="text-sm font-medium text-gray-900 truncate" x-text="notification.title"></p>
                                                                <p class="text-xs text-gray-500 line-clamp-2" x-text="notification.message"></p>
                                                                <p class="text-xs text-gray-400 mt-1" x-text="notification.created_at"></p>
                                                            </div>
                                                            <span x-show="!notification.read" class="w-2 h-2 bg-slate-900 rounded-full flex-shrink-0 mt-1.5"></span>
                                                        </div>
                                                    </a>
                                                </template>
                                            </div>
                                        </div>
                                    </div>

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
        
        @if($isClient)
        <script>
            function notificationDropdown() {
                return {
                    open: false,
                    loading: false,
                    notifications: [],
                    unreadCount: 0,
                    
                    init() {
                        this.fetchUnreadCount();
                        // Refresh unread count every 30 seconds
                        setInterval(() => this.fetchUnreadCount(), 30000);
                    },
                    
                    toggle() {
                        this.open = !this.open;
                        if (this.open) {
                            this.fetchNotifications();
                        }
                    },
                    
                    async fetchUnreadCount() {
                        try {
                            const response = await fetch('{{ route("client.notifications.unread-count") }}');
                            const data = await response.json();
                            this.unreadCount = data.count;
                        } catch (error) {
                            console.error('Failed to fetch unread count:', error);
                        }
                    },
                    
                    async fetchNotifications() {
                        this.loading = true;
                        try {
                            const response = await fetch('{{ route("client.notifications.index") }}');
                            const data = await response.json();
                            this.notifications = data.notifications;
                            this.unreadCount = data.unread_count;
                        } catch (error) {
                            console.error('Failed to fetch notifications:', error);
                        } finally {
                            this.loading = false;
                        }
                    },
                    
                    async markAsRead(id) {
                        try {
                            await fetch(`/client/notifications/${id}/read`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                }
                            });
                            const notification = this.notifications.find(n => n.id === id);
                            if (notification && !notification.read) {
                                notification.read = true;
                                this.unreadCount = Math.max(0, this.unreadCount - 1);
                            }
                        } catch (error) {
                            console.error('Failed to mark as read:', error);
                        }
                    },
                    
                    async markAllAsRead() {
                        try {
                            await fetch('{{ route("client.notifications.read-all") }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                }
                            });
                            this.notifications.forEach(n => n.read = true);
                            this.unreadCount = 0;
                        } catch (error) {
                            console.error('Failed to mark all as read:', error);
                        }
                    }
                }
            }
        </script>
        @endif
    </body>
</html>
