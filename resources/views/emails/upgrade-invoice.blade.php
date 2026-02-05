<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Upgrade MockPay</title>
</head>
<body style="margin:0; padding:0; background:#f8fafc; font-family: 'Google Sans', Arial, sans-serif; color:#0f172a;">
    <div style="max-width:720px; margin:0 auto; padding:32px;">
        <div style="background:#ffffff; border-radius:12px; padding:32px; box-shadow:0 10px 25px rgba(15, 23, 42, 0.08); position:relative;">
            @if($upgradeRequest->status === 'approved')
                <div style="position:absolute; right:-48px; top:24px; background:#7cc243; color:#ffffff; padding:8px 64px; transform:rotate(35deg); font-size:12px; font-weight:700; letter-spacing:1px;">
                    PAID
                </div>
            @endif
            <div style="display:flex; align-items:center; justify-content:space-between; border-bottom:2px solid #e5e7eb; padding-bottom:16px;">
                <div style="display:flex; align-items:center; gap:12px;">
                    <img src="{{ asset('logo.png') }}" alt="MockPay" style="width:52px; height:52px; object-fit:contain;">
                    <div>
                        <div style="font-size:20px; font-weight:700;">MockPay</div>
                        <div style="font-size:12px; color:#64748b;">Dummy payment gateway for developers</div>
                        <div style="font-size:12px; color:#64748b;">support@mockpay.test</div>
                    </div>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:12px; color:#64748b;">Invoice</div>
                    <div style="font-size:18px; font-weight:700;">{{ $upgradeRequest->invoice_number ?? '-' }}</div>
                </div>
            </div>

            <div style="margin-top:16px; display:flex; justify-content:space-between; gap:24px;">
                <div>
                    <div style="font-size:12px; color:#64748b;">Invoice Date</div>
                    <div style="font-size:13px; font-weight:600;">{{ $upgradeRequest->approved_at?->format('l, d F Y') ?? now()->format('l, d F Y') }}</div>
                    <div style="font-size:12px; color:#64748b; margin-top:8px;">Due Date</div>
                    <div style="font-size:13px; font-weight:600;">{{ $upgradeRequest->approved_at?->copy()->addDays(7)->format('l, d F Y') ?? now()->addDays(7)->format('l, d F Y') }}</div>
                </div>
                <div style="text-align:left;">
                    <div style="font-size:12px; color:#64748b;">Invoice To</div>
                    <div style="font-size:13px; font-weight:600;">{{ $upgradeRequest->user->name }}</div>
                    <div style="font-size:12px; color:#64748b;">{{ $upgradeRequest->user->email }}</div>
                </div>
            </div>

            <div style="margin-top:20px; background:#f3f4f6; border-radius:8px; padding:12px 16px;">
                <div style="font-size:14px; font-weight:700;">Invoice {{ $upgradeRequest->invoice_number ?? '' }}</div>
            </div>

            <div style="margin-top:12px;">
                <table style="width:100%; border-collapse:collapse; font-size:13px;">
                    <tr style="background:#f3f4f6;">
                        <th style="text-align:left; padding:8px;">Description</th>
                        <th style="text-align:right; padding:8px;">Total</th>
                    </tr>
                    <tr>
                        <td style="padding:8px 0;">Upgrade Plan {{ strtoupper($upgradeRequest->plan) }}</td>
                        <td style="padding:8px 0; text-align:right;">Rp {{ number_format($upgradeRequest->base_price, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="padding:8px 0;">Pajak ({{ number_format($upgradeRequest->tax_rate, 2) }}%)</td>
                        <td style="padding:8px 0; text-align:right;">Rp {{ number_format($upgradeRequest->tax_amount, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="padding:8px 0;">Biaya Layanan/Admin</td>
                        <td style="padding:8px 0; text-align:right;">Rp {{ number_format($upgradeRequest->admin_fee, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="padding:10px 0; font-weight:700; border-top:1px solid #e5e7eb;">Total</td>
                        <td style="padding:10px 0; text-align:right; font-weight:700; border-top:1px solid #e5e7eb;">
                            Rp {{ number_format($upgradeRequest->total_amount, 0, ',', '.') }}
                        </td>
                    </tr>
                </table>
            </div>

            <div style="margin-top:20px;">
                <div style="font-size:14px; font-weight:600; margin-bottom:8px;">Transactions</div>
                <table style="width:100%; border-collapse:collapse; font-size:12px; background:#ffffff; border:1px solid #e5e7eb;">
                    <tr style="background:#f3f4f6;">
                        <th style="text-align:left; padding:8px;">Transaction Date</th>
                        <th style="text-align:left; padding:8px;">Gateway</th>
                        <th style="text-align:left; padding:8px;">Transaction ID</th>
                        <th style="text-align:right; padding:8px;">Amount</th>
                    </tr>
                    <tr>
                        <td style="padding:8px;">{{ $upgradeRequest->approved_at?->format('l, d F Y') ?? now()->format('l, d F Y') }}</td>
                        <td style="padding:8px;">Manual Transfer</td>
                        <td style="padding:8px;">{{ $upgradeRequest->invoice_number ?? '-' }}</td>
                        <td style="padding:8px; text-align:right;">Rp {{ number_format($upgradeRequest->total_amount, 0, ',', '.') }}</td>
                    </tr>
                    <tr style="background:#f3f4f6;">
                        <td colspan="3" style="padding:8px; text-align:right; font-weight:600;">Balance</td>
                        <td style="padding:8px; text-align:right; font-weight:600;">Rp 0</td>
                    </tr>
                </table>
            </div>

            <div style="margin-top:20px; font-size:13px; color:#64748b;">
                Metode Transfer (manual):
                <table style="width:100%; border-collapse:collapse; font-size:12px; margin-top:6px;">
                    @foreach ($banks as $bank)
                        <tr>
                            <td style="padding:4px 0; color:#475569;">{{ $bank['name'] }}</td>
                            <td style="padding:4px 0; text-align:right; color:#475569;">
                                {{ $bank['account_number'] ?? 'Belum diatur' }} · {{ $bank['account_name'] }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div style="margin-top:20px; padding-top:12px; border-top:1px solid #e2e8f0; font-size:11px; color:#94a3b8; text-align:center;">
                PDF generated on {{ now()->format('l, d F Y') }} · © {{ now()->format('Y') }} MockPay.
            </div>
        </div>
    </div>
</body>
</html>
