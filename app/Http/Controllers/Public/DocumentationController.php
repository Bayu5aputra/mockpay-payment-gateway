<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    /**
     * Display documentation home
     * GET /docs
     */
    public function index()
    {
        $sections = $this->getDocumentationSections();
        return view('public.documentation.index', compact('sections'));
    }

    /**
     * Display getting started
     * GET /docs/getting-started
     */
    public function gettingStarted()
    {
        return view('public.documentation.getting-started');
    }

    /**
     * Display authentication docs
     * GET /docs/authentication
     */
    public function authentication()
    {
        return view('public.documentation.authentication');
    }

    /**
     * Display API reference
     * GET /docs/api-reference
     */
    public function apiReference()
    {
        $endpoints = [
            [
                'method' => 'POST',
                'path' => '/api/v1/payment/create',
                'title' => 'Create Payment',
                'description' => 'Create a new payment transaction'
            ],
            [
                'method' => 'GET',
                'path' => '/api/v1/transaction/{id}',
                'title' => 'Get Transaction',
                'description' => 'Retrieve transaction details by ID'
            ],
            [
                'method' => 'GET',
                'path' => '/api/v1/transactions',
                'title' => 'List Transactions',
                'description' => 'Get list of transactions with filters'
            ],
            [
                'method' => 'POST',
                'path' => '/api/v1/transaction/{id}/cancel',
                'title' => 'Cancel Transaction',
                'description' => 'Cancel a pending transaction'
            ],
            [
                'method' => 'POST',
                'path' => '/api/v1/refund',
                'title' => 'Create Refund',
                'description' => 'Refund a settled transaction'
            ],
            [
                'method' => 'GET',
                'path' => '/api/v1/settlements',
                'title' => 'List Settlements',
                'description' => 'Get settlement history'
            ],
            [
                'method' => 'GET',
                'path' => '/api/v1/payment/channels',
                'title' => 'Get Payment Channels',
                'description' => 'Get available payment methods and channels'
            ],
        ];

        return view('public.documentation.api-reference', compact('endpoints'));
    }

    /**
     * Display payment methods docs
     * GET /docs/payment-methods
     */
    public function paymentMethods()
    {
        $methods = [
            [
                'id' => 'virtual-account',
                'title' => 'Virtual Account',
                'description' => 'Bank transfer via virtual account number',
                'channels' => ['BCA', 'Mandiri', 'BNI', 'BRI', 'Permata']
            ],
            [
                'id' => 'ewallet',
                'title' => 'E-Wallet',
                'description' => 'Digital wallet payments',
                'channels' => ['GoPay', 'OVO', 'DANA', 'ShopeePay', 'LinkAja']
            ],
            [
                'id' => 'credit-card',
                'title' => 'Credit Card',
                'description' => 'Credit and debit card payments',
                'channels' => ['Visa', 'Mastercard', 'JCB', 'American Express']
            ],
            [
                'id' => 'qris',
                'title' => 'QRIS',
                'description' => 'Indonesian Quick Response Code Standard',
                'channels' => ['All QRIS-enabled apps']
            ],
            [
                'id' => 'retail',
                'title' => 'Retail',
                'description' => 'Over-the-counter payments',
                'channels' => ['Alfamart', 'Indomaret']
            ],
        ];

        return view('public.documentation.payment-methods', compact('methods'));
    }

    /**
     * Display webhooks docs
     * GET /docs/webhooks
     */
    public function webhooks()
    {
        $events = [
            [
                'name' => 'transaction.pending',
                'description' => 'Transaction created and waiting for payment'
            ],
            [
                'name' => 'transaction.success',
                'description' => 'Payment received and transaction settled'
            ],
            [
                'name' => 'transaction.failed',
                'description' => 'Payment failed'
            ],
            [
                'name' => 'transaction.expired',
                'description' => 'Transaction expired without payment'
            ],
            [
                'name' => 'transaction.cancelled',
                'description' => 'Transaction cancelled by merchant or system'
            ],
            [
                'name' => 'transaction.refunded',
                'description' => 'Transaction refunded'
            ],
        ];

        return view('public.documentation.webhooks', compact('events'));
    }

    /**
     * Display testing guide
     * GET /docs/testing
     */
    public function testing()
    {
        $testCards = [
            [
                'number' => '4111111111111111',
                'type' => 'Visa',
                'result' => 'Success',
                'description' => 'Standard success transaction'
            ],
            [
                'number' => '5555555555554444',
                'type' => 'Mastercard',
                'result' => 'Success',
                'description' => 'Standard success transaction'
            ],
            [
                'number' => '4111111111110000',
                'type' => 'Visa',
                'result' => '3DS Required',
                'description' => 'Requires 3D Secure authentication (OTP: 112233)'
            ],
            [
                'number' => '4000000000000002',
                'type' => 'Visa',
                'result' => 'Failed',
                'description' => 'Card declined'
            ],
            [
                'number' => '4000000000000069',
                'type' => 'Visa',
                'result' => 'Failed',
                'description' => 'Expired card'
            ],
            [
                'number' => '4000000000000127',
                'type' => 'Visa',
                'result' => 'Failed',
                'description' => 'Incorrect CVV'
            ],
        ];

        return view('public.documentation.testing', compact('testCards'));
    }

    /**
     * Display code examples
     * GET /docs/examples
     */
    public function examples()
    {
        $examples = [
            [
                'title' => 'PHP/Laravel',
                'language' => 'php',
                'code' => $this->getPhpExample()
            ],
            [
                'title' => 'JavaScript/Node.js',
                'language' => 'javascript',
                'code' => $this->getJavascriptExample()
            ],
            [
                'title' => 'Python',
                'language' => 'python',
                'code' => $this->getPythonExample()
            ],
            [
                'title' => 'cURL',
                'language' => 'bash',
                'code' => $this->getCurlExample()
            ],
        ];

        return view('public.documentation.examples', compact('examples'));
    }

    /**
     * Display FAQ
     * GET /docs/faq
     */
    public function faq()
    {
        $faqs = [
            [
                'question' => 'Is MockPay completely free?',
                'answer' => 'Yes, MockPay is completely free for testing and development purposes. You can create unlimited test transactions without any charges.'
            ],
            [
                'question' => 'Can I use MockPay for production?',
                'answer' => 'MockPay is designed for testing and development only. It simulates payment processes but does not process real transactions. For production, you need to integrate with actual payment gateways.'
            ],
            [
                'question' => 'How realistic is the simulation?',
                'answer' => 'MockPay simulates all aspects of real payment gateways including API responses, webhooks, payment flows, and error scenarios. It\'s designed to match the behavior of popular Indonesian payment gateways like Midtrans and Xendit.'
            ],
            [
                'question' => 'What payment methods are supported?',
                'answer' => 'MockPay supports all major Indonesian payment methods including Virtual Accounts (BCA, Mandiri, BNI, BRI, Permata), E-wallets (GoPay, OVO, DANA, ShopeePay, LinkAja), Credit Cards, QRIS, and Retail payments (Alfamart, Indomaret).'
            ],
            [
                'question' => 'Do I need real bank accounts to test?',
                'answer' => 'No, MockPay is a complete simulation. You don\'t need any real bank accounts or payment credentials. Everything runs in a test environment.'
            ],
            [
                'question' => 'How do webhooks work?',
                'answer' => 'MockPay sends webhook notifications to your specified URL when transaction status changes. You can test webhook integration using tools like webhook.site or ngrok for local development.'
            ],
            [
                'question' => 'Is there an API rate limit?',
                'answer' => 'Yes, there\'s a reasonable rate limit to ensure fair usage. The free tier allows sufficient requests for testing purposes. Contact us if you need higher limits.'
            ],
            [
                'question' => 'Can I test failed payment scenarios?',
                'answer' => 'Yes, MockPay provides test card numbers and payment codes that simulate various scenarios including successful payments, failed payments, expired transactions, and declined cards.'
            ],
            [
                'question' => 'How do I get support?',
                'answer' => 'You can reach out through our contact form, join our Discord community, or email us at support@mockpay.test. We also have comprehensive documentation and code examples.'
            ],
            [
                'question' => 'Can I integrate MockPay with my CI/CD pipeline?',
                'answer' => 'Absolutely! MockPay is perfect for automated testing in CI/CD pipelines. You can run integration tests against our API without worrying about real payment processing.'
            ],
        ];

        return view('public.documentation.faq', compact('faqs'));
    }

    /**
     * Search documentation
     * GET /docs/search
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        // In real application, implement full-text search
        // For now, return empty results
        $results = [];

        return view('public.documentation.search', compact('query', 'results'));
    }

    /**
     * Get documentation sections structure
     */
    private function getDocumentationSections()
    {
        return [
            [
                'title' => 'Getting Started',
                'items' => [
                    ['title' => 'Introduction', 'url' => '/docs/getting-started#introduction'],
                    ['title' => 'Quick Start', 'url' => '/docs/getting-started#quick-start'],
                    ['title' => 'API Keys', 'url' => '/docs/getting-started#api-keys'],
                ]
            ],
            [
                'title' => 'API Reference',
                'items' => [
                    ['title' => 'Authentication', 'url' => '/docs/authentication'],
                    ['title' => 'Create Payment', 'url' => '/docs/api-reference#create-payment'],
                    ['title' => 'Get Transaction', 'url' => '/docs/api-reference#get-transaction'],
                    ['title' => 'Cancel Payment', 'url' => '/docs/api-reference#cancel-payment'],
                    ['title' => 'Refund', 'url' => '/docs/api-reference#refund'],
                ]
            ],
            [
                'title' => 'Payment Methods',
                'items' => [
                    ['title' => 'Virtual Account', 'url' => '/docs/payment-methods#virtual-account'],
                    ['title' => 'E-Wallet', 'url' => '/docs/payment-methods#ewallet'],
                    ['title' => 'Credit Card', 'url' => '/docs/payment-methods#credit-card'],
                    ['title' => 'QRIS', 'url' => '/docs/payment-methods#qris'],
                    ['title' => 'Retail', 'url' => '/docs/payment-methods#retail'],
                ]
            ],
            [
                'title' => 'Webhooks',
                'items' => [
                    ['title' => 'Overview', 'url' => '/docs/webhooks#overview'],
                    ['title' => 'Event Types', 'url' => '/docs/webhooks#events'],
                    ['title' => 'Signature Verification', 'url' => '/docs/webhooks#verification'],
                ]
            ],
            [
                'title' => 'Testing',
                'items' => [
                    ['title' => 'Test Cards', 'url' => '/docs/testing#cards'],
                    ['title' => 'Simulation Tools', 'url' => '/docs/testing#tools'],
                    ['title' => 'Common Scenarios', 'url' => '/docs/testing#scenarios'],
                ]
            ],
        ];
    }

    /**
     * Get PHP code example
     */
    private function getPhpExample()
    {
        return <<<'PHP'
<?php

use Illuminate\Support\Facades\Http;

$apiKey = 'sandbox_sk_test_xxxxxxxxxx';
$baseUrl = 'https://mockpay.test/api/v1';

$response = Http::withHeaders([
    'Authorization' => 'Bearer ' . $apiKey,
    'Content-Type' => 'application/json',
])->post($baseUrl . '/payment/create', [
    'order_id' => 'ORDER-' . time(),
    'amount' => 250000,
    'payment_method' => 'bank_transfer',
    'payment_channel' => 'bca_va',
    'customer' => [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '081234567890',
    ],
    'description' => 'Payment for Order #123',
]);

$data = $response->json();
echo $data['data']['payment_url'];
PHP;
    }

    /**
     * Get JavaScript code example
     */
    private function getJavascriptExample()
    {
        return <<<'JS'
const axios = require('axios');

const apiKey = 'sandbox_sk_test_xxxxxxxxxx';
const baseUrl = 'https://mockpay.test/api/v1';

const createPayment = async () => {
    try {
        const response = await axios.post(
            `${baseUrl}/payment/create`,
            {
                order_id: `ORDER-${Date.now()}`,
                amount: 250000,
                payment_method: 'bank_transfer',
                payment_channel: 'bca_va',
                customer: {
                    name: 'John Doe',
                    email: 'john@example.com',
                    phone: '081234567890'
                },
                description: 'Payment for Order #123'
            },
            {
                headers: {
                    'Authorization': `Bearer ${apiKey}`,
                    'Content-Type': 'application/json'
                }
            }
        );

        console.log(response.data.data.payment_url);
    } catch (error) {
        console.error(error.response.data);
    }
};

createPayment();
JS;
    }

    /**
     * Get Python code example
     */
    private function getPythonExample()
    {
        return <<<'PYTHON'
import requests
import time

api_key = 'sandbox_sk_test_xxxxxxxxxx'
base_url = 'https://mockpay.test/api/v1'

headers = {
    'Authorization': f'Bearer {api_key}',
    'Content-Type': 'application/json'
}

payload = {
    'order_id': f'ORDER-{int(time.time())}',
    'amount': 250000,
    'payment_method': 'bank_transfer',
    'payment_channel': 'bca_va',
    'customer': {
        'name': 'John Doe',
        'email': 'john@example.com',
        'phone': '081234567890'
    },
    'description': 'Payment for Order #123'
}

response = requests.post(
    f'{base_url}/payment/create',
    json=payload,
    headers=headers
)

data = response.json()
print(data['data']['payment_url'])
PYTHON;
    }

    /**
     * Get cURL code example
     */
    private function getCurlExample()
    {
        return <<<'BASH'
curl -X POST https://mockpay.test/api/v1/payment/create \
  -H "Authorization: Bearer sandbox_sk_test_xxxxxxxxxx" \
  -H "Content-Type: application/json" \
  -d '{
    "order_id": "ORDER-123456",
    "amount": 250000,
    "payment_method": "bank_transfer",
    "payment_channel": "bca_va",
    "customer": {
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "081234567890"
    },
    "description": "Payment for Order #123"
}'
BASH;
    }
}
