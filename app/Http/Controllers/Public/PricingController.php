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
                'price' => '$0',
                'period' => 'forever',
                'description' => 'Perfect for testing and development',
                'features' => [
                    'Unlimited test transactions',
                    'All payment methods',
                    'Basic dashboard',
                    'Webhook system',
                    'API documentation',
                    'Community support',
                    'Sandbox environment',
                    'Standard rate limits',
                ],
                'limitations' => [
                    'Community support only',
                    'Standard API rate limits',
                ],
                'cta' => 'Get Started',
                'cta_url' => '/register',
                'popular' => false,
            ],
            [
                'name' => 'Pro',
                'price' => '$29',
                'period' => 'per month',
                'description' => 'For teams and growing businesses',
                'features' => [
                    'Everything in Free',
                    'Advanced analytics',
                    'Team collaboration (up to 5 members)',
                    'Priority support',
                    'Custom webhook domains',
                    'Higher API rate limits',
                    'Transaction export',
                    'Email notifications',
                    'Advanced reporting',
                ],
                'cta' => 'Start Free Trial',
                'cta_url' => '/register?plan=pro',
                'popular' => true,
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
                    'Unlimited team members',
                    'Dedicated account manager',
                    'Custom API rate limits',
                    'On-premise deployment option',
                ],
                'cta' => 'Contact Sales',
                'cta_url' => '/contact?subject=enterprise',
                'popular' => false,
            ],
        ];

        $faqs = [
            [
                'question' => 'Is the Free plan really free forever?',
                'answer' => 'Yes! The Free plan is completely free with no time limits. It includes all core features needed for testing and development.'
            ],
            [
                'question' => 'Can I upgrade or downgrade my plan?',
                'answer' => 'Yes, you can upgrade or downgrade your plan at any time. Changes take effect immediately, and we\'ll prorate any charges.'
            ],
            [
                'question' => 'What payment methods do you accept?',
                'answer' => 'We accept all major credit cards (Visa, Mastercard, Amex) and PayPal for Pro plan subscriptions.'
            ],
            [
                'question' => 'Do you offer refunds?',
                'answer' => 'We offer a 30-day money-back guarantee for Pro plan subscriptions. If you\'re not satisfied, we\'ll refund your payment in full.'
            ],
            [
                'question' => 'What are the API rate limits?',
                'answer' => 'Free plan: 100 requests/hour. Pro plan: 1,000 requests/hour. Enterprise: Custom limits based on your needs.'
            ],
            [
                'question' => 'Can I test before committing to a paid plan?',
                'answer' => 'Yes! Start with the Free plan to test all features. We also offer a 14-day free trial for the Pro plan, no credit card required.'
            ],
        ];

        $comparison = [
            [
                'feature' => 'Test Transactions',
                'free' => 'Unlimited',
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
                'feature' => 'API Rate Limit',
                'free' => '100/hour',
                'pro' => '1,000/hour',
                'enterprise' => 'Custom',
            ],
            [
                'feature' => 'Team Members',
                'free' => '1',
                'pro' => 'Up to 5',
                'enterprise' => 'Unlimited',
            ],
            [
                'feature' => 'Support',
                'free' => 'Community',
                'pro' => 'Priority Email',
                'enterprise' => 'Dedicated + Phone',
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
            [
                'feature' => 'White Label',
                'free' => false,
                'pro' => false,
                'enterprise' => true,
            ],
        ];

        return view('public.pricing', compact('plans', 'faqs', 'comparison'));
    }
}
