@extends('layouts.public')

@section('title', 'Dummy Payment Gateway for Developers')

@section('content')
    <!-- Hero Section -->
    <section class="hero-gradient relative overflow-hidden pt-32 pb-20 min-h-screen flex items-center">
        <!-- Animated Background Blobs -->
        <div class="absolute top-20 left-10 w-72 h-72 blob blob-purple rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute top-40 right-10 w-72 h-72 blob blob-blue rounded-full mix-blend-multiply filter blur-3xl opacity-20 animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 blob blob-purple rounded-full mix-blend-multiply filter blur-3xl opacity-20 animation-delay-4000"></div>

        <!-- Floating Ornaments -->
        <div class="absolute top-32 left-1/4 animate-float">
            <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="40" cy="40" r="30" stroke="url(#gradient1)" stroke-width="2" opacity="0.3"/>
                <circle cx="40" cy="40" r="20" stroke="url(#gradient1)" stroke-width="2" opacity="0.5"/>
                <circle cx="40" cy="40" r="10" fill="url(#gradient1)" opacity="0.3"/>
                <defs>
                    <linearGradient id="gradient1" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#8B5CF6;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#3B82F6;stop-opacity:1" />
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <div class="absolute top-1/3 right-1/4 animate-float animation-delay-1000">
            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="10" y="10" width="40" height="40" rx="8" stroke="url(#gradient2)" stroke-width="2" opacity="0.4"/>
                <rect x="20" y="20" width="20" height="20" rx="4" fill="url(#gradient2)" opacity="0.3"/>
                <defs>
                    <linearGradient id="gradient2" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#06B6D4;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#8B5CF6;stop-opacity:1" />
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <div class="absolute bottom-1/3 left-1/3 animate-float animation-delay-2000">
            <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M50 10 L90 90 L10 90 Z" stroke="url(#gradient3)" stroke-width="2" opacity="0.3"/>
                <path d="M50 30 L70 70 L30 70 Z" fill="url(#gradient3)" opacity="0.2"/>
                <defs>
                    <linearGradient id="gradient3" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#EC4899;stop-opacity:1" />
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <!-- Card/Credit Card Ornament -->
        <div class="absolute top-1/4 right-10 animate-float animation-delay-3000">
            <svg width="120" height="80" viewBox="0 0 120 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="5" y="5" width="110" height="70" rx="8" fill="url(#cardGradient)" opacity="0.2"/>
                <rect x="5" y="5" width="110" height="70" rx="8" stroke="url(#cardStroke)" stroke-width="2" opacity="0.4"/>
                <rect x="15" y="25" width="40" height="8" rx="2" fill="white" opacity="0.3"/>
                <rect x="15" y="40" width="30" height="6" rx="2" fill="white" opacity="0.2"/>
                <circle cx="95" cy="35" r="12" stroke="white" stroke-width="2" opacity="0.3"/>
                <defs>
                    <linearGradient id="cardGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#8B5CF6;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#3B82F6;stop-opacity:1" />
                    </linearGradient>
                    <linearGradient id="cardStroke" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#A78BFA;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#60A5FA;stop-opacity:1" />
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <!-- Coin Ornament -->
        <div class="absolute bottom-1/4 right-1/3 animate-float animation-delay-1500">
            <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="35" cy="35" r="30" fill="url(#coinGradient)" opacity="0.2"/>
                <circle cx="35" cy="35" r="30" stroke="url(#coinStroke)" stroke-width="2" opacity="0.5"/>
                <text x="35" y="42" font-size="24" font-weight="bold" text-anchor="middle" fill="white" opacity="0.6">$</text>
                <defs>
                    <linearGradient id="coinGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#FBBF24;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#F59E0B;stop-opacity:1" />
                    </linearGradient>
                    <linearGradient id="coinStroke" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#FCD34D;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#FBBF24;stop-opacity:1" />
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <!-- Lightning/Flash Ornament -->
        <div class="absolute top-1/2 left-1/4 animate-pulse">
            <svg width="50" height="80" viewBox="0 0 50 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M25 5 L15 40 L30 40 L20 75" stroke="url(#lightningGradient)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" opacity="0.4"/>
                <defs>
                    <linearGradient id="lightningGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                        <stop offset="0%" style="stop-color:#FCD34D;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#F59E0B;stop-opacity:1" />
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <!-- Star Ornaments -->
        <div class="absolute top-20 right-1/3">
            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 2 L17 11 L26 11 L19 17 L22 26 L15 20 L8 26 L11 17 L4 11 L13 11 Z" fill="url(#starGradient)" opacity="0.3"/>
                <defs>
                    <linearGradient id="starGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#FCD34D;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#8B5CF6;stop-opacity:1" />
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <div class="absolute bottom-1/4 left-10">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 3 L22 15 L34 15 L24 23 L28 35 L20 27 L12 35 L16 23 L6 15 L18 15 Z" fill="url(#starGradient2)" opacity="0.4"/>
                <defs>
                    <linearGradient id="starGradient2" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#06B6D4;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#3B82F6;stop-opacity:1" />
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid items-center gap-16 lg:grid-cols-2">
                <!-- Left Column - Content -->
                <div class="text-center lg:text-left space-y-8">
                    <div class="inline-flex items-center glass-effect rounded-full px-4 py-2 text-sm font-medium shadow-lg">
                        <svg class="mr-2 h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="bg-gradient-to-r from-yellow-300 via-purple-300 to-cyan-300 bg-clip-text text-transparent font-semibold">
                            XoNE Smart Studio
                        </span>
                    </div>

                    <div>
                        <h1 class="hero-title font-black text-white mb-4 drop-shadow-2xl">
                            Let's get<br>
                            <span class="bg-gradient-to-r from-purple-400 via-pink-400 to-cyan-400 bg-clip-text text-transparent animate-gradient">
                                payless
                            </span>
                        </h1>
                        <p class="hero-subtitle text-gray-300 max-w-2xl mx-auto lg:mx-0 drop-shadow-lg">
                            Test your payment integration safely with our dummy payment gateway. Fast, free, and reliable for developers.
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('docs.index') }}" class="btn-primary group inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold rounded-lg shadow-2xl hover:shadow-cyan-500/50 transition-all duration-300 hover:-translate-y-1">
                            <span class="relative z-10">SEE DOCUMENTATION</span>
                            <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                        <a href="{{ route('register') }}" class="group inline-flex items-center justify-center px-8 py-4 border-2 border-purple-400/50 text-purple-200 font-semibold rounded-lg hover:bg-purple-500/20 hover:border-purple-400 transition-all duration-300">
                            <span>Start Free Trial</span>
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-8 pt-8">
                        <div class="text-center lg:text-left">
                            <div class="text-4xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent drop-shadow-lg">15+</div>
                            <div class="text-sm text-gray-400 mt-1">Payment Methods</div>
                        </div>
                        <div class="text-center lg:text-left">
                            <div class="text-4xl font-bold bg-gradient-to-r from-cyan-400 to-blue-400 bg-clip-text text-transparent drop-shadow-lg">100%</div>
                            <div class="text-sm text-gray-400 mt-1">Free Forever</div>
                        </div>
                        <div class="text-center lg:text-left">
                            <div class="text-4xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent drop-shadow-lg">24/7</div>
                            <div class="text-sm text-gray-400 mt-1">Available</div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Laptop Mockup -->
                <div class="hidden lg:block relative laptop-mockup">
                    <div class="relative laptop-screen">
                        <!-- Laptop Screen Frame -->
                        <div class="rounded-2xl overflow-hidden shadow-2xl border-8 border-gray-800 bg-gray-900">
                            <!-- Screen Content -->
                            <div class="aspect-video bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 p-6">
                                <!-- Mock Dashboard Interface -->
                                <div class="space-y-4">
                                    <!-- Header -->
                                    <div class="flex items-center justify-between">
                                        <div class="h-8 w-32 bg-gradient-to-r from-purple-500/30 to-blue-500/30 rounded-lg"></div>
                                        <div class="h-8 w-8 bg-gradient-to-r from-blue-500/30 to-cyan-500/30 rounded-full"></div>
                                    </div>

                                    <!-- Cards -->
                                    <div class="grid grid-cols-3 gap-3">
                                        <div class="payment-card relative h-24 rounded-xl bg-gradient-to-br from-blue-500/20 to-purple-500/20 border border-blue-400/30 p-4 flex flex-col justify-between">
                                            <div class="w-8 h-8 rounded-lg bg-blue-400/50"></div>
                                            <div class="h-2 w-16 bg-blue-300/50 rounded"></div>
                                        </div>
                                        <div class="payment-card relative h-24 rounded-xl bg-gradient-to-br from-purple-500/20 to-pink-500/20 border border-purple-400/30 p-4 flex flex-col justify-between">
                                            <div class="w-8 h-8 rounded-lg bg-purple-400/50"></div>
                                            <div class="h-2 w-16 bg-purple-300/50 rounded"></div>
                                        </div>
                                        <div class="payment-card relative h-24 rounded-xl bg-gradient-to-br from-pink-500/20 to-blue-500/20 border border-pink-400/30 p-4 flex flex-col justify-between">
                                            <div class="w-8 h-8 rounded-lg bg-pink-400/50"></div>
                                            <div class="h-2 w-16 bg-pink-300/50 rounded"></div>
                                        </div>
                                    </div>

                                    <!-- Chart Area -->
                                    <div class="h-40 rounded-xl bg-gradient-to-br from-gray-700/30 to-gray-800/30 border border-gray-600/30 p-4">
                                        <div class="flex items-end justify-between h-full space-x-2">
                                            <div class="w-full bg-gradient-to-t from-blue-500/40 to-blue-500/10 rounded-t"></div>
                                            <div class="w-full bg-gradient-to-t from-purple-500/40 to-purple-500/10 rounded-t" style="height: 70%"></div>
                                            <div class="w-full bg-gradient-to-t from-pink-500/40 to-pink-500/10 rounded-t" style="height: 85%"></div>
                                            <div class="w-full bg-gradient-to-t from-cyan-500/40 to-cyan-500/10 rounded-t" style="height: 60%"></div>
                                            <div class="w-full bg-gradient-to-t from-blue-500/40 to-blue-500/10 rounded-t" style="height: 90%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Laptop Base -->
                        <div class="h-3 bg-gray-800 rounded-b-2xl shadow-2xl"></div>
                        <div class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-24 h-2 bg-gray-700 rounded-b-lg"></div>
                    </div>

                    <!-- Glow Effects -->
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
                    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse animation-delay-2000"></div>
                </div>
            </div>
        </div>

        <!-- Decorative Wave Bottom -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                <path d="M0 0L60 8C120 16 240 32 360 37.3C480 43 600 37 720 32C840 27 960 21 1080 21.3C1200 21 1320 27 1380 29.3L1440 32V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0V0Z" fill="white"/>
            </svg>
        </div>
    </section>

    <!-- Tagline Section -->
    <section class="bg-white py-20">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                Payment gateway doesn't have to be difficult.
                <br>
                <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    We're here to help.
                </span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                We will help you in creating an application by providing a dummy payment gateway that's easy to integrate and test
            </p>
        </div>
    </section>

    <!-- Payment Methods Cards Section -->
    <section class="bg-gray-50 py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 md:grid-cols-3">
                <!-- Virtual Account Card -->
                <div class="payment-card group relative rounded-3xl bg-gradient-to-br from-blue-500 to-blue-600 p-10 text-white shadow-2xl overflow-hidden">
                    <div class="relative z-10">
                        <div class="mb-8">
                            <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-white/20 backdrop-blur-sm shadow-lg">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold mb-4 tracking-tight">VIRTUAL ACCOUNT</h3>
                        <p class="text-blue-100 leading-relaxed text-lg">
                            Secure bank transfer payments with unique account numbers. Support for all major Indonesian banks including BCA, Mandiri, BNI, and BRI.
                        </p>
                    </div>
                    <!-- Decorative Circle -->
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                </div>

                <!-- E-Wallet Card -->
                <div class="payment-card group relative rounded-3xl bg-gradient-to-br from-cyan-400 to-cyan-500 p-10 text-white shadow-2xl overflow-hidden">
                    <div class="relative z-10">
                        <div class="mb-8">
                            <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-white/20 backdrop-blur-sm shadow-lg">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold mb-4 tracking-tight">E-WALLET</h3>
                        <p class="text-cyan-100 leading-relaxed text-lg">
                            Fast and convenient digital wallet payments. Integrated with GoPay, OVO, DANA, ShopeePay, and LinkAja for seamless transactions.
                        </p>
                    </div>
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                </div>

                <!-- Card Payment Card -->
                <div class="payment-card group relative rounded-3xl bg-gradient-to-br from-blue-600 to-blue-700 p-10 text-white shadow-2xl overflow-hidden">
                    <div class="relative z-10">
                        <div class="mb-8">
                            <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-white/20 backdrop-blur-sm shadow-lg">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold mb-4 tracking-tight">CARD PAYMENT</h3>
                        <p class="text-blue-100 leading-relaxed text-lg">
                            Accept credit and debit cards globally. Support for Visa, Mastercard, JCB, and American Express with advanced fraud protection.
                        </p>
                    </div>
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Grow Your Payment Section -->
    <section class="bg-gradient-to-br from-blue-50 via-white to-purple-50 py-24 relative overflow-hidden">
        <!-- Background Decorations -->
        <div class="absolute top-0 left-0 w-96 h-96 opacity-10">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path fill="#8B5CF6" d="M45.3,-54.4C58.9,-45.6,70.1,-31.5,73.7,-15.9C77.3,-0.3,73.3,16.8,64.8,30.9C56.3,45,43.3,56.1,28.5,61.8C13.7,67.5,-2.9,67.8,-18.3,63.2C-33.7,58.6,-47.9,49.1,-57.5,36.1C-67.1,23.1,-72.1,6.6,-70.3,-9.3C-68.5,-25.2,-59.9,-40.5,-47.8,-49.5C-35.7,-58.5,-20.1,-61.2,-4.3,-56.1C11.5,-51,31.7,-63.2,45.3,-54.4Z" transform="translate(100 100)" />
            </svg>
        </div>
        <div class="absolute bottom-0 right-0 w-80 h-80 opacity-10">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path fill="#3B82F6" d="M41.3,-49.1C54.4,-39.3,66.6,-27.2,71.3,-12.4C76,2.4,73.2,19.9,64.8,33.8C56.4,47.7,42.4,58,27.1,63.1C11.8,68.2,-4.8,68.1,-20.3,63.5C-35.8,58.9,-50.2,49.8,-59.4,36.9C-68.6,24,-72.6,7.3,-70.1,-8.5C-67.6,-24.3,-58.6,-39.2,-46.3,-49.3C-34,-59.4,-18.5,-64.7,-3.2,-61C12.1,-57.3,28.2,-58.9,41.3,-49.1Z" transform="translate(100 100)" />
            </svg>
        </div>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid items-center gap-16 lg:grid-cols-2">
                <!-- Left side - Images Grid -->
                <div class="grid grid-cols-2 gap-6">
                    <!-- Column 1 -->
                    <div class="space-y-6">
                        <div class="image-grid-item h-56 rounded-3xl bg-gradient-to-br from-blue-100 to-purple-100 overflow-hidden shadow-xl">
                            <div class="w-full h-full flex items-center justify-center p-6">
                                <svg class="w-24 h-24 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="image-grid-item h-72 rounded-3xl bg-gradient-to-br from-purple-100 to-pink-100 overflow-hidden shadow-xl">
                            <div class="w-full h-full flex items-center justify-center p-6">
                                <svg class="w-28 h-28 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Column 2 -->
                    <div class="pt-16">
                        <div class="image-grid-item h-96 rounded-3xl bg-gradient-to-br from-blue-500 to-blue-600 overflow-hidden shadow-2xl">
                            <div class="w-full h-full flex items-center justify-center p-8">
                                <div class="glass-effect rounded-2xl p-6 w-full space-y-4">
                                    <div class="h-4 bg-white/30 rounded-full w-3/4"></div>
                                    <div class="h-4 bg-white/30 rounded-full w-1/2"></div>
                                    <div class="grid grid-cols-2 gap-3 mt-6">
                                        <div class="h-20 bg-white/20 rounded-xl"></div>
                                        <div class="h-20 bg-white/20 rounded-xl"></div>
                                    </div>
                                    <div class="h-24 bg-white/20 rounded-xl mt-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right side - Content -->
                <div class="space-y-8">
                    <div>
                        <h2 class="text-5xl font-bold text-gray-900 mb-4 leading-tight">
                            Grow your
                            <br>
                            <span class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
                                payment.
                            </span>
                        </h2>
                        <p class="text-xl text-gray-600 leading-relaxed">
                            Scale your business with our comprehensive payment solutions. Get detailed analytics, real-time monitoring, and robust security features.
                        </p>
                    </div>

                    <!-- Feature Points -->
                    <div class="space-y-4">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 text-lg">Easy Integration</h4>
                                <p class="text-gray-600">Simple REST API with comprehensive documentation and code examples in multiple languages</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 text-lg">Multiple Payment Methods</h4>
                                <p class="text-gray-600">Support for all major payment channels with real-time webhook notifications</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-pink-500 to-blue-500 flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 text-lg">Advanced Security</h4>
                                <p class="text-gray-600">Bank-level encryption and PCI DSS compliance to protect your transactions</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Offer Section -->
    <section class="bg-black py-24 relative overflow-hidden">
        <!-- Background Effects -->
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-20 left-20 w-96 h-96 bg-purple-600 rounded-full mix-blend-multiply filter blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-blue-600 rounded-full mix-blend-multiply filter blur-3xl animate-pulse animation-delay-2000"></div>
        </div>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid items-center gap-16 lg:grid-cols-2">
                <!-- Left side - Content -->
                <div class="space-y-12">
                    <h2 class="text-5xl font-bold text-white leading-tight">
                        What we offer
                    </h2>
                    <div class="space-y-6">
                        <button class="w-full max-w-md text-left group">
                            <div class="px-8 py-5 rounded-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold shadow-xl hover:shadow-2xl hover:shadow-blue-500/50 transition-all duration-300 hover:scale-105">
                                <span class="text-lg">INSTANT PAYMENT TESTING</span>
                            </div>
                        </button>
                        <button class="w-full max-w-md text-left group">
                            <div class="px-8 py-5 rounded-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold shadow-xl hover:shadow-2xl hover:shadow-blue-500/50 transition-all duration-300 hover:scale-105">
                                <span class="text-lg">COMPREHENSIVE ANALYTICS</span>
                            </div>
                        </button>
                        <button class="w-full max-w-md text-left group">
                            <div class="px-8 py-5 rounded-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold shadow-xl hover:shadow-2xl hover:shadow-blue-500/50 transition-all duration-300 hover:scale-105">
                                <span class="text-lg">WEBHOOK INTEGRATION</span>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Right side - Laptop Mockup -->
                <div class="relative laptop-mockup">
                    <div class="relative laptop-screen">
                        <!-- Laptop Frame -->
                        <div class="rounded-2xl overflow-hidden shadow-2xl border-8 border-gray-700 bg-gray-800">
                            <!-- Screen Content -->
                            <div class="aspect-video bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 p-8">
                                <!-- Dashboard Mock -->
                                <div class="space-y-6">
                                    <div class="grid grid-cols-3 gap-4">
                                        <div class="payment-card h-20 rounded-2xl bg-gradient-to-br from-blue-500/30 to-purple-500/30 border border-blue-400/30 flex items-center justify-center shadow-lg">
                                            <div class="w-10 h-10 rounded-full bg-blue-400/50"></div>
                                        </div>
                                        <div class="payment-card h-20 rounded-2xl bg-gradient-to-br from-purple-500/30 to-pink-500/30 border border-purple-400/30 flex items-center justify-center shadow-lg">
                                            <div class="w-10 h-10 rounded-full bg-purple-400/50"></div>
                                        </div>
                                        <div class="payment-card h-20 rounded-2xl bg-gradient-to-br from-pink-500/30 to-blue-500/30 border border-pink-400/30 flex items-center justify-center shadow-lg">
                                            <div class="w-10 h-10 rounded-full bg-pink-400/50"></div>
                                        </div>
                                    </div>
                                    <div class="h-40 rounded-2xl bg-gradient-to-br from-gray-700/30 to-gray-800/30 border border-gray-600/30"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Laptop Base -->
                        <div class="h-3 bg-gray-700 rounded-b-2xl shadow-2xl"></div>
                        <div class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-24 h-2 bg-gray-600 rounded-b-lg"></div>
                    </div>

                    <!-- Glow Effects -->
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="bg-gradient-to-br from-blue-600 via-blue-700 to-purple-700 py-24 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 50px 50px;"></div>
        </div>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold text-white mb-4">Our packages</h2>
                <p class="text-blue-100 text-xl">Choose from our affordable and customizable payment packages.</p>
            </div>

            <div class="grid gap-8 md:grid-cols-3 items-start">
                <!-- Free Package -->
                <div class="pricing-card group relative h-full">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-cyan-400 rounded-3xl blur-xl opacity-40 group-hover:opacity-60 transition-opacity"></div>
                    <div class="relative h-full rounded-3xl p-10 shadow-2xl transition-all duration-300" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                        <div class="mb-8">
                            <h3 class="text-3xl font-bold text-white mb-4">FREE</h3>
                            <div class="flex items-baseline mb-2">
                                <span class="text-5xl font-black text-white">$0</span>
                                <span class="text-2xl font-black text-white">.0</span>
                            </div>
                            <div class="h-1 w-20 bg-gradient-to-r from-cyan-400 to-blue-400 rounded-full"></div>
                        </div>
                        <ul class="space-y-5">
                            <li class="flex items-start">
                                <svg class="w-6 h-6 mr-3 text-cyan-300 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-white text-base">Unlimited API testing calls</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 mr-3 text-cyan-300 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-white text-base">All payment methods</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 mr-3 text-cyan-300 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-white text-base">Basic documentation</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 mr-3 text-cyan-300 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-white text-base">Community support</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- PRO Package -->
                <div class="pricing-card group relative h-full">
                    <!-- Popular Badge -->
                    <!-- <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 z-20">
                        <div class="px-6 py-2 bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-full shadow-lg">
                            <span class="text-sm font-bold text-gray-900 tracking-wide">POPULAR</span>
                        </div>
                    </div> -->

                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-blue-500 rounded-3xl blur-xl opacity-50 group-hover:opacity-70 transition-opacity"></div>
                    <div class="relative h-full rounded-3xl p-10 pt-12 shadow-2xl transition-all duration-300" style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3);">
                        <div class="mb-8">
                            <h3 class="text-3xl font-bold text-white mb-4">PRO</h3>
                            <div class="flex items-baseline mb-2">
                                <span class="text-5xl font-black text-white">$5</span>
                                <span class="text-2xl font-black text-white">.0</span>
                            </div>
                            <div class="h-1 w-20 bg-gradient-to-r from-blue-300 to-cyan-300 rounded-full"></div>
                        </div>
                        <ul class="space-y-5">
                            <li class="flex items-start">
                                <svg class="w-6 h-6 mr-3 text-blue-200 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-white text-base">Everything in Free plan</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 mr-3 text-blue-200 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-white text-base">Advanced analytics dashboard</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 mr-3 text-blue-200 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-white text-base">Priority email support</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- ENTERPRISE Package -->
                <div class="pricing-card group relative h-full">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-purple-600 rounded-3xl blur-xl opacity-40 group-hover:opacity-60 transition-opacity"></div>
                    <div class="relative h-full rounded-3xl p-10 shadow-2xl transition-all duration-300" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                        <div class="mb-8">
                            <h3 class="text-3xl font-bold text-white mb-4">ENTERPRISE</h3>
                            <div class="mb-2">
                                <span class="text-3xl font-black text-white">Custom</span>
                            </div>
                            <div class="h-1 w-20 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full"></div>
                        </div>
                        <ul class="space-y-5">
                            <li class="flex items-start">
                                <svg class="w-6 h-6 mr-3 text-purple-200 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-white text-base">Everything in Pro plan</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 mr-3 text-purple-200 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-white text-base">Dedicated account manager</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 mr-3 text-purple-200 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-white text-base">24/7 phone & chat support</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 mr-3 text-purple-200 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-white text-base">Custom integration support</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-br from-purple-600 to-indigo-600 py-24 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute w-96 h-96 bg-white rounded-full top-0 -left-48 blur-3xl"></div>
            <div class="absolute w-96 h-96 bg-white rounded-full bottom-0 -right-48 blur-3xl"></div>
        </div>

        <div class="mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8 relative z-10">
            <h2 class="mb-6 text-5xl font-bold text-white leading-tight">
                Ready to Start Testing?
            </h2>
            <p class="mb-10 text-2xl text-purple-100">
                Join thousands of developers testing their payment integrations with MockPay
            </p>
            <div class="flex flex-col justify-center gap-6 sm:flex-row">
                <a href="{{ route('register') }}" class="btn-primary group inline-flex items-center justify-center px-10 py-5 bg-white text-purple-600 font-bold rounded-xl shadow-2xl hover:shadow-white/50 transition-all duration-300 hover:scale-105 text-lg">
                    <span class="relative z-10">Get Started for Free</span>
                    <svg class="ml-3 h-6 w-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                <a href="{{ route('docs.index') }}" class="inline-flex items-center justify-center px-10 py-5 border-3 border-white text-white font-bold rounded-xl hover:bg-white hover:text-purple-600 transition-all duration-300 hover:scale-105 text-lg shadow-xl">
                    Read Documentation
                </a>
            </div>
            <p class="mt-8 text-lg text-purple-100">
                No credit card required • Free forever • 5-minute setup
            </p>
        </div>
    </section>
@endsection
