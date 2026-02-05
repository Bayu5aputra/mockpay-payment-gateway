<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accept Merchant Invitation | MockPay</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 antialiased">
    <div class="min-h-screen flex items-center justify-center px-4 py-10">
        <div class="max-w-xl w-full bg-white rounded-2xl shadow-lg p-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Accept Merchant Invitation</h1>
            <p class="text-gray-600 mb-6">Create your merchant account to join MockPay.</p>

            <form method="POST" action="{{ route('merchant-invitations.accept.submit', $invitation->token) }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email (invited)</label>
                    <input type="email" value="{{ $invitation->email }}" disabled class="w-full border border-gray-200 rounded-lg px-4 py-2 bg-gray-50 text-gray-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                    <input type="text" name="company_name" value="{{ old('company_name') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Business Type</label>
                    <select name="business_type" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                        <option value="ecommerce">Ecommerce</option>
                        <option value="marketplace">Marketplace</option>
                        <option value="subscription">Subscription</option>
                        <option value="donation">Donation</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                </div>
                <button class="w-full px-6 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700">
                    Create Merchant Account
                </button>
            </form>
        </div>
    </div>
</body>
</html>
