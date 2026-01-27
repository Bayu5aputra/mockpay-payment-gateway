<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalController extends Controller
{
    /**
     * Display the privacy policy page
     */
    public function privacyPolicy()
    {
        return view('legal.privacy-policy');
    }

    /**
     * Display the terms of service page
     */
    public function termsOfService()
    {
        return view('legal.terms-of-service');
    }

    /**
     * Display the cookie policy page
     */
    public function cookiePolicy()
    {
        return view('legal.cookie-policy');
    }
}
