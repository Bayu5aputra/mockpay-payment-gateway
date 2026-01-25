<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    public function index()
    {
        return view('public.docs.index');
    }

    public function gettingStarted()
    {
        return view('public.docs.getting-started');
    }

    public function authentication()
    {
        return view('public.docs.authentication');
    }

    public function apiReference()
    {
        return view('public.docs.api-reference');
    }

    public function paymentMethods()
    {
        return view('public.docs.payment-methods');
    }

    public function webhooks()
    {
        return view('public.docs.webhooks');
    }

    public function testing()
    {
        return view('public.docs.testing');
    }

    public function troubleshooting()
    {
        return view('public.docs.troubleshooting');
    }
}