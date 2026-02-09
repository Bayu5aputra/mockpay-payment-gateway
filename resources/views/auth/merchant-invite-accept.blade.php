@extends('layouts.public')

@section('title', 'Accept Invitation')

@section('content')
    <section class="bg-[#eae6df] pt-24 pb-20">
        <div class="max-w-6xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-10 lg:p-12">
                <div class="grid gap-10 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
                    <div class="space-y-6">
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Invitation</p>
                        <h1 class="text-4xl lg:text-5xl font-semibold text-slate-900 leading-tight">
                            Join MockPay as a platform admin.
                        </h1>
                        <p class="text-base lg:text-lg text-slate-600 max-w-xl">
                            Complete your profile to activate the admin account and manage platform operations securely.
                        </p>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div class="rounded-2xl bg-white/80 border border-white/70 px-4 py-3">
                                <p class="text-xs text-slate-500">Invited Email</p>
                                <p class="text-sm font-semibold text-slate-900 mt-2">{{ $invitation->email }}</p>
                            </div>
                            <div class="rounded-2xl bg-white/80 border border-white/70 px-4 py-3">
                                <p class="text-xs text-slate-500">Invited By</p>
                                <p class="text-sm font-semibold text-slate-900 mt-2">{{ $invitation->inviter?->company_name ?? $invitation->inviter?->name ?? 'MockPay Platform' }}</p>
                            </div>
                            <div class="rounded-2xl bg-white/80 border border-white/70 px-4 py-3">
                                <p class="text-xs text-slate-500">Status</p>
                                <p class="text-sm font-semibold text-slate-900 mt-2">{{ strtoupper($invitation->status) }}</p>
                            </div>
                            <div class="rounded-2xl bg-white/80 border border-white/70 px-4 py-3">
                                <p class="text-xs text-slate-500">Expires</p>
                                <p class="text-sm font-semibold text-slate-900 mt-2">{{ $invitation->expires_at?->format('d M Y, H:i') ?? 'No expiry' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[28px] bg-white/90 border border-white/70 shadow-[0_25px_60px_rgba(15,23,42,0.18)] p-6 lg:p-8">
                        <h2 class="text-xl font-semibold text-slate-900">Create Admin Account</h2>
                        <p class="text-sm text-slate-600 mt-2">Use your invitation details to finish setup.</p>

                        @if($errors->any())
                            <div class="mt-4 rounded-2xl border border-rose-200 bg-rose-50/80 p-4">
                                <p class="text-rose-700 text-sm font-medium">Please fix the errors below.</p>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('merchant-invitations.accept.submit', $invitation->token) }}" class="mt-6 space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Email (invited)</label>
                                <input type="email" value="{{ $invitation->email }}" disabled class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm text-slate-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Full Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-900/20" required>
                                @error('name')
                                    <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Company Name</label>
                                <input type="text" name="company_name" value="{{ old('company_name') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-900/20" required>
                                @error('company_name')
                                    <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Phone</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-900/20" required>
                                    @error('phone')
                                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Business Type</label>
                                    <select name="business_type" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-900/20" required>
                                        <option value="ecommerce" @selected(old('business_type') === 'ecommerce')>Ecommerce</option>
                                        <option value="marketplace" @selected(old('business_type') === 'marketplace')>Marketplace</option>
                                        <option value="subscription" @selected(old('business_type') === 'subscription')>Subscription</option>
                                        <option value="donation" @selected(old('business_type') === 'donation')>Donation</option>
                                        <option value="other" @selected(old('business_type') === 'other')>Other</option>
                                    </select>
                                    @error('business_type')
                                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                                <input type="password" name="password" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-900/20" required>
                                @error('password')
                                    <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-900/20" required>
                            </div>
                            <button class="w-full px-6 py-3 rounded-2xl bg-slate-900 text-white text-sm font-semibold hover:bg-slate-800 transition">
                                Activate Admin Account
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
