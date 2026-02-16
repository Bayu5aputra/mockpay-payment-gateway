<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-3xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 md:p-10 space-y-8">
                <div class="space-y-3">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Account Security</p>
                    <h1 class="text-3xl md:text-4xl font-semibold text-slate-900">Verify Your Email</h1>
                    <p class="text-sm md:text-base text-slate-600 leading-relaxed">
                        Thanks for signing up. Before you continue, please verify your email address by clicking the verification link we sent to your inbox.
                        If you did not receive it, you can request a new link below.
                    </p>
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="rounded-2xl border border-emerald-200 bg-emerald-50/80 p-4">
                        <p class="text-sm font-medium text-emerald-800">
                            A new verification link has been sent to your registered email address.
                        </p>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-[1fr_auto] gap-4 md:items-center rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button
                            type="submit"
                            class="w-full md:w-auto inline-flex items-center justify-center rounded-2xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-800 transition"
                        >
                            Resend Verification Email
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}" class="md:justify-self-end">
                        @csrf
                        <button
                            type="submit"
                            class="w-full md:w-auto inline-flex items-center justify-center rounded-2xl border border-slate-200 px-6 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition"
                        >
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
