@extends('layouts.public')

@section('title', 'Pricing')

@section('content')
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-cyan-900 pt-24 pb-20">
        <div class="absolute inset-0">
            <div class="absolute -top-20 -left-20 h-72 w-72 rounded-full bg-cyan-400/20 blur-3xl"></div>
            <div class="absolute top-24 -right-24 h-96 w-96 rounded-full bg-emerald-400/10 blur-3xl"></div>
            <div class="absolute bottom-0 left-1/2 h-64 w-64 -translate-x-1/2 rounded-full bg-blue-400/10 blur-3xl"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-6">
            <div class="max-w-2xl">
                <p class="text-sm uppercase tracking-[0.3em] text-cyan-300 font-semibold">Pricing</p>
                <h1 class="text-4xl md:text-5xl font-bold mt-4 text-white">Simple, flexible plans for developer teams</h1>
                <p class="text-cyan-100 mt-4">Choose a plan that fits your payment testing needs. Upgrade anytime with no hidden fees.</p>
                <div class="mt-8 flex flex-wrap gap-4">
                    <div class="flex items-center gap-3 rounded-xl bg-white/10 px-4 py-3 text-white ring-1 ring-white/20">
                        <span class="inline-flex h-2 w-2 rounded-full bg-emerald-400"></span>
                        <span class="text-sm">Fast setup for sandbox and QA</span>
                    </div>
                    <div class="flex items-center gap-3 rounded-xl bg-white/10 px-4 py-3 text-white ring-1 ring-white/20">
                        <span class="text-sm">Enterprise-grade SLA support</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-slate-50 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($plans as $plan)
                    <div class="relative rounded-3xl border {{ $plan['popular'] ? 'border-cyan-500 shadow-2xl' : 'border-slate-200 shadow-lg' }} p-8 bg-white">
                        @if($plan['popular'])
                            <span class="absolute -top-3 left-6 bg-gradient-to-r from-cyan-500 to-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Most Popular</span>
                        @endif
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-900">{{ $plan['name'] }}</h3>
                            <span class="text-xs uppercase tracking-wider text-slate-500">{{ $plan['period'] }}</span>
                        </div>
                        <p class="text-gray-600 mt-3">{{ $plan['description'] }}</p>
                        <div class="mt-6 flex items-end gap-2">
                            <span class="text-4xl font-bold text-gray-900">{{ $plan['price'] }}</span>
                            <span class="text-sm text-gray-500">per {{ $plan['period'] }}</span>
                        </div>
                        <a href="{{ $plan['cta_url'] }}" class="mt-6 block text-center px-4 py-3 rounded-xl font-semibold {{ $plan['popular'] ? 'bg-gradient-to-r from-cyan-600 to-blue-700 text-white' : 'bg-slate-900 text-white' }}">
                            {{ $plan['cta'] }}
                        </a>
                        <div class="mt-6 space-y-3 text-sm text-gray-700">
                            @foreach($plan['features'] as $feature)
                                <div class="flex items-start gap-2">
                                    <div class="mt-0.5 text-emerald-600">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <span>{{ $feature }}</span>
                                </div>
                            @endforeach
                        </div>
                        @if($plan['popular'])
                            <div class="mt-6 rounded-xl bg-cyan-50 px-4 py-3 text-sm text-cyan-700">
                                Best for teams that run high-volume payment simulations.
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Feature comparison</h2>
                <p class="text-sm text-gray-500">Full details for each plan</p>
            </div>
            <div class="overflow-x-auto bg-white rounded-3xl border border-slate-200 shadow-lg">
                <table class="min-w-full text-sm">
                    <thead class="bg-slate-100 text-gray-700">
                        <tr>
                            <th class="text-left px-6 py-4">Feature</th>
                            <th class="text-left px-6 py-4">Free</th>
                            <th class="text-left px-6 py-4">Pro</th>
                            <th class="text-left px-6 py-4">Enterprise</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach($comparison as $row)
                            <tr class="bg-white">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $row['feature'] }}</td>
                                <td class="px-6 py-4 text-gray-600">
                                    @if(is_bool($row['free']))
                                        @if($row['free'])
                                            <span class="inline-flex items-center gap-2 text-emerald-700">
                                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Yes
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-2 text-slate-400">
                                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                No
                                            </span>
                                        @endif
                                    @else
                                        {{ $row['free'] }}
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    @if(is_bool($row['pro']))
                                        @if($row['pro'])
                                            <span class="inline-flex items-center gap-2 text-emerald-700">
                                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Yes
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-2 text-slate-400">
                                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                No
                                            </span>
                                        @endif
                                    @else
                                        {{ $row['pro'] }}
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    @if(is_bool($row['enterprise']))
                                        @if($row['enterprise'])
                                            <span class="inline-flex items-center gap-2 text-emerald-700">
                                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Yes
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-2 text-slate-400">
                                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                No
                                            </span>
                                        @endif
                                    @else
                                        {{ $row['enterprise'] }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="bg-slate-950 py-16">
        <div class="max-w-5xl mx-auto px-6 text-white">
            <div class="rounded-3xl bg-gradient-to-r from-cyan-600 to-blue-700 p-10 shadow-2xl">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <h2 class="text-3xl font-bold">Need a custom plan?</h2>
                        <p class="text-cyan-100 mt-3">Enterprise teams get SLAs, priority support, and tailored features at scale.</p>
                    </div>
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center rounded-xl bg-white px-6 py-3 font-semibold text-slate-900">Contact Sales</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-16">
        <div class="max-w-4xl mx-auto px-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">FAQ</h2>
            <div class="space-y-4">
                @foreach($faqs as $faq)
                    <div class="border border-slate-200 rounded-2xl p-6 bg-slate-50">
                        <h3 class="font-semibold text-gray-900">{{ $faq['question'] }}</h3>
                        <p class="text-gray-600 mt-2">{{ $faq['answer'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
