@extends('layouts.legal')

@section('title', 'Cookie Policy - MockPay')

@section('page-navigation')
<nav class="space-y-2 text-sm">
    <a href="#what-are-cookies" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">What Are Cookies</span>
        <span class="lang-id-inline">Apa Itu Cookie</span>
    </a>
    <a href="#why-we-use" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Why We Use Cookies</span>
        <span class="lang-id-inline">Mengapa Kami Menggunakan Cookie</span>
    </a>
    <a href="#types-of-cookies" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Types of Cookies</span>
        <span class="lang-id-inline">Jenis Cookie</span>
    </a>
    <a href="#consent" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Cookie Consent</span>
        <span class="lang-id-inline">Persetujuan Cookie</span>
    </a>
    <a href="#how-to-control" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">How to Control</span>
        <span class="lang-id-inline">Cara Mengontrol</span>
    </a>
    <a href="#contact" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Contact</span>
        <span class="lang-id-inline">Kontak</span>
    </a>
</nav>
@endsection

@section('legal-content')
<div class="mb-10">
    <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">
        <span class="lang-en-inline">Legal Document</span>
        <span class="lang-id-inline">Dokumen Hukum</span>
    </p>
    <h1 class="text-4xl lg:text-5xl font-semibold text-slate-900 mb-3">
        <span class="lang-en-inline">Cookie Policy</span>
        <span class="lang-id-inline">Kebijakan Cookie</span>
    </h1>
    <p class="text-base text-slate-600">
        <span class="lang-en-inline">Effective Date: January 27, 2026 | Version 2.0</span>
        <span class="lang-id-inline">Tanggal Berlaku: 27 Januari 2026 | Versi 2.0</span>
    </p>
</div>

