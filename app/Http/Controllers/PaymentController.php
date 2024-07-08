<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use App\Http\Controllers\ReservationsController;

class PaymentController extends Controller
{
    protected $reservationsController;

    public function __construct(ReservationsController $reservationsController)
    {
        $this->reservationsController = $reservationsController;
    }

    public function process(PaymentRequest $request)
    {
        if ($request->validated()) {
            // Validation passed

            $this->reservationsController->store($request);
            $this->store($request);
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

    public function store(Request $request)
    {

        $payment = new Payment();
        $payment->user_id = auth()->id(); // ユーザーIDをログインユーザーのIDに設定する例
        $payment->card_number = $request->cardNumber;
        $payment->name_on_card = $request->cardholderName;
        $payment->month = $request->expiryMonth;
        $payment->year = $request->expiryYear;
        $payment->cvv = $request->cvv;
        
        $payment->save();

    }
}

