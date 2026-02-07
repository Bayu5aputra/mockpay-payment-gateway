@extends('layouts.legal')

@section('title', 'Terms of Service - MockPay')

@section('page-navigation')
<nav class="space-y-2 text-sm">
    <a href="#acceptance" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Acceptance of Terms</span>
        <span class="lang-id-inline">Penerimaan Syarat</span>
    </a>
    <a href="#service-description" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Service Description</span>
        <span class="lang-id-inline">Deskripsi Layanan</span>
    </a>
    <a href="#account" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Account</span>
        <span class="lang-id-inline">Akun</span>
    </a>
    <a href="#acceptable-use" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Acceptable Use</span>
        <span class="lang-id-inline">Penggunaan yang Diizinkan</span>
    </a>
    <a href="#api-terms" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">API Terms</span>
        <span class="lang-id-inline">Ketentuan API</span>
    </a>
    <a href="#intellectual-property" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Intellectual Property</span>
        <span class="lang-id-inline">Kekayaan Intelektual</span>
    </a>
    <a href="#disclaimers" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Disclaimers</span>
        <span class="lang-id-inline">Penafian</span>
    </a>
    <a href="#liability" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Limitation of Liability</span>
        <span class="lang-id-inline">Batasan Tanggung Jawab</span>
    </a>
    <a href="#indemnification" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Indemnification</span>
        <span class="lang-id-inline">Ganti Rugi</span>
    </a>
    <a href="#termination" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Termination</span>
        <span class="lang-id-inline">Pengakhiran</span>
    </a>
    <a href="#disputes" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Dispute Resolution</span>
        <span class="lang-id-inline">Penyelesaian Sengketa</span>
    </a>
    <a href="#contact" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Contact</span>
        <span class="lang-id-inline">Kontak</span>
    </a>
</nav>
@endsection

@section('legal-content')
<!-- Header -->
<div class="mb-10">
    <p class="text-xs uppercase tracking-[0.35em] text-slate-500 mb-4">
        <span class="lang-en-inline">Legal Document</span>
        <span class="lang-id-inline">Dokumen Hukum</span>
    </p>
    <h1 class="text-4xl lg:text-5xl font-semibold text-slate-900 mb-3">
        <span class="lang-en-inline">Terms of Service</span>
        <span class="lang-id-inline">Syarat dan Ketentuan</span>
    </h1>
    <p class="text-base text-slate-600">
        <span class="lang-en-inline">Effective Date: January 27, 2026 | Version 2.0</span>
        <span class="lang-id-inline">Tanggal Berlaku: 27 Januari 2026 | Versi 2.0</span>
    </p>
</div>

