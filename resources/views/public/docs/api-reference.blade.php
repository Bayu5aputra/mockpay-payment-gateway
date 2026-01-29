{{-- resources/views/public/docs/api-reference.blade.php --}}
@extends('layouts.public')

@section('title', 'API Reference - MockPay Documentation')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="{{ route('docs.index') }}" class="text-blue-600 hover:text-blue-800">Documentation</a></li>
                <li class="text-gray-500">/</li>
                <li class="text-gray-900 font-semibold">API Reference</li>
            </ol>
        </nav>

        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-6">API Reference</h1>
            <p class="text-gray-700 mb-8">Complete reference for all MockPay API endpoints</p>

            @foreach($endpoints as $endpoint)
            <div class="mb-8 pb-8 border-b border-gray-200 last:border-0">
                <div class="flex items-center mb-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                        @if($endpoint['method'] == 'POST') bg-green-100 text-green-800
                        @elseif($endpoint['method'] == 'GET') bg-blue-100 text-blue-800
                        @elseif($endpoint['method'] == 'PUT') bg-yellow-100 text-yellow-800
                        @elseif($endpoint['method'] == 'DELETE') bg-red-100 text-red-800
                        @endif">
                        {{ $endpoint['method'] }}
                    </span>
                    <code class="ml-3 text-lg font-mono text-gray-900">{{ $endpoint['path'] }}</code>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $endpoint['title'] }}</h3>
                <p class="text-gray-600 mb-4">{{ $endpoint['description'] }}</p>
                
                <details class="mt-4">
                    <summary class="cursor-pointer text-blue-600 hover:text-blue-800 font-semibold">View Details</summary>
                    <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-600">Full documentation coming soon. Check <a href="{{ route('docs.examples') }}" class="text-blue-600 hover:underline">code examples</a> for usage.</p>
                    </div>
                </details>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection