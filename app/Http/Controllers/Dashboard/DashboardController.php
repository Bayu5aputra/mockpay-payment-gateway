<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display main dashboard
     */
    public function index()
    {
        $user = Auth::user();

        // Mock statistics data
        $stats = [
            'total_transactions' => 1234,
            'total_amount' => 45231.89,
            'pending_payments' => 23,
            'pending_amount' => 12456.00,
            'success_rate' => 98.5,
        ];

        return view('dashboard', compact('stats'));
    }

    /**
     * Display developers dashboard
     */
    public function developers()
    {
        $user = Auth::user();

        // Get user's API keys
        $apiKeys = []; // Will be populated from database

        return view('dashboard.developers.index', compact('apiKeys'));
    }

    /**
     * Display API documentation
     */
    public function apiDocs()
    {
        return view('dashboard.developers.api-docs');
    }

    /**
     * Display code examples
     */
    public function codeExamples()
    {
        $examples = [
            'php' => [
                'name' => 'PHP',
                'icon' => '🐘',
                'examples' => [
                    'create_transaction' => [
                        'title' => 'Create Transaction',
                        'code' => $this->getPhpExample('create_transaction')
                    ],
                    'check_status' => [
                        'title' => 'Check Transaction Status',
                        'code' => $this->getPhpExample('check_status')
                    ]
                ]
            ],
            'javascript' => [
                'name' => 'JavaScript',
                'icon' => '⚡',
                'examples' => [
                    'create_transaction' => [
                        'title' => 'Create Transaction',
                        'code' => $this->getJsExample('create_transaction')
                    ],
                    'check_status' => [
                        'title' => 'Check Transaction Status',
                        'code' => $this->getJsExample('check_status')
                    ]
                ]
            ],
            'python' => [
                'name' => 'Python',
                'icon' => '🐍',
                'examples' => [
                    'create_transaction' => [
                        'title' => 'Create Transaction',
                        'code' => $this->getPythonExample('create_transaction')
                    ],
                    'check_status' => [
                        'title' => 'Check Transaction Status',
                        'code' => $this->getPythonExample('check_status')
                    ]
                ]
            ]
        ];

        return view('dashboard.developers.code-examples', compact('examples'));
    }

    /**
     * Display payment simulator
     */
    public function simulator()
    {
        return view('dashboard.developers.simulator');
    }

    /**
     * Display API logs
     */
    public function logs()
    {
        // Mock log data
        $logs = [
            [
                'id' => 1,
                'timestamp' => now()->subMinutes(5),
                'method' => 'POST',
                'endpoint' => '/api/v1/transactions',
                'status_code' => 200,
                'response_time' => '145ms',
                'ip_address' => '192.168.1.1'
            ],
            [
                'id' => 2,
                'timestamp' => now()->subMinutes(15),
                'method' => 'GET',
                'endpoint' => '/api/v1/transactions/TRX-20260127-00001',
                'status_code' => 200,
                'response_time' => '89ms',
                'ip_address' => '192.168.1.1'
            ],
            [
                'id' => 3,
                'timestamp' => now()->subHours(1),
                'method' => 'POST',
                'endpoint' => '/api/v1/transactions',
                'status_code' => 400,
                'response_time' => '52ms',
                'ip_address' => '192.168.1.1'
            ]
        ];

        return view('dashboard.developers.logs', compact('logs'));
    }

    private function getPhpExample($type)
    {
        $examples = [
            'create_transaction' => <<<'PHP'
<?php

$apiKey = 'your-api-key-here';
$endpoint = 'https://mockpay.com/api/v1/transactions';

$data = [
    'order_id' => 'ORDER-' . time(),
    'amount' => 100000,
    'currency' => 'IDR',
    'customer_name' => 'John Doe',
    'customer_email' => 'john@example.com',
    'payment_method' => 'bca_va',
    'description' => 'Payment for Order #12345'
];

$ch = curl_init($endpoint);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $apiKey,
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$result = json_decode($response, true);
print_r($result);
PHP,
            'check_status' => <<<'PHP'
<?php

$apiKey = 'your-api-key-here';
$transactionId = 'TRX-20260127-00001';
$endpoint = "https://mockpay.com/api/v1/transactions/{$transactionId}";

$ch = curl_init($endpoint);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $apiKey,
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$result = json_decode($response, true);
print_r($result);
PHP
        ];

        return $examples[$type] ?? '';
    }

    private function getJsExample($type)
    {
        $examples = [
            'create_transaction' => <<<'JS'
const axios = require('axios');

const apiKey = 'your-api-key-here';
const endpoint = 'https://mockpay.com/api/v1/transactions';

const data = {
    order_id: `ORDER-${Date.now()}`,
    amount: 100000,
    currency: 'IDR',
    customer_name: 'John Doe',
    customer_email: 'john@example.com',
    payment_method: 'bca_va',
    description: 'Payment for Order #12345'
};

axios.post(endpoint, data, {
    headers: {
        'Authorization': `Bearer ${apiKey}`,
        'Content-Type': 'application/json'
    }
})
.then(response => {
    console.log('Success:', response.data);
})
.catch(error => {
    console.error('Error:', error.response?.data || error.message);
});
JS,
            'check_status' => <<<'JS'
const axios = require('axios');

const apiKey = 'your-api-key-here';
const transactionId = 'TRX-20260127-00001';
const endpoint = `https://mockpay.com/api/v1/transactions/${transactionId}`;

axios.get(endpoint, {
    headers: {
        'Authorization': `Bearer ${apiKey}`,
        'Content-Type': 'application/json'
    }
})
.then(response => {
    console.log('Transaction Status:', response.data);
})
.catch(error => {
    console.error('Error:', error.response?.data || error.message);
});
JS
        ];

        return $examples[$type] ?? '';
    }

    private function getPythonExample($type)
    {
        $examples = [
            'create_transaction' => <<<'PYTHON'
import requests
import time

api_key = 'your-api-key-here'
endpoint = 'https://mockpay.com/api/v1/transactions'

data = {
    'order_id': f'ORDER-{int(time.time())}',
    'amount': 100000,
    'currency': 'IDR',
    'customer_name': 'John Doe',
    'customer_email': 'john@example.com',
    'payment_method': 'bca_va',
    'description': 'Payment for Order #12345'
}

headers = {
    'Authorization': f'Bearer {api_key}',
    'Content-Type': 'application/json'
}

response = requests.post(endpoint, json=data, headers=headers)
print('Status Code:', response.status_code)
print('Response:', response.json())
PYTHON,
            'check_status' => <<<'PYTHON'
import requests

api_key = 'your-api-key-here'
transaction_id = 'TRX-20260127-00001'
endpoint = f'https://mockpay.com/api/v1/transactions/{transaction_id}'

headers = {
    'Authorization': f'Bearer {api_key}',
    'Content-Type': 'application/json'
}

response = requests.get(endpoint, headers=headers)
print('Status Code:', response.status_code)
print('Transaction Status:', response.json())
PYTHON
        ];

        return $examples[$type] ?? '';
    }
}
