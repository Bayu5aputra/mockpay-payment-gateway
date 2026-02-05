<x-app-layout>
    @php
        $statusMap = [
            'settlement' => ['label' => 'Settlement', 'class' => 'bg-green-100 text-green-800'],
            'pending' => ['label' => 'Pending', 'class' => 'bg-amber-100 text-amber-800'],
            'processing' => ['label' => 'Processing', 'class' => 'bg-blue-100 text-blue-800'],
            'cancelled' => ['label' => 'Cancelled', 'class' => 'bg-gray-100 text-gray-800'],
            'expired' => ['label' => 'Expired', 'class' => 'bg-red-100 text-red-800'],
            'failed' => ['label' => 'Failed', 'class' => 'bg-red-100 text-red-800'],
            'refunded' => ['label' => 'Refunded', 'class' => 'bg-purple-100 text-purple-800'],
        ];
        $statusMeta = $statusMap[$transaction->status] ?? ['label' => ucfirst($transaction->status), 'class' => 'bg-gray-100 text-gray-800'];
        $paymentDetail = $transaction->getPaymentDetail();
        $items = $transaction->metadata['items'] ?? [];
    @endphp
    <div class="p-8">
        <!-- Back Button -->
        <a href="{{ route('dashboard.transactions.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Transactions
        </a>

        <!-- Transaction Header -->
        <div class="bg-white rounded-xl shadow-md p-8 mb-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Transaction Details</h1>
                    <p class="text-gray-600">{{ $transaction->transaction_id }}</p>
                </div>
                <span class="px-6 py-3 text-sm font-semibold rounded-full {{ $statusMeta['class'] }}">{{ $statusMeta['label'] }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Amount</p>
                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Payment Method</p>
                    <p class="text-lg font-semibold text-gray-900">{{ strtoupper($transaction->payment_method ?? '-') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Created At</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $transaction->created_at->format('M d, Y H:i') }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Customer Information -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Customer Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Name</p>
                            <p class="text-base font-semibold text-gray-900">{{ $transaction->customer_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Email</p>
                            <p class="text-base font-semibold text-gray-900">{{ $transaction->customer_email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Phone</p>
                            <p class="text-base font-semibold text-gray-900">{{ $transaction->customer_phone ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Customer ID</p>
                            <p class="text-base font-semibold text-gray-900">{{ $transaction->metadata['customer_id'] ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Payment Details</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-3 border-b border-gray-200">
                            <span class="text-gray-600">Order ID</span>
                            <span class="font-semibold text-gray-900">{{ $transaction->order_id }}</span>
                        </div>
                        @if ($paymentDetail && $transaction->payment_method === \App\Models\Transaction::METHOD_BANK_TRANSFER)
                            <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                <span class="text-gray-600">VA Number</span>
                                <span class="font-mono font-semibold text-gray-900">{{ $paymentDetail->va_number ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                <span class="text-gray-600">Bank</span>
                                <span class="font-semibold text-gray-900">{{ strtoupper($paymentDetail->bank_code ?? '-') }}</span>
                            </div>
                        @elseif ($paymentDetail && $transaction->payment_method === \App\Models\Transaction::METHOD_EWALLET)
                            <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                <span class="text-gray-600">Provider</span>
                                <span class="font-semibold text-gray-900">{{ strtoupper($paymentDetail->provider ?? '-') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                <span class="text-gray-600">Deeplink</span>
                                <span class="font-semibold text-gray-900 truncate">{{ $paymentDetail->deeplink_url ?? '-' }}</span>
                            </div>
                        @elseif ($paymentDetail && $transaction->payment_method === \App\Models\Transaction::METHOD_CREDIT_CARD)
                            <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                <span class="text-gray-600">Masked Card</span>
                                <span class="font-semibold text-gray-900">{{ $paymentDetail->masked_card ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                <span class="text-gray-600">Card Type</span>
                                <span class="font-semibold text-gray-900">{{ strtoupper($paymentDetail->card_type ?? '-') }}</span>
                            </div>
                        @elseif ($paymentDetail && $transaction->payment_method === \App\Models\Transaction::METHOD_QRIS)
                            <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                <span class="text-gray-600">QRIS</span>
                                <span class="font-semibold text-gray-900">QRIS Payment</span>
                            </div>
                        @elseif ($paymentDetail && $transaction->payment_method === \App\Models\Transaction::METHOD_RETAIL)
                            <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                <span class="text-gray-600">Store</span>
                                <span class="font-semibold text-gray-900">{{ strtoupper($paymentDetail->store_type ?? '-') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                <span class="text-gray-600">Payment Code</span>
                                <span class="font-mono font-semibold text-gray-900">{{ $paymentDetail->payment_code ?? '-' }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between items-center py-3 border-b border-gray-200">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-semibold text-gray-900">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-200">
                            <span class="text-gray-600">Admin Fee</span>
                            <span class="font-semibold text-gray-900">Rp {{ number_format($transaction->fee ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-3">
                            <span class="text-lg font-bold text-gray-900">Total</span>
                            <span class="text-lg font-bold text-gray-900">Rp {{ number_format($transaction->total_amount ?? $transaction->amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Items -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Items</h2>
                    @if (!empty($items))
                        <div class="space-y-3">
                            @foreach ($items as $item)
                                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $item['name'] ?? 'Item' }}</p>
                                        <p class="text-sm text-gray-600">Quantity: {{ $item['quantity'] ?? 1 }}</p>
                                    </div>
                                    <p class="font-semibold text-gray-900">Rp {{ number_format($item['price'] ?? 0, 0, ',', '.') }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500">No item details available.</p>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Timeline -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Transaction Timeline</h2>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900">Transaction Created</p>
                                <p class="text-sm text-gray-600">{{ $transaction->created_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                        @if ($transaction->paid_at)
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="font-semibold text-gray-900">Payment Success</p>
                                    <p class="text-sm text-gray-600">{{ $transaction->paid_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                        @endif
                        @if ($transaction->cancelled_at)
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L10 9.586 7.707 7.293a1 1 0 00-1.414 1.414L8.586 11l-2.293 2.293a1 1 0 101.414 1.414L10 12.414l2.293 2.293a1 1 0 001.414-1.414L11.414 11l2.293-2.293z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="font-semibold text-gray-900">Cancelled</p>
                                    <p class="text-sm text-gray-600">{{ $transaction->cancelled_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                        @endif
                        @if ($transaction->refunded_at)
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3H7a1 1 0 000 2h2v2a1 1 0 002 0v-2h2a1 1 0 000-2h-2V7z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="font-semibold text-gray-900">Refunded</p>
                                    <p class="text-sm text-gray-600">{{ $transaction->refunded_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Actions</h2>
                    <div class="space-y-3">
                        @if ($transaction->canBeCancelled())
                            <form method="POST" action="{{ route('dashboard.transactions.cancel', $transaction->transaction_id) }}">
                                @csrf
                                <button type="submit" class="w-full px-4 py-3 border border-amber-300 text-amber-700 rounded-lg hover:bg-amber-50 flex items-center justify-center">
                                    Cancel Transaction
                                </button>
                            </form>
                        @endif
                        @if ($transaction->canBeRefunded())
                            <form method="POST" action="{{ route('dashboard.transactions.refund', $transaction->transaction_id) }}">
                                @csrf
                                <button type="submit" class="w-full px-4 py-3 border border-red-300 text-red-600 rounded-lg hover:bg-red-50 flex items-center justify-center">
                                    Request Refund
                                </button>
                            </form>
                        @endif
                        <form method="POST" action="{{ route('dashboard.transactions.resend-webhook', $transaction->transaction_id) }}">
                            @csrf
                            <button type="submit" class="w-full px-4 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700">
                                Resend Webhook
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Support -->
                <div class="bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl shadow-md p-6 text-white">
                    <h3 class="text-lg font-bold mb-2">Need Help?</h3>
                    <p class="text-purple-100 text-sm mb-4">Contact our support team for assistance</p>
                    <a href="{{ route('contact') }}" class="block w-full text-center px-4 py-2 bg-white text-purple-600 rounded-lg hover:bg-purple-50 font-semibold">
                        Contact Support
                    </a>
                </div>
            </div>
        </div>

        <!-- Webhook Logs -->
        <div class="mt-8 bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Webhook Logs</h2>
            @if ($webhookLogs->isEmpty())
                <p class="text-sm text-gray-500">No webhook logs yet.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Event</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Attempts</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Last Sent</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($webhookLogs as $log)
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-900">{{ $log->event }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">{{ ucfirst($log->status) }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">{{ $log->attempt_count }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">{{ optional($log->sent_at)->format('M d, Y H:i') ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
