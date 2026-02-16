@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
    <div class="space-y-6">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-slate-900">
                Set a new password
            </h2>
            <p class="mt-2 text-sm text-slate-600">
                Create a strong password to secure your account.
            </p>
        </div>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                    Email address
                </label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    required
                    autofocus
                    autocomplete="username"
                    value="{{ old('email', $request->email) }}"
                    class="appearance-none block w-full px-4 py-3 rounded-xl border @error('email') border-rose-300 @else border-slate-200 @enderror bg-slate-50 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/20 focus:border-transparent transition-all duration-200"
                    placeholder="you@example.com"
                >
                @error('email')
                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                    New password
                </label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="new-password"
                    class="appearance-none block w-full px-4 py-3 rounded-xl border @error('password') border-rose-300 @else border-slate-200 @enderror bg-slate-50 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/20 focus:border-transparent transition-all duration-200"
                    placeholder="********"
                >
                @error('password')
                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">
                    Confirm new password
                </label>
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                    class="appearance-none block w-full px-4 py-3 rounded-xl border @error('password_confirmation') border-rose-300 @else border-slate-200 @enderror bg-slate-50 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/20 focus:border-transparent transition-all duration-200"
                    placeholder="********"
                >
                @error('password_confirmation')
                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900/20 shadow-lg hover:shadow-xl transition-all duration-200"
            >
                Reset password
            </button>
        </form>
    </div>
@endsection
