<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\MerchantInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MerchantInvitationController extends Controller
{
    public function showAccept(string $token)
    {
        $invitation = MerchantInvitation::where('token', $token)->firstOrFail();

        if ($invitation->status !== 'pending' || ($invitation->expires_at && $invitation->expires_at->isPast())) {
            abort(410, 'Invitation link has expired.');
        }

        return view('auth.merchant-invite-accept', compact('invitation'));
    }

    public function accept(Request $request, string $token)
    {
        $invitation = MerchantInvitation::where('token', $token)->firstOrFail();

        if ($invitation->status !== 'pending' || ($invitation->expires_at && $invitation->expires_at->isPast())) {
            abort(410, 'Invitation link has expired.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'business_type' => ['required', 'in:ecommerce,marketplace,subscription,donation,other'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (Merchant::where('email', $invitation->email)->exists()) {
            return redirect()->route('login')->with('error', 'Merchant account already exists for this email.');
        }

        $merchant = Merchant::create([
            'name' => $request->name,
            'email' => $invitation->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'company_name' => $request->company_name,
            'phone' => $request->phone,
            'business_type' => $request->business_type,
            'status' => 'pending',
        ]);

        $invitation->status = 'accepted';
        $invitation->accepted_at = now();
        $invitation->save();

        Auth::guard('merchant')->login($merchant);

        return redirect()->route('dashboard.index')->with('success', 'Merchant account created from invitation.');
    }
}
