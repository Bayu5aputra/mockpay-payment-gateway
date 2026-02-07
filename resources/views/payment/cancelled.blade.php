@extends('layouts.payment')

@section('title', 'Payment Cancelled')

@section('content')
    <div class="max-w-4xl mx-auto px-6">
        <div class="rounded-[28px] bg-white p-8 shadow-sm border border-white/70 text-center">
            <div class="mx-auto h-16 w-16 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-12.728 12.728M5.636 5.636l12.728 12.728"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-semibold text-slate-900 mt-4">Payment Cancelled</h1>
            <p class="text-sm text-slate-600 mt-2">The tenant cancelled this transaction.</p>

            <div class="mt-6 text-sm text-slate-700 space-y-2">
                <div>Transaction ID: <span class="font-semibold text-slate-900">{{ $transaction->transaction_id }}</span></div>
                <div>Order ID: <span class="font-semibold text-slate-900">{{ $transaction->order_id }}</span></div>
                <div>Status: <span class="font-semibold text-slate-900">{{ strtoupper($transaction->status) }}</span></div>
            </div>
        </div>
    </div>
@endsection
