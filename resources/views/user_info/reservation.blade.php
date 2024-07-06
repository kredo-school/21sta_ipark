@extends('layouts.app')

@section('title', 'reservation')

@section('content')

<div class="container">
  <div class="row text-center">
      <div class="col-md-8 mb-4">
          <div class="h1 text-start"><span class="underline">&nbsp;Res</span>ervation History</div>
      </div>
  </div>
  <div class="row ms-1 text-center">
    <div class="col-2 me-3 tab">
        <a
            href="{{route('profile', ['id' => $user->id])}}"
            class="tab-link"
        >
            Profile
        </a>
    </div>
    <div class="col-2 me-3 tab-active">
        <a
            href="{{route('reservation', ['id' => $user->id])}}"
            class="tab-link-active"
        >
            Reservation
        </a>
    </div>
    <div class="col-2 tab">
        <a
            href="{{route('favorite', ['id' => $user->id])}}"
            class="tab-link"
        >
            Favorite
        </a>
    </div>
  </div>
  

  <div class="card mt-0 profile-card p-3 shadow mb-5">
    <div class="card-body" style="color: #343A40;">
      <div class="currentReservation">
        <h4 class="h1 mx-5 p-4 fw-bold">Current Reservation</h4>
        @if (empty($future_reservations))
          <h4 class="mx-5 p-4">No reservation yet</h4>
        @else
          @foreach (array_reverse($future_reservations) as $future_reservation)
            <div class="row border border-2 border-orange rounded-5 mx-5 my-4 p-4 shadow">
              <div class="col-3">
                <a href="{{route('showParkingDetail', $future_reservation->parking_place_id)}}">
                    <img
                        class="w-100"
                        {{-- src="{{$parking_place->image}}" --}}
                        src="{{asset('images/parking_space_image.jpg')}}"
                        alt="{{$future_reservation->ParkingPlace->parking_place_name}}"
                        {{-- {{$favorite->parkingPlace->parking_place_name}} --}}
                    >
                </a>  
              </div>
              <div class="col-3 border-end d-flex flex-column">
                <div class="h4 fw-bold"
                >
                  {{$future_reservation->ParkingPlace->parking_place_name}}
                </div>
                <h5 class="mt-2 mb-3">
                    <i class="fa-solid fa-location-dot"></i>&nbsp;
                    {{$future_reservation->ParkingPlace->city}}
                </h5>
                <div class="mt-auto ms-auto me-2">
                    <a
                        href="{{route('showParkingDetail', $future_reservation->parking_place_id)}}"
                        class="btn btn-sm rounded-pill px-3 btn-orange fw-bold"
                    >
                        See detail
                    </a>
                </div>
              </div>
              <div class="col ms-1 mt-4 align-items-center">
                <div class="row m-4 align-items-center">
                  <div class="col">
                    <div class="row">
                      Start Time
                    </div>
                    <div class="row h5 text-center my-2 fw-bold">
                      {{ $future_reservation->planning_time_from }} <br>
                      {{ $future_reservation->date }}
                    </div>
                  </div>
                  <div class="col-2">
                    <div class="row">

                    </div>
                    <div class="row">
                      &nbsp;&nbsp;&nbsp;-->
                    </div>
                  </div>
                  <div class="col">
                    <div class="row">
                      End Time
                    </div>
                    <div class="row h5 text-center my-2 fw-bold">
                      {{ $future_reservation->planning_time_to }} <br>
                      {{ $future_reservation->date }}
                    </div>
                  </div>
                  <div class="col">
                    <a
                      href="{{route('reservation.cancel', $future_reservation->id)}}"
                      class="btn btn-sm rounded-pill px-3 btn-red-opposite fw-bold"
                    >
                        Cancel Reservation
                    </a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        @endif
      </div>
      <div class="ReservationHistory">
        <h4 class="h1 mx-5 p-4 fw-bold">Reservation History</h4>
        @if (empty($future_reservations))
          <h4 class="mx-5 p-4">No reservation yet</h4>
        @else
          <table class="reservation-History h5 table-hover align-center text-center w-100">
            <thead>
              <tr>
                <th>Date</th>
                <th>Place</th>
                <th>Time</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Review</th>
              </tr>
            </thead>
            @foreach ($past_reservations as $past_reservation)
              <tbody class="bg-white">
                <tr>
                    <td>{{ $past_reservation->date }}</td>
                    <td>{{ $past_reservation->ParkingPlace->parking_place_name }}</td>
                    <td>{{ $past_reservation->planning_time_from }} → {{ $past_reservation->planning_time_to }}</td>
                    <td>¥ {{ $past_reservation->fee }}</td>
                    <td>
                      @if(!is_null($past_reservation->deleted_at))
                        Canceled
                      @elseif($past_reservation->is_current)
                        in progress
                      @else
                        Done
                      @endif
                      </td>
                    <td>
                      <a
                        href="#"
                        class="btn btn-sm rounded-pill px-3 btn-navy fw-bold"
                      >
                        Write a Review
                      </a>
                    </td>
                </tr>
              </tbody>
              @endforeach
          </table>
        @endif
      </div>
    </div>
  </div>

</div>
@endsection