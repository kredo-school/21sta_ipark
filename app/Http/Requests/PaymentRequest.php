<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cardNumber' => 'required|numeric|digits:16', // カード番号は必須で数値であり、16桁である必要があります
            'cardholderName' => 'required|string',        // カード保持者名は必須で文字列である必要があります
            'expiryMonth' => 'required|digits:2|in:01,02,03,04,05,06,07,08,09,10,11,12',
            'expiryYear' => 'required|digits:2|numeric|min:24',
            'cvv' => 'required|digits_between:3,4',       // CVVは必須で3または4桁の数字である必要があります
        ];
    }
    
    public function messages()
    {
        return [
            'cardNumber.required' => 'Card number is required.',
            'cardNumber.numeric' => 'Card number must be numeric.',
            'cardNumber.digits' => 'Card number must be 16 digits.',
            'cardholderName.required' => 'Cardholder name is required.',
            'cardholderName.string' => 'Cardholder name must be a string.',
            'expiryMonth.required' => 'Expiration month is required.',
            'expiryMonth.digits' => 'Expiration month must be 2 digits.',
            'expiryMonth.in' => 'Expiration month must be between 01 and 12.',
            'expiryYear.required' => 'Expiration year is required.',
            'expiryYear.min' => 'Expiration year must be at least 24.',
            'cvv.required' => 'CVV is required.',
            'cvv.digits_between' => 'CVV must be between 3 and 4 digits.',
        ];
    }
}
