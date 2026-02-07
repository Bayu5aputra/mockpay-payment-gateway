@extends('layouts.public')

@section('title', 'MockPay Payment Sandbox')

@section('content')
    <section class="bg-[#eae6df] pt-28 pb-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-10 lg:p-12">
                <div class="grid gap-12 lg:grid-cols-2 lg:items-center">
                    <div class="space-y-7">
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-500">MockPay Sandbox</p>
                        <h1 class="text-4xl lg:text-5xl font-semibold text-slate-900 leading-tight">
                            Payment gateway sandbox for confident integration testing.
                        </h1>
                        <p class="text-base lg:text-lg text-slate-600">
                            Simulate every payment method, control outcomes per client, and keep data isolated. Built for teams
                            who want production-ready integrations without production risk.
                        </p>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 transition">
                                Start Free
                            </a>
                            <a href="{{ route('docs.index') }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 hover:text-slate-900 hover:border-slate-300 transition">
                                Read Docs
                            </a>
                        </div>
                        <div class="grid grid-cols-2 gap-6 pt-4 md:grid-cols-4">
                            @foreach($stats as $stat)
                                <div>
                                    <p class="text-xs uppercase tracking-[0.2em] text-slate-500">{{ $stat['label'] }}</p>
                                    <p class="text-2xl font-semibold text-slate-900 mt-2">{{ $stat['value'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute -top-6 -right-6 h-28 w-28 rounded-full bg-slate-900/10 blur-2xl"></div>
                        <div class="absolute -bottom-8 -left-6 h-24 w-24 rounded-full bg-amber-200/60 blur-2xl"></div>
                        <div class="rounded-[28px] bg-white/90 border border-white/70 shadow-[0_25px_60px_rgba(15,23,42,0.18)] p-6">
                            <div class="flex items-center justify-between">
                                <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Dashboard Preview</p>
                                <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-white text-xs font-semibold">MP</span>
                            </div>
                            <div class="mt-6 grid grid-cols-3 gap-4">
                                <div class="rounded-2xl bg-slate-900 text-white p-4">
                                    <p class="text-xs text-white/70">Transactions</p>
                                    <p class="text-xl font-semibold mt-3">1,248</p>
                                </div>
                                <div class="rounded-2xl bg-slate-100 p-4">
                                    <p class="text-xs text-slate-500">Success Rate</p>
                                    <p class="text-xl font-semibold text-slate-900 mt-3">96.4%</p>
                                </div>
                                <div class="rounded-2xl bg-slate-100 p-4">
                                    <p class="text-xs text-slate-500">Webhooks</p>
                                    <p class="text-xl font-semibold text-slate-900 mt-3">312</p>
                                </div>
                            </div>
                            <div class="mt-6 rounded-2xl bg-slate-100 p-4">
                                <div class="flex items-center justify-between text-xs text-slate-500">
                                    <span>Simulations</span>
                                    <span>Last 7 days</span>
                                </div>
                                <div class="mt-3 flex items-end gap-2 h-20">
                                    <div class="w-full rounded-t-lg bg-slate-300" style="height: 40%"></div>
                                    <div class="w-full rounded-t-lg bg-slate-400" style="height: 70%"></div>
                                    <div class="w-full rounded-t-lg bg-slate-500" style="height: 55%"></div>
                                    <div class="w-full rounded-t-lg bg-slate-600" style="height: 85%"></div>
                                    <div class="w-full rounded-t-lg bg-slate-700" style="height: 65%"></div>
                                </div>
                            </div>
                            <div class="mt-6 flex items-center justify-between text-xs text-slate-500">
                                <span>Sandbox environment</span>
                                <span class="inline-flex items-center gap-1 text-emerald-600 font-semibold">
                                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                    Active
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#eae6df] py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($features as $feature)
                    <div class="rounded-[24px] bg-white/80 border border-white/70 p-6 shadow-sm">
                        <div class="h-12 w-12 rounded-2xl bg-slate-900 text-white flex items-center justify-center text-sm font-semibold">
                            {{ strtoupper(substr($feature['icon'], 0, 1)) }}
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mt-5">{{ $feature['title'] }}</h3>
                        <p class="text-sm text-slate-600 mt-2">{{ $feature['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Supported Methods</p>
                    <h2 class="text-3xl lg:text-4xl font-semibold text-slate-900 mt-3">All channels your clients expect.</h2>
                    <p class="text-base text-slate-600 mt-4">
                        Cover every mainstream payment method with detailed instructions, realistic statuses, and webhook delivery.
                    </p>
                </div>
                <div class="grid gap-4">
                    @foreach($paymentMethods as $method)
                        <div class="rounded-[22px] border border-slate-200 bg-slate-50 px-5 py-4">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-slate-900">{{ $method['category'] }}</p>
                                <span class="text-xs text-slate-500">{{ count($method['items']) }} options</span>
                            </div>
                            <div class="mt-3 flex flex-wrap gap-2">
                                @foreach($method['items'] as $item)
                                    <span class="rounded-full bg-white px-3 py-1 text-xs text-slate-600 border border-slate-200">{{ $item }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#eae6df] py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto">
                <p class="text-xs uppercase tracking-[0.35em] text-slate-500">How It Works</p>
                <h2 class="text-3xl lg:text-4xl font-semibold text-slate-900 mt-3">From register to go live in minutes.</h2>
                <p class="text-base text-slate-600 mt-4">Structured steps that mirror real payment gateway integrations.</p>
            </div>
            <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-5">
                @foreach($steps as $step)
                    <div class="rounded-[22px] bg-white/80 border border-white/70 p-5 shadow-sm">
                        <div class="text-2xl font-semibold text-slate-900">{{ $step['number'] }}</div>
                        <h3 class="text-sm font-semibold text-slate-900 mt-3">{{ $step['title'] }}</h3>
                        <p class="text-xs text-slate-600 mt-2">{{ $step['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Testimonials</p>
                    <h2 class="text-3xl lg:text-4xl font-semibold text-slate-900 mt-3">Teams shipping faster with MockPay.</h2>
                </div>
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-5 py-2 text-sm font-semibold text-slate-700 hover:text-slate-900 hover:border-slate-300 transition">
                    Join them
                </a>
            </div>
            <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($testimonials as $testimonial)
                    <div class="rounded-[24px] border border-slate-200 bg-slate-50 p-6">
                        <div class="flex items-center gap-4">
                            <img src="{{ $testimonial['avatar'] }}" alt="{{ $testimonial['name'] }}" class="h-12 w-12 rounded-full object-cover">
                            <div>
                                <p class="text-sm font-semibold text-slate-900">{{ $testimonial['name'] }}</p>
                                <p class="text-xs text-slate-500">{{ $testimonial['role'] }}</p>
                            </div>
                        </div>
                        <p class="text-sm text-slate-700 mt-4">{{ $testimonial['content'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-[#0b0b0c] py-16">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-3xl lg:text-4xl font-semibold text-white">Ready to simulate with confidence?</h2>
            <p class="text-base text-white/70 mt-4">
                Spin up your sandbox and validate payment flows before you ship to production.
            </p>
            <div class="mt-8 flex flex-wrap justify-center gap-3">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-white px-6 py-3 text-sm font-semibold text-slate-900 shadow-sm hover:bg-slate-100 transition">
                    Create Free Account
                </a>
                <a href="{{ route('docs.index') }}" class="inline-flex items-center justify-center rounded-full border border-white/20 px-6 py-3 text-sm font-semibold text-white hover:border-white/40 transition">
                    View Documentation
                </a>
            </div>
        </div>
    </section>
@endsection
