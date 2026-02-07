@extends('layouts.docs')

@section('title', 'API Reference - MockPay Documentation')

@section('doc-content')
@php
    $baseUrl = rtrim(config('app.url'), '/');
@endphp
<div class="rounded-[28px] bg-white/90 border border-white/70 shadow-[0_25px_60px_rgba(15,23,42,0.08)] p-8 lg:p-10">
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm">
            <li><a href="{{ route('docs.index') }}" class="text-slate-500 hover:text-slate-900">Documentation</a></li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-900 font-semibold">API Reference</li>
        </ol>
    </nav>

    <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">Endpoints</p>
    <h1 class="text-4xl lg:text-5xl font-semibold text-slate-900 mb-6">API Reference</h1>
    <p class="text-base text-slate-600 mb-8">Complete reference for all MockPay API endpoints. All requests must be authenticated using your API key.</p>

    <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-6 mb-8">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-slate-900 mb-1">Base URL</h3>
                <code class="text-sm font-mono bg-slate-200 px-3 py-1 rounded">{{ $baseUrl }}/api/v1</code>
                <p class="text-sm text-slate-600 mt-2">
                    All endpoints require Bearer token authentication. See <a href="{{ route('docs.authentication') }}" class="text-slate-900 font-medium underline hover:text-slate-700">Authentication</a> for details.
                </p>
            </div>
        </div>
    </div>

    <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-6">Available Endpoints</p>

    @foreach($endpoints as $endpoint)
    <div class="mb-6 rounded-[22px] border border-slate-200 bg-white hover:border-slate-400 hover:shadow-md transition-all overflow-hidden">
        <div class="p-6">
            <div class="flex items-center gap-4 mb-4">
                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold
                    @if($endpoint['method'] == 'POST') bg-emerald-100 text-emerald-800
                    @elseif($endpoint['method'] == 'GET') bg-blue-100 text-blue-800
                    @elseif($endpoint['method'] == 'PUT') bg-amber-100 text-amber-800
                    @elseif($endpoint['method'] == 'DELETE') bg-red-100 text-red-800
                    @endif">
                    {{ $endpoint['method'] }}
                </span>
                <code class="text-base font-mono text-slate-900 font-medium">{{ $endpoint['path'] }}</code>
            </div>
            <h3 class="text-lg font-semibold text-slate-900 mb-2">{{ $endpoint['title'] }}</h3>
            <p class="text-sm text-slate-600">{{ $endpoint['description'] }}</p>
        </div>
        
        <details class="border-t border-slate-100">
            <summary class="cursor-pointer px-6 py-4 text-sm text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors flex items-center justify-between">
                <span class="font-medium">View Request & Response Details</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </summary>
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                <p class="text-sm text-slate-600 mb-4">
                    For complete request/response examples, see the <a href="{{ route('docs.examples') }}" class="text-slate-900 font-medium underline hover:text-slate-700">Code Examples</a> section.
                </p>
                
                @if($endpoint['method'] == 'POST' && str_contains($endpoint['path'], 'create'))
                <div class="rounded-[16px] bg-slate-900 text-slate-100 p-5 overflow-x-auto">
                    <p class="text-xs text-slate-400 mb-3 font-mono">// Example Request</p>
                    <pre class="text-sm font-mono"><code>{
    "order_id": "ORDER-12345",
    "amount": 100000,
    "payment_method": "bank_transfer",
    "payment_channel": "bca_va",
    "customer": {
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "081234567890"
    }
}</code></pre>
                </div>
                @endif
            </div>
        </details>
    </div>
    @endforeach

    <div class="rounded-[22px] bg-slate-900 text-white p-6 mt-8">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-white mb-1">Need Code Examples?</h3>
                <p class="text-sm text-white/70">
                    Check out our <a href="{{ route('docs.examples') }}" class="text-emerald-400 hover:text-emerald-300 underline">integration examples</a> in PHP, Node.js, Python, and cURL.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
