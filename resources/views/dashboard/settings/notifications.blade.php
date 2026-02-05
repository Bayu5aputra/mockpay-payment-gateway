<x-app-layout>
    <div class="p-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Notifications</h1>
            <p class="text-gray-600">Manage your email and webhook notification preferences</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <p class="text-red-800 font-medium">{{ session('error') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-md p-6 max-w-2xl">
            <form method="POST" action="{{ route('dashboard.settings.notifications.update') }}" class="space-y-4">
                @csrf
                @method('PUT')

                <label class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-700">Email Notifications</p>
                        <p class="text-xs text-gray-500">Receive emails for important events</p>
                    </div>
                    <input type="checkbox" name="email_notifications" value="1" {{ $merchant->email_notifications ? 'checked' : '' }} class="w-5 h-5 text-purple-600 rounded">
                </label>

                <label class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-700">Webhook Notifications</p>
                        <p class="text-xs text-gray-500">Enable webhook event delivery</p>
                    </div>
                    <input type="checkbox" name="webhook_notifications" value="1" {{ $merchant->webhook_notifications ? 'checked' : '' }} class="w-5 h-5 text-purple-600 rounded">
                </label>

                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700">
                    Save Preferences
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
