@extends('layouts.legal')

@section('title', 'Privacy Policy - MockPay')

@section('page-navigation')
<nav class="space-y-2 text-sm">
    <a href="#introduction" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Introduction</span>
        <span class="lang-id-inline">Pendahuluan</span>
    </a>
    <a href="#data-controller" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Data Controller</span>
        <span class="lang-id-inline">Pengendali Data</span>
    </a>
    <a href="#information-collected" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Information Collected</span>
        <span class="lang-id-inline">Informasi yang Dikumpulkan</span>
    </a>
    <a href="#legal-basis" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Legal Basis</span>
        <span class="lang-id-inline">Dasar Hukum</span>
    </a>
    <a href="#data-usage" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Data Usage</span>
        <span class="lang-id-inline">Penggunaan Data</span>
    </a>
    <a href="#data-sharing" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Data Sharing</span>
        <span class="lang-id-inline">Pembagian Data</span>
    </a>
    <a href="#data-retention" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Data Retention</span>
        <span class="lang-id-inline">Penyimpanan Data</span>
    </a>
    <a href="#data-security" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Data Security</span>
        <span class="lang-id-inline">Keamanan Data</span>
    </a>
    <a href="#your-rights" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Your Rights</span>
        <span class="lang-id-inline">Hak Anda</span>
    </a>
    <a href="#data-breach" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Data Breach</span>
        <span class="lang-id-inline">Pelanggaran Data</span>
    </a>
    <a href="#international-transfer" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">International Transfer</span>
        <span class="lang-id-inline">Transfer Internasional</span>
    </a>
    <a href="#contact" class="block text-slate-600 hover:text-slate-900 transition-colors">
        <span class="lang-en-inline">Contact Us</span>
        <span class="lang-id-inline">Hubungi Kami</span>
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
        <span class="lang-en-inline">Privacy Policy</span>
        <span class="lang-id-inline">Kebijakan Privasi</span>
    </h1>
    <p class="text-base text-slate-600">
        <span class="lang-en-inline">Effective Date: January 27, 2026 | Version 2.0</span>
        <span class="lang-id-inline">Tanggal Berlaku: 27 Januari 2026 | Versi 2.0</span>
    </p>
</div>

