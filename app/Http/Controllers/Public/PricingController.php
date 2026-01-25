<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        $plans = [
            [
                'name' => 'Free',
                'price' => '$0',
                'period' => 'forever',
                'description' => 'Perfect for testing and development',
                'features' => [
                    'Unlimited test transactions',
                    'All payment methods',
                    'Basic dashboard',
                    'Webhook system',
                    'API documentation',
                    'Community support'
                ],
                'cta' => 'Get Started',
                'highlighted' => false
            ],
            [
                'name' => 'Pro',
                'price' => '$29',
                'period' => 'per month',
                'description' => 'For professional developers and teams',
                'features' => [
                    'Everything in Free',
                    'Advanced analytics',
                    'Team collaboration (up to 5 members)',
                    'Priority support',
                    'Custom webhook domains',
                    'API rate limit increase',
                    'Export transaction data'
                ],
                'cta' => 'Start Free Trial',
                'highlighted' => true
            ],
            [
                'name' => 'Enterprise',
                'price' => 'Custom',
                'period' => 'contact us',
                'description' => 'For large organizations with custom needs',
                'features' => [
                    'Everything in Pro',
                    'Dedicated instance',
                    'SLA guarantee (99.9% uptime)',
                    'Custom integration support',
                    'Training sessions',
                    'White-label options',
                    'Unlimited team members'
                ],
                'cta' => 'Contact Sales',
                'highlighted' => false
            ]
        ];

        return view('public.pricing', compact('plans'));
    }
}