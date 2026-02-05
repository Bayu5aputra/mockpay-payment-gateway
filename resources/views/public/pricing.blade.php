@extends('layouts.public')

@section('title', 'Pricing')

@section('content')
    <section class="bg-gray-950 text-white pt-20 pb-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="max-w-2xl">
                <p class="text-sm uppercase tracking-widest text-purple-400 font-semibold">Pricing</p>
                <h1 class="text-4xl md:text-5xl font-bold mt-4">Paket sederhana, fleksibel untuk tim developer</h1>
                <p class="text-gray-300 mt-4">Pilih plan yang sesuai kebutuhan testing integrasi pembayaran kamu.</p>
            </div>
        </div>
    </section>

    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($plans as $plan)
                    <div class="rounded-2xl border {{ $plan['popular'] ? 'border-purple-500 shadow-xl' : 'border-gray-200 shadow-md' }} p-8 bg-white relative">
                        @if($plan['popular'])
                            <span class="absolute -top-3 left-6 bg-purple-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Most Popular</span>
                        @endif
                        <h3 class="text-xl font-bold text-gray-900">{{ $plan['name'] }}</h3>
                        <p class="text-gray-600 mt-2">{{ $plan['description'] }}</p>
                        <div class="mt-6">
                            <span class="text-3xl font-bold text-gray-900">{{ $plan['price'] }}</span>
                            <span class="text-sm text-gray-500"> / {{ $plan['period'] }}</span>
                        </div>
                        <a href="{{ $plan['cta_url'] }}" class="mt-6 block text-center px-4 py-3 rounded-lg font-semibold {{ $plan['popular'] ? 'bg-gradient-to-r from-purple-600 to-indigo-600 text-white' : 'bg-gray-900 text-white' }}">
                            {{ $plan['cta'] }}
                        </a>
                        <ul class="mt-6 space-y-2 text-sm text-gray-600">
                            @foreach($plan['features'] as $feature)
                                <li class="flex items-start gap-2">
                                    <span class="text-green-500 mt-1">•</span>
                                    <span>{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Perbandingan fitur</h2>
            <div class="overflow-x-auto bg-white rounded-2xl border border-gray-200 shadow-md">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="text-left px-6 py-4">Feature</th>
                            <th class="text-left px-6 py-4">Free</th>
                            <th class="text-left px-6 py-4">Pro</th>
                            <th class="text-left px-6 py-4">Enterprise</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($comparison as $row)
                            <tr>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $row['feature'] }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ is_bool($row['free']) ? ($row['free'] ? '✓' : '—') : $row['free'] }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ is_bool($row['pro']) ? ($row['pro'] ? '✓' : '—') : $row['pro'] }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ is_bool($row['enterprise']) ? ($row['enterprise'] ? '✓' : '—') : $row['enterprise'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="bg-white py-16">
        <div class="max-w-4xl mx-auto px-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">FAQ</h2>
            <div class="space-y-4">
                @foreach($faqs as $faq)
                    <div class="border border-gray-200 rounded-xl p-6">
                        <h3 class="font-semibold text-gray-900">{{ $faq['question'] }}</h3>
                        <p class="text-gray-600 mt-2">{{ $faq['answer'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
