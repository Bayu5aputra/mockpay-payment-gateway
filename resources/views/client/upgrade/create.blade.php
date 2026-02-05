<x-app-layout>
    <div class="p-8">
        <div class="mb-8">
            <a href="{{ route('client.upgrade-requests.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back
            </a>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Request Upgrade</h1>
            <p class="text-gray-600">Fill out the form and upload your transfer proof with the correct amount.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <form method="POST" action="{{ route('client.upgrade-requests.store') }}" enctype="multipart/form-data" class="lg:col-span-2 bg-white rounded-xl shadow p-6 space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Plan</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="border rounded-lg p-4 cursor-pointer hover:border-purple-500 transition-colors">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-semibold text-gray-900">Pro</p>
                                    <p class="text-sm text-gray-600">Rp {{ number_format($pricing['plans']['pro'], 0, ',', '.') }}/month</p>
                                </div>
                                <input type="radio" name="plan" value="pro" class="w-5 h-5 text-purple-600" checked>
                            </div>
                        </label>
                        <label class="border rounded-lg p-4 cursor-pointer hover:border-purple-500 transition-colors">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-semibold text-gray-900">Enterprise</p>
                                    <p class="text-sm text-gray-600">Starting from Rp {{ number_format($pricing['plans']['enterprise_min'], 0, ',', '.') }}</p>
                                </div>
                                <input type="radio" name="plan" value="enterprise" class="w-5 h-5 text-purple-600">
                            </div>
                        </label>
                    </div>
                    @error('plan')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div id="enterprisePriceField" class="hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Enterprise Price (Rp)</label>
                    <input type="number" name="requested_price" min="{{ $pricing['plans']['enterprise_min'] }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter amount">
                    @error('requested_price')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Transfer Proof</label>
                    <input type="file" name="proof" class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white">
                    <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, PDF. Max 5MB.</p>
                    @error('proof')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Notes (Optional)</label>
                    <textarea name="notes" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Add notes if needed..."></textarea>
                    @error('notes')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold py-3 rounded-lg hover:from-purple-700 hover:to-indigo-700">
                    Submit Request
                </button>
            </form>

            <div class="bg-white rounded-xl shadow p-6 space-y-4">
                <h2 class="text-lg font-semibold text-gray-900">Cost Summary</h2>
                <div class="space-y-2 text-sm">
                    <div class="flex items-center justify-between">
                        <span>Plan Price</span>
                        <span id="summaryBase">Rp {{ number_format($pricing['plans']['pro'], 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Tax ({{ $pricing['tax_rate'] * 100 }}%)</span>
                        <span id="summaryTax">Rp {{ number_format($pricing['plans']['pro'] * $pricing['tax_rate'], 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Admin Fee</span>
                        <span id="summaryAdmin">Rp {{ number_format($pricing['admin_fee'], 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t pt-2 flex items-center justify-between font-semibold">
                        <span>Total</span>
                        <span id="summaryTotal">Rp {{ number_format($pricing['plans']['pro'] + ($pricing['plans']['pro'] * $pricing['tax_rate']) + $pricing['admin_fee'], 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="border-t pt-4">
                    <h3 class="text-sm font-semibold text-gray-900 mb-2">Destination Accounts</h3>
                    <div class="space-y-2 text-sm text-gray-600">
                        @foreach($banks as $bank)
                            <div class="flex items-center justify-between">
                                <span>{{ $bank['name'] }}</span>
                                <span>{{ $bank['account_number'] ?? 'Not set' }}</span>
                            </div>
                        @endforeach
                    </div>
                    <p class="text-xs text-gray-500 mt-3">Account numbers will be updated in production.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const planInputs = document.querySelectorAll('input[name="plan"]');
        const enterpriseField = document.getElementById('enterprisePriceField');
        const enterpriseInput = document.querySelector('input[name="requested_price"]');
        const basePricePro = {{ $pricing['plans']['pro'] }};
        const enterpriseMin = {{ $pricing['plans']['enterprise_min'] }};
        const taxRate = {{ $pricing['tax_rate'] }};
        const adminFee = {{ $pricing['admin_fee'] }};

        const baseEl = document.getElementById('summaryBase');
        const taxEl = document.getElementById('summaryTax');
        const totalEl = document.getElementById('summaryTotal');

        const format = (value) => new Intl.NumberFormat('id-ID').format(value);

        const updateSummary = (base) => {
            const tax = Math.round(base * taxRate);
            const total = base + tax + adminFee;
            baseEl.textContent = `Rp ${format(base)}`;
            taxEl.textContent = `Rp ${format(tax)}`;
            totalEl.textContent = `Rp ${format(total)}`;
        };

        planInputs.forEach((input) => {
            input.addEventListener('change', () => {
                if (input.value === 'enterprise' && input.checked) {
                    enterpriseField.classList.remove('hidden');
                    updateSummary(enterpriseMin);
                    enterpriseInput.value = enterpriseMin;
                } else if (input.value === 'pro' && input.checked) {
                    enterpriseField.classList.add('hidden');
                    enterpriseInput.value = '';
                    updateSummary(basePricePro);
                }
            });
        });

        if (enterpriseInput) {
            enterpriseInput.addEventListener('input', (event) => {
                const value = parseInt(event.target.value || enterpriseMin, 10);
                updateSummary(Math.max(value, enterpriseMin));
            });
        }
    </script>
</x-app-layout>
