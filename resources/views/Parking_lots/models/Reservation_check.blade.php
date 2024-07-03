<style>
    .table-condensed th,
    .table-condensed td {
        padding: 2px 4px;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="modal fade" id="reservationCheckModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-orange">
                    <div class="modal-body">
                        <form action="{{route('reservation.payment')}}" method="GET">
                            @csrf
                            <div class="header text-center">
                                <div class="row h1">
                                    <i class="fa-solid fa-circle-exclamation color1_orange"></i>
                                </div>
                                <div class="row h1">
                                    <div class=" color1_orange">Please check below</div>
                                </div>
                                <div class="row">
                                    <p class="color2_red">*Reservation has not completed yet</p>
                                    <hr>
                                </div>
                            </div>
                            <div class="row justify-content-center mb-3">
                                <div class="col">
                                    <input type="hidden" name="parking_places_id" value="{{ $parking_places->id }}">
                                    <table class="table user-info mx-auto table-condensed table-borderless">
                                        <tr>
                                            <th>Name</th>
                                            <td>{{Auth::user()->username}}</td>
                                        </tr>
                                        <tr>
                                            <th>Mail</th>
                                            <td>{{Auth::user()->email}}</td>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <td>{{Auth::user()->phone}}</td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <td></td> 
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <td></td> 
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <td></td> 
                                        </tr>
                                        <tr>
                                            <th>Parking place Name</th>
                                            <td>{{$parking_places->parking_place_name}}</td> 
                                        </tr>
                                        <tr>
                                            <th>Date</th>
                                            <td>{{ date('d/m/Y', strtotime(session('date'))) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Time</th>
                                            <td>{{ session('from_time') }} - {{ session('to_time') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Car type</th>
                                            <td>{{ session('cartype') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Fee</th>
                                            <td>￥ {{ session('fee') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="bottom text-center justify-content-center">
                                @csrf
                                <a class="btn rounded-pill fw-bold px-4 btn-white fs-5 btn-sm" 
                                    data-bs-dismiss="modal"
                                    onmouseover="this.style.color='#ff9900';"
                                    onmouseout="this.style.color='#ff9900';"
                                >
                                    Cancel
                                </a>
                                <button type="submit" class="btn rounded-pill fw-bold px-4 btn-orange fs-5 btn-sm">
                                    Proceed to Payment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>