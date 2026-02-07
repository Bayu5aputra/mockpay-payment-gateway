@extends('layouts.payment')

@section('title', 'Payment Success')

@section('content')
    <div class="max-w-4xl mx-auto px-6">
        <div class="rounded-[28px] bg-white p-8 shadow-sm border border-white/70 text-center">
            <div class="mx-auto h-16 w-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-semibold text-slate-900 mt-4">Payment Successful</h1>
            <p class="text-sm text-slate-600 mt-2">Your payment simulation has been approved by the tenant.</p>

            <div class="mt-6 text-sm text-slate-700 space-y-2">
                <div>Transaction ID: <span class="font-semibold text-slate-900">{{ $transaction->transaction_id }}</span></div>
                <div>Order ID: <span class="font-semibold text-slate-900">{{ $transaction->order_id }}</span></div>
                <div>Amount: <span class="font-semibold text-slate-900">Rp {{ number_format($transaction->total_amount ?? $transaction->amount, 0, ',', '.') }}</span></div>
            </div>
        </div>
    </div>
@endsection
