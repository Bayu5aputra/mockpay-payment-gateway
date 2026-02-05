<x-app-layout>
    <div class="p-8">
        <div class="bg-white rounded-xl shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-4">Request Withdrawal</h1>
            <form method="POST" action="{{ route('dashboard.settlements.withdraw') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Amount</label>
                    <input type="number" name="amount" min="10000" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700">
                    Submit Request
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
