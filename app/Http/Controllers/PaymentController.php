<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;

class PaymentController extends Controller
{
    public function process(PaymentRequest $request)
    {
        if ($request->validated()) {
            // Validation passed
            $cardNumber = $request->cardNumber;
            $cardholderName = $request->cardholderName;
            $expiryMonth = $request->expiryMonth;
            $expiryYear = $request->expiryYear;
            $cvv = $request->cvv;

            return redirect()->route('payment.success');
        } else {
            // Validation failed
            return redirect()->back()->withErrors($request->errors())->withInput(); //GET
        }
    }

    public function success()
    {
        $success = true;
        return view('Parking_lots.payment')
                ->with('success', $success);
    }
}

