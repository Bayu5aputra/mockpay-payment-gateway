<?php

$apiKey = 'mpk_test_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$url = 'http://127.0.0.1:8000/api/v1/payment/create';

$payload = [
    'order_id' => 'ORDER-1001',
    'amount' => 250000,
    'payment_method' => 'bank_transfer',
    'payment_channel' => 'bca_va',
    'customer' => [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '081234567890',
    ],
    'items' => [
        ['name' => 'MockPay Pro', 'quantity' => 1, 'price' => 250000],
    ],
    'description' => 'Test payment via MockPay',
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $apiKey,
    'Content-Type: application/json',
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

echo $response;
