@extends('layouts.app')

@section('title', 'Parking List')

@section('content')
    <div class="row align-items-center">
        <div class="col h1 fw-bold">
            <span class="color2_red">
                <i class="fa-solid fa-location-dot"></i>&nbsp;
            </span>
            @if ($search)
                {{ $search }}
            @else
                All parking places
            @endif
        </div>
        <div class="col">
            <div class="row fw-bold text-center justify-content-center">
                {{ $parking_places->links('vendor.pagination.custom') }}
            </div>
        </div>
        <a href="" class="col h1 text-end">
            <i class="fa-solid fa-filter"></i>
        </a>
    </div>
    <div class="row mt-4 px-3">
        @forelse ($parking_places as $parking_place)
            <div class="col-4">
                <div class="row">
                    <div class="col bg-white p-4 shadow m-3 border border-2 border-orange rounded-4">
                        <div class="row ms-0 me-2 d-flex align-items-center">
                            @if ( $parking_place->isReservationPossible() )
                                <div class="col-2 bg-navy rounded-circle text-white shadow d-flex justify-content-center align-items-center" style="width: 70px; height: 70px;">
                                    OPEN
                                </div>
                            @else
                                <div class="col-2 bg-red rounded-circle text-white shadow d-flex justify-content-center align-items-center" style="width: 70px; height: 70px;">
                                    FULL
                                </div>
                            @endif

                            <div class="col ms-1">
                                <div class="row h4 fw-bold justify-content-center text-center">
                                    {{ $parking_place->parking_place_name }}
                                </div>
                                <div class="row h6 justify-content-center">
                                    {{ $parking_place->street }}
                                </div>
                            </div>
                            <div class="col-1 float-end h2">
                                @guest
                                    <a
                                        href="{{route('login_to_favorite')}}"
                                        style="color: #343A40;"
                                    >
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                @else
                                    @if($parking_place->isFavorited())
                                        <form
                                            action="{{route('favorite.destroy', $parking_place->id)}}"
                                            method="post"
                                            class="favorite-form"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn p-0">
                                                <i class="fa-solid fa-heart text-danger fa-2x"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form
                                            action="{{route('favorite.store', $parking_place->id)}}"
                                            method="post"
                                            class="favorite-form"
                                        >
                                            @csrf
                                            <button class="btn p-0">
                                                <i class="fa-regular fa-heart fa-2x"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endguest
                            </div>
                        </div>
                        <div class="row mt-3">
                            <a href="{{route('showParkingDetail', $parking_place->id)}}">
                                <img
                                    class="w-100"
                                    {{-- src="{{$parking_place->image}}" --}}
                                    src="{{asset('images/parking_space_image.jpg')}}"
                                    alt="{{$parking_place->parking_place_name}}"
                                    style="height:150px"
                                >
                            </a>
                        </div>
                        <div class="row mt-3 justify-content-center">
                            @if (
                                $parking_place->daytime_from == '00:00'
                                && $parking_place->daytime_to == '24:00'
                            )
                                <div class="row h5 d-flex align-items-center">
                                    <div class="col">
                                        <i class="fa-regular fa-clock"></i>
                                        {{ $parking_place->daytime_from }}
                                        - {{ $parking_place->daytime_to }}
                                    </div>
                                    <div class="col d-flex align-items-center">
                                        <span class="color2_red h3 fw-bold me-1 mb-0">
                                            @if( $isTodayHoliday || $isTodayWeekend )
                                                ¥{{$parking_place->holiday_daytime_amount}}
                                            @else
                                                ¥{{$parking_place->weekday_daytime_amount}}
                                            @endif
                                        </span>
                                        <span>/30mins</span>
                                    </div>
                                </div>
                                <div class="row h5 d-flex align-items-center">
                                    <div class="col d-flex align-items-center">
                                        <span class="color2_red h3 fw-bold me-1 mb-0"><br></span>
                                    </div>
                                </div>
                            @else
                                <div class="row h5 d-flex align-items-center">
                                    <div class="col">
                                        <i class="fa-regular fa-clock"></i>
                                        {{ $parking_place->daytime_from }}
                                        - {{ $parking_place->daytime_to }}
                                    </div>
                                    <div class="col d-flex align-items-center">
                                        <span class="color2_red h3 fw-bold me-1 mb-0">
                                            @if( $isTodayHoliday || $isTodayWeekend )
                                                ¥{{$parking_place->holiday_daytime_amount}}
                                            @else
                                                ¥{{$parking_place->weekday_daytime_amount}}
                                            @endif
                                        </span>
                                        <span>/30mins</span>
                                    </div>
                                </div>
                                <div class="row h5 d-flex align-items-center">
                                    <div class="col">
                                        <i class="fa-regular fa-clock"></i>
                                        {{ $parking_place->daytime_to }}
                                        - {{ $parking_place->daytime_from }}
                                    </div>
                                    <div class="col d-flex align-items-center">
                                        <span class="color2_red h3 fw-bold me-1 mb-0">
                                            @if( $isTodayHoliday || $isTodayWeekend )
                                                ¥{{$parking_place->holiday_night_amount}}
                                            @else
                                                ¥{{$parking_place->weekday_night_amount}}
                                            @endif
                                        </span>
                                        <span>/30mins</span>
                                    </div>
                                </div>
                            @endif
                            <div class="row h5 mt-1">
                                <div class="col">
                                    MAX: ¥{{$parking_place->maximum_amount}} /24h
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-2">
                            <a
                                href="{{route('showReservationForm', $parking_place->id)}}"
                                class="btn btn-sm rounded-pill px-5 btn-orange fw-bold fs-5"
                            >
                                Reserve now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center h3 my-5">No parking places found in {{ $search }}.</p>
            </div>
        @endforelse
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
