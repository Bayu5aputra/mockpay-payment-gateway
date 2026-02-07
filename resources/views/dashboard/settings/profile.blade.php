<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-4xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('dashboard.settings.index') }}" class="inline-flex items-center text-slate-600 hover:text-slate-900 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Settings
            </a>
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Profile Settings</h1>
            <p class="text-slate-600">Manage your personal information and preferences</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Picture -->
            <div class="lg:col-span-1">
                <div class="bg-white/80 border border-white/70 rounded-[24px] shadow-sm p-6">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">Profile Picture</h2>
                    <div class="text-center">
                        @if(Auth::user()->avatar_url)
                            <img
                                src="{{ Auth::user()->avatar_url }}"
                                alt="{{ Auth::user()->name }}"
                                class="w-40 h-40 rounded-full mx-auto mb-4 border-4 border-white/80 object-cover shadow-sm"
                                onerror="this.classList.add('hidden'); this.nextElementSibling?.classList.remove('hidden');"
                            >
                            <div class="hidden w-40 h-40 rounded-full mx-auto mb-4 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-700 flex items-center justify-center text-white text-5xl font-bold border-4 border-white/80 shadow-sm">
                                {{ Auth::user()->initials }}
                            </div>
                        @else
                            <div class="w-40 h-40 rounded-full mx-auto mb-4 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-700 flex items-center justify-center text-white text-5xl font-bold border-4 border-white/80 shadow-sm">
                                {{ Auth::user()->initials }}
                            </div>
                        @endif
                        <button class="px-6 py-2 bg-slate-900 text-white rounded-full text-sm font-semibold hover:bg-slate-800 shadow-sm mb-2 transition">
                            Upload New Photo
                        </button>
                        <p class="text-sm text-slate-600">JPG, PNG or GIF. Max size 2MB</p>
                    </div>
                </div>
            </div>

            <!-- Profile Information -->
            <div class="lg:col-span-2">
                <div class="bg-white/80 border border-white/70 rounded-[28px] shadow-sm p-8">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">Personal Information</h2>
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">First Name</label>
                                <input type="text" value="John" class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-slate-800 focus:ring-2 focus:ring-slate-900/10 focus:border-slate-300">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Last Name</label>
                                <input type="text" value="Doe" class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-slate-800 focus:ring-2 focus:ring-slate-900/10 focus:border-slate-300">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                            <input type="email" value="{{ Auth::user()->email }}" class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-slate-800 focus:ring-2 focus:ring-slate-900/10 focus:border-slate-300">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Phone Number</label>
                            <input type="tel" placeholder="+62 812-3456-7890" class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-slate-800 focus:ring-2 focus:ring-slate-900/10 focus:border-slate-300">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Company Name</label>
                            <input type="text" placeholder="Your Company" class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-slate-800 focus:ring-2 focus:ring-slate-900/10 focus:border-slate-300">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Bio</label>
                            <textarea rows="4" placeholder="Tell us about yourself..." class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-slate-800 focus:ring-2 focus:ring-slate-900/10 focus:border-slate-300"></textarea>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" class="px-6 py-3 border border-slate-200 text-slate-700 rounded-full hover:bg-white/70 transition">
                                Cancel
                            </button>
                            <button type="submit" class="px-6 py-3 bg-slate-900 text-white rounded-full hover:bg-slate-800 shadow-sm transition">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Change Password -->
                <div class="bg-white/80 border border-white/70 rounded-[28px] shadow-sm p-8 mt-6">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">Change Password</h2>
                    <form class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Current Password</label>
                            <input type="password" class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-slate-800 focus:ring-2 focus:ring-slate-900/10 focus:border-slate-300">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">New Password</label>
                            <input type="password" class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-slate-800 focus:ring-2 focus:ring-slate-900/10 focus:border-slate-300">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Confirm New Password</label>
                            <input type="password" class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-slate-800 focus:ring-2 focus:ring-slate-900/10 focus:border-slate-300">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-3 bg-slate-900 text-white rounded-full hover:bg-slate-800 shadow-sm transition">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>
</x-app-layout>
