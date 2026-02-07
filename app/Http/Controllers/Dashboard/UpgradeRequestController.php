<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\UpgradeInvoiceMail;
use App\Models\UpgradeRequest;
use App\Notifications\UpgradeApprovedNotification;
use App\Notifications\UpgradeRejectedNotification;
use App\Services\UpgradeProofService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class UpgradeRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = UpgradeRequest::query()->with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('plan')) {
            $query->where('plan', $request->plan);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $requests = $query->latest()->paginate(15)->withQueryString();

        return view('dashboard.upgrade-requests.index', compact('requests'));
    }

    public function show(UpgradeRequest $upgradeRequest)
    {
        $upgradeRequest->load('user', 'approvedBy');
        $banks = Config::get('mockpay.banks', []);
        return view('dashboard.upgrade-requests.show', compact('upgradeRequest', 'banks'));
    }

    public function approve(UpgradeRequest $upgradeRequest)
    {
        if (!$upgradeRequest->isPending()) {
            return redirect()->back()->with('error', 'Permintaan ini sudah diproses.');
        }

        if (!$upgradeRequest->invoice_number) {
            $upgradeRequest->invoice_number = $this->generateInvoiceNumber();
        }

        $upgradeRequest->status = 'approved';
        $upgradeRequest->approved_at = now();
        $upgradeRequest->approved_by_merchant_id = Auth::guard('merchant')->id();
        $upgradeRequest->save();

        $user = $upgradeRequest->user;
        $user->plan = $upgradeRequest->plan;

        $currentEnd = $user->plan_ends_at;
        $baseDate = $currentEnd && $currentEnd->isFuture() ? $currentEnd : now();
        $user->plan_ends_at = $baseDate->copy()->addMonth();
        $user->save();

        try {
            Mail::to($user->email)->send(new UpgradeInvoiceMail($upgradeRequest));
            $upgradeRequest->invoice_sent_at = now();
            $upgradeRequest->save();
        } catch (\Throwable $e) {
            return redirect()
                ->route('dashboard.upgrade-requests.show', $upgradeRequest)
                ->with('error', 'Permintaan disetujui, tetapi email gagal dikirim. Periksa konfigurasi SMTP.');
        }

        // Send notification to user
        $user->notify(new UpgradeApprovedNotification($upgradeRequest));

        return redirect()
            ->route('dashboard.upgrade-requests.show', $upgradeRequest)
            ->with('success', 'Permintaan disetujui dan invoice telah dikirim ke email client.');
    }

    public function reject(Request $request, UpgradeRequest $upgradeRequest)
    {
        if (!$upgradeRequest->isPending()) {
            return redirect()->back()->with('error', 'Permintaan ini sudah diproses.');
        }

        $validated = $request->validate([
            'rejection_reason' => 'nullable|string|max:2000',
        ]);

        $upgradeRequest->status = 'rejected';
        $upgradeRequest->rejected_at = now();
        $upgradeRequest->approved_by_merchant_id = Auth::guard('merchant')->id();
        $upgradeRequest->rejection_reason = $validated['rejection_reason'] ?? null;
        $upgradeRequest->save();

        // Send notification to user
        $upgradeRequest->user->notify(new UpgradeRejectedNotification($upgradeRequest));

        return redirect()
            ->route('dashboard.upgrade-requests.show', $upgradeRequest)
            ->with('success', 'Permintaan upgrade ditolak.');
    }

    public function downloadProof(UpgradeRequest $upgradeRequest, UpgradeProofService $proofService)
    {
        abort_unless($upgradeRequest->proof_path, 404);

        $content = $proofService->retrieveDecrypted($upgradeRequest->proof_path);
        $filename = $upgradeRequest->proof_original_name ?? 'bukti-transfer';
        $mime = $upgradeRequest->proof_mime ?? 'application/octet-stream';

        return response()->streamDownload(function () use ($content) {
            echo $content;
        }, $filename, ['Content-Type' => $mime]);
    }

    public function downloadInvoice(UpgradeRequest $upgradeRequest)
    {
        abort_unless($upgradeRequest->invoice_number, 404, 'Invoice belum tersedia untuk permintaan ini.');

        $banks = Config::get('mockpay.banks', []);

        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.upgrade-invoice', [
                'upgradeRequest' => $upgradeRequest->load('user'),
                'banks' => $banks,
            ]);
            return $pdf->download($upgradeRequest->invoice_number . '.pdf');
        }

        // Fallback: render HTML view if DomPDF not installed
        return view('pdf.upgrade-invoice', [
            'upgradeRequest' => $upgradeRequest->load('user'),
            'banks' => $banks,
        ]);
    }

    private function generateInvoiceNumber(): string
    {
        $date = now()->format('Ymd');
        $sequence = UpgradeRequest::whereDate('created_at', now()->toDateString())->count() + 1;
        $sequenceFormatted = str_pad((string) $sequence, 10, '0', STR_PAD_LEFT);

        return "INV-MP-{$date}-ID-{$sequenceFormatted}";
    }
}
