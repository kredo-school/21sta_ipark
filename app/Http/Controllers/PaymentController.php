<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;

class PaymentController extends Controller
{
    public function process(PaymentRequest $request)
    {
        // dd($request);
        if ($request->validated()) {
            // Validation passed
            $cardNumber = $request->cardNumber;
            $cardholderName = $request->cardholderName;
            $expiryMonth = $request->expiryMonth;
            $expiryYear = $request->expiryYear;
            $cvv = $request->cvv;

            // Save payment data to database or perform other operations

            return redirect()->route('payment.success')->with('cardNumber', $cardNumber)
                                                         ->with('cardholderName', $cardholderName)
                                                         ->with('expiryMonth', $expiryMonth)
                                                         ->with('expiryYear', $expiryYear)
                                                         ->with('cvv', $cvv);
        } else {
            dd($request);
            // Validation failed
            return redirect()->back()->withErrors($request->errors())->withInput();
        }
    }
}
