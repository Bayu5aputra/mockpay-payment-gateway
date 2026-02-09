@extends('layouts.public')

@section('title', 'Page Not Found')

@section('content')
    <section class="bg-[#eae6df] pt-24 pb-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-10 lg:p-12">
                <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
                    <div class="space-y-6">
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-500">MockPay</p>
                        <h1 class="text-4xl lg:text-5xl font-semibold text-slate-900 leading-tight">
                            404 — We lost the simulation trail.
                        </h1>
                        <p class="text-base lg:text-lg text-slate-600 max-w-xl">
                            The page you are looking for is not available. Return to the dashboard, explore the docs,
                            or head back to the landing page.
                        </p>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('home') }}"
                               class="inline-flex items-center justify-center rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 transition">
                                Back to Home
                            </a>
                            <a href="{{ route('docs.index') }}"
                               class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 hover:text-slate-900 hover:border-slate-300 transition">
                                View Documentation
                            </a>
                            <a href="{{ route('contact') }}"
                               class="inline-flex items-center justify-center rounded-full border border-transparent px-6 py-3 text-sm font-semibold text-slate-600 hover:text-slate-900 transition">
                                Contact Support
                            </a>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute -top-8 -right-8 h-28 w-28 rounded-full bg-slate-900/10 blur-2xl"></div>
                        <div class="absolute -bottom-8 -left-6 h-24 w-24 rounded-full bg-amber-200/60 blur-2xl"></div>
                        <div class="rounded-[28px] bg-white/90 border border-white/70 shadow-[0_25px_60px_rgba(15,23,42,0.18)] p-6 space-y-5">
                            <div class="flex items-center justify-between">
                                <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Status</p>
                                <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-slate-900 text-white text-xs font-semibold">404</span>
                            </div>
                            <div class="rounded-2xl bg-slate-900 text-white p-5">
                                <p class="text-xs text-white/70">Route</p>
                                <p class="text-lg font-semibold mt-2">Not Found</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div class="rounded-2xl bg-slate-100 p-4">
                                    <p class="text-xs text-slate-500">Suggested</p>
                                    <p class="text-base font-semibold text-slate-900 mt-2">Home</p>
                                </div>
                                <div class="rounded-2xl bg-slate-100 p-4">
                                    <p class="text-xs text-slate-500">Fallback</p>
                                    <p class="text-base font-semibold text-slate-900 mt-2">Docs</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-xs text-slate-500">
                                <span>MockPay Sandbox</span>
                                <span class="inline-flex items-center gap-1 text-emerald-600 font-semibold">
                                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                    Online
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
