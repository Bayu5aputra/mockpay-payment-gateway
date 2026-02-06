@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')
    <div class="space-y-6">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-slate-900">
                Reset your password
            </h2>
            <p class="mt-2 text-sm text-slate-600">
                Enter your email and we will send you a reset link.
            </p>
        </div>

        @if (session('status'))
            <div class="rounded-xl bg-emerald-50 p-4 border border-emerald-200">
                <p class="text-sm font-medium text-emerald-800">
                    {{ session('status') }}
                </p>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                    Email address
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                    </div>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        autocomplete="email"
                        required
                        autofocus
                        value="{{ old('email') }}"
                        class="appearance-none block w-full pl-12 pr-4 py-3 rounded-xl border @error('email') border-rose-300 @else border-slate-200 @enderror bg-slate-50 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/20 focus:border-transparent transition-all duration-200"
                        placeholder="you@example.com"
                    >
                </div>
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900/20 shadow-lg hover:shadow-xl transition-all duration-200"
            >
                Send reset link
            </button>
        </form>

        <div class="text-center text-sm">
            <a href="{{ route('login') }}" class="font-semibold text-slate-900 hover:text-slate-700 transition-colors">
                Back to sign in
            </a>
        </div>
    </div>
@endsection
