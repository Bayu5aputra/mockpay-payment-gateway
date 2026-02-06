<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transaction Receipt</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 12px; color: #111827; }
        .header { margin-bottom: 16px; }
        .title { font-size: 18px; font-weight: bold; }
        .section { margin-top: 14px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 6px 8px; border-bottom: 1px solid #e5e7eb; }
        .muted { color: #6b7280; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">MockPay Transaction Receipt</div>
        <div class="muted">Transaction ID: {{ $transaction->transaction_id }}</div>
        <div class="muted">Order ID: {{ $transaction->order_id }}</div>
    </div>

    <div class="section">
        <table>
            <tr>
                <th>Customer</th>
                <td>{{ $transaction->customer_name }} ({{ $transaction->customer_email }})</td>
            </tr>
            <tr>
                <th>Amount</th>
                <td>Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Fee</th>
                <td>Rp {{ number_format($transaction->fee ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Total</th>
                <td>Rp {{ number_format($transaction->total_amount ?? $transaction->amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ strtoupper($transaction->status) }}</td>
            </tr>
            <tr>
                <th>Created At</th>
                <td>{{ $transaction->created_at?->format('Y-m-d H:i:s') }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="title">Manual Override History</div>
        <table>
            <thead>
                <tr>
                    <th>From</th>
                    <th>To</th>
                    <th>Reason</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse($overrides as $override)
                    <tr>
                        <td>{{ strtoupper($override->previous_status) }}</td>
                        <td>{{ strtoupper($override->new_status) }}</td>
                        <td>{{ $override->reason ?? '-' }}</td>
                        <td>{{ $override->created_at?->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="muted">No overrides recorded.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="title">Webhook Logs</div>
        <table>
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Status</th>
                    <th>Attempts</th>
                    <th>Sent At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($webhookLogs as $log)
                    <tr>
                        <td>{{ $log->event }}</td>
                        <td>{{ $log->status }}</td>
                        <td>{{ $log->attempt_count }}</td>
                        <td>{{ $log->sent_at?->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="muted">No webhook logs recorded.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
