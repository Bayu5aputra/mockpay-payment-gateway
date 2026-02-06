<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MockPay') }} - @yield('title', 'Authentication')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/landing.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="font-sans antialiased bg-[#0b0b0c] min-h-screen" style="font-family: 'Manrope', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;">
    <div class="fixed inset-0 pointer-events-none">
        <div class="absolute inset-0 bg-gradient-to-br from-[#0b0b0c] via-[#111827] to-[#0f172a] opacity-90"></div>
        <div class="absolute -top-24 left-10 h-64 w-64 rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute bottom-0 right-16 h-72 w-72 rounded-full bg-white/5 blur-3xl"></div>
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle, rgba(255,255,255,0.4) 1px, transparent 1px); background-size: 48px 48px;"></div>
    </div>

    <div class="relative min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <!-- Logo -->
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <a href="{{ route('home') }}" class="flex justify-center items-center space-x-3 mb-6">
                <div class="w-12 h-12 rounded-2xl bg-white/10 border border-white/10 flex items-center justify-center shadow-xl">
                    <img src="{{ asset('logo.png') }}" alt="MockPay" class="w-7 h-7 object-contain">
                </div>
                <span class="text-3xl font-bold text-white">MockPay</span>
            </a>
        </div>

        <!-- Page Content -->
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="relative">
                <div class="absolute inset-0 rounded-3xl bg-white/10 blur-xl opacity-70"></div>
                <div class="relative bg-white py-8 px-6 shadow-2xl sm:rounded-3xl sm:px-10 border border-white/20">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
