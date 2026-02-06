<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ManualOverrideRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'action' => [
                'required',
                'string',
                Rule::in(['approve', 'success', 'reject', 'failed', 'expire', 'expired', 'cancel', 'cancelled', 'refund', 'partial_refund']),
            ],
            'reason' => 'nullable|string|max:500',
            'refund_amount' => 'nullable|numeric|min:0.01',
        ];
    }
}
