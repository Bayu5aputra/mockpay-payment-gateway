<x-app-layout>
    <div class="p-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('dashboard.settings.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Settings
            </a>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Profile Settings</h1>
            <p class="text-gray-600">Manage your personal information and preferences</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Picture -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Profile Picture</h2>
                    <div class="text-center">
                        @if(Auth::user()->avatar_url)
                            <img
                                src="{{ Auth::user()->avatar_url }}"
                                alt="{{ Auth::user()->name }}"
                                class="w-40 h-40 rounded-full mx-auto mb-4 border-4 border-purple-200 object-cover"
                                onerror="this.classList.add('hidden'); this.nextElementSibling?.classList.remove('hidden');"
                            >
                            <div class="hidden w-40 h-40 rounded-full mx-auto mb-4 bg-gradient-to-br from-purple-500 to-indigo-500 flex items-center justify-center text-white text-5xl font-bold border-4 border-purple-200">
                                {{ Auth::user()->initials }}
                            </div>
                        @else
                            <div class="w-40 h-40 rounded-full mx-auto mb-4 bg-gradient-to-br from-purple-500 to-indigo-500 flex items-center justify-center text-white text-5xl font-bold border-4 border-purple-200">
                                {{ Auth::user()->initials }}
                            </div>
                        @endif
                        <button class="px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 mb-2">
                            Upload New Photo
                        </button>
                        <p class="text-sm text-gray-600">JPG, PNG or GIF. Max size 2MB</p>
                    </div>
                </div>
            </div>

            <!-- Profile Information -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Personal Information</h2>
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">First Name</label>
                                <input type="text" value="John" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Last Name</label>
                                <input type="text" value="Doe" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                            <input type="email" value="{{ Auth::user()->email }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" placeholder="+62 812-3456-7890" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Company Name</label>
                            <input type="text" placeholder="Your Company" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Bio</label>
                            <textarea rows="4" placeholder="Tell us about yourself..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"></textarea>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                                Cancel
                            </button>
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Change Password -->
                <div class="bg-white rounded-xl shadow-md p-8 mt-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Change Password</h2>
                    <form class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Current Password</label>
                            <input type="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                            <input type="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm New Password</label>
                            <input type="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
