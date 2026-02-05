# MockPay API

MockPay adalah platform SaaS mock payment gateway berbasis Laravel untuk kebutuhan development, testing, dan simulasi alur pembayaran seperti di production. Setiap user/client/guest memiliki data yang terisolasi (multi-tenant). Aplikasi ini menyediakan API, dashboard client, halaman checkout, dan simulator pembayaran untuk berbagai metode.

---

## Fitur Utama

- API Key authentication (Bearer token)
- Manajemen merchant (admin) dan client
- Multi payment channel (VA, e-wallet, credit card, QRIS, retail)
- Transaction, settlement, refund, dan webhook flow
- Dashboard dan dokumentasi publik
- Simulator pembayaran untuk testing skenario per client (client mengatur hasil simulasi)

---

## Persyaratan

- PHP 8.2+
- Composer
- Node.js 18+ dan npm
- Database SQLite atau MySQL

---

## Quick Start (Local)

### Opsi 1: Script setup

```bash
composer run setup
```

### Opsi 2: Manual

```bash
composer install
copy .env.example .env
```

Jika menggunakan SQLite:

```bash
mkdir -Force database
New-Item -ItemType File -Path database\database.sqlite
```

Lanjutkan:

```bash
php artisan key:generate
php artisan migrate
npm install
npm run build
```

---

## Menjalankan Aplikasi

Dev mode (server + queue + logs + Vite):

```bash
composer run dev
```

Atau jalankan terpisah:

```bash
php artisan serve
php artisan queue:listen --tries=1 --timeout=0
npm run dev
```

Pastikan `APP_URL` di `.env` sesuai alamat lokal, misalnya:

```
APP_URL=http://127.0.0.1:8000
```

---

## Panduan Penggunaan (Guest vs Client vs Merchant)

### Guest (tanpa login)

Guest dapat:

- Akses dokumentasi: `/docs`
- Akses simulator pembayaran:
  - `/payment/simulate/va`
  - `/payment/simulate/ewallet`
  - `/payment/simulate/qris`
  - `/payment/simulate/retail`
- Health check API: `GET /api/health`
- Ringkas endpoint API: `GET /api/docs`

### Client (login)

Client diperlukan untuk:

- Mendapatkan API Key
- Mengakses dashboard dan tools developer
- Menjalankan request ke endpoint `/api/v1/*`
- Mengatur alur dan hasil simulasi transaksi miliknya sendiri
- Mengelola webhook dan API integration miliknya sendiri

### Merchant (admin)

Merchant digunakan untuk:

- Mengelola user/client/guest
- Melakukan approval plan Pro/Enterprise
- Melihat ringkasan penggunaan platform

Langkah singkat:

1. Register: `/register`
2. Login: `/login`
3. Buat API Key: Client Dashboard -> API Keys
4. Gunakan Server Key di header:

```
Authorization: Bearer <server_key>
```

Base URL API mengikuti `APP_URL`, contoh:

```
http://127.0.0.1:8000/api/v1
```

---

## Dokumentasi

Dokumentasi lengkap tersedia di:

- `/docs`
- `/docs/getting-started`
- `/docs/api-reference`

---

## Testing

```bash
php artisan test
```
