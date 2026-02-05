const apiKey = 'mpk_test_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
const url = 'http://127.0.0.1:8000/api/v1/payment/create';

async function createPayment() {
  const payload = {
    order_id: 'ORDER-1001',
    amount: 250000,
    payment_method: 'bank_transfer',
    payment_channel: 'bca_va',
    customer: {
      name: 'John Doe',
      email: 'john@example.com',
      phone: '081234567890',
    },
    items: [
      { name: 'MockPay Pro', quantity: 1, price: 250000 },
    ],
    description: 'Test payment via MockPay',
  };

  const response = await fetch(url, {
    method: 'POST',
    headers: {
      Authorization: `Bearer ${apiKey}`,
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(payload),
  });

  const data = await response.json();
  console.log(data);
}

createPayment();
