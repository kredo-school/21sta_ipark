@extends('layouts.app')

@section('title', 'Reservation Histroy')

@section('content')
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="container">
  <div class="row text-center">
      <div class="col-md-8 mb-4 page-title">
          <div class="h1 text-start"><span class="underline">&nbsp;Res</span>ervation History</div>
      </div>
  </div>
  <div class="row ms-1 text-center">
    <div class="col-md-2 tab-inactive user-info-tab">
        <a
            href="{{route('profile', ['id' => $user->id])}}"
            class="tab-link"
        >
            Profile
        </a>
    </div>
    <div class="col-md-2 tab-active user-info-tab">
        <a
            href="{{route('reservation', ['id' => $user->id])}}"
            class="tab-link-active"
        >
            Reservation
        </a>
    </div>
    <div class="col-md-2 tab-inactive user-info-tab">
        <a
            href="{{route('favorite', ['id' => $user->id])}}"
            class="tab-link"
        >
            Favorite
        </a>
    </div>
  </div>
  

  <div class="card mt-0 profile-card p-3 shadow mb-5">
    <div class="card-body" style="color: #343A40; overflow-x: auto;">
      <div class="currentReservation">
        <h4 class="h1 mx-5 p-4 fw-bold">Current Reservation</h4>
        @if (empty($future_reservations))
          <h4 class="mx-5 p-4">No reservation yet</h4>
        @else
          @foreach (array_reverse($future_reservations) as $future_reservation)
            <div class="row border border-2 border-orange rounded-5 mx-5 my-4 p-4 shadow">
              <div class="col-md-3">
                <a class ="text-decoration-none" 
                  href="{{route('showParkingDetail', $future_reservation->parking_place_id)}}">
                  @if ($future_reservation->ParkingPlace->image != null)
                      <img
                        class="w-100"
                        src="{{asset($future_reservation->ParkingPlace->image)}}"
                        alt="{{$future_reservation->ParkingPlace->parking_place_name}}"
                        style="height:200px"
                      >
                  @else
                      <div class="no-image" style="height:200px">
                          <p class="text-center h5">
                              No image
                          </p>
                      </div>
                  @endif
                </a>  
              </div>
              <div class="col-md-3 border-end d-flex flex-column">
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
              <div class="col-md ms-1 mt-4 align-items-center">
                <div class="row m-4 align-items-center">
                  <div class="col-md">
                    <div class="row">
                      Start Time
                    </div>
                    <div class="row h5 text-center my-2 fw-bold">
                      {{ \Carbon\Carbon::parse($future_reservation->planning_time_from)->format('H:i') }} <br>
                      {{ $future_reservation->date }}
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="row">

                    </div>
                    <div class="row">
                      &nbsp;&nbsp;&nbsp;-->
                    </div>
                  </div>
                  <div class="col-md">
                    <div class="row">
                      End Time
                    </div>
                    <div class="row h5 text-center my-2 fw-bold">
                      {{ \Carbon\Carbon::parse($future_reservation->planning_time_to)->format('H:i') }} <br>
                      {{ $future_reservation->date }}
                    </div>
                  </div>
                  <div class="col-md">
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
        @if (empty($past_reservations))
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
            <?php $count = 0; ?>
            @foreach ($past_reservations as $past_reservation)
              <tbody class="bg-white">
                <tr>
                    <td>{{ $past_reservation->date }}</td>
                    <td>{{ $past_reservation->ParkingPlace->parking_place_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($past_reservation->planning_time_from)->format('H:i') }} 
                         → 
                         {{ \Carbon\Carbon::parse($past_reservation->planning_time_to)->format('H:i') }}
                    </td>
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
                      @if (!is_null($past_reservation->deleted_at) || !is_null($review[$count]->id))
                        <button
                          type="submit"
                          class="btn btn-sm rounded-pill px-3 btn-navy fw-bold review-btn"
                          disabled
                        >
                          Write a Review
                        </button>
                      @else
                        <input type="hidden" name="userId" value="{{ $user->id }}">
                        <button
                          type="submit"
                          class="btn btn-sm rounded-pill px-3 btn-navy fw-bold review-btn"
                          data-bs-toggle="modal" data-bs-target="#reviewModal"
                          data-reservation-id="{{ $past_reservation->id }}"
                          data-parking-place-id="{{ $past_reservation->parking_place_id }}"
                          data-parking-name="{{ $past_reservation->ParkingPlace->parking_place_name }}"
                          data-star="{{ $review[$count]->star }}"
                          data-comment="{{ $review[$count]->comment }}"
                        >
                          Write a Review
                        </button>
                        @include('user_info.modals.review')
                      @endif
                    </td>
                </tr>
              </tbody>
              <?php $count++; ?>
            @endforeach
          </table>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection