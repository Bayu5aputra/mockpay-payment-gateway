<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Upgrade Request</p>
                        <h1 class="text-4xl font-semibold text-slate-900 mt-2">Request Upgrade</h1>
                        <p class="text-sm text-slate-600 mt-2">Fill out the form and upload your transfer proof with the correct amount.</p>
                    </div>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:text-slate-900 hover:border-slate-300 transition">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h6m-6 8h10a2 2 0 002-2V6a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Contact Support
                    </a>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <form method="POST" action="{{ route('client.upgrade-requests.store') }}" enctype="multipart/form-data" class="lg:col-span-2 bg-white rounded-[28px] shadow-sm border border-white/70 p-6 space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Select Plan</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="border border-slate-200 rounded-2xl p-4 cursor-pointer hover:border-slate-400 transition-colors bg-white/90">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-semibold text-slate-900">Pro</p>
                                    <p class="text-sm text-slate-600">Rp {{ number_format($pricing['plans']['pro'], 0, ',', '.') }}/month</p>
                                </div>
                                <input type="radio" name="plan" value="pro" class="w-5 h-5 text-slate-900" checked>
                            </div>
                        </label>
                        <label class="border border-slate-200 rounded-2xl p-4 cursor-pointer hover:border-slate-400 transition-colors bg-white/90">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-semibold text-slate-900">Enterprise</p>
                                    <p class="text-sm text-slate-600">Starting from Rp {{ number_format($pricing['plans']['enterprise_min'], 0, ',', '.') }}</p>
                                </div>
                                <input type="radio" name="plan" value="enterprise" class="w-5 h-5 text-slate-900">
                            </div>
                        </label>
                    </div>
                    @error('plan')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div id="enterprisePriceField" class="hidden">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Enterprise Price (Rp)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center gap-2 text-slate-500">
                            <div class="h-8 w-8 rounded-full bg-slate-100 flex items-center justify-center">
                                <svg class="h-4 w-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-semibold">Rp</span>
                        </div>
                        <input id="enterprisePriceDisplay" type="text" inputmode="numeric" class="w-full rounded-2xl border border-slate-200 bg-white/90 pl-20 pr-4 py-3 text-lg font-semibold text-slate-900 tracking-wide focus:outline-none focus:ring-2 focus:ring-slate-900/20" placeholder="1.000.000">
                        <input id="enterprisePriceValue" type="hidden" name="requested_price" min="{{ $pricing['plans']['enterprise_min'] }}">
                    </div>
                    @error('requested_price')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Transfer Proof</label>
                    <input id="proofInput" type="file" name="proof" class="hidden" accept="image/*,application/pdf">
                    <label id="proofUploadCta" for="proofInput" class="group block rounded-2xl border border-dashed border-slate-300 bg-white/90 p-6 text-center cursor-pointer hover:border-slate-400 hover:bg-white transition">
                        <div class="flex flex-col items-center gap-2 text-slate-600">
                            <div class="h-12 w-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 group-hover:text-slate-700">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h10a4 4 0 000-8h-1.1A5.002 5.002 0 006 10.1V11a4 4 0 00-3 4z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12v7m0 0l-3-3m3 3l3-3"></path>
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-slate-700">Click to upload</p>
                            <p class="text-xs text-slate-500">JPG, PNG, or PDF. Max 5MB.</p>
                        </div>
                    </label>
                    <div id="proofPreview" class="mt-4 hidden">
                        <div class="rounded-2xl border border-slate-200 bg-white/90 p-4 flex items-center gap-4">
                            <div id="proofPreviewThumb" class="h-16 w-16 rounded-xl bg-slate-100 flex items-center justify-center overflow-hidden">
                                <svg class="h-7 w-7 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V7l-5-5H7a2 2 0 00-2 2v15a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p id="proofPreviewName" class="text-sm font-semibold text-slate-900 truncate"></p>
                                <p id="proofPreviewMeta" class="text-xs text-slate-500"></p>
                            </div>
                        </div>
                        <label for="proofInput" class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-slate-700 hover:text-slate-900 cursor-pointer">
                            <span>Change file</span>
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </label>
                    </div>
                    @error('proof')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Notes (Optional)</label>
                    <textarea name="notes" rows="4" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-900/20" placeholder="Add notes if needed..."></textarea>
                    @error('notes')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-slate-900 text-white font-semibold py-3 rounded-2xl hover:bg-slate-800 transition">
                    Submit Request
                </button>
            </form>

                    <div class="bg-white rounded-[28px] shadow-sm border border-white/70 p-6 space-y-4">
                        <h2 class="text-lg font-semibold text-slate-900">Cost Summary</h2>
                        <div class="space-y-2 text-sm text-slate-600">
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
                    <div class="border-t border-slate-200 pt-2 flex items-center justify-between font-semibold text-slate-900">
                        <span>Total</span>
                        <span id="summaryTotal">Rp {{ number_format($pricing['plans']['pro'] + ($pricing['plans']['pro'] * $pricing['tax_rate']) + $pricing['admin_fee'], 0, ',', '.') }}</span>
                    </div>
                </div>

                        <div class="border-t border-slate-200 pt-4">
                            <h3 class="text-sm font-semibold text-slate-900 mb-2">Destination Accounts</h3>
                            <div class="space-y-2 text-sm text-slate-600">
                        @foreach($banks as $bank)
                            <div class="flex items-center justify-between">
                                <span>{{ $bank['name'] }}</span>
                                <span>{{ $bank['account_number'] ?? 'Not set' }}</span>
                            </div>
                        @endforeach
                    </div>
                            <p class="text-xs text-slate-500 mt-3">Account numbers will be updated in production.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script>
        const planInputs = document.querySelectorAll('input[name="plan"]');
        const enterpriseField = document.getElementById('enterprisePriceField');
        const enterpriseValueInput = document.getElementById('enterprisePriceValue');
        const enterpriseDisplayInput = document.getElementById('enterprisePriceDisplay');
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

        const normalizeEnterpriseValue = (rawValue) => {
            const numeric = parseInt(String(rawValue).replace(/\D/g, ''), 10);
            if (!numeric || Number.isNaN(numeric)) {
                return enterpriseMin;
            }
            return Math.max(numeric, enterpriseMin);
        };

        planInputs.forEach((input) => {
            input.addEventListener('change', () => {
                if (input.value === 'enterprise' && input.checked) {
                    enterpriseField.classList.remove('hidden');
                    const normalized = normalizeEnterpriseValue(enterpriseValueInput.value);
                    enterpriseValueInput.value = normalized;
                    if (enterpriseDisplayInput) {
                        enterpriseDisplayInput.value = format(normalized);
                    }
                    updateSummary(normalized);
                } else if (input.value === 'pro' && input.checked) {
                    enterpriseField.classList.add('hidden');
                    enterpriseValueInput.value = '';
                    if (enterpriseDisplayInput) {
                        enterpriseDisplayInput.value = '';
                    }
                    updateSummary(basePricePro);
                }
            });
        });

        if (enterpriseDisplayInput) {
            enterpriseDisplayInput.addEventListener('input', (event) => {
                const normalized = normalizeEnterpriseValue(event.target.value);
                enterpriseDisplayInput.value = format(normalized);
                enterpriseValueInput.value = normalized;
                updateSummary(normalized);
            });
        }

        const proofInput = document.getElementById('proofInput');
        const proofPreview = document.getElementById('proofPreview');
        const proofUploadCta = document.getElementById('proofUploadCta');
        const proofPreviewThumb = document.getElementById('proofPreviewThumb');
        const proofPreviewName = document.getElementById('proofPreviewName');
        const proofPreviewMeta = document.getElementById('proofPreviewMeta');

        if (proofInput) {
            proofInput.addEventListener('change', (event) => {
                const file = event.target.files?.[0];
                if (!file) {
                    proofPreview.classList.add('hidden');
                    proofUploadCta.classList.remove('hidden');
                    return;
                }

                proofPreview.classList.remove('hidden');
                proofUploadCta.classList.add('hidden');
                proofPreviewName.textContent = file.name;
                proofPreviewMeta.textContent = `${Math.round(file.size / 1024)} KB`;

                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        proofPreviewThumb.innerHTML = `<img src="${e.target.result}" alt="Preview" class="h-full w-full object-cover">`;
                    };
                    reader.readAsDataURL(file);
                } else {
                    proofPreviewThumb.innerHTML = `<svg class="h-7 w-7 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V7l-5-5H7a2 2 0 00-2 2v15a2 2 0 002 2z"></path></svg>`;
                }
            });
        }
    </script>
</x-app-layout>
