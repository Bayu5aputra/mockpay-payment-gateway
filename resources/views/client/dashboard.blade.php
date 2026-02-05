@extends('layouts.app')

@section('title', 'Client Dashboard')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-6xl mx-auto px-6 py-10">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Welcome, {{ $user->name }}</h1>
                <p class="text-gray-600">Manage your client account and track your activity.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl shadow p-6 border-l-4 border-amber-500">
                    <p class="text-sm text-gray-500 mb-2">Current Plan</p>
                    <p class="text-2xl font-semibold text-gray-900 uppercase">{{ $user->effectivePlan() }}</p>
                    <p class="text-xs text-gray-500 mt-1">
                        @if($user->plan_ends_at && $user->plan_ends_at->isFuture())
                            Valid until {{ $user->plan_ends_at->format('d M Y') }}
                        @else
                            No expiration date
                        @endif
                    </p>
                </div>
                <div class="bg-white rounded-xl shadow p-6 border-l-4 border-blue-500">
                    <p class="text-sm text-gray-500 mb-2">Total Transactions</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['total_payments']) }}</p>
                </div>
                <div class="bg-white rounded-xl shadow p-6 border-l-4 border-purple-500">
                    <p class="text-sm text-gray-500 mb-2">Total Amount</p>
                    <p class="text-2xl font-semibold text-gray-900">Rp {{ number_format($stats['total_amount'], 0, ',', '.') }}</p>
                </div>
                <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-500">
                    <p class="text-sm text-gray-500 mb-2">Success Rate</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['success_rate'], 2) }}%</p>
                    @if($stats['daily_limit'])
                        <p class="text-xs text-gray-500 mt-1">
                            Daily limit used: {{ $stats['daily_used'] }}/{{ $stats['daily_limit'] }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
                <div class="lg:col-span-2 bg-white rounded-xl shadow p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Recent Activity</h2>
                        <span class="text-xs text-gray-500">Last 5 transactions</span>
                    </div>
                    <div class="space-y-4 text-sm text-gray-600">
                        @forelse($recentTransactions as $transaction)
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $transaction->transaction_id }}</p>
                                    <p class="text-xs text-gray-500">{{ $transaction->customer_name }} - {{ $transaction->payment_method }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-900">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>
                                    <p class="text-xs text-gray-500">{{ $transaction->created_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="flex items-center justify-between">
                                <span>No recent transactions yet.</span>
                                <span class="text-xs text-gray-400">--</span>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Links</h2>
                    <div class="flex flex-col gap-3">
                        <a href="{{ route('docs.index') }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-purple-600 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                            View Documentation
                        </a>
                        <a href="{{ route('pricing') }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                            View Pricing
                        </a>
                        <a href="{{ route('contact') }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                            Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
