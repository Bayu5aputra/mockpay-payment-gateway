@extends('layouts.auth')

@section('title', 'Verify OTP')

@section('content')
    <div class="space-y-6">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-slate-900">
                Verifikasi OTP
            </h2>
            <p class="mt-2 text-sm text-slate-600">
                Kami telah mengirim kode 6 digit ke
                <span class="font-semibold text-slate-900">{{ $email }}</span>
            </p>
        </div>

        @if(session('status'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        @if(session('error'))
            <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                {{ session('error') }}
            </div>
        @endif

        <form class="space-y-5" method="POST" action="{{ route('register.otp.verify') }}">
            @csrf

            <div>
                <label for="otp" class="block text-sm font-semibold text-slate-700 mb-2">
                    Kode OTP
                </label>
                <input
                    id="otp"
                    name="otp"
                    type="text"
                    inputmode="numeric"
                    pattern="[0-9]{6}"
                    maxlength="6"
                    required
                    value="{{ old('otp') }}"
                    class="appearance-none block w-full text-center tracking-[0.4em] px-4 py-3 rounded-xl border @error('otp') border-rose-300 @else border-slate-200 @enderror bg-slate-50 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/20 focus:border-transparent transition-all duration-200"
                    placeholder="123456"
                >
                @error('otp')
                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900/20 shadow-lg hover:shadow-xl transition-all duration-200"
            >
                Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('register.otp.resend') }}" class="text-center">
            @csrf
            <button type="submit" class="text-sm font-semibold text-slate-900 hover:text-slate-700 transition-colors">
                Kirim ulang kode
            </button>
        </form>

        <div class="text-center">
            <a href="{{ route('register') }}" class="text-sm text-slate-600 hover:text-slate-800 transition-colors">
                Kembali ke registrasi
            </a>
        </div>
    </div>
@endsection
