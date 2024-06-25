<div class="container">
    <div class="row justify-content-center">
        <div class="modal fade" id="paymentModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-green">
                    <div class="modal-body">
                        <div class="header text-center">
                            <div class="row h1">
                                <i class="fa-solid fa-circle-exclamation color1_orange"></i>
                            </div>
                            <div class="row h1">
                                <div class=" color1_orange">Reservation Success</div>
                            </div>
                        </div>
                        <div class="row justify-content-center mb-3">
                            <div class="col">
                                {{ $reservationdata['parkingPlacesId'] }}
                                {{ $reservationdata['cartype']}}
                            </div>
                        <div class="bottom text-center justify-content-center">
                                <form action="{{ route('reservation.pay') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="parking_places_id" value="{{ $reservationdata['parkingPlacesId'] }}">
                                    <input type="hidden" name="cartype" value="{{ $reservationdata['cartype']}}">
                                    <input type="hidden" name="date" value="{{ $reservationdata['date']}}">
                                    <input type="hidden" name="from_hour" value="{{ $reservationdata['fromHour']}}">
                                    <input type="hidden" name="from_minute" value="{{ $reservationdata['fromMinute']}}">
                                    <input type="hidden" name="to_hour" value="{{ $reservationdata['toHour']}}">
                                    <input type="hidden" name="to_minute" value="{{ $reservationdata['toMinute']}}">

                                </form>
                                <a href="" class="tab-link">Go to History Page</a>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- {{route('reservation', ['id' => $user->id])}} --}}