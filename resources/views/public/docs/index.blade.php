@extends('layouts.docs')

@section('title', 'Documentation - MockPay')

@section('doc-content')
<div class="rounded-[28px] bg-white/90 border border-white/70 shadow-[0_25px_60px_rgba(15,23,42,0.08)] p-8 lg:p-10">
    <div class="text-center mb-12">
        <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">Developer Documentation</p>
        <h1 class="text-4xl lg:text-5xl font-semibold text-slate-900 mb-4">MockPay API Documentation</h1>
        <p class="text-lg text-slate-600 max-w-2xl mx-auto">
            Comprehensive guides and API references to help you integrate payment simulation into your development workflow.
        </p>
    </div>

    <div class="max-w-2xl mx-auto mb-12">
        <form action="{{ route('docs.search') }}" method="GET">
            <div class="relative">
                <input type="text" 
                       name="q" 
                       placeholder="Search documentation..." 
                       class="w-full px-6 py-4 pr-12 rounded-full border border-slate-200 bg-slate-50 focus:ring-2 focus:ring-slate-900 focus:border-transparent transition-all">
                <button type="submit" class="absolute right-4 top-1/2 transform -translate-y-1/2">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <div class="rounded-[22px] bg-slate-900 text-white p-6 mb-12">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-white mb-1">Quick Start</h3>
                <p class="text-sm text-white/70">
                    New to MockPay? Follow our <a href="{{ route('docs.getting-started') }}" class="text-emerald-400 hover:text-emerald-300 font-medium underline">Getting Started Guide</a> to set up your first integration in under 5 minutes.
                </p>
            </div>
        </div>
    </div>

    <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-6 mb-12">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-slate-900 mb-1">Authentication Required</h3>
                <p class="text-sm text-slate-600">
                    Guest users can browse documentation freely. To access authenticated API endpoints and manage transactions, you must <a href="{{ route('register') }}" class="text-slate-900 font-medium underline hover:text-slate-700">create a client account</a> and obtain API keys from the Client Dashboard. All client data is strictly isolated per account.
                </p>
            </div>
        </div>
    </div>

    <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-6">Documentation Sections</p>
    
    <div class="grid md:grid-cols-2 gap-6 mb-12">
        @foreach($sections as $section)
        <div class="rounded-[22px] border border-slate-200 bg-white p-6 hover:border-slate-400 hover:shadow-lg transition-all">
            <h3 class="text-base font-semibold text-slate-900 mb-4 flex items-center">
                <div class="w-8 h-8 rounded-lg bg-slate-900 text-white flex items-center justify-center mr-3 text-xs font-bold">
                    {{ strtoupper(substr($section['title'], 0, 1)) }}
                </div>
                {{ $section['title'] }}
            </h3>
            <ul class="space-y-2">
                @foreach($section['items'] as $item)
                <li>
                    <a href="{{ $item['url'] }}" class="text-slate-600 hover:text-slate-900 text-sm flex items-center">
                        <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        {{ $item['title'] }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @endforeach

        <div class="rounded-[22px] border border-slate-200 bg-white p-6 hover:border-emerald-400 hover:shadow-lg transition-all">
            <h3 class="text-base font-semibold text-slate-900 mb-4 flex items-center">
                <div class="w-8 h-8 rounded-lg bg-emerald-500 text-white flex items-center justify-center mr-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                Quick Links
            </h3>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('docs.getting-started') }}" class="text-slate-600 hover:text-slate-900 text-sm flex items-center">
                        <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        Getting Started Guide
                    </a>
                </li>
                <li>
                    <a href="{{ route('docs.examples') }}" class="text-slate-600 hover:text-slate-900 text-sm flex items-center">
                        <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        Code Examples
                    </a>
                </li>
                <li>
                    <a href="{{ route('docs.testing') }}" class="text-slate-600 hover:text-slate-900 text-sm flex items-center">
                        <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        Testing Guide
                    </a>
                </li>
                <li>
                    <a href="{{ route('docs.faq') }}" class="text-slate-600 hover:text-slate-900 text-sm flex items-center">
                        <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        Frequently Asked Questions
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-6">Core Capabilities</p>

    <div class="grid md:grid-cols-2 gap-6 mb-12">
        <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-6">
            <div class="flex items-center mb-3">
                <div class="w-10 h-10 rounded-xl bg-slate-900 text-white flex items-center justify-center mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-slate-900">RESTful API</h3>
            </div>
            <p class="text-sm text-slate-600">Industry-standard REST API designed to mirror production payment gateways like Midtrans and Xendit for seamless integration testing.</p>
        </div>

        <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-6">
            <div class="flex items-center mb-3">
                <div class="w-10 h-10 rounded-xl bg-slate-900 text-white flex items-center justify-center mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-slate-900">Webhook System</h3>
            </div>
            <p class="text-sm text-slate-600">Asynchronous webhook delivery with automatic retry logic, HMAC signature verification, and comprehensive delivery logs.</p>
        </div>

        <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-6">
            <div class="flex items-center mb-3">
                <div class="w-10 h-10 rounded-xl bg-slate-900 text-white flex items-center justify-center mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-slate-900">15+ Payment Methods</h3>
            </div>
            <p class="text-sm text-slate-600">Virtual accounts, e-wallets (GoPay, OVO, DANA), credit cards, QRIS, and retail payment channels fully simulated.</p>
        </div>

        <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-6">
            <div class="flex items-center mb-3">
                <div class="w-10 h-10 rounded-xl bg-slate-900 text-white flex items-center justify-center mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-slate-900">Manual Override</h3>
            </div>
            <p class="text-sm text-slate-600">Full control over transaction outcomes. Approve, reject, expire, or refund transactions directly from your dashboard to test every scenario.</p>
        </div>
    </div>

    <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-6">Popular Topics</p>

    <div class="grid md:grid-cols-3 gap-4 mb-12">
        <a href="{{ route('docs.getting-started') }}" class="block rounded-[22px] border border-slate-200 bg-white p-6 hover:border-slate-400 hover:shadow-lg transition-all">
            <h3 class="text-base font-semibold text-slate-900 mb-2">Getting Started</h3>
            <p class="text-sm text-slate-600">Set up your account, generate API keys, and create your first transaction.</p>
        </a>

        <a href="{{ route('docs.authentication') }}" class="block rounded-[22px] border border-slate-200 bg-white p-6 hover:border-slate-400 hover:shadow-lg transition-all">
            <h3 class="text-base font-semibold text-slate-900 mb-2">Authentication</h3>
            <p class="text-sm text-slate-600">Learn about API key types, Bearer token authentication, and security best practices.</p>
        </a>

        <a href="{{ route('docs.api-reference') }}" class="block rounded-[22px] border border-slate-200 bg-white p-6 hover:border-slate-400 hover:shadow-lg transition-all">
            <h3 class="text-base font-semibold text-slate-900 mb-2">API Reference</h3>
            <p class="text-sm text-slate-600">Complete endpoint documentation with request/response examples.</p>
        </a>

        <a href="{{ route('docs.payment-methods') }}" class="block rounded-[22px] border border-slate-200 bg-white p-6 hover:border-slate-400 hover:shadow-lg transition-all">
            <h3 class="text-base font-semibold text-slate-900 mb-2">Payment Methods</h3>
            <p class="text-sm text-slate-600">Available payment channels and integration instructions for each method.</p>
        </a>

        <a href="{{ route('docs.webhooks') }}" class="block rounded-[22px] border border-slate-200 bg-white p-6 hover:border-slate-400 hover:shadow-lg transition-all">
            <h3 class="text-base font-semibold text-slate-900 mb-2">Webhooks</h3>
            <p class="text-sm text-slate-600">Configure webhook endpoints, verify signatures, and handle event notifications.</p>
        </a>

        <a href="{{ route('docs.testing') }}" class="block rounded-[22px] border border-slate-200 bg-white p-6 hover:border-slate-400 hover:shadow-lg transition-all">
            <h3 class="text-base font-semibold text-slate-900 mb-2">Testing Guide</h3>
            <p class="text-sm text-slate-600">Test cards, simulation scenarios, and manual override techniques.</p>
        </a>
    </div>

    <div class="rounded-[28px] bg-slate-900 p-8 text-white text-center mb-12">
        <h2 class="text-2xl lg:text-3xl font-semibold mb-4">Ready to Start Testing?</h2>
        <p class="text-base text-white/70 mb-6 max-w-xl mx-auto">
            Create a free account to access API keys and start simulating payment flows in your development environment.
        </p>
        <div class="flex justify-center gap-4 flex-wrap">
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-white text-slate-900 px-6 py-3 text-sm font-semibold hover:bg-slate-100 transition-colors">
                Create Free Account
            </a>
            <a href="{{ route('docs.api-reference') }}" class="inline-flex items-center justify-center rounded-full border border-white/20 text-white px-6 py-3 text-sm font-semibold hover:border-white/40 transition-colors">
                View API Reference
            </a>
        </div>
    </div>

    <div>
        <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">Need Assistance?</p>
        <p class="text-sm text-slate-600 mb-4">
            Cannot find what you are looking for? Explore these additional resources:
        </p>
        <ul class="space-y-2">
            <li class="flex items-center text-sm">
                <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('docs.troubleshooting') }}" class="text-slate-600 hover:text-slate-900">Troubleshooting Guide</a>
                <span class="text-slate-400 ml-2">— Common issues and solutions</span>
            </li>
            <li class="flex items-center text-sm">
                <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('contact') }}" class="text-slate-600 hover:text-slate-900">Contact Support</a>
                <span class="text-slate-400 ml-2">— Reach our technical support team</span>
            </li>
            <li class="flex items-center text-sm">
                <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('docs.faq') }}" class="text-slate-600 hover:text-slate-900">FAQ</a>
                <span class="text-slate-400 ml-2">— Frequently asked questions</span>
            </li>
        </ul>
    </div>
</div>
@endsection
