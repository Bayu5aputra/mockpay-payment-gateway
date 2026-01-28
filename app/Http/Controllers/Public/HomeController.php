<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display landing page
     * GET /
     */
    public function index()
    {
        $features = [
            [
                'icon' => 'shield-check',
                'title' => 'Realistic Simulation',
                'description' => 'Test all payment methods with realistic simulation just like real payment gateways'
            ],
            [
                'icon' => 'code',
                'title' => 'Complete API',
                'description' => 'REST API matching Midtrans/Xendit specifications for seamless integration'
            ],
            [
                'icon' => 'webhook',
                'title' => 'Webhook System',
                'description' => 'Real-time notifications with automatic retry logic for failed deliveries'
            ],
            [
                'icon' => 'chart-bar',
                'title' => 'Dashboard Analytics',
                'description' => 'Track test transactions and monitor performance with detailed analytics'
            ],
            [
                'icon' => 'layers',
                'title' => 'Multiple Environments',
                'description' => 'Separate sandbox and production modes for safe testing'
            ],
            [
                'icon' => 'dollar-sign',
                'title' => 'Zero Cost',
                'description' => 'Free forever for testing and development purposes'
            ],
        ];

        $paymentMethods = [
            [
                'category' => 'Bank Transfer',
                'items' => ['BCA Virtual Account', 'Mandiri Virtual Account', 'BNI Virtual Account', 'BRI Virtual Account', 'Permata Virtual Account']
            ],
            [
                'category' => 'E-Wallets',
                'items' => ['GoPay', 'OVO', 'DANA', 'ShopeePay', 'LinkAja']
            ],
            [
                'category' => 'Credit Cards',
                'items' => ['Visa', 'Mastercard', 'JCB', 'American Express']
            ],
            [
                'category' => 'QRIS',
                'items' => ['Dynamic QRIS standard compliant']
            ],
            [
                'category' => 'Retail',
                'items' => ['Alfamart', 'Indomaret']
            ],
        ];

        $steps = [
            [
                'number' => '1',
                'title' => 'Register Account',
                'description' => 'Create your merchant account in seconds with email verification'
            ],
            [
                'number' => '2',
                'title' => 'Get API Keys',
                'description' => 'Generate sandbox and production API keys from your dashboard'
            ],
            [
                'number' => '3',
                'title' => 'Integrate',
                'description' => 'Use our API documentation and code examples to integrate quickly'
            ],
            [
                'number' => '4',
                'title' => 'Test',
                'description' => 'Simulate payments without real money using our test environment'
            ],
            [
                'number' => '5',
                'title' => 'Go Live',
                'description' => 'Switch to production mode when your integration is ready'
            ],
        ];

        $testimonials = [
            [
                'name' => 'John Doe',
                'role' => 'Lead Developer at TechCorp',
                'avatar' => 'https://ui-avatars.com/api/?name=John+Doe&background=6366f1&color=fff',
                'content' => 'MockPay saved us weeks of development time. The API is easy to use and the simulation is incredibly realistic.',
                'rating' => 5
            ],
            [
                'name' => 'Jane Smith',
                'role' => 'CTO at StartupXYZ',
                'avatar' => 'https://ui-avatars.com/api/?name=Jane+Smith&background=6366f1&color=fff',
                'content' => 'Perfect for testing our payment integration before going live. The webhook system works flawlessly.',
                'rating' => 5
            ],
            [
                'name' => 'Michael Chen',
                'role' => 'Backend Engineer at DevStudio',
                'avatar' => 'https://ui-avatars.com/api/?name=Michael+Chen&background=6366f1&color=fff',
                'content' => 'The best dummy payment gateway out there. All Indonesian payment methods in one place.',
                'rating' => 5
            ],
        ];

        $stats = [
            ['label' => 'Active Developers', 'value' => '5,000+'],
            ['label' => 'Test Transactions', 'value' => '1M+'],
            ['label' => 'API Uptime', 'value' => '99.9%'],
            ['label' => 'Payment Methods', 'value' => '15+'],
        ];

        return view('public.home', compact('features', 'paymentMethods', 'steps', 'testimonials', 'stats'));
    }

    /**
     * Display about page
     * GET /about
     */
    public function about()
    {
        return view('public.about');
    }

    /**
     * Display features page
     * GET /features
     */
    public function features()
    {
        $features = [
            [
                'title' => 'Virtual Account',
                'description' => 'Simulate bank transfer payments with all major Indonesian banks',
                'icon' => 'building-columns',
                'benefits' => [
                    'Unique VA number generation',
                    'Real-time payment confirmation',
                    'Support for BCA, Mandiri, BNI, BRI, Permata',
                    'Payment instructions for ATM and mobile banking'
                ]
            ],
            [
                'title' => 'E-Wallet Integration',
                'description' => 'Test popular Indonesian e-wallet payment methods',
                'icon' => 'wallet',
                'benefits' => [
                    'GoPay, OVO, DANA, ShopeePay, LinkAja support',
                    'QR code generation',
                    'Deeplink URL for mobile apps',
                    'Instant payment confirmation'
                ]
            ],
            [
                'title' => 'Credit Card Processing',
                'description' => 'Comprehensive credit card payment simulation',
                'icon' => 'credit-card',
                'benefits' => [
                    'Visa, Mastercard, JCB, Amex support',
                    '3D Secure authentication',
                    'Test card numbers for different scenarios',
                    'Installment options'
                ]
            ],
            [
                'title' => 'QRIS Standard',
                'description' => 'Indonesian QRIS standard compliant QR code',
                'icon' => 'qrcode',
                'benefits' => [
                    'Dynamic QRIS generation',
                    'EMV standard compliance',
                    'All QRIS-enabled apps support',
                    'Real-time payment updates'
                ]
            ],
            [
                'title' => 'Retail Payment',
                'description' => 'Over-the-counter payment at convenience stores',
                'icon' => 'store',
                'benefits' => [
                    'Alfamart and Indomaret support',
                    'Payment code generation',
                    'Barcode for easy scanning',
                    'Extended expiry time'
                ]
            ],
            [
                'title' => 'Webhook System',
                'description' => 'Real-time payment notifications with retry mechanism',
                'icon' => 'bell',
                'benefits' => [
                    'HMAC SHA-256 signature verification',
                    'Automatic retry with exponential backoff',
                    'Detailed webhook logs',
                    'Test webhook functionality'
                ]
            ],
        ];

        return view('public.features', compact('features'));
    }
}
