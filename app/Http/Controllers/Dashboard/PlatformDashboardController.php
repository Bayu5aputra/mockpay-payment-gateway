<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\UpgradeRequest;
use App\Models\User;
use Illuminate\Http\Request;

class PlatformDashboardController extends Controller
{
    public function index(Request $request)
    {
        $tenantCount = User::count();
        $pendingUpgradeCount = UpgradeRequest::where('status', 'pending')->count();
        $planCounts = [
            'free' => User::where('plan', 'free')->count(),
            'pro' => User::where('plan', 'pro')->count(),
            'enterprise' => User::where('plan', 'enterprise')->count(),
        ];

        return view('dashboard.platform', compact(
            'tenantCount',
            'pendingUpgradeCount',
            'planCounts'
        ));
    }
}
