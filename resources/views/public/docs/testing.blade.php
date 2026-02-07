@extends('layouts.docs')

@section('title', 'Testing Guide - MockPay Documentation')

@section('doc-content')
<div class="rounded-[28px] bg-white/90 border border-white/70 shadow-[0_25px_60px_rgba(15,23,42,0.08)] p-8 lg:p-10">
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm">
            <li><a href="{{ route('docs.index') }}" class="text-slate-500 hover:text-slate-900">Documentation</a></li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-900 font-semibold">Testing Guide</li>
        </ol>
    </nav>

    <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">Simulation</p>
    <h1 class="text-4xl lg:text-5xl font-semibold text-slate-900 mb-6">Testing Guide</h1>
    <p class="text-base text-slate-600 mb-8">Test various payment scenarios using our simulation tools and test credentials.</p>

    <section id="cards" class="mb-12">
        <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">Test Credentials</p>
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">Test Credit Cards</h2>
        <p class="text-base text-slate-600 mb-4">
            Use these test card numbers to simulate different payment outcomes:
        </p>
        <div class="rounded-[22px] border border-slate-200 overflow-hidden">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-900 uppercase tracking-wider">Card Number</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-900 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-900 uppercase tracking-wider">Result</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-900 uppercase tracking-wider">Description</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    @foreach($testCards as $card)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <code class="text-sm font-mono bg-slate-100 px-2 py-1 rounded">{{ $card['number'] }}</code>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">{{ $card['type'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($card['result'] == 'Success') bg-emerald-100 text-emerald-800
                                @elseif($card['result'] == 'Failed') bg-red-100 text-red-800
                                @else bg-amber-100 text-amber-800
                                @endif">
                                {{ $card['result'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $card['description'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-5 mt-4">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-lg bg-slate-900 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-slate-600">
                        <strong class="text-slate-900">Test Card Details:</strong> Use any future expiry date (MM/YY format) and any 3-digit CVV for all test cards.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="tools" class="mb-12">
        <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">Interactive</p>
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">Payment Simulators</h2>
        <p class="text-base text-slate-600 mb-4">
            Use our built-in simulation tools to test different payment methods. These simulators are publicly accessible and do not require authentication.
        </p>
        <div class="grid md:grid-cols-2 gap-4">
            <a href="{{ route('payment.simulate.va') }}" class="rounded-[22px] border border-slate-200 bg-white p-5 hover:border-slate-400 hover:shadow-lg transition-all group">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 group-hover:bg-blue-500 transition-colors flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-900">Virtual Account Simulator</h3>
                </div>
                <p class="text-sm text-slate-600 ml-13">Test VA payments with BCA, BNI, BRI, Mandiri, and other banks</p>
            </a>
            <a href="{{ route('payment.simulate.ewallet') }}" class="rounded-[22px] border border-slate-200 bg-white p-5 hover:border-slate-400 hover:shadow-lg transition-all group">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-green-100 group-hover:bg-green-500 transition-colors flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-900">E-Wallet Simulator</h3>
                </div>
                <p class="text-sm text-slate-600 ml-13">Simulate GoPay, OVO, DANA, and ShopeePay payments</p>
            </a>
            <a href="{{ route('payment.simulate.qris') }}" class="rounded-[22px] border border-slate-200 bg-white p-5 hover:border-slate-400 hover:shadow-lg transition-all group">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 group-hover:bg-purple-500 transition-colors flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-900">QRIS Simulator</h3>
                </div>
                <p class="text-sm text-slate-600 ml-13">Test QRIS payments with QR code generation</p>
            </a>
            <a href="{{ route('payment.simulate.retail') }}" class="rounded-[22px] border border-slate-200 bg-white p-5 hover:border-slate-400 hover:shadow-lg transition-all group">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-orange-100 group-hover:bg-orange-500 transition-colors flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-900">Retail Payment Simulator</h3>
                </div>
                <p class="text-sm text-slate-600 ml-13">Simulate Alfamart, Indomaret, and retail payments</p>
            </a>
        </div>
    </section>

    <section id="scenarios" class="mb-12">
        <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">Test Cases</p>
        <h2 class="text-2xl font-semibold text-slate-900 mb-6">Common Test Scenarios</h2>
        <div class="space-y-4">
            <div class="rounded-[22px] border-l-4 border-emerald-500 bg-emerald-50 p-5">
                <h3 class="font-semibold text-slate-900 mb-2">Successful Payment</h3>
                <p class="text-sm text-slate-600">Use card <code class="bg-emerald-100 px-2 py-0.5 rounded font-mono text-xs">4111111111111111</code> or complete any VA/QRIS transaction through the simulator</p>
            </div>
            <div class="rounded-[22px] border-l-4 border-red-500 bg-red-50 p-5">
                <h3 class="font-semibold text-slate-900 mb-2">Failed Payment</h3>
                <p class="text-sm text-slate-600">Use card <code class="bg-red-100 px-2 py-0.5 rounded font-mono text-xs">4000000000000002</code> to simulate declined transactions</p>
            </div>
            <div class="rounded-[22px] border-l-4 border-amber-500 bg-amber-50 p-5">
                <h3 class="font-semibold text-slate-900 mb-2">Expired Transaction</h3>
                <p class="text-sm text-slate-600">Wait for transaction expiry time (default 24 hours) or use <strong>Manual Override</strong> to expire immediately</p>
            </div>
            <div class="rounded-[22px] border-l-4 border-blue-500 bg-blue-50 p-5">
                <h3 class="font-semibold text-slate-900 mb-2">3D Secure Authentication</h3>
                <p class="text-sm text-slate-600">Use card <code class="bg-blue-100 px-2 py-0.5 rounded font-mono text-xs">4111111111110000</code> and enter OTP: <code class="bg-blue-100 px-2 py-0.5 rounded font-mono text-xs">112233</code></p>
            </div>
        </div>
    </section>

    <section id="manual-override" class="mb-12">
        <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">Advanced Testing</p>
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">Manual Override</h2>
        <p class="text-base text-slate-600 mb-4">
            The Manual Override feature allows you to control transaction outcomes directly from your Client Dashboard. This is the primary method for testing your integration's response to different payment states.
        </p>
        <div class="rounded-[22px] bg-slate-900 text-white p-6">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-white mb-2">Available Override Actions</h3>
                    <ul class="text-sm text-white/70 space-y-1">
                        <li>• <strong class="text-white">Approve/Success</strong> — Mark transaction as paid</li>
                        <li>• <strong class="text-white">Reject/Failed</strong> — Mark transaction as failed</li>
                        <li>• <strong class="text-white">Expire</strong> — Mark transaction as expired</li>
                        <li>• <strong class="text-white">Refund</strong> — Process full or partial refund</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
