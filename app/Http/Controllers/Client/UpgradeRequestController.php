<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\UpgradeRequest;
use App\Mail\UpgradeRequestNotificationMail;
use App\Services\UpgradeProofService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class UpgradeRequestController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $requests = UpgradeRequest::where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('client.upgrade.index', compact('requests', 'user'));
    }

    public function create()
    {
        $user = Auth::user();
        $pricing = Config::get('mockpay.upgrade');
        $banks = Config::get('mockpay.banks', []);

        return view('client.upgrade.create', compact('user', 'pricing', 'banks'));
    }

    public function store(Request $request, UpgradeProofService $proofService)
    {
        $pricing = Config::get('mockpay.upgrade');
        $enterpriseMin = $pricing['plans']['enterprise_min'];

        $validated = $request->validate([
            'plan' => 'required|in:pro,enterprise',
            'requested_price' => 'nullable|integer|min:' . $enterpriseMin,
            'notes' => 'nullable|string|max:2000',
            'proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $plan = $validated['plan'];
        $basePrice = $plan === 'pro'
            ? $pricing['plans']['pro']
            : max($enterpriseMin, (int) ($validated['requested_price'] ?? $enterpriseMin));

        $taxRate = $pricing['tax_rate'];
        $taxAmount = (int) round($basePrice * $taxRate);
        $adminFee = $pricing['admin_fee'];
        $totalAmount = $basePrice + $taxAmount + $adminFee;

        $proofData = $proofService->store($request->file('proof'));

        $upgradeRequest = UpgradeRequest::create([
            'user_id' => Auth::id(),
            'plan' => $plan,
            'requested_price' => $validated['requested_price'] ?? null,
            'base_price' => $basePrice,
            'tax_rate' => $taxRate * 100,
            'tax_amount' => $taxAmount,
            'admin_fee' => $adminFee,
            'total_amount' => $totalAmount,
            'currency' => $pricing['currency'],
            'notes' => $validated['notes'] ?? null,
            ...$proofData,
        ]);

        $notifyEmail = $pricing['notify_email'] ?? null;
        if ($notifyEmail) {
            try {
                Mail::to($notifyEmail)->send(new UpgradeRequestNotificationMail($upgradeRequest));
            } catch (\Throwable $e) {
                // Skip notification failure, keep main flow successful.
            }
        }

        return redirect()
            ->route('client.upgrade-requests.index')
            ->with('success', 'Upgrade request submitted successfully. We will process it as soon as possible.');
    }

    public function show(UpgradeRequest $upgradeRequest)
    {
        $user = Auth::user();
        abort_unless($upgradeRequest->user_id === $user->id, 403);

        $pricing = Config::get('mockpay.upgrade');
        $banks = Config::get('mockpay.banks', []);

        return view('client.upgrade.show', compact('upgradeRequest', 'pricing', 'banks'));
    }

    public function downloadProof(UpgradeRequest $upgradeRequest, UpgradeProofService $proofService)
    {
        $user = Auth::user();
        abort_unless($upgradeRequest->user_id === $user->id, 403);
        abort_unless($upgradeRequest->proof_path, 404);

        $content = $proofService->retrieveDecrypted($upgradeRequest->proof_path);
        $filename = $upgradeRequest->proof_original_name ?? 'transfer-proof';
        $mime = $upgradeRequest->proof_mime ?? 'application/octet-stream';

        return response()->streamDownload(function () use ($content) {
            echo $content;
        }, $filename, ['Content-Type' => $mime]);
    }

    public function downloadInvoice(UpgradeRequest $upgradeRequest)
    {
        $user = Auth::user();
        abort_unless($upgradeRequest->user_id === $user->id, 403);
        abort_unless($upgradeRequest->invoice_number, 404);

        $banks = Config::get('mockpay.banks', []);

        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.upgrade-invoice', [
                'upgradeRequest' => $upgradeRequest->load('user'),
                'banks' => $banks,
            ]);
            return $pdf->download($upgradeRequest->invoice_number . '.pdf');
        }

        return view('pdf.upgrade-invoice', [
            'upgradeRequest' => $upgradeRequest->load('user'),
            'banks' => $banks,
        ]);
    }
}
