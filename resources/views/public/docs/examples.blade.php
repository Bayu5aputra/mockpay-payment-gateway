{{-- resources/views/public/docs/examples.blade.php --}}
@extends('layouts.public')

@section('title', 'Code Examples - MockPay Documentation')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="{{ route('docs.index') }}" class="text-blue-600 hover:text-blue-800">Documentation</a></li>
                <li class="text-gray-500">/</li>
                <li class="text-gray-900 font-semibold">Code Examples</li>
            </ol>
        </nav>

        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-6">Code Examples</h1>
            <p class="text-gray-700 mb-8">Ready-to-use code snippets in various programming languages</p>

            @foreach($examples as $example)
            <div class="mb-8 pb-8 border-b border-gray-200 last:border-0">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $example['title'] }}</h2>
                    <button onclick="copyCode('{{ $loop->index }}')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Copy Code
                    </button>
                </div>
                <div class="bg-gray-900 text-gray-100 rounded-lg p-6 overflow-x-auto">
                    <pre id="code-{{ $loop->index }}"><code class="language-{{ $example['language'] }}">{{ $example['code'] }}</code></pre>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
function copyCode(index) {
    const codeElement = document.getElementById('code-' + index);
    const text = codeElement.textContent;
    
    navigator.clipboard.writeText(text).then(function() {
        alert('Code copied to clipboard!');
    }, function(err) {
        console.error('Could not copy text: ', err);
    });
}
</script>
@endsection