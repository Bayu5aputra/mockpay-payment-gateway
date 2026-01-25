@extends('layouts.docs')

@section('title', 'Documentation - MockPay')

@section('doc-content')
<div class="prose prose-lg max-w-none">
    <h1>MockPay Documentation</h1>
    
    <p class="lead">
        Welcome to MockPay documentation. Learn how to integrate and test payment systems with our realistic dummy payment gateway.
    </p>

    <div class="bg-blue-50 border-l-4 border-blue-500 p-6 my-8">
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

    <h2>What is MockPay?</h2>
    
    <p>
        MockPay is a full-featured dummy payment gateway designed specifically for developers. It simulates all major Indonesian payment methods without involving real money, making it perfect for:
    </p>

    <ul>
        <li>Development and testing of e-commerce applications</li>
        <li>Integration testing without production credentials</li>
        <li>Training and educational purposes</li>
        <li>Demonstrating payment flows to stakeholders</li>
    </ul>

    <h2>Key Features</h2>

    <div class="grid md:grid-cols-2 gap-6 my-8 not-prose">
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

    <h2>Popular Topics</h2>

    <div class="grid md:grid-cols-3 gap-4 my-8 not-prose">
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

    <h2>Need Help?</h2>

    <p>
        Can't find what you're looking for? Here are some helpful resources:
    </p>

    <ul>
        <li><a href="{{ route('docs.troubleshooting') }}">Troubleshooting Guide</a> - Common issues and solutions</li>
        <li><a href="{{ route('contact') }}">Contact Support</a> - Get help from our team</li>
        <li><a href="#">Community Forum</a> - Ask questions and share knowledge</li>
        <li><a href="#">GitHub Repository</a> - View source code and examples</li>
    </ul>
</div>
@endsection