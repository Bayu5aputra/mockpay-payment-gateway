@extends('layouts.docs')

@section('title', 'Testing Guide - MockPay Documentation')

@section('doc-content')
<div class="bg-white rounded-lg shadow-md p-8">
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm">
            <li><a href="{{ route('docs.index') }}" class="text-blue-600 hover:text-blue-800">Documentation</a></li>
            <li class="text-gray-500">/</li>
            <li class="text-gray-900 font-semibold">Testing</li>
        </ol>
    </nav>

    <h1 class="text-4xl font-bold text-gray-900 mb-6">Testing Guide</h1>
    <p class="text-gray-700 mb-8">Test different payment scenarios using our test data</p>

    <section id="cards" class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Test Credit Cards</h2>
        <p class="text-gray-700 mb-4">
            Use these test card numbers to simulate different payment scenarios:
        </p>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Card Number</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Result</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($testCards as $card)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <code class="text-sm font-mono">{{ $card['number'] }}</code>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $card['type'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($card['result'] == 'Success') bg-green-100 text-green-800
                                @elseif($card['result'] == 'Failed') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800
                                @endif">
                                {{ $card['result'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $card['description'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4 bg-gray-50 border border-gray-200 rounded-lg p-4">
            <p class="text-sm text-gray-700">
                <strong>Note:</strong> Use any future expiry date (MM/YY format) and any 3-digit CVV for all test cards.
            </p>
        </div>
    </section>

    <section id="tools" class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Simulation Tools</h2>
        <p class="text-gray-700 mb-4">
            Use our built-in simulation tools to test different payment methods. These pages are public and do not require login.
        </p>
        <div class="grid md:grid-cols-2 gap-4">
            <a href="{{ route('payment.simulate.va') }}" class="border border-gray-200 rounded-lg p-4 hover:border-blue-600 hover:shadow-md transition-all">
                <h3 class="font-semibold text-gray-900 mb-2">Virtual Account Simulator</h3>
                <p class="text-sm text-gray-600">Test VA payments with different banks</p>
            </a>
            <a href="{{ route('payment.simulate.ewallet') }}" class="border border-gray-200 rounded-lg p-4 hover:border-blue-600 hover:shadow-md transition-all">
                <h3 class="font-semibold text-gray-900 mb-2">E-Wallet Simulator</h3>
                <p class="text-sm text-gray-600">Simulate e-wallet payments</p>
            </a>
            <a href="{{ route('payment.simulate.qris') }}" class="border border-gray-200 rounded-lg p-4 hover:border-blue-600 hover:shadow-md transition-all">
                <h3 class="font-semibold text-gray-900 mb-2">QRIS Simulator</h3>
                <p class="text-sm text-gray-600">Test QRIS payments</p>
            </a>
            <a href="{{ route('payment.simulate.retail') }}" class="border border-gray-200 rounded-lg p-4 hover:border-blue-600 hover:shadow-md transition-all">
                <h3 class="font-semibold text-gray-900 mb-2">Retail Simulator</h3>
                <p class="text-sm text-gray-600">Simulate retail payments</p>
            </a>
        </div>
    </section>

    <section id="scenarios" class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Common Test Scenarios</h2>
        <div class="space-y-4">
            <div class="border-l-4 border-green-500 bg-green-50 p-4">
                <h3 class="font-semibold text-gray-900 mb-2">Successful Payment</h3>
                <p class="text-sm text-gray-700">Use card 4111111111111111 or pay any VA/QRIS transaction through simulator</p>
            </div>
            <div class="border-l-4 border-red-500 bg-red-50 p-4">
                <h3 class="font-semibold text-gray-900 mb-2">Failed Payment</h3>
                <p class="text-sm text-gray-700">Use card 4000000000000002 for declined transactions</p>
            </div>
            <div class="border-l-4 border-yellow-500 bg-yellow-50 p-4">
                <h3 class="font-semibold text-gray-900 mb-2">Expired Transaction</h3>
                <p class="text-sm text-gray-700">Wait for transaction expiry time (default 24 hours) or manually expire</p>
            </div>
            <div class="border-l-4 border-blue-500 bg-blue-50 p-4">
                <h3 class="font-semibold text-gray-900 mb-2">3D Secure</h3>
                <p class="text-sm text-gray-700">Use card 4111111111110000 and OTP: 112233</p>
            </div>
        </div>
    </section>
</div>
@endsection