<!-- Content -->
<div class="prose prose-slate max-w-none">
    <!-- Introduction -->
    <section id="introduction" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">1. Introduction</span>
            <span class="lang-id-inline">1. Pendahuluan</span>
        </h2>
        
        <div class="lang-en">
            <p class="text-base text-slate-600 leading-relaxed mb-4 text-justify">
                This Privacy Policy ("Policy") describes how MockPay ("we," "us," or "our") collects, uses, stores, protects, and discloses personal data when you access or use our SaaS dummy payment gateway simulation platform ("Service"). This Policy is drafted in compliance with Indonesian Law Number 27 of 2022 concerning Personal Data Protection ("UU PDP") and other applicable regulations.
            </p>
        </div>
        <div class="lang-id">
            <p class="text-base text-slate-600 leading-relaxed mb-4 text-justify">
                Kebijakan Privasi ini ("Kebijakan") menjelaskan bagaimana MockPay ("kami") mengumpulkan, menggunakan, menyimpan, melindungi, dan mengungkapkan data pribadi saat Anda mengakses atau menggunakan platform simulasi payment gateway dummy SaaS kami ("Layanan"). Kebijakan ini disusun sesuai dengan Undang-Undang Nomor 27 Tahun 2022 tentang Perlindungan Data Pribadi ("UU PDP") dan peraturan lain yang berlaku.
            </p>
        </div>

        <div class="rounded-[22px] bg-blue-50 border border-blue-200 p-6">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-blue-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-blue-900 mb-1">
                        <span class="lang-en-inline">Critical Notice: Sandbox Environment</span>
                        <span class="lang-id-inline">Pemberitahuan Penting: Lingkungan Sandbox</span>
                    </h3>
                    <div class="lang-en">
                        <p class="text-sm text-blue-800 text-justify">
                            MockPay is exclusively a <strong>testing and development sandbox platform</strong>. No real financial transactions or actual payment processing occurs. All payment simulations use fictitious data. We do not collect, store, or process any real credit card numbers, bank account details, or actual financial information.
                        </p>
                    </div>
                    <div class="lang-id">
                        <p class="text-sm text-blue-800 text-justify">
                            MockPay adalah <strong>platform sandbox untuk pengujian dan pengembangan</strong>. Tidak ada transaksi keuangan nyata atau pemrosesan pembayaran aktual yang terjadi. Semua simulasi pembayaran menggunakan data fiktif. Kami tidak mengumpulkan, menyimpan, atau memproses nomor kartu kredit asli, detail rekening bank, atau informasi keuangan aktual.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Data Controller -->
    <section id="data-controller" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">2. Data Controller</span>
            <span class="lang-id-inline">2. Pengendali Data</span>
        </h2>
        
        <div class="lang-en">
            <p class="text-base text-slate-600 leading-relaxed mb-4 text-justify">
                MockPay acts as the <strong>Data Controller</strong> (Pengendali Data Pribadi) for personal data processed through our platform. For tenant-uploaded simulation data, MockPay acts as a <strong>Data Processor</strong> (Prosesor Data Pribadi), with the Tenant acting as the Data Controller.
            </p>
        </div>
        <div class="lang-id">
            <p class="text-base text-slate-600 leading-relaxed mb-4 text-justify">
                MockPay bertindak sebagai <strong>Pengendali Data Pribadi</strong> untuk data pribadi yang diproses melalui platform kami. Untuk data simulasi yang diunggah oleh tenant, MockPay bertindak sebagai <strong>Prosesor Data Pribadi</strong>, dengan Tenant bertindak sebagai Pengendali Data.
            </p>
        </div>

        <div class="rounded-[22px] bg-slate-900 text-white p-6">
            <div class="space-y-3">
                <div class="flex items-center gap-3">
                    <span class="text-sm font-semibold text-white/70 w-32">
                        <span class="lang-en-inline">Entity Name:</span>
                        <span class="lang-id-inline">Nama Entitas:</span>
                    </span>
                    <span class="text-sm text-white">MockPay (PT Next Innovation Technology)</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm font-semibold text-white/70 w-32">
                        <span class="lang-en-inline">Jurisdiction:</span>
                        <span class="lang-id-inline">Yurisdiksi:</span>
                    </span>
                    <span class="text-sm text-white">Republic of Indonesia</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm font-semibold text-white/70 w-32">
                        <span class="lang-en-inline">DPO Email:</span>
                        <span class="lang-id-inline">Email DPO:</span>
                    </span>
                    <span class="text-sm text-white">support@m.next-it.my.id</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Information Collected -->
    <section id="information-collected" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">3. Information We Collect</span>
            <span class="lang-id-inline">3. Informasi yang Kami Kumpulkan</span>
        </h2>

        <div class="space-y-4">
            <!-- Account Information -->
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-5">
                <h3 class="text-lg font-semibold text-slate-900 mb-3">
                    <span class="lang-en-inline">3.1 Account Information (Tenant Data)</span>
                    <span class="lang-id-inline">3.1 Informasi Akun (Data Tenant)</span>
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="font-medium text-slate-700 mb-2">
                            <span class="lang-en-inline">Data Collected:</span>
                            <span class="lang-id-inline">Data yang Dikumpulkan:</span>
                        </p>
                        <ul class="list-disc pl-5 text-slate-600 space-y-1">
                            <li><span class="lang-en-inline">Full name</span><span class="lang-id-inline">Nama lengkap</span></li>
                            <li><span class="lang-en-inline">Email address</span><span class="lang-id-inline">Alamat email</span></li>
                            <li><span class="lang-en-inline">Company/organization name</span><span class="lang-id-inline">Nama perusahaan/organisasi</span></li>
                            <li><span class="lang-en-inline">Hashed password</span><span class="lang-id-inline">Password ter-hash</span></li>
                            <li><span class="lang-en-inline">Phone number (optional)</span><span class="lang-id-inline">Nomor telepon (opsional)</span></li>
                        </ul>
                    </div>
                    <div>
                        <p class="font-medium text-slate-700 mb-2">
                            <span class="lang-en-inline">Purpose:</span>
                            <span class="lang-id-inline">Tujuan:</span>
                        </p>
                        <ul class="list-disc pl-5 text-slate-600 space-y-1">
                            <li><span class="lang-en-inline">Account creation and authentication</span><span class="lang-id-inline">Pembuatan akun dan autentikasi</span></li>
                            <li><span class="lang-en-inline">Service provision</span><span class="lang-id-inline">Penyediaan layanan</span></li>
                            <li><span class="lang-en-inline">Communication</span><span class="lang-id-inline">Komunikasi</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- API Credentials -->
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-5">
                <h3 class="text-lg font-semibold text-slate-900 mb-3">
                    <span class="lang-en-inline">3.2 API Credentials & Configuration</span>
                    <span class="lang-id-inline">3.2 Kredensial API & Konfigurasi</span>
                </h3>
                <div class="lang-en">
                    <p class="text-sm text-slate-600 text-justify">
                        We generate and store API keys, webhook URLs, webhook secrets, and configuration settings. These are used solely for authenticating your API requests and delivering webhook notifications. API keys are encrypted at rest using AES-256 encryption.
                    </p>
                </div>
                <div class="lang-id">
                    <p class="text-sm text-slate-600 text-justify">
                        Kami menghasilkan dan menyimpan kunci API, URL webhook, secret webhook, dan pengaturan konfigurasi. Ini digunakan semata-mata untuk mengautentikasi permintaan API Anda dan mengirimkan notifikasi webhook. Kunci API dienkripsi saat disimpan menggunakan enkripsi AES-256.
                    </p>
                </div>
            </div>

            <!-- Simulation Data -->
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-5">
                <h3 class="text-lg font-semibold text-slate-900 mb-3">
                    <span class="lang-en-inline">3.3 Simulation Data (Transaction Data)</span>
                    <span class="lang-id-inline">3.3 Data Simulasi (Data Transaksi)</span>
                </h3>
                <div class="lang-en">
                    <p class="text-sm text-slate-600 mb-3 text-justify">
                        <strong>Important:</strong> All transaction data is fictional test data. We store:
                    </p>
                    <ul class="list-disc pl-5 text-sm text-slate-600 space-y-1">
                        <li>Simulated transaction IDs and order references</li>
                        <li>Test payment method details (dummy card numbers, virtual account numbers)</li>
                        <li>Transaction status history and manual override logs</li>
                        <li>Webhook delivery logs and responses</li>
                        <li>Customer metadata you provide (as Data Processor)</li>
                    </ul>
                </div>
                <div class="lang-id">
                    <p class="text-sm text-slate-600 mb-3 text-justify">
                        <strong>Penting:</strong> Semua data transaksi adalah data uji fiktif. Kami menyimpan:
                    </p>
                    <ul class="list-disc pl-5 text-sm text-slate-600 space-y-1">
                        <li>ID transaksi simulasi dan referensi pesanan</li>
                        <li>Detail metode pembayaran uji (nomor kartu dummy, nomor rekening virtual)</li>
                        <li>Riwayat status transaksi dan log override manual</li>
                        <li>Log pengiriman webhook dan respons</li>
                        <li>Metadata pelanggan yang Anda berikan (sebagai Prosesor Data)</li>
                    </ul>
                </div>
            </div>

            <!-- Technical Data -->
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-5">
                <h3 class="text-lg font-semibold text-slate-900 mb-3">
                    <span class="lang-en-inline">3.4 Technical & Usage Data</span>
                    <span class="lang-id-inline">3.4 Data Teknis & Penggunaan</span>
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <ul class="list-disc pl-5 text-slate-600 space-y-1">
                        <li><span class="lang-en-inline">IP addresses</span><span class="lang-id-inline">Alamat IP</span></li>
                        <li><span class="lang-en-inline">Browser type and version</span><span class="lang-id-inline">Jenis dan versi browser</span></li>
                        <li><span class="lang-en-inline">Device information</span><span class="lang-id-inline">Informasi perangkat</span></li>
                    </ul>
                    <ul class="list-disc pl-5 text-slate-600 space-y-1">
                        <li><span class="lang-en-inline">Access timestamps</span><span class="lang-id-inline">Waktu akses</span></li>
                        <li><span class="lang-en-inline">API request logs</span><span class="lang-id-inline">Log permintaan API</span></li>
                        <li><span class="lang-en-inline">Error logs</span><span class="lang-id-inline">Log kesalahan</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Legal Basis -->
    <section id="legal-basis" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">4. Legal Basis for Processing</span>
            <span class="lang-id-inline">4. Dasar Hukum Pemrosesan</span>
        </h2>
        
        <div class="lang-en">
            <p class="text-base text-slate-600 leading-relaxed mb-4 text-justify">
                In accordance with Article 20 of the UU PDP, we process your personal data based on the following legal grounds:
            </p>
        </div>
        <div class="lang-id">
            <p class="text-base text-slate-600 leading-relaxed mb-4 text-justify">
                Sesuai dengan Pasal 20 UU PDP, kami memproses data pribadi Anda berdasarkan dasar hukum berikut:
            </p>
        </div>

        <div class="space-y-3">
            <div class="flex items-start gap-4 p-4 rounded-[16px] bg-emerald-50 border border-emerald-200">
                <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center flex-shrink-0">
                    <span class="text-white font-bold text-sm">1</span>
                </div>
                <div>
                    <p class="font-semibold text-slate-900 text-sm">
                        <span class="lang-en-inline">Contractual Necessity</span>
                        <span class="lang-id-inline">Kebutuhan Kontraktual</span>
                    </p>
                    <div class="lang-en"><p class="text-xs text-slate-600">Processing necessary to perform our contract with you (Terms of Service)</p></div>
                    <div class="lang-id"><p class="text-xs text-slate-600">Pemrosesan yang diperlukan untuk melaksanakan kontrak kami dengan Anda (Syarat dan Ketentuan)</p></div>
                </div>
            </div>

            <div class="flex items-start gap-4 p-4 rounded-[16px] bg-emerald-50 border border-emerald-200">
                <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center flex-shrink-0">
                    <span class="text-white font-bold text-sm">2</span>
                </div>
                <div>
                    <p class="font-semibold text-slate-900 text-sm">
                        <span class="lang-en-inline">Explicit Consent</span>
                        <span class="lang-id-inline">Persetujuan Eksplisit</span>
                    </p>
                    <div class="lang-en"><p class="text-xs text-slate-600">Where required (e.g., marketing communications), we obtain your explicit consent</p></div>
                    <div class="lang-id"><p class="text-xs text-slate-600">Jika diperlukan (mis. komunikasi pemasaran), kami memperoleh persetujuan eksplisit Anda</p></div>
                </div>
            </div>

            <div class="flex items-start gap-4 p-4 rounded-[16px] bg-emerald-50 border border-emerald-200">
                <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center flex-shrink-0">
                    <span class="text-white font-bold text-sm">3</span>
                </div>
                <div>
                    <p class="font-semibold text-slate-900 text-sm">
                        <span class="lang-en-inline">Legitimate Interest</span>
                        <span class="lang-id-inline">Kepentingan Sah</span>
                    </p>
                    <div class="lang-en"><p class="text-xs text-slate-600">Security monitoring, fraud prevention, and service improvement</p></div>
                    <div class="lang-id"><p class="text-xs text-slate-600">Pemantauan keamanan, pencegahan penipuan, dan peningkatan layanan</p></div>
                </div>
            </div>

            <div class="flex items-start gap-4 p-4 rounded-[16px] bg-emerald-50 border border-emerald-200">
                <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center flex-shrink-0">
                    <span class="text-white font-bold text-sm">4</span>
                </div>
                <div>
                    <p class="font-semibold text-slate-900 text-sm">
                        <span class="lang-en-inline">Legal Obligation</span>
                        <span class="lang-id-inline">Kewajiban Hukum</span>
                    </p>
                    <div class="lang-en"><p class="text-xs text-slate-600">Compliance with applicable Indonesian laws and regulations</p></div>
                    <div class="lang-id"><p class="text-xs text-slate-600">Kepatuhan terhadap hukum dan peraturan Indonesia yang berlaku</p></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Data Usage -->
    <section id="data-usage" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">5. How We Use Your Data</span>
            <span class="lang-id-inline">5. Cara Kami Menggunakan Data Anda</span>
        </h2>

        <div class="rounded-[22px] bg-slate-900 text-white p-6">
            <div class="space-y-4">
                @php
                $usages = [
                    ['en' => 'Providing and maintaining the MockPay simulation service', 'id' => 'Menyediakan dan memelihara layanan simulasi MockPay'],
                    ['en' => 'Processing API requests and delivering webhook notifications', 'id' => 'Memproses permintaan API dan mengirimkan notifikasi webhook'],
                    ['en' => 'Authenticating users and securing account access', 'id' => 'Mengautentikasi pengguna dan mengamankan akses akun'],
                    ['en' => 'Generating transaction simulation reports and exports', 'id' => 'Menghasilkan laporan dan ekspor simulasi transaksi'],
                    ['en' => 'Providing technical support and responding to inquiries', 'id' => 'Menyediakan dukungan teknis dan menanggapi pertanyaan'],
                    ['en' => 'Monitoring service performance and preventing abuse', 'id' => 'Memantau kinerja layanan dan mencegah penyalahgunaan'],
                    ['en' => 'Complying with legal obligations and law enforcement requests', 'id' => 'Mematuhi kewajiban hukum dan permintaan penegak hukum'],
                    ['en' => 'Improving and developing new features', 'id' => 'Meningkatkan dan mengembangkan fitur baru'],
                ];
                @endphp
                @foreach($usages as $usage)
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-sm text-white/90">
                        <span class="lang-en-inline">{{ $usage['en'] }}</span>
                        <span class="lang-id-inline">{{ $usage['id'] }}</span>
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Data Sharing -->
    <section id="data-sharing" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">6. Data Sharing and Disclosure</span>
            <span class="lang-id-inline">6. Pembagian dan Pengungkapan Data</span>
        </h2>

        <div class="lang-en">
            <p class="text-base text-slate-600 leading-relaxed mb-4 text-justify">
                We do not sell, rent, or trade your personal data. We may share your data only in the following limited circumstances:
            </p>
        </div>
        <div class="lang-id">
            <p class="text-base text-slate-600 leading-relaxed mb-4 text-justify">
                Kami tidak menjual, menyewakan, atau memperdagangkan data pribadi Anda. Kami hanya dapat membagikan data Anda dalam keadaan terbatas berikut:
            </p>
        </div>

        <div class="space-y-4">
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-5">
                <h3 class="text-base font-semibold text-slate-900 mb-2">
                    <span class="lang-en-inline">Service Providers</span>
                    <span class="lang-id-inline">Penyedia Layanan</span>
                </h3>
                <div class="lang-en">
                    <p class="text-sm text-slate-600 text-justify">Cloud hosting (DigitalOcean, AWS), email services, analytics providers who process data on our behalf under strict confidentiality agreements.</p>
                </div>
                <div class="lang-id">
                    <p class="text-sm text-slate-600 text-justify">Hosting cloud (DigitalOcean, AWS), layanan email, penyedia analitik yang memproses data atas nama kami berdasarkan perjanjian kerahasiaan yang ketat.</p>
                </div>
            </div>

            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-5">
                <h3 class="text-base font-semibold text-slate-900 mb-2">
                    <span class="lang-en-inline">Legal Requirements</span>
                    <span class="lang-id-inline">Persyaratan Hukum</span>
                </h3>
                <div class="lang-en">
                    <p class="text-sm text-slate-600 text-justify">When required by Indonesian law, court order, or government authority with valid jurisdiction (e.g., law enforcement requests pursuant to KUHAP).</p>
                </div>
                <div class="lang-id">
                    <p class="text-sm text-slate-600 text-justify">Ketika diwajibkan oleh hukum Indonesia, perintah pengadilan, atau otoritas pemerintah dengan yurisdiksi yang sah (mis. permintaan penegak hukum sesuai KUHAP).</p>
                </div>
            </div>

            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-5">
                <h3 class="text-base font-semibold text-slate-900 mb-2">
                    <span class="lang-en-inline">Business Transfers</span>
                    <span class="lang-id-inline">Transfer Bisnis</span>
                </h3>
                <div class="lang-en">
                    <p class="text-sm text-slate-600 text-justify">In connection with a merger, acquisition, or sale of assets, with prior notification to affected users.</p>
                </div>
                <div class="lang-id">
                    <p class="text-sm text-slate-600 text-justify">Sehubungan dengan merger, akuisisi, atau penjualan aset, dengan pemberitahuan sebelumnya kepada pengguna yang terpengaruh.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Data Retention -->
    <section id="data-retention" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">7. Data Retention</span>
            <span class="lang-id-inline">7. Penyimpanan Data</span>
        </h2>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border border-slate-200 rounded-[16px] overflow-hidden">
                <thead class="bg-slate-100">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-slate-900">
                            <span class="lang-en-inline">Data Type</span>
                            <span class="lang-id-inline">Jenis Data</span>
                        </th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-900">
                            <span class="lang-en-inline">Retention Period</span>
                            <span class="lang-id-inline">Periode Penyimpanan</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <tr>
                        <td class="px-4 py-3 text-slate-600">
                            <span class="lang-en-inline">Account Data</span>
                            <span class="lang-id-inline">Data Akun</span>
                        </td>
                        <td class="px-4 py-3 text-slate-600">
                            <span class="lang-en-inline">Duration of account + 5 years after deletion</span>
                            <span class="lang-id-inline">Durasi akun + 5 tahun setelah penghapusan</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-slate-600">
                            <span class="lang-en-inline">Transaction Simulation Data</span>
                            <span class="lang-id-inline">Data Simulasi Transaksi</span>
                        </td>
                        <td class="px-4 py-3 text-slate-600">
                            <span class="lang-en-inline">90 days (Free) / 1 year (Pro) / Custom (Enterprise)</span>
                            <span class="lang-id-inline">90 hari (Gratis) / 1 tahun (Pro) / Kustom (Enterprise)</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-slate-600">
                            <span class="lang-en-inline">Webhook Logs</span>
                            <span class="lang-id-inline">Log Webhook</span>
                        </td>
                        <td class="px-4 py-3 text-slate-600">
                            <span class="lang-en-inline">30 days (Free) / 90 days (Pro)</span>
                            <span class="lang-id-inline">30 hari (Gratis) / 90 hari (Pro)</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-slate-600">
                            <span class="lang-en-inline">API Logs</span>
                            <span class="lang-id-inline">Log API</span>
                        </td>
                        <td class="px-4 py-3 text-slate-600">
                            <span class="lang-en-inline">7 days (Free) / 30 days (Pro)</span>
                            <span class="lang-id-inline">7 hari (Gratis) / 30 hari (Pro)</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-slate-600">
                            <span class="lang-en-inline">Security/Audit Logs</span>
                            <span class="lang-id-inline">Log Keamanan/Audit</span>
                        </td>
                        <td class="px-4 py-3 text-slate-600">
                            <span class="lang-en-inline">7 years (legal requirement)</span>
                            <span class="lang-id-inline">7 tahun (persyaratan hukum)</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Data Security -->
    <section id="data-security" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">8. Data Security</span>
            <span class="lang-id-inline">8. Keamanan Data</span>
        </h2>

        <div class="rounded-[22px] bg-slate-900 text-white p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @php
                $security = [
                    ['icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z', 'en_title' => 'TLS 1.3 Encryption', 'id_title' => 'Enkripsi TLS 1.3', 'en_desc' => 'All data in transit encrypted', 'id_desc' => 'Semua data dienkripsi saat transit'],
                    ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'en_title' => 'AES-256 at Rest', 'id_title' => 'AES-256 saat Istirahat', 'en_desc' => 'Sensitive data encrypted at rest', 'id_desc' => 'Data sensitif dienkripsi saat disimpan'],
                    ['icon' => 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z', 'en_title' => 'Bcrypt Password Hashing', 'id_title' => 'Hashing Password Bcrypt', 'en_desc' => 'Passwords never stored in plaintext', 'id_desc' => 'Password tidak pernah disimpan dalam teks biasa'],
                    ['icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'en_title' => 'Rate Limiting & DDoS Protection', 'id_title' => 'Pembatasan Rate & Perlindungan DDoS', 'en_desc' => 'Protection against abuse', 'id_desc' => 'Perlindungan terhadap penyalahgunaan'],
                ];
                @endphp
                @foreach($security as $item)
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">
                            <span class="lang-en-inline">{{ $item['en_title'] }}</span>
                            <span class="lang-id-inline">{{ $item['id_title'] }}</span>
                        </p>
                        <p class="text-xs text-white/70">
                            <span class="lang-en-inline">{{ $item['en_desc'] }}</span>
                            <span class="lang-id-inline">{{ $item['id_desc'] }}</span>
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Your Rights -->
    <section id="your-rights" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">9. Your Rights Under UU PDP</span>
            <span class="lang-id-inline">9. Hak Anda Berdasarkan UU PDP</span>
        </h2>

        <div class="lang-en">
            <p class="text-base text-slate-600 leading-relaxed mb-4 text-justify">
                Under Indonesian Personal Data Protection Law (UU PDP), you have the following rights:
            </p>
        </div>
        <div class="lang-id">
            <p class="text-base text-slate-600 leading-relaxed mb-4 text-justify">
                Berdasarkan Undang-Undang Perlindungan Data Pribadi Indonesia (UU PDP), Anda memiliki hak-hak berikut:
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @php
            $rights = [
                ['en_title' => 'Right to Access', 'id_title' => 'Hak Akses', 'en_desc' => 'Obtain confirmation and copies of your personal data', 'id_desc' => 'Mendapatkan konfirmasi dan salinan data pribadi Anda'],
                ['en_title' => 'Right to Rectification', 'id_title' => 'Hak Koreksi', 'en_desc' => 'Correct inaccurate or incomplete data', 'id_desc' => 'Memperbaiki data yang tidak akurat atau tidak lengkap'],
                ['en_title' => 'Right to Erasure', 'id_title' => 'Hak Penghapusan', 'en_desc' => 'Request deletion of your personal data', 'id_desc' => 'Meminta penghapusan data pribadi Anda'],
                ['en_title' => 'Right to Restrict Processing', 'id_title' => 'Hak Pembatasan Pemrosesan', 'en_desc' => 'Limit how we use your data', 'id_desc' => 'Membatasi cara kami menggunakan data Anda'],
                ['en_title' => 'Right to Data Portability', 'id_title' => 'Hak Portabilitas Data', 'en_desc' => 'Receive your data in portable format', 'id_desc' => 'Menerima data Anda dalam format portabel'],
                ['en_title' => 'Right to Withdraw Consent', 'id_title' => 'Hak Menarik Persetujuan', 'en_desc' => 'Withdraw consent at any time', 'id_desc' => 'Menarik persetujuan kapan saja'],
            ];
            @endphp
            @foreach($rights as $right)
            <div class="rounded-[22px] border border-slate-200 bg-slate-50 p-4">
                <p class="font-semibold text-slate-900 text-sm mb-1">
                    <span class="lang-en-inline">{{ $right['en_title'] }}</span>
                    <span class="lang-id-inline">{{ $right['id_title'] }}</span>
                </p>
                <p class="text-xs text-slate-600">
                    <span class="lang-en-inline">{{ $right['en_desc'] }}</span>
                    <span class="lang-id-inline">{{ $right['id_desc'] }}</span>
                </p>
            </div>
            @endforeach
        </div>

        <div class="mt-4 rounded-[16px] bg-amber-50 border border-amber-200 p-4">
            <div class="lang-en">
                <p class="text-xs text-amber-800 text-justify">
                    <strong>How to Exercise:</strong> Submit requests to support@m.next-it.my.id. We will respond within 3×24 hours and fulfill valid requests within 14 days per UU PDP requirements.
                </p>
            </div>
            <div class="lang-id">
                <p class="text-xs text-amber-800 text-justify">
                    <strong>Cara Menggunakan:</strong> Kirim permintaan ke support@m.next-it.my.id. Kami akan merespons dalam 3×24 jam dan memenuhi permintaan yang valid dalam 14 hari sesuai persyaratan UU PDP.
                </p>
            </div>
        </div>
    </section>

    <!-- Data Breach -->
    <section id="data-breach" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">10. Data Breach Notification</span>
            <span class="lang-id-inline">10. Pemberitahuan Pelanggaran Data</span>
        </h2>

        <div class="rounded-[22px] bg-red-50 border border-red-200 p-6">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-red-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div>
                    <div class="lang-en">
                        <p class="text-sm text-red-800 text-justify mb-3">
                            In accordance with Article 46 of UU PDP, in the event of a personal data breach that poses a risk to data subjects:
                        </p>
                        <ul class="list-disc pl-5 text-sm text-red-800 space-y-1">
                            <li>We will notify affected users <strong>within 72 hours</strong> of becoming aware of the breach</li>
                            <li>We will notify the relevant Indonesian authorities as required by law</li>
                            <li>Notification will include: nature of breach, affected data, mitigation measures, and contact information</li>
                        </ul>
                    </div>
                    <div class="lang-id">
                        <p class="text-sm text-red-800 text-justify mb-3">
                            Sesuai dengan Pasal 46 UU PDP, dalam hal terjadi pelanggaran data pribadi yang menimbulkan risiko bagi subjek data:
                        </p>
                        <ul class="list-disc pl-5 text-sm text-red-800 space-y-1">
                            <li>Kami akan memberitahu pengguna yang terdampak <strong>dalam 72 jam</strong> setelah mengetahui pelanggaran</li>
                            <li>Kami akan memberitahu otoritas Indonesia yang relevan sesuai ketentuan hukum</li>
                            <li>Pemberitahuan akan mencakup: sifat pelanggaran, data yang terdampak, langkah mitigasi, dan informasi kontak</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- International Transfer -->
    <section id="international-transfer" class="mb-12">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">11. International Data Transfer</span>
            <span class="lang-id-inline">11. Transfer Data Internasional</span>
        </h2>

        <div class="lang-en">
            <p class="text-base text-slate-600 leading-relaxed mb-4 text-justify">
                Our primary servers are located in Singapore and Indonesia. If we transfer personal data to countries outside Indonesia, we ensure that:
            </p>
            <ul class="list-disc pl-5 text-base text-slate-600 space-y-2 mb-4">
                <li>The receiving country has adequate data protection laws, OR</li>
                <li>Appropriate contractual safeguards are in place (Standard Contractual Clauses), OR</li>
                <li>We have obtained your explicit consent for the transfer</li>
            </ul>
            <p class="text-sm text-slate-500">This is in compliance with Article 56 of UU PDP regarding cross-border data transfers.</p>
        </div>
        <div class="lang-id">
            <p class="text-base text-slate-600 leading-relaxed mb-4 text-justify">
                Server utama kami berlokasi di Singapura dan Indonesia. Jika kami mentransfer data pribadi ke negara di luar Indonesia, kami memastikan bahwa:
            </p>
            <ul class="list-disc pl-5 text-base text-slate-600 space-y-2 mb-4">
                <li>Negara penerima memiliki undang-undang perlindungan data yang memadai, ATAU</li>
                <li>Perlindungan kontraktual yang sesuai telah ada (Klausul Kontraktual Standar), ATAU</li>
                <li>Kami telah memperoleh persetujuan eksplisit Anda untuk transfer tersebut</li>
            </ul>
            <p class="text-sm text-slate-500">Ini sesuai dengan Pasal 56 UU PDP tentang transfer data lintas batas.</p>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact" class="mb-8">
        <h2 class="text-2xl font-semibold text-slate-900 mb-4">
            <span class="lang-en-inline">12. Contact Us</span>
            <span class="lang-id-inline">12. Hubungi Kami</span>
        </h2>

        <div class="rounded-[22px] bg-slate-900 text-white p-6">
            <div class="space-y-4">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wider text-white/50 mb-1">
                            <span class="lang-en-inline">Data Protection Officer</span>
                            <span class="lang-id-inline">Petugas Perlindungan Data</span>
                        </p>
                        <p class="text-sm font-semibold text-white">support@m.next-it.my.id</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wider text-white/50 mb-1">
                            <span class="lang-en-inline">Legal Department</span>
                            <span class="lang-id-inline">Departemen Hukum</span>
                        </p>
                        <p class="text-sm font-semibold text-white">support@m.next-it.my.id</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 rounded-[16px] bg-slate-100 border border-slate-200 p-4">
            <div class="lang-en">
                <p class="text-xs text-slate-600 text-center">
                    <strong>Legal Notice:</strong> This Privacy Policy is governed by Indonesian law. Any disputes shall be resolved through the courts of Jakarta, Indonesia. We reserve the right to modify this Policy with 30 days prior notice.
                </p>
            </div>
            <div class="lang-id">
                <p class="text-xs text-slate-600 text-center">
                    <strong>Pemberitahuan Hukum:</strong> Kebijakan Privasi ini diatur oleh hukum Indonesia. Setiap sengketa akan diselesaikan melalui pengadilan Jakarta, Indonesia. Kami berhak mengubah Kebijakan ini dengan pemberitahuan 30 hari sebelumnya.
                </p>
            </div>
        </div>
    </section>
</div>
@endsection
