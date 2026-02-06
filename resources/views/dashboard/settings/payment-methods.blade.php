<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-6xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('dashboard.settings.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Settings
            </a>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Payment Methods</h1>
            <p class="text-gray-600">Configure available payment channels for your customers</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <form method="POST" action="{{ route('dashboard.settings.payment-methods.update') }}">
            @csrf
            @method('PUT')

            @foreach ($paymentMethods as $key => $method)
                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <div class="flex items-center justify-between gap-4 mb-6">
                        <div class="flex items-center space-x-4">
                            <img src="{{ asset('logo.png') }}" alt="MockPay" class="w-12 h-12 rounded-lg object-contain bg-gray-50 p-2">
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">{{ $method['name'] }}</h2>
                                <p class="text-sm text-gray-600">{{ ucfirst(str_replace('_', ' ', $key)) }}</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="methods[{{ $key }}][enabled]" value="1" checked class="sr-only peer">
                            <div class="w-12 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[3px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                        </label>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($method['channels'] as $channel)
                            <label class="border border-gray-200 rounded-lg p-4 hover:border-purple-400 cursor-pointer transition-colors block">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ strtoupper(str_replace('_', ' ', $channel)) }}</p>
                                        <p class="text-xs text-gray-500 mt-1">Enabled</p>
                                    </div>
                                    <input type="checkbox" name="methods[{{ $key }}][channels][{{ $channel }}]" value="1" checked class="mt-1 w-5 h-5 text-purple-600 rounded">
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700">
                    Save Changes
                </button>
            </div>
        </form>
            </div>
        </div>
    </div>
</x-app-layout>
