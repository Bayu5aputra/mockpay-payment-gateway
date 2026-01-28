<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardAuthRequest extends FormRequest
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
            'card_number' => 'required|string|digits:16',
            'card_holder' => 'required|string|max:255',
            'expiry_month' => 'required|integer|min:1|max:12',
            'expiry_year' => 'required|integer|min:' . date('Y') . '|max:' . (date('Y') + 20),
            'cvv' => 'required|string|digits:3',
            'save_card' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'card_number.required' => 'Card number is required',
            'card_number.digits' => 'Card number must be 16 digits',
            'card_holder.required' => 'Cardholder name is required',
            'card_holder.max' => 'Cardholder name must not exceed 255 characters',
            'expiry_month.required' => 'Expiry month is required',
            'expiry_month.integer' => 'Expiry month must be a number',
            'expiry_month.min' => 'Invalid expiry month',
            'expiry_month.max' => 'Invalid expiry month',
            'expiry_year.required' => 'Expiry year is required',
            'expiry_year.integer' => 'Expiry year must be a number',
            'expiry_year.min' => 'Card has expired',
            'expiry_year.max' => 'Invalid expiry year',
            'cvv.required' => 'CVV is required',
            'cvv.digits' => 'CVV must be 3 digits',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'card_number' => 'card number',
            'card_holder' => 'cardholder name',
            'expiry_month' => 'expiry month',
            'expiry_year' => 'expiry year',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Remove spaces from card number
        if ($this->has('card_number')) {
            $this->merge([
                'card_number' => str_replace(' ', '', $this->card_number),
            ]);
        }

        // Remove spaces from CVV
        if ($this->has('cvv')) {
            $this->merge([
                'cvv' => str_replace(' ', '', $this->cvv),
            ]);
        }
    }

    /**
     * Validate card number using Luhn algorithm
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($this->has('card_number') && !$this->isValidCardNumber($this->card_number)) {
                $validator->errors()->add('card_number', 'Invalid card number');
            }

            // Check if card is expired
            if ($this->has('expiry_month') && $this->has('expiry_year')) {
                $expiryDate = \Carbon\Carbon::createFromDate($this->expiry_year, $this->expiry_month, 1)->endOfMonth();
                if ($expiryDate->isPast()) {
                    $validator->errors()->add('expiry_month', 'Card has expired');
                }
            }
        });
    }

    /**
     * Validate card number using Luhn algorithm
     */
    protected function isValidCardNumber(string $number): bool
    {
        // Remove any non-digit characters
        $number = preg_replace('/\D/', '', $number);

        // Check if number is numeric and has correct length
        if (!ctype_digit($number) || strlen($number) < 13 || strlen($number) > 19) {
            return false;
        }

        // Luhn algorithm
        $sum = 0;
        $numDigits = strlen($number);
        $parity = $numDigits % 2;

        for ($i = 0; $i < $numDigits; $i++) {
            $digit = (int) $number[$i];

            if ($i % 2 == $parity) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $sum += $digit;
        }

        return ($sum % 10) == 0;
    }

    /**
     * Get card type from card number
     */
    public function getCardType(): ?string
    {
        $number = $this->card_number;

        if (!$number) {
            return null;
        }

        $firstDigit = substr($number, 0, 1);
        $firstTwoDigits = substr($number, 0, 2);

        if ($firstDigit == '4') {
            return 'Visa';
        } elseif (in_array($firstTwoDigits, ['51', '52', '53', '54', '55'])) {
            return 'Mastercard';
        } elseif (in_array($firstTwoDigits, ['34', '37'])) {
            return 'American Express';
        } elseif ($firstTwoDigits == '35') {
            return 'JCB';
        }

        return 'Unknown';
    }
}