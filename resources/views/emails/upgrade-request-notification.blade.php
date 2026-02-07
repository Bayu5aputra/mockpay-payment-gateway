<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Upgrade Request</title>
</head>
<body style="margin:0; padding:0; background:#f8fafc; font-family:'Google Sans', Arial, sans-serif; color:#0f172a;">
    <div style="max-width:640px; margin:0 auto; padding:24px;">
        <div style="background:#ffffff; border-radius:12px; padding:24px; box-shadow:0 10px 25px rgba(15, 23, 42, 0.08);">
            <div style="display:flex; align-items:center; gap:12px; border-bottom:1px solid #e2e8f0; padding-bottom:12px;">
                <img src="{{ rtrim(config('app.url'), '/') . '/logo.png' }}" alt="MockPay" style="width:40px; height:40px; object-fit:contain;">
                <div>
                    <div style="font-size:18px; font-weight:700;">MockPay</div>
                    <div style="font-size:12px; color:#64748b;">Notifikasi Upgrade Request</div>
                </div>
            </div>

            <div style="margin-top:16px; font-size:14px; color:#475569;">
                Ada request upgrade baru yang masuk.
            </div>

            <div style="margin-top:16px; background:#f1f5f9; border-radius:10px; padding:16px; font-size:13px;">
                <div style="margin-bottom:6px;"><strong>Nama:</strong> {{ $upgradeRequest->user->name }}</div>
                <div style="margin-bottom:6px;"><strong>Email:</strong> {{ $upgradeRequest->user->email }}</div>
                <div style="margin-bottom:6px;"><strong>Plan:</strong> {{ strtoupper($upgradeRequest->plan) }}</div>
                <div style="margin-bottom:6px;"><strong>Total:</strong> Rp {{ number_format($upgradeRequest->total_amount, 0, ',', '.') }}</div>
                <div><strong>Tanggal:</strong> {{ $upgradeRequest->created_at->format('d M Y H:i') }}</div>
            </div>

            <div style="margin-top:16px; font-size:12px; color:#64748b;">
                Silakan masuk ke dashboard merchant untuk melakukan review dan approve/reject.
            </div>
        </div>
    </div>
</body>
</html>
