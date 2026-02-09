<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ApiRequestLog;
use App\Models\PaymentChannel;
use App\Models\PlatformSetting;
use App\Models\UpgradeRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PlatformDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $tenantCount = User::query()->count();
        $pendingUpgradeCount = UpgradeRequest::where('status', 'pending')->count();
        $planCounts = [
            'free' => User::where('plan', 'free')->count(),
            'pro' => User::where('plan', 'pro')->count(),
            'enterprise' => User::where('plan', 'enterprise')->count(),
        ];
        $statusCounts = [
            'active' => User::where('status', 'active')->count(),
            'suspended' => User::where('status', 'suspended')->count(),
        ];

        $health = [
            'database' => $this->isDatabaseHealthy(),
            'queue_backlog' => Schema::hasTable('jobs') ? DB::table('jobs')->count() : 0,
            'api_requests_24h' => ApiRequestLog::query()->where('created_at', '>=', now()->subDay())->count(),
            'failed_webhooks_24h' => Schema::hasTable('webhook_logs')
                ? DB::table('webhook_logs')
                    ->where('status', 'failed')
                    ->where('created_at', '>=', now()->subDay())
                    ->count()
                : 0,
        ];

        return view('dashboard.platform', compact(
            'tenantCount',
            'pendingUpgradeCount',
            'planCounts',
            'statusCounts',
            'health',
        ));
    }

    public function tenants(Request $request): View
    {
        $query = User::query()
            ->select(['id', 'email', 'status', 'plan', 'created_at'])
            ->withCount([
                'transactions',
                'webhookLogs',
                'apiRequestLogs',
            ])
            ->latest('id');

        if ($request->filled('search')) {
            $search = trim((string) $request->string('search'));
            $query->where(function ($q) use ($search) {
                $q->where('email', 'like', "%{$search}%")
                    ->orWhere('id', $search);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->filled('plan')) {
            $query->where('plan', $request->string('plan'));
        }

        $tenants = $query->paginate(20)->withQueryString();

        return view('dashboard.tenants.index', compact('tenants'));
    }

    public function updateTenantStatus(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['active', 'suspended'])],
        ]);

        $user->update([
            'status' => $validated['status'],
        ]);

        return redirect()->back()->with('success', 'Tenant status updated successfully.');
    }

    public function updateTenantPlan(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'plan' => ['required', Rule::in(['free', 'pro', 'enterprise'])],
            'plan_ends_at' => ['nullable', 'date'],
        ]);

        $user->update([
            'plan' => $validated['plan'],
            'plan_ends_at' => $validated['plan_ends_at'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Tenant plan updated successfully.');
    }

    public function globalSettings(): View
    {
        $channels = PaymentChannel::query()->orderBy('display_order')->orderBy('name')->get();

        $defaults = PlatformSetting::getValue('platform.defaults', [
            'baseline_fee_percentage' => 0,
            'baseline_fee_fixed' => 0,
            'baseline_rate_limit' => 500,
        ]);

        return view('dashboard.settings.global', compact('channels', 'defaults'));
    }

    public function updateChannel(Request $request, PaymentChannel $channel): RedirectResponse
    {
        $validated = $request->validate([
            'is_active' => ['required', 'boolean'],
            'fee_merchant_percentage' => ['required', 'numeric', 'min:0', 'max:100'],
            'fee_merchant_fixed' => ['required', 'numeric', 'min:0'],
        ]);

        $channel->update($validated);

        return redirect()->back()->with('success', 'Payment channel updated successfully.');
    }

    public function updateDefaults(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'baseline_fee_percentage' => ['required', 'numeric', 'min:0', 'max:100'],
            'baseline_fee_fixed' => ['required', 'numeric', 'min:0'],
            'baseline_rate_limit' => ['required', 'integer', 'min:1'],
        ]);

        PlatformSetting::putValue('platform.defaults', $validated);

        return redirect()->back()->with('success', 'Global baseline settings updated successfully.');
    }

    private function isDatabaseHealthy(): bool
    {
        try {
            DB::select('select 1');

            return true;
        } catch (\Throwable) {
            return false;
        }
    }
}
