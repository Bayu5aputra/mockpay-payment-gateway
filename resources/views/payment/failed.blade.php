@extends('layouts.payment')

@section('title', 'Payment Failed')

@section('content')
    <div class="max-w-4xl mx-auto px-6">
        <div class="rounded-[28px] bg-white p-8 shadow-sm border border-white/70 text-center">
            <div class="mx-auto h-16 w-16 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-semibold text-slate-900 mt-4">Payment Failed</h1>
            <p class="text-sm text-slate-600 mt-2">The tenant marked this payment as failed.</p>

            <div class="mt-6 text-sm text-slate-700 space-y-2">
                <div>Transaction ID: <span class="font-semibold text-slate-900">{{ $transaction->transaction_id }}</span></div>
                <div>Order ID: <span class="font-semibold text-slate-900">{{ $transaction->order_id }}</span></div>
                <div>Status: <span class="font-semibold text-slate-900">{{ strtoupper($transaction->status) }}</span></div>
            </div>
        </div>
    </div>
@endsection
