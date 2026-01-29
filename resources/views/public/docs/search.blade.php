@extends('layouts.docs')

@section('title', 'Search Results - MockPay Documentation')

@section('doc-content')
<div class="bg-white rounded-lg shadow-md p-8">
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm">
            <li><a href="{{ route('docs.index') }}" class="text-blue-600 hover:text-blue-800">Documentation</a></li>
            <li class="text-gray-500">/</li>
            <li class="text-gray-900 font-semibold">Search</li>
        </ol>
    </nav>

    <h1 class="text-3xl font-bold text-gray-900 mb-6">Search Results</h1>
    
    <form action="{{ route('docs.search') }}" method="GET" class="mb-8">
        <div class="relative">
            <input type="text" 
                   name="q" 
                   value="{{ $query }}"
                   placeholder="Search documentation..." 
                   class="w-full px-6 py-4 pr-12 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <button type="submit" class="absolute right-4 top-1/2 transform -translate-y-1/2">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>
        </div>
    </form>

    @if($query)
        @if(count($results) > 0)
            <p class="text-gray-600 mb-6">Found {{ count($results) }} results for "{{ $query }}"</p>
            <div class="space-y-4">
                @foreach($results as $result)
                <div class="border border-gray-200 rounded-lg p-6 hover:border-blue-600 hover:shadow-md transition-all">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        <a href="{{ $result['url'] }}" class="hover:text-blue-600">{{ $result['title'] }}</a>
                    </h3>
                    <p class="text-gray-600 mb-2">{{ $result['excerpt'] }}</p>
                    <a href="{{ $result['url'] }}" class="text-blue-600 hover:text-blue-800 text-sm">Read more →</a>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M12 12h.01M12 12h.01M12 12h.01"></path>
                </svg>
                <h3 class="mt-2 text-xl font-medium text-gray-900">No results found</h3>
                <p class="mt-1 text-gray-500">We couldn't find anything matching "{{ $query }}"</p>
                <p class="mt-4 text-sm text-gray-600">Try searching with different keywords or browse our documentation:</p>
                <div class="mt-6">
                    <a href="{{ route('docs.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200">
                        Browse Documentation
                    </a>
                </div>
            </div>
        @endif
    @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <h3 class="mt-2 text-lg font-medium text-gray-900">Start searching</h3>
            <p class="mt-1 text-gray-500">Enter a search query to find documentation</p>
        </div>
    @endif
</div>
@endsection