<div class="prose prose-slate max-w-none">
    <section id="what-are-cookies" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">1. What Are Cookies</span>
            <span class="lang-id-inline">1. Apa Itu Cookie</span>
        </h2>
        
        <div class="lang-en">
            <p class="text-base text-slate-600 leading-relaxed mb-4 text-justify">
                Cookies are small text files stored on your device when you visit our website. They help us provide essential functionality, remember your preferences, and understand how you use our service.
            </p>
            <p class="text-base text-slate-600 leading-relaxed text-justify">
                <strong>First-party cookies</strong> are set by MockPay. <strong>Third-party cookies</strong> are set by external services (e.g., analytics providers).
            </p>
        </div>
        <div class="lang-id">
            <p class="text-base text-slate-600 leading-relaxed mb-4 text-justify">
                Cookie adalah file teks kecil yang disimpan di perangkat Anda saat mengunjungi situs web kami. Cookie membantu kami menyediakan fungsionalitas penting, mengingat preferensi Anda, dan memahami cara Anda menggunakan layanan kami.
            </p>
            <p class="text-base text-slate-600 leading-relaxed text-justify">
                <strong>Cookie pihak pertama</strong> ditetapkan oleh MockPay. <strong>Cookie pihak ketiga</strong> ditetapkan oleh layanan eksternal (mis. penyedia analitik).
            </p>
        </div>
    </section>

    <section id="why-we-use" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">2. Why We Use Cookies</span>
            <span class="lang-id-inline">2. Mengapa Kami Menggunakan Cookie</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-5">
                <div class="w-10 h-10 bg-slate-900 rounded-lg flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="text-sm font-semibold text-slate-900 mb-1"><span class="lang-en-inline">Security & Authentication</span><span class="lang-id-inline">Keamanan & Autentikasi</span></h3>
                <p class="text-xs text-slate-600"><span class="lang-en-inline">Session management, CSRF protection, and secure login</span><span class="lang-id-inline">Manajemen sesi, perlindungan CSRF, dan login aman</span></p>
            </div>
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-5">
                <div class="w-10 h-10 bg-slate-900 rounded-lg flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                </div>
                <h3 class="text-sm font-semibold text-slate-900 mb-1"><span class="lang-en-inline">Preferences</span><span class="lang-id-inline">Preferensi</span></h3>
                <p class="text-xs text-slate-600"><span class="lang-en-inline">Language settings, dashboard preferences</span><span class="lang-id-inline">Pengaturan bahasa, preferensi dashboard</span></p>
            </div>
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-5">
                <div class="w-10 h-10 bg-slate-900 rounded-lg flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <h3 class="text-sm font-semibold text-slate-900 mb-1"><span class="lang-en-inline">Analytics</span><span class="lang-id-inline">Analitik</span></h3>
                <p class="text-xs text-slate-600"><span class="lang-en-inline">Usage statistics to improve service</span><span class="lang-id-inline">Statistik penggunaan untuk meningkatkan layanan</span></p>
            </div>
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-5">
                <div class="w-10 h-10 bg-slate-900 rounded-lg flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-sm font-semibold text-slate-900 mb-1"><span class="lang-en-inline">Performance</span><span class="lang-id-inline">Performa</span></h3>
                <p class="text-xs text-slate-600"><span class="lang-en-inline">Load balancing, caching for faster access</span><span class="lang-id-inline">Penyeimbangan beban, caching untuk akses lebih cepat</span></p>
            </div>
        </div>
    </section>

    <section id="types-of-cookies" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">3. Types of Cookies We Use</span>
            <span class="lang-id-inline">3. Jenis Cookie yang Kami Gunakan</span>
        </h2>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border border-slate-200 rounded-[16px] overflow-hidden">
                <thead class="bg-slate-100">
                    <tr>
                        <th class="px-3 py-2 text-left font-semibold text-slate-900">Cookie</th>
                        <th class="px-3 py-2 text-left font-semibold text-slate-900"><span class="lang-en-inline">Purpose</span><span class="lang-id-inline">Tujuan</span></th>
                        <th class="px-3 py-2 text-left font-semibold text-slate-900"><span class="lang-en-inline">Duration</span><span class="lang-id-inline">Durasi</span></th>
                        <th class="px-3 py-2 text-left font-semibold text-slate-900"><span class="lang-en-inline">Type</span><span class="lang-id-inline">Jenis</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-xs">
                    <tr>
                        <td class="px-3 py-2 text-slate-600 font-mono">mockpay_session</td>
                        <td class="px-3 py-2 text-slate-600"><span class="lang-en-inline">Session auth</span><span class="lang-id-inline">Autentikasi sesi</span></td>
                        <td class="px-3 py-2 text-slate-600">Session</td>
                        <td class="px-3 py-2 text-slate-600"><span class="lang-en-inline">Essential</span><span class="lang-id-inline">Esensial</span></td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 text-slate-600 font-mono">XSRF-TOKEN</td>
                        <td class="px-3 py-2 text-slate-600"><span class="lang-en-inline">CSRF protection</span><span class="lang-id-inline">Perlindungan CSRF</span></td>
                        <td class="px-3 py-2 text-slate-600">2h</td>
                        <td class="px-3 py-2 text-slate-600"><span class="lang-en-inline">Essential</span><span class="lang-id-inline">Esensial</span></td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 text-slate-600 font-mono">remember_token</td>
                        <td class="px-3 py-2 text-slate-600"><span class="lang-en-inline">Remember Me</span><span class="lang-id-inline">Ingat Saya</span></td>
                        <td class="px-3 py-2 text-slate-600">30d</td>
                        <td class="px-3 py-2 text-slate-600"><span class="lang-en-inline">Functional</span><span class="lang-id-inline">Fungsional</span></td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 text-slate-600 font-mono">mockpay_lang</td>
                        <td class="px-3 py-2 text-slate-600"><span class="lang-en-inline">Language pref</span><span class="lang-id-inline">Preferensi bahasa</span></td>
                        <td class="px-3 py-2 text-slate-600">1y</td>
                        <td class="px-3 py-2 text-slate-600"><span class="lang-en-inline">Functional</span><span class="lang-id-inline">Fungsional</span></td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 text-slate-600 font-mono">_ga, _gid</td>
                        <td class="px-3 py-2 text-slate-600"><span class="lang-en-inline">Google Analytics</span><span class="lang-id-inline">Google Analytics</span></td>
                        <td class="px-3 py-2 text-slate-600">2y / 24h</td>
                        <td class="px-3 py-2 text-slate-600"><span class="lang-en-inline">Analytics</span><span class="lang-id-inline">Analitik</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section id="consent" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">4. Cookie Consent</span>
            <span class="lang-id-inline">4. Persetujuan Cookie</span>
        </h2>

        <div class="rounded-[22px] bg-blue-50 border border-blue-200 p-6">
            <div class="lang-en">
                <p class="text-sm text-blue-800 text-justify mb-3">
                    When you first visit our website, you will be presented with a cookie consent banner. You can:
                </p>
                <ul class="list-disc pl-5 text-sm text-blue-800 space-y-1">
                    <li><strong>Accept All:</strong> Enable all cookies including analytics</li>
                    <li><strong>Essential Only:</strong> Only strictly necessary cookies for site operation</li>
                    <li><strong>Manage Preferences:</strong> Choose which categories to enable</li>
                </ul>
                <p class="text-sm text-blue-800 mt-3 text-justify">
                    Essential cookies cannot be disabled as they are required for the website to function.
                </p>
            </div>
            <div class="lang-id">
                <p class="text-sm text-blue-800 text-justify mb-3">
                    Saat Anda pertama kali mengunjungi situs web kami, Anda akan disajikan banner persetujuan cookie. Anda dapat:
                </p>
                <ul class="list-disc pl-5 text-sm text-blue-800 space-y-1">
                    <li><strong>Terima Semua:</strong> Aktifkan semua cookie termasuk analitik</li>
                    <li><strong>Hanya Esensial:</strong> Hanya cookie yang diperlukan untuk operasi situs</li>
                    <li><strong>Kelola Preferensi:</strong> Pilih kategori mana yang akan diaktifkan</li>
                </ul>
                <p class="text-sm text-blue-800 mt-3 text-justify">
                    Cookie esensial tidak dapat dinonaktifkan karena diperlukan agar situs web berfungsi.
                </p>
            </div>
        </div>
    </section>

    <section id="how-to-control" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">5. How to Control Cookies</span>
            <span class="lang-id-inline">5. Cara Mengontrol Cookie</span>
        </h2>

        <div class="rounded-[22px] bg-slate-900 text-white p-6">
            <h4 class="text-sm font-semibold text-white mb-3">
                <span class="lang-en-inline">Browser Settings:</span>
                <span class="lang-id-inline">Pengaturan Browser:</span>
            </h4>
            <div class="space-y-2 text-sm">
                <p class="text-white/80">• <span class="font-bold text-white">Chrome:</span> Settings → Privacy → Cookies</p>
                <p class="text-white/80">• <span class="font-bold text-white">Firefox:</span> Options → Privacy → Cookies</p>
                <p class="text-white/80">• <span class="font-bold text-white">Safari:</span> Preferences → Privacy → Cookies</p>
                <p class="text-white/80">• <span class="font-bold text-white">Edge:</span> Settings → Cookies and site permissions</p>
            </div>
        </div>

        <div class="mt-4 rounded-[16px] bg-amber-50 border border-amber-200 p-4">
            <div class="lang-en"><p class="text-xs text-amber-800 text-justify"><strong>Note:</strong> Disabling cookies may affect functionality. Essential cookies cannot be blocked without breaking the service.</p></div>
            <div class="lang-id"><p class="text-xs text-amber-800 text-justify"><strong>Catatan:</strong> Menonaktifkan cookie dapat mempengaruhi fungsionalitas. Cookie esensial tidak dapat diblokir tanpa merusak layanan.</p></div>
        </div>
    </section>

    <section id="contact" class="mb-8">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">6. Contact Us</span>
            <span class="lang-id-inline">6. Hubungi Kami</span>
        </h2>

        <div class="rounded-[22px] bg-slate-900 text-white p-6">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wider text-white/50 mb-0.5"><span class="lang-en-inline">Privacy Questions</span><span class="lang-id-inline">Pertanyaan Privasi</span></p>
                    <p class="text-sm font-semibold text-white">support@m.next-it.my.id</p>
                </div>
            </div>
        </div>

        <div class="mt-6 rounded-[16px] bg-slate-100 border border-slate-200 p-4">
            <div class="lang-en"><p class="text-xs text-slate-600 text-center">This Cookie Policy is governed by Indonesian law. Last updated: January 27, 2026.</p></div>
            <div class="lang-id"><p class="text-xs text-slate-600 text-center">Kebijakan Cookie ini diatur oleh hukum Indonesia. Terakhir diperbarui: 27 Januari 2026.</p></div>
        </div>
    </section>
</div>
@endsection
