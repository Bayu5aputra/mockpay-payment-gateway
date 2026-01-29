@extends('layouts.docs')

@section('title', 'Payment Methods - MockPay Documentation')

@section('doc-content')
<div class="bg-white rounded-lg shadow-md p-8">
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm">
            <li><a href="{{ route('docs.index') }}" class="text-blue-600 hover:text-blue-800">Documentation</a></li>
            <li class="text-gray-500">/</li>
            <li class="text-gray-900 font-semibold">Payment Methods</li>
        </ol>
    </nav>

    <h1 class="text-4xl font-bold text-gray-900 mb-6">Payment Methods</h1>
    <p class="text-gray-700 mb-8">MockPay supports all major Indonesian payment methods</p>

    @foreach($methods as $method)
    <div id="{{ $method['id'] }}" class="mb-8 pb-8 border-b border-gray-200 last:border-0">
        <h2 class="text-2xl font-bold text-gray-900 mb-3">{{ $method['title'] }}</h2>
        <p class="text-gray-600 mb-4">{{ $method['description'] }}</p>
        
        <h3 class="text-lg font-semibold text-gray-900 mb-3">Available Channels:</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            @foreach($method['channels'] as $channel)
            <div class="border border-gray-200 rounded-lg p-3 text-center">
                <span class="text-sm font-medium text-gray-900">{{ $channel }}</span>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
@endsection