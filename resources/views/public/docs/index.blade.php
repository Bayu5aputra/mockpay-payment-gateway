@extends('layouts.docs')

@section('title', 'Documentation - MockPay')

@section('doc-content')
<div class="bg-white rounded-lg shadow-md p-8">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">MockPay Documentation</h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            Welcome to MockPay documentation. Learn how to integrate and test payment systems with our realistic dummy payment gateway.
        </p>
    </div>

    <div class="max-w-2xl mx-auto mb-12">
        <form action="{{ route('docs.search') }}" method="GET">
            <div class="relative">
                <input type="text" 
                       name="q" 
                       placeholder="Search documentation..." 
                       class="w-full px-6 py-4 pr-12 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <button type="submit" class="absolute right-4 top-1/2 transform -translate-y-1/2">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <div class="bg-blue-50 border-l-4 border-blue-500 p-6 mb-12">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800">Quick Start</h3>
                <div class="mt-2 text-sm text-blue-700">
                    <p>New to MockPay? Check out our <a href="{{ route('docs.getting-started') }}" class="font-medium underline">Getting Started Guide</a> to set up your first integration in minutes.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-green-50 border-l-4 border-green-500 p-6 mb-12">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-4a1 1 0 100 2 1 1 0 000-2zm1 4a1 1 0 00-2 0v5a1 1 0 102 0V10z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-green-800">Guest vs Client</h3>
                <div class="mt-2 text-sm text-green-700">
                    <p>Guest users can browse docs and use payment simulators. To call the API you need an account and an API key from the Client Dashboard. All client data is isolated per account.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-6 mb-12">
        @foreach($sections as $section)
        <div class="bg-white border border-gray-200 rounded-lg p-6 hover:border-purple-300 hover:shadow-lg transition-all">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                {{ $section['title'] }}
            </h3>
            <ul class="space-y-2">
                @foreach($section['items'] as $item)
                <li>
                    <a href="{{ $item['url'] }}" class="text-blue-600 hover:text-blue-800 hover:underline text-sm">
                        {{ $item['title'] }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @endforeach

        <div class="bg-white border border-gray-200 rounded-lg p-6 hover:border-green-300 hover:shadow-lg transition-all">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Quick Links
            </h3>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('docs.getting-started') }}" class="text-blue-600 hover:text-blue-800 hover:underline text-sm">
                        Getting Started Guide
                    </a>
                </li>
                <li>
                    <a href="{{ route('docs.examples') }}" class="text-blue-600 hover:text-blue-800 hover:underline text-sm">
                        Code Examples
                    </a>
                </li>
                <li>
                    <a href="{{ route('docs.testing') }}" class="text-blue-600 hover:text-blue-800 hover:underline text-sm">
                        Testing Guide
                    </a>
                </li>
                <li>
                    <a href="{{ route('docs.faq') }}" class="text-blue-600 hover:text-blue-800 hover:underline text-sm">
                        FAQ
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <h2 class="text-3xl font-bold text-gray-900 mb-6">Key Features</h2>

    <div class="grid md:grid-cols-2 gap-6 mb-12">
        <div class="border border-gray-200 rounded-lg p-6">
            <div class="flex items-center mb-3">
                <div class="w-10 h-10 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Complete API</h3>
            </div>
            <p class="text-gray-600">RESTful API matching specifications of popular gateways like Midtrans and Xendit</p>
        </div>

        <div class="border border-gray-200 rounded-lg p-6">
            <div class="flex items-center mb-3">
                <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Webhook System</h3>
            </div>
            <p class="text-gray-600">Real-time notifications with automatic retry logic and signature verification</p>
        </div>

        <div class="border border-gray-200 rounded-lg p-6">
            <div class="flex items-center mb-3">
                <div class="w-10 h-10 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">15+ Payment Methods</h3>
            </div>
            <p class="text-gray-600">Virtual accounts, e-wallets, credit cards, QRIS, and retail payments</p>
        </div>

        <div class="border border-gray-200 rounded-lg p-6">
            <div class="flex items-center mb-3">
                <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Analytics Dashboard</h3>
            </div>
            <p class="text-gray-600">Track transactions, view reports, and monitor integration performance</p>
        </div>
    </div>

    <h2 class="text-3xl font-bold text-gray-900 mb-6">Popular Topics</h2>

    <div class="grid md:grid-cols-3 gap-4 mb-12">
        <a href="{{ route('docs.getting-started') }}" class="block p-6 bg-white border border-gray-200 rounded-lg hover:border-purple-300 hover:shadow-lg transition-all">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Getting Started</h3>
            <p class="text-sm text-gray-600">Learn the basics and create your first transaction</p>
        </a>

        <a href="{{ route('docs.authentication') }}" class="block p-6 bg-white border border-gray-200 rounded-lg hover:border-purple-300 hover:shadow-lg transition-all">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Authentication</h3>
            <p class="text-sm text-gray-600">Understand API keys and authentication methods</p>
        </a>

        <a href="{{ route('docs.api-reference') }}" class="block p-6 bg-white border border-gray-200 rounded-lg hover:border-purple-300 hover:shadow-lg transition-all">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">API Reference</h3>
            <p class="text-sm text-gray-600">Complete API endpoints documentation</p>
        </a>

        <a href="{{ route('docs.payment-methods') }}" class="block p-6 bg-white border border-gray-200 rounded-lg hover:border-purple-300 hover:shadow-lg transition-all">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Payment Methods</h3>
            <p class="text-sm text-gray-600">All available payment methods and how to use them</p>
        </a>

        <a href="{{ route('docs.webhooks') }}" class="block p-6 bg-white border border-gray-200 rounded-lg hover:border-purple-300 hover:shadow-lg transition-all">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Webhooks</h3>
            <p class="text-sm text-gray-600">Set up and verify webhook notifications</p>
        </a>

        <a href="{{ route('docs.testing') }}" class="block p-6 bg-white border border-gray-200 rounded-lg hover:border-purple-300 hover:shadow-lg transition-all">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Testing Guide</h3>
            <p class="text-sm text-gray-600">Test cards, scenarios, and simulation tools</p>
        </a>
    </div>

    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-xl p-8 text-white text-center mb-12">
        <h2 class="text-3xl font-bold mb-4">Ready to Start Testing?</h2>
        <p class="text-xl mb-6">You can explore docs as a guest, and create an account when you need API keys</p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                Get Started Free
            </a>
            <a href="{{ route('docs.api-reference') }}" class="bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-600 transition-colors">
                View API Reference
            </a>
        </div>
    </div>

    <div>
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Need Help?</h2>
        <p class="text-gray-700 mb-4">
            Can't find what you're looking for? Here are some helpful resources:
        </p>
        <ul class="space-y-2">
            <li><a href="{{ route('docs.troubleshooting') }}" class="text-blue-600 hover:underline">Troubleshooting Guide</a> - Common issues and solutions</li>
            <li><a href="{{ route('contact') }}" class="text-blue-600 hover:underline">Contact Support</a> - Get help from our team</li>
            <li><a href="{{ route('docs.getting-started') }}" class="text-blue-600 hover:underline">Getting Started</a> - Setup and first API call</li>
            <li><a href="{{ route('docs.api-reference') }}" class="text-blue-600 hover:underline">API Reference</a> - List of available endpoints</li>
        </ul>
    </div>
</div>
@endsection
