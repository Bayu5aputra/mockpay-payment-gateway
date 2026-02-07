@extends('layouts.payment')

@section('title', 'Payment Expired')

@section('content')
    <div class="max-w-4xl mx-auto px-6">
        <div class="rounded-[28px] bg-white p-8 shadow-sm border border-white/70 text-center">
            <div class="mx-auto h-16 w-16 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-semibold text-slate-900 mt-4">Payment Expired</h1>
            <p class="text-sm text-slate-600 mt-2">This transaction has expired and can no longer be paid.</p>

            <div class="mt-6 text-sm text-slate-700 space-y-2">
                <div>Transaction ID: <span class="font-semibold text-slate-900">{{ $transaction->transaction_id }}</span></div>
                <div>Order ID: <span class="font-semibold text-slate-900">{{ $transaction->order_id }}</span></div>
                <div>Expired At: <span class="font-semibold text-slate-900">{{ $transaction->expired_at?->format('Y-m-d H:i:s') }}</span></div>
            </div>
        </div>
    </div>
@endsection
