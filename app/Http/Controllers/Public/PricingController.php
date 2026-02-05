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
                'period' => 'per bulan',
                'description' => 'Untuk testing dan development ringan',
                'features' => [
                    '10 dummy transaksi per hari',
                    'Semua metode pembayaran',
                    'Dashboard dasar',
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
                'period' => 'per bulan',
                'description' => 'Untuk tim dan integrasi yang aktif',
                'features' => [
                    'Unlimited dummy transaksi',
                    'Semua metode pembayaran',
                    'Advanced analytics',
                    'Priority support',
                    'Webhook logs & retry',
                    'Export transaksi',
                ],
                'cta' => 'Upgrade to Pro',
                'cta_url' => '/register?plan=pro',
                'popular' => true,
            ],
            [
                'name' => 'Enterprise',
                'price' => 'Mulai Rp 1.000.000',
                'period' => 'per bulan',
                'description' => 'Untuk kebutuhan khusus dan skala besar',
                'features' => [
                    'Unlimited dummy transaksi',
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
                'answer' => 'Ya, Free plan selalu gratis untuk testing, dengan limit 10 transaksi dummy per hari.'
            ],
            [
                'question' => 'Can I upgrade or downgrade my plan?',
                'answer' => 'Ya, Anda bisa upgrade kapan saja. Perubahan berlaku setelah approval.'
            ],
            [
                'question' => 'What payment methods do you accept?',
                'answer' => 'Pembayaran upgrade dilakukan manual via transfer bank sesuai instruksi invoice.'
            ],
            [
                'question' => 'Do you offer refunds?',
                'answer' => 'MockPay adalah layanan dummy; proses refund mengikuti kebijakan internal.'
            ],
            [
                'question' => 'What are the API rate limits?',
                'answer' => 'Free: 10 transaksi dummy per hari. Pro/Enterprise: unlimited.'
            ],
            [
                'question' => 'Can I test before committing to a paid plan?',
                'answer' => 'Ya, gunakan Free plan untuk testing sebelum upgrade.'
            ],
        ];

        $comparison = [
            [
                'feature' => 'Dummy Transactions',
                'free' => '10 / hari',
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
