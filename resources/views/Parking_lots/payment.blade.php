@extends('layouts.app')

@section('content')
<div class="col-8">
    <a
        href="javascript:history.back()"
        class="btn btn-red fw-bold rounded-pill btn-sm"
    >
        <i class="fa-solid fa-angles-left"></i>
        Back to previous page
    </a>
    <div class="h1 mt-3 mb-3">
        <span class="underline ms-1">&nbsp;Pay</span>ment
    </div>
</div>
<div class="row">
    <div class="col color2_red text-center">
        *Reservation has not completed yet
    </div>
</div>
<div class="col-4 bg-white p-4 m-3 border border-2 border-orange radius-size">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <img
                class="w-100 mb-3"
                src="{{asset('images/card_5brand.png')}}"
                >
                <form>
                    <div class="mb-3">
                        <label for="cardNumber" class="form-label fw-bold">Card Number <span class="color2_red">*</span></label>
                        <input type="text" class="form-control" id="cardNumber" placeholder="Enter card number">
                    </div>
                    <div class="mb-3">
                        <label for="cardholderName" class="form-label fw-bold">Cardholder Name <span class="color2_red">*</span></label>
                        <input type="text" class="form-control " id="cardholderName" placeholder="Enter cardholder name">
                    </div>
                    <div class="mb-3">
                        <label for="expiryDate" class="form-label  fw-bold">Expiration Date <span class="color2_red">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="expiryMonth" placeholder="MM" maxlength="2">
                            <input type="text" class="form-control" id="expiryYear" placeholder="YY" maxlength="2">
                            <span class="input-group-text">/</span>
                            <input type="text" class="form-control" id="cvv" placeholder="CVV">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-orange w-100 btn-block">Pay</button>
                </form>
            </div>
        </div>
    </div>        
</div>
@endsection