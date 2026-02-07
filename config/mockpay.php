<?php

return [
    'upgrade' => [
        'currency' => 'IDR',
        'tax_rate' => 0.11,
        'admin_fee' => 2000,
        'notify_email' => 'bayusaputra.005.003@gmail.com',
        'plans' => [
            'pro' => 150000,
            'enterprise_min' => 1000000,
        ],
    ],
    'limits' => [
        'free_daily_transactions' => 10,
        'free_daily_api_requests' => 500,
    ],
    'banks' => [
        [
            'name' => 'BCA',
            'account_name' => 'MockPay (Belum diatur)',
            'account_number' => null,
        ],
        [
            'name' => 'SeaBank',
            'account_name' => 'MockPay (Belum diatur)',
            'account_number' => null,
        ],
        [
            'name' => 'Mandiri',
            'account_name' => 'MockPay (Belum diatur)',
            'account_number' => null,
        ],
    ],
];
