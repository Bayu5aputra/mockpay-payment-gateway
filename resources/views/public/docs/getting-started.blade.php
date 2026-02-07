@extends('layouts.docs')

@section('title', 'Getting Started - MockPay Documentation')

@section('doc-content')
@php
    $baseUrl = rtrim(config('app.url'), '/');
@endphp
<div class="rounded-[28px] bg-white/90 border border-white/70 shadow-[0_25px_60px_rgba(15,23,42,0.08)] p-8 lg:p-10">
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm">
            <li><a href="{{ route('docs.index') }}" class="text-slate-500 hover:text-slate-900">Documentation</a></li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-900 font-semibold">Getting Started</li>
        </ol>
    </nav>

    <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">Introduction</p>
    <h1 class="text-4xl lg:text-5xl font-semibold text-slate-900 mb-6">Getting Started</h1>

    <section id="introduction" class="mb-12">
        <p class="text-base text-slate-600 mb-4">
            MockPay is a SaaS payment gateway simulation platform designed specifically for developers and QA teams to test payment integrations without connecting to production payment processors.
        </p>
        <p class="text-base text-slate-600 mb-4">
            Each client account operates in complete isolation (multi-tenant architecture), ensuring your transactions, API keys, and webhook configurations remain private and separate from other users.
        </p>
        <div class="rounded-[22px] bg-amber-50 border border-amber-200 p-6">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-amber-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-amber-900 mb-1">Development Environment Only</h3>
                    <p class="text-sm text-amber-800">MockPay is intended exclusively for testing and development purposes. Do not use MockPay for production transactions or real financial operations.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="local-setup" class="mb-12">
        <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">Self-Hosted Installation</p>
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">Local Development Setup</h2>
        <p class="text-base text-slate-600 mb-4">
            If you prefer to run MockPay on your local machine for development and testing purposes, follow these installation steps:
        </p>
        <div class="rounded-[22px] bg-slate-900 text-slate-100 p-6 mb-6 overflow-x-auto">
            <pre class="text-sm font-mono"><code># Clone and install dependencies
composer install
copy .env.example .env

# Database setup (SQLite)
mkdir -Force database
New-Item -ItemType File -Path database\database.sqlite

# Application configuration
php artisan key:generate
php artisan migrate

# Frontend assets
npm install
npm run build

