<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-4xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Notifications</h1>
            <p class="text-slate-600">Manage your email and webhook notification preferences</p>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 mb-6">
                <p class="text-emerald-700 font-medium">{{ session('success') }}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-rose-50 border border-rose-200 rounded-xl p-4 mb-6">
                <p class="text-rose-700 font-medium">{{ session('error') }}</p>
            </div>
        @endif

        <div class="bg-white/80 border border-white/70 rounded-[24px] shadow-sm p-6 max-w-2xl">
            <form method="POST" action="{{ route('dashboard.settings.notifications.update') }}" class="space-y-4">
                @csrf
                @method('PUT')

                <label class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-700">Email Notifications</p>
                        <p class="text-xs text-slate-500">Receive emails for important events</p>
                    </div>
                    <input type="checkbox" name="email_notifications" value="1" {{ $merchant->email_notifications ? 'checked' : '' }} class="w-5 h-5 text-slate-900 rounded border-slate-300 focus:ring-slate-900/20">
                </label>

                <label class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-700">Webhook Notifications</p>
                        <p class="text-xs text-slate-500">Enable webhook event delivery</p>
                    </div>
                    <input type="checkbox" name="webhook_notifications" value="1" {{ $merchant->webhook_notifications ? 'checked' : '' }} class="w-5 h-5 text-slate-900 rounded border-slate-300 focus:ring-slate-900/20">
                </label>

                <button type="submit" class="px-6 py-3 bg-slate-900 text-white rounded-full text-sm font-semibold hover:bg-slate-800 shadow-sm transition">
                    Save Preferences
                </button>
            </form>
        </div>
            </div>
        </div>
    </div>
</x-app-layout>
