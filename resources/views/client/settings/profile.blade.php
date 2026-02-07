<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-6xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
                <div class="flex flex-col gap-3">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Profile Settings</p>
                    <h1 class="text-4xl font-semibold text-slate-900">Profile Settings</h1>
                    <p class="text-sm text-slate-600">Update your profile information and avatar.</p>
                </div>

                @if(session('success'))
                    <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4">
                        <p class="text-emerald-700 font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                <div class="bg-white/80 border border-white/70 rounded-[28px] shadow-sm p-6 space-y-6">
                    <div class="flex flex-wrap items-center gap-6">
                        @if($user->avatar_url)
                            <img
                                src="{{ $user->avatar_url }}"
                                alt="{{ $user->name }}"
                                class="w-20 h-20 rounded-full border-2 border-white/80 object-cover shadow-sm"
                                onerror="this.classList.add('hidden'); this.nextElementSibling?.classList.remove('hidden');"
                            >
                            <div class="hidden w-20 h-20 rounded-full bg-gradient-to-br from-slate-900 via-slate-800 to-slate-700 flex items-center justify-center text-white text-2xl font-bold border-2 border-white/80 shadow-sm">
                                {{ $user->initials }}
                            </div>
                        @else
                            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-slate-900 via-slate-800 to-slate-700 flex items-center justify-center text-white text-2xl font-bold border-2 border-white/80 shadow-sm">
                                {{ $user->initials }}
                            </div>
                        @endif
                        <div>
                            <p class="text-sm text-slate-600">Avatar will use your Google photo if available.</p>
                            <p class="text-xs text-slate-500">If photo fails to load, initials will be shown.</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('client.settings.profile.update') }}" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 bg-white text-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 bg-white text-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Avatar URL (optional)</label>
                            <input type="url" name="avatar" value="{{ old('avatar', $user->avatar) }}" class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 bg-white text-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-300" placeholder="https://...">
                        </div>
                        <button class="inline-flex items-center justify-center rounded-full bg-slate-900 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 transition">
                            Save Profile
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