<div class="prose prose-slate max-w-none">
    <!-- Section 1: Acceptance -->
    <section id="acceptance" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">1. Acceptance of Terms</span>
            <span class="lang-id-inline">1. Penerimaan Syarat</span>
        </h2>
        
        <div class="lang-en">
            <p class="text-base text-slate-600 leading-relaxed mb-4 text-justify">
                By accessing, registering for, or using MockPay's services ("Service"), you ("Tenant," "you," or "your") unconditionally agree to be bound by these Terms of Service ("Terms"), our Privacy Policy, and all applicable laws of the Republic of Indonesia. If you do not agree, you must immediately discontinue use.
            </p>
            <p class="text-base text-slate-600 leading-relaxed text-justify">
                These Terms constitute a legally binding agreement between you and PT Next Innovation Technology ("MockPay," "we," "us," or "our").
            </p>
        </div>
        <div class="lang-id">
            <p class="text-base text-slate-600 leading-relaxed mb-4 text-justify">
                Dengan mengakses, mendaftar, atau menggunakan layanan MockPay ("Layanan"), Anda ("Tenant," "Anda") tanpa syarat setuju untuk terikat oleh Syarat dan Ketentuan ini ("Syarat"), Kebijakan Privasi kami, dan semua hukum Republik Indonesia yang berlaku. Jika Anda tidak setuju, Anda harus segera menghentikan penggunaan.
            </p>
            <p class="text-base text-slate-600 leading-relaxed text-justify">
                Syarat ini merupakan perjanjian yang mengikat secara hukum antara Anda dan PT Next Innovation Technology ("MockPay," "kami").
            </p>
        </div>

        <div class="rounded-[22px] bg-red-50 border border-red-200 p-6 mt-4">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-red-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-red-900 mb-1">
                        <span class="lang-en-inline">Critical Disclaimer</span>
                        <span class="lang-id-inline">Pemberitahuan Penting</span>
                    </h3>
                    <div class="lang-en">
                        <p class="text-sm text-red-800 text-justify">
                            MockPay is exclusively a <strong>testing and development sandbox environment</strong>. <strong>NO REAL FINANCIAL TRANSACTIONS</strong> occur through this platform. All payment processing is simulated for development purposes only. You acknowledge this limitation.
                        </p>
                    </div>
                    <div class="lang-id">
                        <p class="text-sm text-red-800 text-justify">
                            MockPay adalah <strong>lingkungan sandbox untuk pengujian dan pengembangan</strong>. <strong>TIDAK ADA TRANSAKSI KEUANGAN NYATA</strong> yang terjadi melalui platform ini. Semua pemrosesan pembayaran disimulasikan hanya untuk tujuan pengembangan. Anda mengakui batasan ini.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Service Description -->
    <section id="service-description" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">2. Service Description</span>
            <span class="lang-id-inline">2. Deskripsi Layanan</span>
        </h2>
        
        <div class="lang-en">
            <p class="text-base text-slate-600 leading-relaxed mb-4 text-justify">
                MockPay is a SaaS dummy payment gateway simulator designed to help developers and companies test payment integration logic without real money. The Service includes:
            </p>
        </div>
        <div class="lang-id">
            <p class="text-base text-slate-600 leading-relaxed mb-4 text-justify">
                MockPay adalah simulator payment gateway dummy SaaS yang dirancang untuk membantu pengembang dan perusahaan menguji logika integrasi pembayaran tanpa uang nyata. Layanan meliputi:
            </p>
        </div>

        <div class="space-y-3">
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-4">
                <p class="font-semibold text-slate-900 text-sm"><span class="lang-en-inline">2.1 API Access</span><span class="lang-id-inline">2.1 Akses API</span></p>
                <p class="text-sm text-slate-600"><span class="lang-en-inline">RESTful API for creating simulated transactions, generating test payment methods, and receiving webhook notifications.</span><span class="lang-id-inline">API RESTful untuk membuat transaksi simulasi, menghasilkan metode pembayaran uji, dan menerima notifikasi webhook.</span></p>
            </div>
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-4">
                <p class="font-semibold text-slate-900 text-sm"><span class="lang-en-inline">2.2 Manual Override</span><span class="lang-id-inline">2.2 Override Manual</span></p>
                <p class="text-sm text-slate-600"><span class="lang-en-inline">Tenant-controlled simulation outcome (Approve, Reject, Expire, Cancel, Refund) for testing various payment scenarios.</span><span class="lang-id-inline">Hasil simulasi yang dikontrol tenant (Setuju, Tolak, Kadaluarsa, Batal, Refund) untuk menguji berbagai skenario pembayaran.</span></p>
            </div>
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-4">
                <p class="font-semibold text-slate-900 text-sm"><span class="lang-en-inline">2.3 Dashboard</span><span class="lang-id-inline">2.3 Dashboard</span></p>
                <p class="text-sm text-slate-600"><span class="lang-en-inline">Web-based interface for managing API keys, webhooks, viewing transactions, and downloading test results.</span><span class="lang-id-inline">Antarmuka berbasis web untuk mengelola kunci API, webhook, melihat transaksi, dan mengunduh hasil pengujian.</span></p>
            </div>
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-4">
                <p class="font-semibold text-slate-900 text-sm"><span class="lang-en-inline">2.4 Hosted Payment Page</span><span class="lang-id-inline">2.4 Halaman Pembayaran Terhosti</span></p>
                <p class="text-sm text-slate-600"><span class="lang-en-inline">Optional pre-built payment UI for simulating guest payment flows.</span><span class="lang-id-inline">UI pembayaran yang sudah dibuat untuk mensimulasikan alur pembayaran tamu (opsional).</span></p>
            </div>
        </div>
    </section>

    <!-- Section 3: Account -->
    <section id="account" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">3. Account Registration & Security</span>
            <span class="lang-id-inline">3. Pendaftaran Akun & Keamanan</span>
        </h2>

        <div class="rounded-[22px] bg-slate-900 text-white p-6">
            <div class="space-y-3">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    <p class="text-sm text-white/90"><span class="lang-en-inline">Provide accurate and complete registration information</span><span class="lang-id-inline">Berikan informasi pendaftaran yang akurat dan lengkap</span></p>
                </div>
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    <p class="text-sm text-white/90"><span class="lang-en-inline">Maintain the security and confidentiality of your credentials</span><span class="lang-id-inline">Jaga keamanan dan kerahasiaan kredensial Anda</span></p>
                </div>
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    <p class="text-sm text-white/90"><span class="lang-en-inline">You are solely responsible for all activities under your account</span><span class="lang-id-inline">Anda sepenuhnya bertanggung jawab atas semua aktivitas di bawah akun Anda</span></p>
                </div>
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    <p class="text-sm text-white/90"><span class="lang-en-inline">Immediately notify us of any unauthorized access</span><span class="lang-id-inline">Segera beritahu kami tentang akses tidak sah</span></p>
                </div>
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    <p class="text-sm text-white/90"><span class="lang-en-inline">Do not share API keys or allow unauthorized access</span><span class="lang-id-inline">Jangan bagikan kunci API atau izinkan akses tidak sah</span></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 4: Acceptable Use -->
    <section id="acceptable-use" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">4. Acceptable Use Policy</span>
            <span class="lang-id-inline">4. Kebijakan Penggunaan yang Dapat Diterima</span>
        </h2>

        <div class="lang-en"><p class="text-base text-slate-600 leading-relaxed mb-4 text-justify">You agree NOT to:</p></div>
        <div class="lang-id"><p class="text-base text-slate-600 leading-relaxed mb-4 text-justify">Anda setuju untuk TIDAK:</p></div>

        <div class="space-y-2">
            <div class="flex items-start gap-3 p-3 rounded-[16px] bg-red-50 border border-red-200">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                <p class="text-sm text-slate-700"><span class="lang-en-inline">Process any real financial transactions or use actual payment credentials</span><span class="lang-id-inline">Memproses transaksi keuangan nyata atau menggunakan kredensial pembayaran asli</span></p>
            </div>
            <div class="flex items-start gap-3 p-3 rounded-[16px] bg-red-50 border border-red-200">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                <p class="text-sm text-slate-700"><span class="lang-en-inline">Store real customer financial data (credit cards, bank accounts) in MockPay</span><span class="lang-id-inline">Menyimpan data keuangan pelanggan nyata di MockPay</span></p>
            </div>
            <div class="flex items-start gap-3 p-3 rounded-[16px] bg-red-50 border border-red-200">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                <p class="text-sm text-slate-700"><span class="lang-en-inline">Attempt unauthorized access to other accounts or systems</span><span class="lang-id-inline">Mencoba akses tidak sah ke akun atau sistem lain</span></p>
            </div>
            <div class="flex items-start gap-3 p-3 rounded-[16px] bg-red-50 border border-red-200">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                <p class="text-sm text-slate-700"><span class="lang-en-inline">Distribute malware, viruses, or malicious code</span><span class="lang-id-inline">Mendistribusikan malware, virus, atau kode berbahaya</span></p>
            </div>
            <div class="flex items-start gap-3 p-3 rounded-[16px] bg-red-50 border border-red-200">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                <p class="text-sm text-slate-700"><span class="lang-en-inline">Conduct DDoS attacks or disrupt service availability</span><span class="lang-id-inline">Melakukan serangan DDoS atau mengganggu ketersediaan layanan</span></p>
            </div>
            <div class="flex items-start gap-3 p-3 rounded-[16px] bg-red-50 border border-red-200">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                <p class="text-sm text-slate-700"><span class="lang-en-inline">Violate any applicable Indonesian law (UU ITE, KUHP, etc.)</span><span class="lang-id-inline">Melanggar hukum Indonesia yang berlaku (UU ITE, KUHP, dll.)</span></p>
            </div>
        </div>
    </section>

    <!-- Section 5: API Terms -->
    <section id="api-terms" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">5. API Terms & Rate Limits</span>
            <span class="lang-id-inline">5. Ketentuan API & Batas Rate</span>
        </h2>

        <div class="overflow-x-auto mb-4">
            <table class="w-full text-sm border border-slate-200 rounded-[16px] overflow-hidden">
                <thead class="bg-slate-100">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-slate-900">Plan</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-900"><span class="lang-en-inline">Rate Limit</span><span class="lang-id-inline">Batas Rate</span></th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-900"><span class="lang-en-inline">Daily Limit</span><span class="lang-id-inline">Batas Harian</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <tr><td class="px-4 py-3 text-slate-600">Free</td><td class="px-4 py-3 text-slate-600">60 req/min</td><td class="px-4 py-3 text-slate-600">1,000 transactions</td></tr>
                    <tr><td class="px-4 py-3 text-slate-600">Pro</td><td class="px-4 py-3 text-slate-600">300 req/min</td><td class="px-4 py-3 text-slate-600">10,000 transactions</td></tr>
                    <tr><td class="px-4 py-3 text-slate-600">Enterprise</td><td class="px-4 py-3 text-slate-600">Custom</td><td class="px-4 py-3 text-slate-600">Unlimited</td></tr>
                </tbody>
            </table>
        </div>

        <div class="lang-en"><p class="text-sm text-slate-600 text-justify">Exceeding rate limits will result in HTTP 429 responses. Repeated abuse may result in temporary or permanent suspension.</p></div>
        <div class="lang-id"><p class="text-sm text-slate-600 text-justify">Melebihi batas rate akan menghasilkan respons HTTP 429. Penyalahgunaan berulang dapat mengakibatkan penangguhan sementara atau permanen.</p></div>
    </section>

    <!-- Section 6: Intellectual Property -->
    <section id="intellectual-property" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">6. Intellectual Property</span>
            <span class="lang-id-inline">6. Kekayaan Intelektual</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-5">
                <h3 class="text-base font-semibold text-slate-900 mb-2"><span class="lang-en-inline">MockPay Ownership</span><span class="lang-id-inline">Kepemilikan MockPay</span></h3>
                <div class="lang-en"><p class="text-sm text-slate-600 text-justify">MockPay owns all rights to the platform, API, documentation, trademarks, logos, and proprietary technology. You receive a limited, non-exclusive, revocable license to use the Service.</p></div>
                <div class="lang-id"><p class="text-sm text-slate-600 text-justify">MockPay memiliki semua hak atas platform, API, dokumentasi, merek dagang, logo, dan teknologi proprietary. Anda menerima lisensi terbatas, non-eksklusif, yang dapat dicabut untuk menggunakan Layanan.</p></div>
            </div>
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-5">
                <h3 class="text-base font-semibold text-slate-900 mb-2"><span class="lang-en-inline">Your Data Ownership</span><span class="lang-id-inline">Kepemilikan Data Anda</span></h3>
                <div class="lang-en"><p class="text-sm text-slate-600 text-justify">You retain ownership of your simulation data and test results. MockPay acts only as a processor and storage provider. You may export your data at any time.</p></div>
                <div class="lang-id"><p class="text-sm text-slate-600 text-justify">Anda mempertahankan kepemilikan data simulasi dan hasil pengujian Anda. MockPay hanya bertindak sebagai prosesor dan penyedia penyimpanan. Anda dapat mengekspor data Anda kapan saja.</p></div>
            </div>
        </div>
    </section>

    <!-- Section 7: Disclaimers -->
    <section id="disclaimers" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">7. Disclaimers</span>
            <span class="lang-id-inline">7. Penafian</span>
        </h2>

        <div class="rounded-[22px] bg-amber-50 border border-amber-200 p-6">
            <div class="lang-en">
                <p class="text-sm text-amber-900 text-justify mb-3"><strong>THE SERVICE IS PROVIDED "AS IS" AND "AS AVAILABLE" WITHOUT WARRANTIES OF ANY KIND.</strong></p>
                <ul class="list-disc pl-5 text-sm text-amber-800 space-y-1">
                    <li>MockPay is NOT a real payment processor and cannot be used for actual transactions</li>
                    <li>We do not guarantee uninterrupted availability or error-free operation</li>
                    <li>Simulation results are for testing purposes only and do not represent real payment behavior</li>
                    <li>You must independently validate your integration before using a real payment gateway</li>
                </ul>
            </div>
            <div class="lang-id">
                <p class="text-sm text-amber-900 text-justify mb-3"><strong>LAYANAN DISEDIAKAN "SEBAGAIMANA ADANYA" TANPA JAMINAN APA PUN.</strong></p>
                <ul class="list-disc pl-5 text-sm text-amber-800 space-y-1">
                    <li>MockPay BUKAN pemroses pembayaran nyata dan tidak dapat digunakan untuk transaksi aktual</li>
                    <li>Kami tidak menjamin ketersediaan tanpa gangguan atau operasi bebas kesalahan</li>
                    <li>Hasil simulasi hanya untuk tujuan pengujian dan tidak mewakili perilaku pembayaran nyata</li>
                    <li>Anda harus memvalidasi integrasi Anda secara independen sebelum menggunakan payment gateway nyata</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Section 8: Limitation of Liability -->
    <section id="liability" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">8. Limitation of Liability</span>
            <span class="lang-id-inline">8. Batasan Tanggung Jawab</span>
        </h2>

        <div class="rounded-[22px] bg-red-50 border border-red-200 p-6">
            <div class="lang-en">
                <p class="text-sm text-red-800 text-justify mb-3">
                    <strong>TO THE MAXIMUM EXTENT PERMITTED BY LAW, MOCKPAY SHALL NOT BE LIABLE FOR:</strong>
                </p>
                <ul class="list-disc pl-5 text-sm text-red-800 space-y-1">
                    <li>Any indirect, incidental, special, consequential, or punitive damages</li>
                    <li>Loss of profits, revenue, data, or business opportunities</li>
                    <li>Damages arising from reliance on simulation results in production systems</li>
                    <li>Any damages exceeding the amount paid by you to MockPay in the preceding 12 months</li>
                    <li>Actions taken by third parties using your credentials</li>
                </ul>
            </div>
            <div class="lang-id">
                <p class="text-sm text-red-800 text-justify mb-3">
                    <strong>SEJAUH DIIZINKAN OLEH HUKUM, MOCKPAY TIDAK BERTANGGUNG JAWAB ATAS:</strong>
                </p>
                <ul class="list-disc pl-5 text-sm text-red-800 space-y-1">
                    <li>Kerugian tidak langsung, insidental, khusus, konsekuensial, atau punitif</li>
                    <li>Kehilangan keuntungan, pendapatan, data, atau peluang bisnis</li>
                    <li>Kerugian akibat mengandalkan hasil simulasi dalam sistem produksi</li>
                    <li>Kerugian melebihi jumlah yang Anda bayarkan ke MockPay dalam 12 bulan sebelumnya</li>
                    <li>Tindakan yang diambil pihak ketiga menggunakan kredensial Anda</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Section 9: Indemnification -->
    <section id="indemnification" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">9. Indemnification</span>
            <span class="lang-id-inline">9. Ganti Rugi</span>
        </h2>

        <div class="rounded-[22px] bg-slate-900 text-white p-6">
            <div class="lang-en">
                <p class="text-sm text-white/90 text-justify">
                    You agree to <span class="font-bold text-white">defend, indemnify, and hold harmless</span> MockPay, its affiliates, officers, directors, employees, and agents from any claims, damages, losses, liabilities, costs, and expenses (including legal fees) arising from: (a) your use of the Service; (b) your violation of these Terms; (c) your violation of any third-party rights; (d) any content you submit to the Service; or (e) your negligence or willful misconduct.
                </p>
            </div>
            <div class="lang-id">
                <p class="text-sm text-white/90 text-justify">
                    Anda setuju untuk <span class="font-bold text-white">membela, mengganti kerugian, dan membebaskan</span> MockPay, afiliasi, pejabat, direktur, karyawan, dan agennya dari setiap klaim, kerugian, tanggung jawab, biaya, dan pengeluaran (termasuk biaya hukum) yang timbul dari: (a) penggunaan Layanan oleh Anda; (b) pelanggaran Syarat ini oleh Anda; (c) pelanggaran hak pihak ketiga oleh Anda; (d) konten yang Anda kirimkan ke Layanan; atau (e) kelalaian atau kesalahan yang disengaja oleh Anda.
                </p>
            </div>
        </div>
    </section>

    <!-- Section 10: Termination -->
    <section id="termination" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">10. Termination</span>
            <span class="lang-id-inline">10. Pengakhiran</span>
        </h2>

        <div class="space-y-4">
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-5">
                <h3 class="text-base font-semibold text-slate-900 mb-2"><span class="lang-en-inline">By You</span><span class="lang-id-inline">Oleh Anda</span></h3>
                <div class="lang-en"><p class="text-sm text-slate-600">You may terminate your account at any time through the dashboard or by contacting support. Upon termination, you must cease using the Service.</p></div>
                <div class="lang-id"><p class="text-sm text-slate-600">Anda dapat mengakhiri akun Anda kapan saja melalui dashboard atau dengan menghubungi support. Setelah pengakhiran, Anda harus berhenti menggunakan Layanan.</p></div>
            </div>
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-5">
                <h3 class="text-base font-semibold text-slate-900 mb-2"><span class="lang-en-inline">By MockPay</span><span class="lang-id-inline">Oleh MockPay</span></h3>
                <div class="lang-en"><p class="text-sm text-slate-600">We may suspend or terminate your account immediately for violation of these Terms, suspected fraud, or as required by law. We will provide notice where practical.</p></div>
                <div class="lang-id"><p class="text-sm text-slate-600">Kami dapat menangguhkan atau mengakhiri akun Anda segera karena pelanggaran Syarat ini, dugaan penipuan, atau sebagaimana diwajibkan hukum. Kami akan memberikan pemberitahuan jika memungkinkan.</p></div>
            </div>
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-5">
                <h3 class="text-base font-semibold text-slate-900 mb-2"><span class="lang-en-inline">Data Retention After Termination</span><span class="lang-id-inline">Penyimpanan Data Setelah Pengakhiran</span></h3>
                <div class="lang-en"><p class="text-sm text-slate-600">Your simulation data will be retained for 30 days after termination to allow recovery. After 30 days, data will be permanently deleted except where retention is required by law.</p></div>
                <div class="lang-id"><p class="text-sm text-slate-600">Data simulasi Anda akan disimpan selama 30 hari setelah pengakhiran untuk pemulihan. Setelah 30 hari, data akan dihapus secara permanen kecuali penyimpanan diwajibkan oleh hukum.</p></div>
            </div>
        </div>
    </section>

    <!-- Section 11: Dispute Resolution -->
    <section id="disputes" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">11. Dispute Resolution & Governing Law</span>
            <span class="lang-id-inline">11. Penyelesaian Sengketa & Hukum yang Berlaku</span>
        </h2>

        <div class="rounded-[22px] bg-blue-50 border border-blue-200 p-6">
            <div class="space-y-4">
                <div>
                    <p class="font-semibold text-slate-900 text-sm mb-1"><span class="lang-en-inline">Governing Law</span><span class="lang-id-inline">Hukum yang Berlaku</span></p>
                    <div class="lang-en"><p class="text-sm text-slate-600">These Terms shall be governed by the laws of the Republic of Indonesia.</p></div>
                    <div class="lang-id"><p class="text-sm text-slate-600">Syarat ini diatur oleh hukum Republik Indonesia.</p></div>
                </div>
                <div>
                    <p class="font-semibold text-slate-900 text-sm mb-1"><span class="lang-en-inline">Negotiation</span><span class="lang-id-inline">Negosiasi</span></p>
                    <div class="lang-en"><p class="text-sm text-slate-600">Parties shall first attempt to resolve disputes through good-faith negotiation within 30 days.</p></div>
                    <div class="lang-id"><p class="text-sm text-slate-600">Para pihak akan terlebih dahulu mencoba menyelesaikan sengketa melalui negosiasi dengan itikad baik dalam 30 hari.</p></div>
                </div>
                <div>
                    <p class="font-semibold text-slate-900 text-sm mb-1"><span class="lang-en-inline">Arbitration</span><span class="lang-id-inline">Arbitrase</span></p>
                    <div class="lang-en"><p class="text-sm text-slate-600">Unresolved disputes shall be submitted to BANI (Badan Arbitrase Nasional Indonesia) in Jakarta for final and binding arbitration.</p></div>
                    <div class="lang-id"><p class="text-sm text-slate-600">Sengketa yang tidak terselesaikan akan diajukan ke BANI (Badan Arbitrase Nasional Indonesia) di Jakarta untuk arbitrase yang final dan mengikat.</p></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 12: Force Majeure -->
    <section id="force-majeure" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">12. Force Majeure</span>
            <span class="lang-id-inline">12. Keadaan Kahar</span>
        </h2>

        <div class="lang-en">
            <p class="text-base text-slate-600 leading-relaxed text-justify">
                MockPay shall not be liable for any failure to perform due to circumstances beyond reasonable control, including but not limited to: natural disasters, war, terrorism, pandemic, government actions, power failures, internet outages, or infrastructure failures.
            </p>
        </div>
        <div class="lang-id">
            <p class="text-base text-slate-600 leading-relaxed text-justify">
                MockPay tidak bertanggung jawab atas kegagalan untuk melaksanakan karena keadaan di luar kendali yang wajar, termasuk namun tidak terbatas pada: bencana alam, perang, terorisme, pandemi, tindakan pemerintah, kegagalan listrik, gangguan internet, atau kegagalan infrastruktur.
            </p>
        </div>
    </section>

    <!-- Section 13: Modifications -->
    <section id="modifications" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">13. Modifications to Terms</span>
            <span class="lang-id-inline">13. Modifikasi Syarat</span>
        </h2>

        <div class="lang-en">
            <p class="text-base text-slate-600 leading-relaxed text-justify">
                We may modify these Terms at any time. For material changes, we will provide at least <strong>30 days' prior written notice</strong> via email or dashboard notification. Continued use after the effective date constitutes acceptance of the modified Terms.
            </p>
        </div>
        <div class="lang-id">
            <p class="text-base text-slate-600 leading-relaxed text-justify">
                Kami dapat memodifikasi Syarat ini kapan saja. Untuk perubahan material, kami akan memberikan pemberitahuan tertulis <strong>minimal 30 hari sebelumnya</strong> melalui email atau notifikasi dashboard. Penggunaan berkelanjutan setelah tanggal berlaku merupakan penerimaan Syarat yang dimodifikasi.
            </p>
        </div>
    </section>

    <!-- Section 14: Contact -->
    <section id="contact" class="mb-8">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">14. Contact Us</span>
            <span class="lang-id-inline">14. Hubungi Kami</span>
        </h2>

        <div class="rounded-[22px] bg-slate-900 text-white p-6">
            <div class="space-y-3">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wider text-white/50 mb-0.5"><span class="lang-en-inline">Legal Inquiries</span><span class="lang-id-inline">Pertanyaan Hukum</span></p>
                        <p class="text-sm font-semibold text-white">support@m.next-it.my.id</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wider text-white/50 mb-0.5"><span class="lang-en-inline">Technical Support</span><span class="lang-id-inline">Dukungan Teknis</span></p>
                        <p class="text-sm font-semibold text-white">support@m.next-it.my.id</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 rounded-[16px] bg-slate-100 border border-slate-200 p-4">
            <div class="lang-en"><p class="text-xs text-slate-600 text-center"><strong>Legal Notice:</strong> By using MockPay, you acknowledge that you have read, understood, and agree to be bound by these Terms. This agreement is governed by Indonesian law.</p></div>
            <div class="lang-id"><p class="text-xs text-slate-600 text-center"><strong>Pemberitahuan Hukum:</strong> Dengan menggunakan MockPay, Anda mengakui bahwa Anda telah membaca, memahami, dan setuju untuk terikat oleh Syarat ini. Perjanjian ini diatur oleh hukum Indonesia.</p></div>
        </div>
    </section>
</div>
@endsection
