<x-app-layout>
    <div class="p-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Profile Settings</h1>
            <p class="text-gray-600">Update your profile information and avatar.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow p-6 space-y-6">
            <div class="flex items-center gap-6">
                @if($user->avatar_url)
                    <img
                        src="{{ $user->avatar_url }}"
                        alt="{{ $user->name }}"
                        class="w-20 h-20 rounded-full border-2 border-purple-200 object-cover"
                        onerror="this.classList.add('hidden'); this.nextElementSibling?.classList.remove('hidden');"
                    >
                    <div class="hidden w-20 h-20 rounded-full bg-gradient-to-br from-purple-500 to-indigo-500 flex items-center justify-center text-white text-2xl font-bold border-2 border-purple-200">
                        {{ $user->initials }}
                    </div>
                @else
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-purple-500 to-indigo-500 flex items-center justify-center text-white text-2xl font-bold border-2 border-purple-200">
                        {{ $user->initials }}
                    </div>
                @endif
                <div>
                    <p class="text-sm text-gray-500">Avatar will use your Google photo if available.</p>
                    <p class="text-xs text-gray-400">If photo fails to load, initials will be shown.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('client.settings.profile.update') }}" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Avatar URL (optional)</label>
                    <input type="url" name="avatar" value="{{ old('avatar', $user->avatar) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="https://...">
                </div>
                <button class="px-6 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700">
                    Save Profile
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
