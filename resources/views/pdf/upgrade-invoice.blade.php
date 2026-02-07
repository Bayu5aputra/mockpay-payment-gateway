<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $upgradeRequest->invoice_number ?? '' }}</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; color: #0f172a; }
        .wrapper { padding: 24px; position: relative; }
        .title { font-size: 20px; font-weight: 700; }
        .muted { color: #64748b; font-size: 12px; }
        .card { border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px; margin-top: 16px; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        td, th { padding: 6px 0; }
        th { text-align: left; background: #f3f4f6; padding: 8px; }
        .total { font-weight: 700; border-top: 1px solid #e5e7eb; padding-top: 8px; }
        .ribbon { position: absolute; right: -40px; top: 16px; background: #7cc243; color: #fff; padding: 6px 48px; transform: rotate(35deg); font-size: 11px; font-weight: 700; letter-spacing: 1px; }
        .section-title { font-size: 13px; font-weight: 700; margin-bottom: 6px; }
        .gray-box { background: #f3f4f6; border-radius: 8px; padding: 10px 12px; }
    </style>
</head>
<body>
    <div class="wrapper">
        @if($upgradeRequest->status === 'approved')
            <div class="ribbon">PAID</div>
        @endif

        <table style="width:100%;">
            <tr>
                <td style="width:70%;">
                    <table>
                        <tr>
                            <td style="padding-right:10px;">
                                <div style="width:48px; height:48px; background:linear-gradient(135deg, #6366f1, #8b5cf6); border-radius:10px; display:flex; align-items:center; justify-content:center;">
                                    <span style="color:#fff; font-weight:700; font-size:18px;">MP</span>
                                </div>
                            </td>
                            <td>
                                <div class="title">MockPay</div>
                                <div class="muted">Dummy payment gateway for developers</div>
                                <div class="muted">support@mockpay.test</div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="text-align:right;">
                    <div class="muted">Invoice</div>
                    <div style="font-weight:700;">{{ $upgradeRequest->invoice_number ?? '-' }}</div>
                </td>
            </tr>
        </table>

        <div class="gray-box" style="margin-top:12px;">
            <strong>Invoice {{ $upgradeRequest->invoice_number ?? '' }}</strong>
        </div>

        <table style="width:100%; margin-top:12px;">
            <tr>
                <td>
                    <div class="muted">Invoice Date</div>
                    <div style="font-weight:600;">{{ $upgradeRequest->approved_at?->format('l, d F Y') ?? now()->format('l, d F Y') }}</div>
                    <div class="muted" style="margin-top:6px;">Due Date</div>
                    <div style="font-weight:600;">{{ $upgradeRequest->approved_at?->copy()->addDays(7)->format('l, d F Y') ?? now()->addDays(7)->format('l, d F Y') }}</div>
                </td>
                <td style="text-align:right;">
                    <div class="muted">Invoice To</div>
                    <div style="font-weight:600;">{{ $upgradeRequest->user->name }}</div>
                    <div class="muted">{{ $upgradeRequest->user->email }}</div>
                </td>
            </tr>
        </table>

        <div class="card">
            <table>
                <tr>
                    <th>Description</th>
                    <th style="text-align:right;">Total</th>
                </tr>
                <tr>
                    <td>Upgrade Plan {{ strtoupper($upgradeRequest->plan) }}</td>
                    <td style="text-align:right;">Rp {{ number_format($upgradeRequest->base_price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Pajak ({{ number_format($upgradeRequest->tax_rate, 2) }}%)</td>
                    <td style="text-align:right;">Rp {{ number_format($upgradeRequest->tax_amount, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Biaya Layanan/Admin</td>
                    <td style="text-align:right;">Rp {{ number_format($upgradeRequest->admin_fee, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="total">Total</td>
                    <td class="total" style="text-align:right;">Rp {{ number_format($upgradeRequest->total_amount, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <div class="section-title">Transactions</div>
        <table style="border:1px solid #e5e7eb;">
            <tr>
                <th>Transaction Date</th>
                <th>Gateway</th>
                <th>Transaction ID</th>
                <th style="text-align:right;">Amount</th>
            </tr>
            <tr>
                <td>{{ $upgradeRequest->approved_at?->format('l, d F Y') ?? now()->format('l, d F Y') }}</td>
                <td>Manual Transfer</td>
                <td>{{ $upgradeRequest->invoice_number ?? '-' }}</td>
                <td style="text-align:right;">Rp {{ number_format($upgradeRequest->total_amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:right; font-weight:600; background:#f3f4f6;">Balance</td>
                <td style="text-align:right; font-weight:600; background:#f3f4f6;">Rp 0</td>
            </tr>
        </table>

        <div class="card">
            <div class="section-title">Metode Transfer (manual)</div>
            <table>
                @foreach ($banks as $bank)
                    <tr>
                        <td>{{ $bank['name'] }}</td>
                        <td style="text-align:right;">{{ $bank['account_number'] ?? 'Belum diatur' }} · {{ $bank['account_name'] }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="muted" style="margin-top:12px; text-align:center;">
            PDF generated on {{ now()->format('l, d F Y') }} · © {{ now()->format('Y') }} MockPay.
        </div>
    </div>
</body>
</html>
