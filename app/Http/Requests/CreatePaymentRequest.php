<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'order_id' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1000',
            'currency' => 'nullable|string|in:IDR',
            'payment_method' => 'required|in:bank_transfer,ewallet,credit_card,qris,retail',
            'payment_channel' => 'required|string',
            'customer.name' => 'required|string|max:255',
            'customer.email' => 'required|email|max:255',
            'customer.phone' => 'nullable|string|max:20',
            'items' => 'nullable|array',
            'items.*.name' => 'required_with:items|string',
            'items.*.quantity' => 'required_with:items|integer|min:1',
            'items.*.price' => 'required_with:items|numeric|min:0',
            'description' => 'nullable|string|max:500',
            'callback_url' => 'nullable|url',
            'metadata' => 'nullable|array',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'order_id.required' => 'Order ID is required',
            'amount.required' => 'Amount is required',
            'amount.min' => 'Minimum amount is Rp 1,000',
            'payment_method.required' => 'Payment method is required',
            'payment_method.in' => 'Invalid payment method',
            'payment_channel.required' => 'Payment channel is required',
            'customer.name.required' => 'Customer name is required',
            'customer.email.required' => 'Customer email is required',
            'customer.email.email' => 'Customer email must be a valid email address',
        ];
    }
}