# Start development server
php artisan serve</code></pre>
        </div>
        <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-6">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-900 mb-1">Environment Configuration</h3>
                    <p class="text-sm text-slate-600">Ensure <code class="bg-slate-200 px-2 py-0.5 rounded text-xs font-mono">APP_URL</code> in your <code class="bg-slate-200 px-2 py-0.5 rounded text-xs font-mono">.env</code> file matches your local server address (e.g., <code class="bg-slate-200 px-2 py-0.5 rounded text-xs font-mono">http://127.0.0.1:8000</code>).</p>
                </div>
            </div>
        </div>
    </section>

    <section id="quick-start" class="mb-12">
        <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">Integration Guide</p>
        <h2 class="text-2xl font-semibold text-slate-900 mb-6">Quick Start</h2>

        <div class="space-y-8">
            <div class="flex gap-6">
                <div class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-semibold flex-shrink-0">1</div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-slate-900 mb-2">Create an Account</h3>
                    <p class="text-base text-slate-600">
                        Register for a free client account at <a href="{{ route('register') }}" class="text-slate-900 font-medium underline hover:text-slate-700">{{ route('register') }}</a>
                    </p>
                </div>
            </div>

            <div class="flex gap-6">
                <div class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-semibold flex-shrink-0">2</div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-slate-900 mb-2">Generate API Keys</h3>
                    <p class="text-base text-slate-600 mb-4">
                        After logging in, navigate to the Client Dashboard to generate your API credentials:
                    </p>
                    <ol class="list-decimal list-inside space-y-2 text-sm text-slate-600 ml-4">
                        <li>Navigate to <strong>Client Dashboard → API Keys</strong></li>
                        <li>Click <strong>"Generate New Key"</strong></li>
                        <li>Copy your Server Key (prefixed with <code class="bg-slate-100 px-2 py-0.5 rounded text-xs font-mono">sandbox_sk_</code>)</li>
                        <li>Store the key securely — treat it as a password</li>
                    </ol>
                </div>
            </div>

            <div class="flex gap-6">
                <div class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-semibold flex-shrink-0">3</div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-slate-900 mb-2">Create Your First Transaction</h3>
                    <p class="text-base text-slate-600 mb-4">
                        Make an API request to create a payment transaction:
                    </p>
                    <div class="rounded-[22px] bg-slate-900 text-slate-100 p-6 overflow-x-auto">
                        <pre class="text-sm font-mono"><code>curl -X POST {{ $baseUrl }}/api/v1/payment/create \
  -H "Authorization: Bearer sandbox_sk_test_xxxxxxxxxx" \
  -H "Content-Type: application/json" \
  -d '{
    "order_id": "ORDER-12345",
    "amount": 100000,
    "payment_method": "bank_transfer",
    "payment_channel": "bca_va",
    "customer": {
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "081234567890"
    }
}'</code></pre>
                    </div>
                </div>
            </div>

            <div class="flex gap-6">
                <div class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-semibold flex-shrink-0">4</div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-slate-900 mb-2">Handle the Response</h3>
                    <p class="text-base text-slate-600 mb-4">
                        The API returns a structured response containing payment details:
                    </p>
                    <div class="rounded-[22px] bg-slate-900 text-slate-100 p-6 overflow-x-auto">
                        <pre class="text-sm font-mono"><code>{
    "success": true,
    "data": {
        "transaction_id": "TRX-xxxxx",
        "order_id": "ORDER-12345",
        "amount": 100000,
        "status": "pending",
        "payment_url": "{{ $baseUrl }}/payment/TRX-xxxxx",
        "virtual_account_number": "8808123456789012",
        "expires_at": "2026-01-30T23:59:59Z"
    }
}</code></pre>
                    </div>
                </div>
            </div>

            <div class="flex gap-6">
                <div class="w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center font-semibold flex-shrink-0">5</div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-slate-900 mb-2">Simulate Payment Outcome</h3>
                    <p class="text-base text-slate-600 mb-4">
                        Direct your customer to the <code class="bg-slate-100 px-2 py-0.5 rounded text-xs font-mono">payment_url</code> for the hosted payment page, or use the <strong>Manual Override</strong> feature in your Client Dashboard to control the transaction outcome directly.
                    </p>
                    <div class="rounded-[22px] bg-emerald-50 border border-emerald-200 p-4">
                        <p class="text-sm text-emerald-800">
                            <strong>Pro Tip:</strong> Use Manual Override to test success, failure, expiration, and refund scenarios without waiting for actual payment flows.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="guest-client" class="mb-12">
        <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">Access Levels</p>
        <h2 class="text-2xl font-semibold text-slate-900 mb-6">Guest vs Client</h2>
        <div class="grid md:grid-cols-2 gap-6">
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-6">
                <h3 class="text-base font-semibold text-slate-900 mb-4 flex items-center">
                    <div class="w-8 h-8 rounded-lg bg-slate-300 flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    Guest (No Authentication)
                </h3>
                <ul class="space-y-2 text-sm text-slate-600">
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Browse documentation at <code class="bg-slate-200 px-1 py-0.5 rounded text-xs">/docs</code>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Access payment simulators
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Check API health status
                    </li>
                </ul>
            </div>
            <div class="rounded-[22px] border border-slate-200 bg-white p-6">
                <h3 class="text-base font-semibold text-slate-900 mb-4 flex items-center">
                    <div class="w-8 h-8 rounded-lg bg-slate-900 flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    Client (Authenticated)
                </h3>
                <ul class="space-y-2 text-sm text-slate-600">
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Generate and manage API keys
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Create and manage transactions
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Configure webhook endpoints
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Manual override transaction outcomes
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Download transaction reports (JSON/PDF/CSV)
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section id="api-keys" class="mb-12">
        <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">Security</p>
        <h2 class="text-2xl font-semibold text-slate-900 mb-6">Understanding API Keys</h2>

        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-6">
                <h3 class="text-base font-semibold text-slate-900 mb-2">Server Key</h3>
                <p class="text-xs text-slate-500 mb-3 font-mono bg-slate-200 inline-block px-2 py-1 rounded">sandbox_sk_test_...</p>
                <p class="text-sm text-slate-600">
                    Used for server-side API calls. This key must be kept confidential and should never be exposed in client-side code or version control.
                </p>
            </div>
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-6">
                <h3 class="text-base font-semibold text-slate-900 mb-2">Client Key</h3>
                <p class="text-xs text-slate-500 mb-3 font-mono bg-slate-200 inline-block px-2 py-1 rounded">sandbox_pk_test_...</p>
                <p class="text-sm text-slate-600">
                    Used for client-side integrations. This key can be safely exposed in frontend applications as it has limited permissions.
                </p>
            </div>
        </div>

        <div class="rounded-[22px] bg-red-50 border border-red-200 p-6">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-red-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-red-900 mb-1">Security Best Practice</h3>
                    <p class="text-sm text-red-800">Never commit API keys to version control. Store credentials in environment variables or secure secret management systems.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="border-t border-slate-200 pt-8">
        <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-6">Continue Learning</p>
        <div class="grid md:grid-cols-3 gap-4">
            <a href="{{ route('docs.authentication') }}" class="rounded-[22px] border border-slate-200 bg-white p-5 hover:border-slate-400 hover:shadow-lg transition-all">
                <h3 class="font-semibold text-slate-900 mb-2">Authentication</h3>
                <p class="text-sm text-slate-600">Learn about API authentication methods and signature verification.</p>
            </a>
            <a href="{{ route('docs.api-reference') }}" class="rounded-[22px] border border-slate-200 bg-white p-5 hover:border-slate-400 hover:shadow-lg transition-all">
                <h3 class="font-semibold text-slate-900 mb-2">API Reference</h3>
                <p class="text-sm text-slate-600">Explore all available API endpoints and their parameters.</p>
            </a>
            <a href="{{ route('docs.examples') }}" class="rounded-[22px] border border-slate-200 bg-white p-5 hover:border-slate-400 hover:shadow-lg transition-all">
                <h3 class="font-semibold text-slate-900 mb-2">Code Examples</h3>
                <p class="text-sm text-slate-600">Implementation examples in PHP, Node.js, Python, and cURL.</p>
            </a>
        </div>
    </section>
</div>
@endsection
