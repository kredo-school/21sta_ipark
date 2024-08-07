@extends('layouts.app')

@section('title', 'Favorites')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="h1 text-start page-title">
                <span class="underline">&nbsp;Fav</span>orite Parking Spaces
            </div>
        </div>
    </div>
    <div class="row ms-1 text-center">
        <div class="col-2 tab-inactive user-info-tab">
            <a
                href="{{route('profile', ['id' => $user->id])}}"
                class="tab-link"
            >
                Profile
            </a>
        </div>
        <div class="col-2 tab-inactive user-info-tab">
            <a
                href="{{route('reservation', ['id' => $user->id])}}"
                class="tab-link"
            >
                Reservation
            </a>
        </div>
        <div class="col-2 tab-active user-info-tab">
            <a
                href="{{route('favorite', ['id' => $user->id])}}"
                class="tab-link-active"
            >
                Favorite
            </a>
        </div>
    </div>

    <div class="card mt-0 profile-card py-3 shadow mb-5 custom-padding favorite-list">
        <div class="card-body" style="color: #343A40;">
            @if ($user->favorites->isEmpty())
                <h4 class="mx-5 p-4 no-data">No favorite parking place yet</h4>
            @else
                @foreach ($favorites as $favorite)
                    <div class="row border border-2 border-orange rounded-5 mx-5 my-4 p-4 shadow">
                        {{-- image --}}
                        <div class="col-lg-3">
                            <a
                                href="{{route('showParkingDetail', $favorite->parkingPlace->id)}}"
                                class="text-decoration-none"
                            >
                                @if ($favorite->parkingPlace->image !== null)
                                    <img
                                        class="w-100"
                                        src="{{asset($favorite->parkingPlace->image)}}"
                                        alt="{{$favorite->parkingPlace->parking_place_name}}"
                                        style="object-fit:cover;"
                                    >
                                @else
                                    <div class="no-image">
                                        <p class="text-center h5">
                                            No image
                                        </p>
                                    </div>
                                @endif
                            </a>
                        </div>

                        {{-- name, city, button --}}
                        <div class="col-lg-3 border-end d-flex flex-column">
                            <a
                                href="{{route('showParkingDetail', $favorite->parkingPlace->id)}}"
                                class="h3 fw-bold mt-2 parking-place-name"
                            >
                                {{$favorite->parkingPlace->parking_place_name}}
                            </a>
                            <h5 class="mt-2 mb-3 city-name">
                                <i class="fa-solid fa-location-dot"></i>&nbsp;
                                {{$favorite->parkingPlace->city}}
                            </h5>
                            <div class="mt-auto ms-auto me-2 reserve-button">
                                <a
                                    href="{{route('showReservationForm', $favorite->parkingPlace->id)}}"
                                    class="btn btn-sm rounded-pill px-3 btn-orange fw-bold"
                                >
                                    Reserve now
                                </a>
                            </div>
                        </div>

                        {{-- price --}}
                        <div class="col m-4 margin-none">
                            @if (
                                $favorite->parkingPlace->daytime_from == '00:00'
                                && $favorite->parkingPlace->daytime_to == '24:00'
                            )
                                <div class="row h5 d-flex align-items-center justify-content-center">
                                    <div class="time-column">
                                        <i class="fa-regular fa-clock"></i>
                                        {{ $favorite->parkingPlace->daytime_from }}
                                        - {{ $favorite->parkingPlace->daytime_to }}
                                    </div>
                                    <div class="amount-column d-flex align-items-center">
                                        <span class="color2_red h3 fw-bold me-1 mb-0">
                                            @if( $isTodayHoliday || $isTodayWeekend )
                                                ¥{{$favorite->parkingPlace->holiday_daytime_amount}}
                                            @else
                                                ¥{{$favorite->parkingPlace->weekday_daytime_amount}}
                                            @endif
                                        </span>
                                        <span>/30mins</span>
                                    </div>
                                </div>
                            @else
                                <div class="row h5 d-flex align-items-center">
                                    <div class="time-column">
                                        <i class="fa-regular fa-clock"></i>
                                        {{ $favorite->parkingPlace->daytime_from }}
                                        - {{ $favorite->parkingPlace->daytime_to }}
                                    </div>
                                    <div class="amount-column d-flex align-items-center">
                                        <span class="color2_red h3 fw-bold me-1 mb-0">
                                            @if( $isTodayHoliday || $isTodayWeekend )
                                                ¥{{$favorite->parkingPlace->holiday_daytime_amount}}
                                            @else
                                                ¥{{$favorite->parkingPlace->weekday_daytime_amount}}
                                            @endif
                                        </span>
                                        <span>/30mins</span>
                                    </div>
                                </div>
                                <div class="row h5 d-flex align-items-center">
                                    <div class="time-column">
                                        <i class="fa-regular fa-clock"></i>
                                        {{ $favorite->parkingPlace->daytime_to }}
                                        - {{ $favorite->parkingPlace->daytime_from }}
                                    </div>
                                    <div class="amount-column d-flex align-items-center">
                                        <span class="color2_red h3 fw-bold me-1 mb-0">
                                            @if( $isTodayHoliday || $isTodayWeekend )
                                                ¥{{$favorite->parkingPlace->holiday_night_amount}}
                                            @else
                                                ¥{{$favorite->parkingPlace->weekday_night_amount}}
                                            @endif
                                        </span>
                                        <span>/30mins</span>
                                    </div>
                                </div>
                            @endif
                            <div class="row h5 mt-3">
                                <div class="col max-amount">
                                    MAX: ¥{{$favorite->parkingPlace->maximum_amount}} /24h
                                </div>
                            </div>
                        </div>

                        {{-- heart button --}}
                        <div class="col-lg-1 d-flex align-items-center">
                            @if($favorite->parkingPlace->isFavorited())
                                <form
                                    action="{{route('favorite.destroy', $favorite->parkingPlace->id)}}"
                                    method="post"
                                    class="favorite-form"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn p-0 heart-button">
                                        <i class="fa-solid fa-heart text-danger fa-3x"></i>
                                    </button>
                                </form>
                            @else
                                <form
                                    action="{{route('favorite.store', $favorite->parkingPlace->id)}}"
                                    method="post"
                                    class="favorite-form"
                                >
                                    @csrf
                                    <button class="btn p-0 heart-button">
                                        <i class="fa-regular fa-heart fa-3x"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.favorite-form').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const url = form.action;
                const method = form.querySelector('input[name="_method"]') ? form.querySelector('input[name="_method"]').value : 'POST';
                const token = form.querySelector('input[name="_token"]').value;

                fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const icon = form.querySelector('i');
                        if (data.action === 'added') {
                            icon.classList.remove('fa-regular');
                            icon.classList.add('fa-solid', 'text-danger');
                        } else {
                            icon.classList.remove('fa-solid', 'text-danger');
                            icon.classList.add('fa-regular');
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
</script>
@endsection
