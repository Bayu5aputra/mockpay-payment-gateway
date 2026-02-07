<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode OTP Registrasi</title>
</head>
<body style="margin:0; padding:0; background:#f8fafc; font-family:'Google Sans', Arial, sans-serif; color:#0f172a;">
    <div style="max-width:640px; margin:0 auto; padding:24px;">
        <div style="background:#ffffff; border-radius:12px; padding:24px; box-shadow:0 10px 25px rgba(15, 23, 42, 0.08);">
            <div style="display:flex; align-items:center; gap:12px; border-bottom:1px solid #e2e8f0; padding-bottom:12px;">
                <img src="{{ rtrim(config('app.url'), '/') . '/logo.png' }}" alt="MockPay" style="width:40px; height:40px; object-fit:contain;">
                <div>
                    <div style="font-size:18px; font-weight:700;">MockPay</div>
                    <div style="font-size:12px; color:#64748b;">Verifikasi Registrasi</div>
                </div>
            </div>

            <div style="margin-top:16px; font-size:14px; color:#475569;">
                Halo {{ $name }}, gunakan kode berikut untuk menyelesaikan pendaftaran akun Anda.
            </div>

            <div style="margin-top:16px; background:#f1f5f9; border-radius:12px; padding:16px; text-align:center;">
                <div style="font-size:24px; letter-spacing:8px; font-weight:700; color:#0f172a;">
                    {{ $otp }}
                </div>
                <div style="margin-top:8px; font-size:12px; color:#64748b;">
                    Kode berlaku selama 10 menit.
                </div>
            </div>

            <div style="margin-top:16px; font-size:12px; color:#64748b;">
                Jika Anda tidak melakukan pendaftaran, abaikan email ini.
            </div>
        </div>
    </div>
</body>
</html>
