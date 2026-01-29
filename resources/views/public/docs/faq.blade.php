{{-- resources/views/public/docs/faq.blade.php --}}
@extends('layouts.public')

@section('title', 'FAQ - MockPay Documentation')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="{{ route('docs.index') }}" class="text-blue-600 hover:text-blue-800">Documentation</a></li>
                <li class="text-gray-500">/</li>
                <li class="text-gray-900 font-semibold">FAQ</li>
            </ol>
        </nav>

        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-6">Frequently Asked Questions</h1>
            <p class="text-gray-700 mb-8">Find answers to common questions about MockPay</p>

            <div class="space-y-6">
                @foreach($faqs as $faq)
                <details class="border border-gray-200 rounded-lg p-6 hover:border-blue-600 transition-colors">
                    <summary class="cursor-pointer font-semibold text-gray-900 text-lg">
                        {{ $faq['question'] }}
                    </summary>
                    <div class="mt-4 text-gray-700 leading-relaxed">
                        {{ $faq['answer'] }}
                    </div>
                </details>
                @endforeach
            </div>

            <div class="mt-12 bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-xl p-8 text-white text-center">
                <h2 class="text-2xl font-bold mb-4">Still have questions?</h2>
                <p class="text-lg mb-6">Our support team is here to help</p>
                <div class="flex justify-center gap-4">
                    <a href="{{ route('contact') }}" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        Contact Support
                    </a>
                    <a href="{{ route('docs.index') }}" class="bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-600 transition-colors">
                        Browse Docs
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection