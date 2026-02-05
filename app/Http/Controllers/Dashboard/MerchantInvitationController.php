<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MerchantInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Mail\MerchantInvitationMail;

class MerchantInvitationController extends Controller
{
    public function index()
    {
        $merchant = Auth::guard('merchant')->user();
        $invitations = MerchantInvitation::where('invited_by', $merchant->id)
            ->orderByDesc('created_at')
            ->get();

        return view('dashboard.invitations.index', compact('merchant', 'invitations'));
    }

    public function store(Request $request)
    {
        $merchant = Auth::guard('merchant')->user();

        $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $existing = MerchantInvitation::where('invited_by', $merchant->id)
            ->where('email', $request->email)
            ->where('status', 'pending')
            ->first();

        if ($existing) {
            $existing->token = Str::random(64);
            $existing->expires_at = now()->addDays(7);
            $existing->save();
            $invitation = $existing;
        } else {
            $invitation = MerchantInvitation::create([
                'invited_by' => $merchant->id,
                'email' => $request->email,
                'token' => Str::random(64),
                'expires_at' => now()->addDays(7),
            ]);
        }

        try {
            Mail::mailer('smtp')->to($invitation->email)->send(new MerchantInvitationMail($invitation, $merchant));
            Log::info('Merchant invitation email sent', [
                'email' => $invitation->email,
                'invited_by' => $merchant->id,
            ]);
        } catch (\Exception $e) {
            Log::error('Merchant invitation email failed', [
                'email' => $invitation->email,
                'error' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'Invitation created, but email failed to send. Please check mail configuration.');
        }

        return redirect()->back()->with('success', 'Invitation link created successfully.');
    }

    public function destroy(MerchantInvitation $invitation)
    {
        $merchant = Auth::guard('merchant')->user();

        if ($invitation->invited_by !== $merchant->id) {
            abort(403);
        }

        $invitation->delete();

        return redirect()->back()->with('success', 'Invitation deleted.');
    }

    public function testEmail(Request $request)
    {
        $merchant = Auth::guard('merchant')->user();
        $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $invitation = new MerchantInvitation([
            'invited_by' => $merchant->id,
            'email' => $request->email,
            'token' => Str::random(64),
            'expires_at' => now()->addDays(7),
        ]);

        try {
            Mail::mailer('smtp')->to($invitation->email)->send(new MerchantInvitationMail($invitation, $merchant));
            Log::info('Merchant invitation test email sent', [
                'email' => $invitation->email,
                'invited_by' => $merchant->id,
            ]);
        } catch (\Exception $e) {
            Log::error('Merchant invitation test email failed', [
                'email' => $invitation->email,
                'error' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'Test email failed to send. Please check mail configuration.');
        }

        return redirect()->back()->with('success', 'Test email sent successfully.');
    }
}
