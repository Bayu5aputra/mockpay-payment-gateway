<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * Display pricing page
     * GET /pricing
     */
    public function index()
    {
        $plans = [
            [
                'name' => 'Free',
                'price' => 'Rp 0',
                'period' => 'per month',
                'description' => 'For lightweight testing and development',
                'features' => [
                    '10 simulated transactions per day',
                    'All payment methods',
                    'Basic dashboard',
                    'Webhook system',
                    'API documentation',
                    'Sandbox environment',
                ],
                'cta' => 'Get Started',
                'cta_url' => '/register',
                'popular' => false,
            ],
            [
                'name' => 'Pro',
                'price' => 'Rp 150.000',
                'period' => 'per month',
                'description' => 'For active teams and integrations',
                'features' => [
                    'Unlimited simulated transactions',
                    'All payment methods',
                    'Advanced analytics',
                    'Priority support',
                    'Webhook logs & retry',
                    'Transaction export',
                ],
                'cta' => 'Upgrade to Pro',
                'cta_url' => '/register?plan=pro',
                'popular' => true,
            ],
            [
                'name' => 'Enterprise',
                'price' => 'From Rp 1.000.000',
                'period' => 'per month',
                'description' => 'For custom needs and large-scale operations',
                'features' => [
                    'Unlimited simulated transactions',
                    'Custom API limits',
                    'Dedicated support',
                    'SLA 99.9%',
                    'Custom integration support',
                    'White-label options',
                ],
                'cta' => 'Contact Sales',
                'cta_url' => '/contact?subject=enterprise',
                'popular' => false,
            ],
        ];

        $faqs = [
            [
                'question' => 'Is the Free plan really free forever?',
                'answer' => 'Yes. The Free plan is always free for testing, with a limit of 10 simulated transactions per day.'
            ],
            [
                'question' => 'Can I upgrade or downgrade my plan?',
                'answer' => 'Yes. You can upgrade anytime. Changes take effect after approval.'
            ],
            [
                'question' => 'What payment methods do you accept?',
                'answer' => 'Upgrades are handled manually via bank transfer based on the invoice instructions.'
            ],
            [
                'question' => 'Do you offer refunds?',
                'answer' => 'MockPay is a sandbox service; refunds follow our internal policy.'
            ],
            [
                'question' => 'What are the API rate limits?',
                'answer' => 'Free: 10 simulated transactions per day. Pro/Enterprise: unlimited.'
            ],
            [
                'question' => 'Can I test before committing to a paid plan?',
                'answer' => 'Yes. Use the Free plan to test before upgrading.'
            ],
            [
                'question' => 'Are accounts and data isolated per client?',
                'answer' => 'Yes. MockPay is multi-tenant SaaS and each client, user, and guest account is isolated from others.'
            ],
            [
                'question' => 'Who controls the outcome of simulated transactions?',
                'answer' => 'Clients control their own simulation outcomes through their dashboard and API tools. Platform admins only review plans and usage.'
            ],
        ];

        $comparison = [
            [
                'feature' => 'Simulated Transactions',
                'free' => '10 / day',
                'pro' => 'Unlimited',
                'enterprise' => 'Unlimited',
            ],
            [
                'feature' => 'Payment Methods',
                'free' => 'All methods',
                'pro' => 'All methods',
                'enterprise' => 'All methods',
            ],
            [
                'feature' => 'Support',
                'free' => 'Community',
                'pro' => 'Priority',
                'enterprise' => 'Dedicated',
            ],
            [
                'feature' => 'Advanced Analytics',
                'free' => false,
                'pro' => true,
                'enterprise' => true,
            ],
            [
                'feature' => 'Custom Webhooks',
                'free' => false,
                'pro' => true,
                'enterprise' => true,
            ],
            [
                'feature' => 'SLA Guarantee',
                'free' => false,
                'pro' => false,
                'enterprise' => '99.9%',
            ],
        ];

        return view('public.pricing', compact('plans', 'faqs', 'comparison'));
    }
}
