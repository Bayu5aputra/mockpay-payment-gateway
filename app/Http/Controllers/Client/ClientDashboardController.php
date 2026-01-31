<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientDashboardController extends Controller
{
    /**
     * Display the client dashboard.
     */
    public function index(): View
    {
        $user = auth()->user();
        
        // Placeholder data - akan diisi dengan data real nanti
        $stats = [
            'total_payments' => 0,
            'total_amount' => 0,
            'pending_payments' => 0,
            'success_rate' => 0,
        ];

        return view('client.dashboard', compact('user', 'stats'));
    }
}
