@extends('layouts.app')

@section('title', 'Transaction Detail')

@section('content')
    @php
        $statusMap = [
            'settlement' => ['label' => 'Settlement', 'class' => 'bg-emerald-100 text-emerald-700'],
            'pending' => ['label' => 'Pending', 'class' => 'bg-amber-100 text-amber-700'],
            'processing' => ['label' => 'Processing', 'class' => 'bg-blue-100 text-blue-700'],
            'cancelled' => ['label' => 'Cancelled', 'class' => 'bg-gray-100 text-gray-700'],
            'expired' => ['label' => 'Expired', 'class' => 'bg-rose-100 text-rose-700'],
            'failed' => ['label' => 'Failed', 'class' => 'bg-rose-100 text-rose-700'],
            'refunded' => ['label' => 'Refunded', 'class' => 'bg-slate-200 text-slate-700'],
            'partial_refund' => ['label' => 'Partial Refund', 'class' => 'bg-slate-200 text-slate-700'],
        ];
        $statusMeta = $statusMap[$transaction->status] ?? ['label' => ucfirst($transaction->status), 'class' => 'bg-gray-100 text-gray-700'];
        $paymentDetail = $transaction->getPaymentDetail();
    @endphp

    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Transaction</p>
                        <h1 class="text-4xl font-semibold text-slate-900 mt-2">Transaction Detail</h1>
                        <p class="text-sm text-slate-600 mt-2">{{ $transaction->transaction_id }}</p>
                    </div>
                    <span class="px-4 py-2 rounded-full text-xs font-semibold {{ $statusMeta['class'] }}">{{ $statusMeta['label'] }}</span>
                </div>

                @if(session('success'))
                    <div class="rounded-2xl border border-emerald-200 bg-emerald-50/80 p-4">
                        <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="rounded-2xl border border-rose-200 bg-rose-50/80 p-4">
                        <p class="text-rose-800 font-medium">{{ session('error') }}</p>
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 space-y-6">
                        <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                            <h2 class="text-lg font-semibold text-slate-900 mb-4">Details</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-slate-700">
                                <div>
                                    <p class="text-xs text-slate-500">Order ID</p>
                                    <p class="font-semibold text-slate-900">{{ $transaction->order_id }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500">Amount</p>
                                    <p class="font-semibold text-slate-900">Rp {{ number_format($transaction->total_amount ?? $transaction->amount, 0, ',', '.') }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500">Customer</p>
                                    <p class="font-semibold text-slate-900">{{ $transaction->customer_name }}</p>
                                    <p class="text-xs text-slate-500">{{ $transaction->customer_email }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500">Payment Method</p>
                                    <p class="font-semibold text-slate-900">{{ strtoupper($transaction->payment_method ?? '-') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                            <h2 class="text-lg font-semibold text-slate-900 mb-4">Timeline</h2>
                            <div class="space-y-3 text-sm text-slate-700">
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">Created</span>
                                    <span class="font-semibold text-slate-900">{{ $transaction->created_at?->format('Y-m-d H:i:s') }}</span>
                                </div>
                                @if($transaction->paid_at)
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-500">Paid At</span>
                                        <span class="font-semibold text-slate-900">{{ $transaction->paid_at->format('Y-m-d H:i:s') }}</span>
                                    </div>
                                @endif
                                @if($transaction->settled_at)
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-500">Settled At</span>
                                        <span class="font-semibold text-slate-900">{{ $transaction->settled_at->format('Y-m-d H:i:s') }}</span>
                                    </div>
                                @endif
                                @if($transaction->cancelled_at)
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-500">Cancelled At</span>
                                        <span class="font-semibold text-slate-900">{{ $transaction->cancelled_at->format('Y-m-d H:i:s') }}</span>
                                    </div>
                                @endif
                                @if($transaction->refunded_at)
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-500">Refunded At</span>
                                        <span class="font-semibold text-slate-900">{{ $transaction->refunded_at->format('Y-m-d H:i:s') }}</span>
                                    </div>
                                @endif
                                @if($transaction->expired_at)
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-500">Expired At</span>
                                        <span class="font-semibold text-slate-900">{{ $transaction->expired_at->format('Y-m-d H:i:s') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                            <h2 class="text-lg font-semibold text-slate-900 mb-4">Payment Detail</h2>
                            @if($paymentDetail)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-slate-700">
                                    @if($transaction->payment_method === 'bank_transfer')
                                        <div>
                                            <p class="text-xs text-slate-500">Bank Code</p>
                                            <p class="font-semibold text-slate-900">{{ strtoupper($paymentDetail->bank_code) }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500">VA Number</p>
                                            <p class="font-semibold text-slate-900">{{ $paymentDetail->va_number }}</p>
                                        </div>
                                    @elseif($transaction->payment_method === 'ewallet')
                                        <div>
                                            <p class="text-xs text-slate-500">Provider</p>
                                            <p class="font-semibold text-slate-900">{{ strtoupper($paymentDetail->provider) }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500">Deeplink</p>
                                            <p class="font-semibold text-slate-900 truncate">{{ $paymentDetail->deeplink_url ?? '-' }}</p>
                                        </div>
                                    @elseif($transaction->payment_method === 'qris')
                                        <div>
                                            <p class="text-xs text-slate-500">QR String</p>
                                            <p class="font-semibold text-slate-900 truncate">{{ $paymentDetail->qr_string }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500">QR Image</p>
                                            <img src="{{ route('payment.qris.qr', $transaction->transaction_id) }}" alt="QRIS QR" class="mt-2 h-28 w-28 rounded-xl border border-slate-200">
                                        </div>
                                    @elseif($transaction->payment_method === 'retail')
                                        <div>
                                            <p class="text-xs text-slate-500">Store</p>
                                            <p class="font-semibold text-slate-900">{{ strtoupper($paymentDetail->store_type) }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500">Payment Code</p>
                                            <p class="font-semibold text-slate-900">{{ $paymentDetail->payment_code }}</p>
                                        </div>
                                    @elseif($transaction->payment_method === 'credit_card')
                                        <div>
                                            <p class="text-xs text-slate-500">Card Type</p>
                                            <p class="font-semibold text-slate-900">{{ $paymentDetail->card_type ? strtoupper($paymentDetail->card_type) : '-' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500">Masked Card</p>
                                            <p class="font-semibold text-slate-900">{{ $paymentDetail->masked_card ?? '-' }}</p>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <p class="text-sm text-slate-500">No payment detail available.</p>
                            @endif
                        </div>

                        <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                            <h2 class="text-lg font-semibold text-slate-900 mb-4">Metadata</h2>
                            <div class="rounded-2xl bg-slate-50 px-4 py-3 text-xs text-slate-700 whitespace-pre-wrap">
                                {{ $transaction->metadata ? json_encode($transaction->metadata, JSON_PRETTY_PRINT) : 'No metadata provided.' }}
                            </div>
                        </div>

                        <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                            <h2 class="text-lg font-semibold text-slate-900 mb-4">Manual Override</h2>
                            <form method="POST" action="{{ route('client.transactions.override', $transaction->transaction_id) }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @csrf
                                <div class="md:col-span-1">
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Action</label>
                                    <select name="action" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700">
                                        <option value="approve">Approve (Settlement)</option>
                                        <option value="reject">Reject (Failed)</option>
                                        <option value="expire">Expire</option>
                                        <option value="cancel">Cancel</option>
                                        <option value="refund">Refund (Full)</option>
                                        <option value="partial_refund">Refund (Partial)</option>
                                    </select>
                                </div>
                                <div class="md:col-span-1">
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Refund Amount</label>
                                    <input type="number" name="refund_amount" step="0.01" min="0" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700" placeholder="Optional">
                                </div>
                                <div class="md:col-span-1">
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Reason</label>
                                    <input type="text" name="reason" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700" placeholder="Optional">
                                </div>
                                <div class="md:col-span-3">
                                    <button class="rounded-2xl bg-slate-900 px-6 py-2 text-sm font-semibold text-white">Apply Override</button>
                                </div>
                            </form>
                        </div>

                        <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                            <h2 class="text-lg font-semibold text-slate-900 mb-4">Override History</h2>
                            <div class="space-y-3">
                                @forelse($transaction->overrides as $override)
                                    <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3">
                                        <p class="text-sm font-semibold text-slate-900">{{ strtoupper($override->previous_status) }} → {{ strtoupper($override->new_status) }}</p>
                                        <p class="text-xs text-slate-500">{{ $override->created_at->format('Y-m-d H:i:s') }}</p>
                                        @if($override->reason)
                                            <p class="text-xs text-slate-600 mt-1">Reason: {{ $override->reason }}</p>
                                        @endif
                                    </div>
                                @empty
                                    <p class="text-sm text-slate-500">No overrides recorded.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                            <h2 class="text-lg font-semibold text-slate-900 mb-4">Downloads</h2>
                            <div class="space-y-3">
                                <a href="{{ route('client.transactions.download.json', $transaction->transaction_id) }}" class="block rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Download JSON</a>
                                <a href="{{ route('client.transactions.download.pdf', $transaction->transaction_id) }}" class="block rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Download PDF</a>
                                <form method="POST" action="{{ route('client.transactions.resend-webhook', $transaction->transaction_id) }}">
                                    @csrf
                                    <button class="w-full rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white">Resend Webhook</button>
                                </form>
                            </div>
                        </div>

                        <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                            <h2 class="text-lg font-semibold text-slate-900 mb-4">Payment Attempts</h2>
                            <div class="space-y-3">
                                @forelse($transaction->paymentAttempts as $attempt)
                                    <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3">
                                        <p class="text-sm font-semibold text-slate-900">{{ $attempt->source }}</p>
                                        <p class="text-xs text-slate-500">{{ $attempt->created_at->format('Y-m-d H:i:s') }}</p>
                                    </div>
                                @empty
                                    <p class="text-sm text-slate-500">No payment attempts recorded.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4">Webhook Logs</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-slate-50/70 border-b border-slate-200">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Event</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Attempts</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Last Sent</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @forelse($transaction->webhookLogs as $log)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-slate-900">{{ $log->event }}</td>
                                        <td class="px-4 py-3 text-sm text-slate-700">{{ ucfirst($log->status) }}</td>
                                        <td class="px-4 py-3 text-sm text-slate-700">{{ $log->attempt_count }}</td>
                                        <td class="px-4 py-3 text-sm text-slate-700">{{ optional($log->sent_at)->format('Y-m-d H:i:s') ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-4 text-center text-slate-500">No webhook logs yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
