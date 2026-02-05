<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MerchantController extends Controller
{
    /**
     * Display merchant profile
     * GET /dashboard/profile
     */
    public function profile()
    {
        $merchant = Auth::user();
        return view('dashboard.merchant.profile', compact('merchant'));
    }

    /**
     * Update merchant profile
     * PUT /dashboard/profile
     */
    public function updateProfile(Request $request)
    {
        $merchant = Auth::user();

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|unique:merchants,email,' . $merchant->id,
            'phone' => 'nullable|string|max:20',
            'company_address' => 'nullable|string|max:500',
            'website' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $merchant->update([
                'company_name' => $request->company_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'company_address' => $request->company_address,
                'website' => $request->website,
            ]);

            return redirect()->back()->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update profile: ' . $e->getMessage());
        }
    }

    /**
     * Update password
     * PUT /dashboard/password
     */
    public function updatePassword(Request $request)
    {
        $merchant = Auth::user();

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (!Hash::check($request->current_password, $merchant->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect');
        }

        try {
            $merchant->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('success', 'Password updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update password: ' . $e->getMessage());
        }
    }

    /**
     * Display company information
     * GET /dashboard/company
     */
    public function company()
    {
        $merchant = Auth::user();
        return view('dashboard.merchant.company', compact('merchant'));
    }

    /**
     * Update company information
     * PUT /dashboard/company
     */
    public function updateCompany(Request $request)
    {
        $merchant = Auth::user();

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'business_type' => 'required|string|max:100',
            'tax_id' => 'nullable|string|max:50',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $merchant->update([
                'company_name' => $request->company_name,
                'business_type' => $request->business_type,
                'tax_id' => $request->tax_id,
                'company_address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
                'website' => $request->website,
            ]);

            return redirect()->back()->with('success', 'Company information updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update company information: ' . $e->getMessage());
        }
    }
}
