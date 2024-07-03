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
                <form action="{{ route('payment.process') }}" method="post">
                    @csrf

                    @if (!$success)
                        <input type="hidden" name="parkingPlacesId" value="{{ $reservationdata['parkingPlacesId'] }}">
                        <input type="hidden" name="date" value="{{ $reservationdata['date'] }}">
                        <input type="hidden" name="fromtime" value="{{ $reservationdata['fromtime'] }}">
                        <input type="hidden" name="totime" value="{{ $reservationdata['totime'] }}">
                        <input type="hidden" name="cartype" value="{{ $reservationdata['cartype'] }}">
                    @endif

                    <div class="mb-3">
                        <label for="cardNumber" class="form-label fw-bold">Card Number <span class="color2_red">*</span></label>
                        <input type="text" class="form-control" id="cardNumber" name="cardNumber" value="{{ old('cardNumber') }}" placeholder="Enter card number">
                    </div>
                    <div class="mb-3">
                        <label for="cardholderName" class="form-label fw-bold">Cardholder Name <span class="color2_red">*</span></label>
                        <input type="text" class="form-control " id="cardholderName" name="cardholderName" value="{{ old('cardholderName') }}" placeholder="Enter cardholder name">
                    </div>
                    <div class="mb-3">
                        <label for="expiryDate" class="form-label  fw-bold">Expiration Date <span class="color2_red">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="expiryMonth"  name="expiryMonth" value="{{ old('expiryMonth') }}" placeholder="MM" maxlength="2">
                            <input type="text" class="form-control" id="expiryYear" name="expiryYear" value="{{ old('expiryYear') }}" placeholder="YY" maxlength="2">
                            <span class="input-group-text">/</span>
                            <input type="text" class="form-control" id="cvv" name="cvv" value="{{ old('cvv') }}" placeholder="CVV">
                        </div>
                    </div>
                    @if ($success)
                        @include('Parking_lots.models.payment')
                    @endif

                    <button type="submit" class="btn btn-orange w-100 btn-block" id="payButton" data-bs-toggle="modal" data-bs-target="#paymentModal" >
                        Pay
                    </button>
                    @if ($errors->any())
                        <div class="alert text-center color2_red fw-bold">
                            @foreach ($errors->all() as $error)
                                {{ $error }} <br>
                            @endforeach
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>        
</div>
@endsection

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@if ($success)
    <script>
        $(document).ready(function() {
            $('#paymentModal').modal('show');
        });
    </script>
@endif


