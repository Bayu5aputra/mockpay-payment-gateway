<x-app-layout>
    <div class="p-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('dashboard.developers.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Developer Tools
            </a>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Payment Simulator</h1>
            <p class="text-gray-600">Test payment flows without processing real transactions</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Simulator Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Create Test Transaction</h2>

                    <form id="simulatorForm" class="space-y-6">
                        <!-- Payment Method -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Payment Method</label>
                            <div class="grid grid-cols-2 gap-4">
                                <button type="button" onclick="selectPaymentMethod('bca_va')" data-method="bca_va" class="payment-method-btn border-2 border-gray-200 rounded-lg p-4 hover:border-blue-500 transition-colors">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                        <div class="text-left">
                                            <p class="font-semibold text-gray-900">BCA VA</p>
                                            <p class="text-xs text-gray-500">Virtual Account</p>
                                        </div>
                                    </div>
                                </button>

                                <button type="button" onclick="selectPaymentMethod('gopay')" data-method="gopay" class="payment-method-btn border-2 border-gray-200 rounded-lg p-4 hover:border-green-500 transition-colors">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <div class="text-left">
                                            <p class="font-semibold text-gray-900">GoPay</p>
                                            <p class="text-xs text-gray-500">E-Wallet</p>
                                        </div>
                                    </div>
                                </button>

                                <button type="button" onclick="selectPaymentMethod('qris')" data-method="qris" class="payment-method-btn border-2 border-gray-200 rounded-lg p-4 hover:border-purple-500 transition-colors">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                            </svg>
                                        </div>
                                        <div class="text-left">
                                            <p class="font-semibold text-gray-900">QRIS</p>
                                            <p class="text-xs text-gray-500">QR Payment</p>
                                        </div>
                                    </div>
                                </button>

                                <button type="button" onclick="selectPaymentMethod('credit_card')" data-method="credit_card" class="payment-method-btn border-2 border-gray-200 rounded-lg p-4 hover:border-amber-500 transition-colors">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                            </svg>
                                        </div>
                                        <div class="text-left">
                                            <p class="font-semibold text-gray-900">Credit Card</p>
                                            <p class="text-xs text-gray-500">Card Payment</p>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <input type="hidden" id="payment_method" name="payment_method" required>
                        </div>

                        <!-- Amount -->
                        <div>
                            <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">Amount (IDR)</label>
                            <input type="number" id="amount" name="amount" value="100000" min="10000" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                        </div>

                        <!-- Customer Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="customer_name" class="block text-sm font-semibold text-gray-700 mb-2">Customer Name</label>
                                <input type="text" id="customer_name" name="customer_name" value="John Doe" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                            </div>
                            <div>
                                <label for="customer_email" class="block text-sm font-semibold text-gray-700 mb-2">Customer Email</label>
                                <input type="email" id="customer_email" name="customer_email" value="john@example.com" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                            </div>
                        </div>

                        <!-- Order ID -->
                        <div>
                            <label for="order_id" class="block text-sm font-semibold text-gray-700 mb-2">Order ID</label>
                            <input type="text" id="order_id" name="order_id" value="ORDER-{{ time() }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold py-4 rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                            Create Test Transaction
                        </button>
                    </form>
                </div>
            </div>

            <!-- Result Panel -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-8 sticky top-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Transaction Result</h3>

                    <div id="resultPanel" class="hidden">
                        <div class="space-y-4">
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                <div class="flex items-center space-x-2 mb-2">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm font-semibold text-green-800">Transaction Created</span>
                                </div>
                                <p class="text-sm text-green-700" id="transactionId"></p>
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Status:</span>
                                    <span class="font-semibold text-gray-900" id="status"></span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Amount:</span>
                                    <span class="font-semibold text-gray-900" id="resultAmount"></span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Payment Method:</span>
                                    <span class="font-semibold text-gray-900" id="resultMethod"></span>
                                </div>
                            </div>

                            <div id="paymentDetails" class="bg-gray-50 rounded-lg p-4">
                                <!-- Payment details will be inserted here -->
                            </div>

                            <button onclick="simulatePayment()" class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white font-bold py-3 rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-200">
                                Simulate Payment
                            </button>
                        </div>
                    </div>

                    <div id="emptyState" class="text-center py-12">
                        <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-gray-500">Create a transaction to see the result</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let selectedMethod = null;
        let currentTransactionId = null;

        function selectPaymentMethod(method) {
            selectedMethod = method;
            document.getElementById('payment_method').value = method;

            // Update UI
            document.querySelectorAll('.payment-method-btn').forEach(btn => {
                btn.classList.remove('border-blue-500', 'border-green-500', 'border-purple-500', 'border-amber-500', 'bg-blue-50', 'bg-green-50', 'bg-purple-50', 'bg-amber-50');
                btn.classList.add('border-gray-200');
            });

            const selectedBtn = document.querySelector(`[data-method="${method}"]`);
            const colorMap = {
                'bca_va': 'blue',
                'gopay': 'green',
                'qris': 'purple',
                'credit_card': 'amber'
            };
            const color = colorMap[method];
            selectedBtn.classList.remove('border-gray-200');
            selectedBtn.classList.add(`border-${color}-500`, `bg-${color}-50`);
        }

        document.getElementById('simulatorForm').addEventListener('submit', function(e) {
            e.preventDefault();

            if (!selectedMethod) {
                alert('Please select a payment method');
                return;
            }

            // Generate mock transaction
            const transactionId = 'TRX-' + new Date().getFullYear() +
                                  String(new Date().getMonth() + 1).padStart(2, '0') +
                                  String(new Date().getDate()).padStart(2, '0') + '-' +
                                  String(Math.floor(Math.random() * 100000)).padStart(5, '0');

            currentTransactionId = transactionId;

            const amount = document.getElementById('amount').value;
            const formattedAmount = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(amount);

            // Show result
            document.getElementById('emptyState').classList.add('hidden');
            document.getElementById('resultPanel').classList.remove('hidden');

            document.getElementById('transactionId').textContent = transactionId;
            document.getElementById('status').textContent = 'Pending';
            document.getElementById('resultAmount').textContent = formattedAmount;
            document.getElementById('resultMethod').textContent = selectedMethod.toUpperCase().replace('_', ' ');

            // Show payment details
            const detailsHtml = getPaymentDetails(selectedMethod, amount);
            document.getElementById('paymentDetails').innerHTML = detailsHtml;
        });

        function getPaymentDetails(method, amount) {
            switch(method) {
                case 'bca_va':
                    return `
                        <p class="text-sm font-semibold text-gray-700 mb-2">Virtual Account Number:</p>
                        <p class="text-lg font-mono font-bold text-blue-600">80777${Math.floor(Math.random() * 1000000000)}</p>
                    `;
                case 'gopay':
                    return `
                        <p class="text-sm font-semibold text-gray-700 mb-2">Payment Link:</p>
                        <button class="text-sm text-green-600 hover:text-green-700 font-medium">Open GoPay App</button>
                    `;
                case 'qris':
                    return `
                        <div class="text-center">
                            <div class="w-32 h-32 bg-gray-200 mx-auto rounded-lg flex items-center justify-center mb-2">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                </svg>
                            </div>
                            <p class="text-xs text-gray-500">Scan this QR code to pay</p>
                        </div>
                    `;
                case 'credit_card':
                    return `
                        <p class="text-sm text-gray-600">Please complete 3DS verification</p>
                        <button class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-medium">Verify Now</button>
                    `;
                default:
                    return '';
            }
        }

        function simulatePayment() {
            // Simulate payment success
            document.getElementById('status').textContent = 'Success';
            document.getElementById('status').classList.add('text-green-600');

            alert('Payment simulated successfully! Transaction ID: ' + currentTransactionId);
        }
    </script>
    @endpush
</x-app-layout>
