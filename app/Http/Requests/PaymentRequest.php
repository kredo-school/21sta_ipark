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
        // dd("test");
        return [
            'cardNumber' => 'required|numeric', // カード番号は必須で数値である必要があります
            'cardholderName' => 'required|string', // カード保持者名は必須で文字列である必要があります
            'expiryMonth' => 'required|digits:2', // 有効期限の月は必須で2桁の数字である必要があります
            'expiryYear' => 'required|digits:2', // 有効期限の年は必須で2桁の数字である必要があります
            'cvv' => 'required|digits_between:3,4', // CVVは必須で3または4桁の数字である必要があります
        ];
    }

    public function messages()
    {
        // dd("test");
        return [
            // バリデーションエラーメッセージをカスタマイズする場合はここに記述します
            'cardNumber.required' => 'Card number is required.',
            'cardNumber.numeric' => 'Card number must be numeric.',
            'cardholderName.required' => 'Cardholder name is required.',
            'cardholderName.string' => 'Cardholder name must be a string.',
            'expiryMonth.required' => 'Expiration month is required.',
            'expiryMonth.digits' => 'Expiration month must be 2 digits.',
            'expiryYear.required' => 'Expiration year is required.',
            'expiryYear.digits' => 'Expiration year must be 2 digits.',
            'cvv.required' => 'CVV is required.',
            'cvv.digits_between' => 'CVV must be between 3 and 4 digits.',
        ];
    }
}
