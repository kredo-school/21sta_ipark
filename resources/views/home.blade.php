@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row">
        <div class="col-7">
            <h1 class="mt-5 fw-bold text-center display-5 text-shadow">
                You can
                <span class="color2_red">FIND and RESERVE</span>
                <br>
                parking spaces soon!
            </h1>
            <div class="row mt-5 mx-5">
                <div class="col-8 d-flex align-items-center color3_bluegray">
                    <span class="h2 me-2">
                        <i class="fa-solid fa-car"></i>
                    </span>
                    <p class="fw-bold mb-2 h5">
                        more than 100k parking spaces
                    </p>
                </div>
                <div class="col-4 d-flex align-items-center color3_bluegray">
                    <span class="h2 me-2">
                        <i class="fa-brands fa-creative-commons-nc-jp"></i>
                    </span>
                    <p class="fw-bold mb-2 h5">
                        free to register
                    </p>
                </div>
            </div>
            <div class="row mt-4"></div>
            <div class="row mt-5 justify-content-center">
                <div class="col-7">
                    <form action="{{route('showParkingList')}}" method="get">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text rounded-pill rounded-end">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                            <input
                                type="text"
                                name="search"
                                placeholder="Search by place name"
                                class="form-control rounded-pill rounded-start"
                            >
                        </div>
                        <div class="text-center mt-4">
                            <button
                                type="submit"
                                class="btn rounded-pill fw-bold px-4 btn-navy fs-5 btn-sm"
                            >
                                Show parking spaces
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-5">
            <img
                src="{{asset('images/Parking-illustration.png')}}"
                alt="main_img"
                class="img-fluid"
            >
        </div>
    </div>

    {{-- Recommendation --}}
    <div class="h1 fw-bold mt-5">
        <span class="underline ms-1">&nbsp;Rec</span>ommendation
    </div>
    <div class="row mt-4">
        @foreach ($recommendation as $parking_place)
            <div class="col-4">
                <div class="row">
                    <div class="col bg-white p-4 shadow m-3">
                        <div class="row">
                            <div class="col-10">
                                <a
                                    href="{{route('showParkingDetail', $parking_place->id)}}"
                                    class="h3 text-decoration-none fw-bold"
                                >
                                    {{$parking_place->parking_place_name}}
                                </a>
                            </div>
                            <div class="col-2 text-end h2 p-0">
                                @guest
                                    <a
                                        href="{{route('login_to_favorite')}}"
                                        style="color: #343A40;"
                                    >
                                        <i class="fa-regular fa-heart me-3"></i>
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
                                                <i class="fa-solid fa-heart text-danger me-3 fa-2x"></i>
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
                                                <i class="fa-regular fa-heart me-3 fa-2x"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endguest
                            </div>
                        </div>
                        <div class="row mt-2">
                            <a href="{{route('showParkingDetail', $parking_place->id)}}">
                                <img
                                    class="w-100"
                                    {{-- src="{{$parking_place->image}}" --}}
                                    src="{{asset('images/parking_space_image.jpg')}}"
                                    alt="{{$parking_place->parking_place_name}}"
                                    style="height:200px"
                                >
                            </a>
                        </div>
                        <div class="row mt-3">
                            <div class="h4 color2_red">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= floor($parking_place->average_star))
                                        <i class="fa-solid fa-star"></i>
                                    @elseif ($i == ceil($parking_place->average_star))
                                        <i class="fa-solid fa-star-half-stroke"></i>
                                    @else
                                        <i class="fa-regular fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <div class="row mt-2">
                            <h4>
                                <i class="fa-solid fa-location-dot"></i>&nbsp;
                                {{$parking_place->city}}
                            </h4>
                        </div>
                        <div class="row mt-2">
                            <h4>Price</h4>
                        </div>
                        <div class="row px-2">
                            @if ( $parking_place->daytime_from == '00:00' && $parking_place->daytime_to == '24:00')
                                <div class="row h5 d-flex align-items-center">
                                    <div class="col">
                                        <i class="fa-regular fa-clock"></i>
                                        {{ $parking_place->daytime_from }} - {{ $parking_place->daytime_to }}
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
                                        {{ $parking_place->daytime_from }} - {{ $parking_place->daytime_to }}
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
                                        {{ $parking_place->daytime_to }} - {{ $parking_place->daytime_from }}
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
                        <div class="text-center mt-4">
                            <a
                                href="{{route('showReservationForm', $parking_place->id)}}"
                                class="btn rounded-pill px-5 btn-orange fw-bold fs-5"
                            >
                                Reserve now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <a
        href="{{route('showParkingList')}}"
        class="mt-4 text-end me-5 h3 text-decoration-none"
    >
        View more
        <i class="fa-solid fa-angles-right"></i>
    </a>
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
