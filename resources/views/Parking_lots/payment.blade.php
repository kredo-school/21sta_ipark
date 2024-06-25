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
                <form id="paymentForm" action="{{ route('payment.process') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="cardNumber" class="form-label fw-bold">Card Number <span class="color2_red">*</span></label>
                        <input type="text" class="form-control" id="cardNumber" placeholder="Enter card number"required>
                    </div>
                    <div class="mb-3">
                        <label for="cardholderName" class="form-label fw-bold">Cardholder Name <span class="color2_red">*</span></label>
                        <input type="text" class="form-control " id="cardholderName" placeholder="Enter cardholder name"required>
                    </div>
                    <div class="mb-3">
                        <label for="expiryDate" class="form-label  fw-bold">Expiration Date <span class="color2_red">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="expiryMonth" placeholder="MM" maxlength="2"required>
                            <input type="text" class="form-control" id="expiryYear" placeholder="YY" maxlength="2"required>
                            <span class="input-group-text">/</span>
                            <input type="text" class="form-control" id="cvv" placeholder="CVV"required>
                        </div>
                    </div>
                    {{-- <button type="button" class="btn btn-orange w-100 btn-block" data-bs-toggle="modal" data-bs-target="#paymentModal">Pay</button>
                    @include('Parking_lots.models.payment') --}}
                    <button type="submit" class="btn btn-orange w-100 btn-block" id="payButton">Pay</button>
                </form>
            </div>
        </div>
    </div>        
</div>

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Confirm Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>You are about to proceed with the payment.</p>
                <p>Card Number: <span id="modalCardNumber"></span></p>
                <p>Cardholder Name: <span id="modalCardholderName"></span></p>
                <p>Expiration Date: <span id="modalExpiryDate"></span></p>
                <p>CVV: <span id="modalCvv"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirmPaymentBtn">Confirm Payment</button>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
            paymentModal.show();
        });
    </script>
@endif

@endsection

