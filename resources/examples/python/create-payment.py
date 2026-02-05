import requests

api_key = "mpk_test_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
url = "http://127.0.0.1:8000/api/v1/payment/create"

payload = {
    "order_id": "ORDER-1001",
    "amount": 250000,
    "payment_method": "bank_transfer",
    "payment_channel": "bca_va",
    "customer": {
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "081234567890",
    },
    "items": [
        {"name": "MockPay Pro", "quantity": 1, "price": 250000},
    ],
    "description": "Test payment via MockPay",
}

headers = {
    "Authorization": f"Bearer {api_key}",
    "Content-Type": "application/json",
}

response = requests.post(url, json=payload, headers=headers, timeout=30)
print(response.json())
