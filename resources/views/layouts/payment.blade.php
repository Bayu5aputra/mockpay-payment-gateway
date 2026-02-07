<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MockPay') }} - @yield('title', 'Payment')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=space-grotesk:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-['Space Grotesk'] text-slate-900 bg-[#ebe7e1]">
    <div class="min-h-screen">
        <header class="py-8">
            <div class="max-w-6xl mx-auto px-6 flex items-center justify-between">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div class="h-12 w-12 rounded-2xl bg-slate-900 text-white flex items-center justify-center shadow-lg">
                        <span class="text-sm font-semibold">MP</span>
                    </div>
                    <div>
                        <div class="text-lg font-semibold">MockPay</div>
                        <div class="text-xs uppercase tracking-[0.2em] text-slate-500">Secure Simulation</div>
                    </div>
                </a>
                <div class="text-xs text-slate-500 hidden md:block">
                    Hosted payment page
                </div>
            </div>
        </header>

        <main class="pb-16">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
