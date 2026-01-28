<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RefundRequest extends FormRequest
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
            'transaction_id' => 'required|string|exists:transactions,transaction_id',
            'amount' => 'nullable|numeric|min:1000',
            'reason' => 'nullable|string|max:500',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'transaction_id.required' => 'Transaction ID is required',
            'transaction_id.exists' => 'Transaction not found',
            'amount.numeric' => 'Refund amount must be a number',
            'amount.min' => 'Minimum refund amount is Rp 1,000',
            'reason.max' => 'Refund reason must not exceed 500 characters',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'transaction_id' => 'transaction ID',
        ];
    }
}