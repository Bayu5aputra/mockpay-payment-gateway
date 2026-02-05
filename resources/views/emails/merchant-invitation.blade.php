<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Invitation</title>
</head>
<body style="margin:0; padding:0; background:#f8fafc; font-family:Arial, sans-serif; color:#0f172a;">
    <div style="max-width:640px; margin:0 auto; padding:24px;">
        <div style="background:#ffffff; border:1px solid #e2e8f0; border-radius:12px; padding:24px;">
            <h1 style="margin:0 0 12px; font-size:22px;">You are invited to join MockPay</h1>
            <p style="margin:0 0 16px; font-size:14px; color:#475569;">
                {{ $merchant->company_name ?? $merchant->name }} invited you to create a merchant account.
            </p>
            <p style="margin:0 0 16px; font-size:14px; color:#475569;">
                This invitation will expire on
                <strong>{{ $invitation->expires_at?->format('d M Y, H:i') ?? 'N/A' }}</strong>.
            </p>

            <a href="{{ route('merchant-invitations.accept', $invitation->token) }}"
               style="display:inline-block; padding:12px 18px; background:#6d28d9; color:#ffffff; text-decoration:none; border-radius:8px; font-weight:bold;">
                Accept Invitation
            </a>

            <p style="margin:16px 0 0; font-size:12px; color:#64748b;">
                If the button doesn’t work, copy and paste this link:
                <br>
                {{ route('merchant-invitations.accept', $invitation->token) }}
            </p>
        </div>
    </div>
</body>
</html>
