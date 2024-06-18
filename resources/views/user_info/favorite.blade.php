@extends('layouts.app')

@section('title', 'reservation')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="h1 text-start"><span class="underline">&nbsp;Fav</span>orite Parking Spaces</div>
        </div>
    </div>


    <div class="row ms-1 text-center">
        <div class="col-2 me-3 tab">
            <a href="{{route('profile', ['id' => $user->id])}}" class="tab-link">Profile</a>
        </div>

        <div class="col-2 me-3 tab">
            <a href="{{route('reservation', ['id' => $user->id])}}" class="tab-link">Reservation</a>
        </div>

        <div class="col-2 tab-active">
            <a href="{{route('favorite', ['id' => $user->id])}}" class="tab-link-active">Favorite</a>
        </div>
    </div>


    <div class="card mt-0 profile-card p-3 shadow mb-5">
        <div class="card-body" style="color: #343A40;">
            <div class="row border border-2 border-orange rounded-5 mx-5 my-4 p-4 shadow">
                <div class="col-3">
                    <a href="{{-- {{route('showParkingDetail', $parking_place->id)}} --}}">
                        <img
                            class="w-100"
                            {{-- src="{{$parking_place->image}}" --}}
                            src="{{asset('images/parking_space_image.jpg')}}"
                            {{-- alt="{{$parking_place->parking_place_name}}" --}}
                        >
                    </a>
                </div>
                <div class="col-3 border-end">
                    <a
                        href="{{-- {{route('showParkingDetail', $parking_place->id)}} --}}"
                        class="h3 fw-bold"
                    >
                        {{-- {{$parking_place->parking_place_name}} --}}
                        Parking space1
                    </a>
                    <h5 class="mt-2 mb-3">
                        <i class="fa-solid fa-location-dot"></i>&nbsp;
                        {{-- {{$parking_place->city}} --}}
                        Arakawa
                    </h5>
                    <div class="float-end mt-5 me-2">
                        <a
                            href="{{-- {{route('showReservationForm', $parking_place->id)}} --}}"
                            class="btn btn-sm rounded-pill px-3 btn-orange fw-bold"
                        >
                            Reserve now
                        </a>
                    </div>
                </div>
                <div class="col m-4">
                    <div class="row h5 d-flex align-items-center">
                        <div class="col">
                            <i class="fa-regular fa-clock"></i>
                            {{-- {{ $parking_place->daytime_from }} - {{ $parking_place->daytime_to }} --}}
                            8:00 - 22:00
                        </div>
                        <div class="col d-flex align-items-center">
                            <span class="color2_red h3 fw-bold me-1 mb-0">
                                {{-- ¥{{$parking_place->weekday_daytime_amount}} --}}
                                ¥400
                            </span>
                            <span>/30mins</span>
                        </div>
                    </div>
                    <div class="row h5 d-flex align-items-center">
                        <div class="col">
                            <i class="fa-regular fa-clock"></i>
                            {{-- {{ $parking_place->daytime_to }} - {{ $parking_place->daytime_from }} --}}
                            22:00 - 8:00
                        </div>
                        <div class="col d-flex align-items-center">
                            <span class="color2_red h3 fw-bold me-1 mb-0">
                                {{-- ¥{{$parking_place->weekday_night_amount}} --}}
                                ¥100
                            </span>
                            <span>/30mins</span>
                        </div>
                        <div class="row h5 mt-3">
                            <div class="col">
                                {{-- MAX: ¥{{$parking_place->maximum_amount}} /24h --}}
                                MAX: ¥1500 /24h
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1 d-flex align-items-center">
                    <i class="fa-solid fa-heart text-danger fa-3x"></i>
                </div>
            </div>
            <div class="row border border-2 border-orange rounded-5 mx-5 my-4 p-4 shadow">
                <div class="col-3">
                    <a href="{{-- {{route('showParkingDetail', $parking_place->id)}} --}}">
                        <img
                            class="w-100"
                            {{-- src="{{$parking_place->image}}" --}}
                            src="{{asset('images/parking_space_image.jpg')}}"
                            {{-- alt="{{$parking_place->parking_place_name}}" --}}
                        >
                    </a>
                </div>
                <div class="col-3 border-end">
                    <a
                        href="{{-- {{route('showParkingDetail', $parking_place->id)}} --}}"
                        class="h3 fw-bold"
                    >
                        {{-- {{$parking_place->parking_place_name}} --}}
                        Parking space2
                    </a>
                    <h5 class="mt-2 mb-3">
                        <i class="fa-solid fa-location-dot"></i>&nbsp;
                        {{-- {{$parking_place->city}} --}}
                        Arakawa
                    </h5>
                    <div class="float-end mt-5 me-2">
                        <a
                            href="{{-- {{route('showReservationForm', $parking_place->id)}} --}}"
                            class="btn btn-sm rounded-pill px-3 btn-orange fw-bold"
                        >
                            Reserve now
                        </a>
                    </div>
                </div>
                <div class="col m-4">
                    <div class="row h5 d-flex align-items-center">
                        <div class="col">
                            <i class="fa-regular fa-clock"></i>
                            {{-- {{ $parking_place->daytime_from }} - {{ $parking_place->daytime_to }} --}}
                            8:00 - 22:00
                        </div>
                        <div class="col d-flex align-items-center">
                            <span class="color2_red h3 fw-bold me-1 mb-0">
                                {{-- ¥{{$parking_place->weekday_daytime_amount}} --}}
                                ¥400
                            </span>
                            <span>/30mins</span>
                        </div>
                    </div>
                    <div class="row h5 d-flex align-items-center">
                        <div class="col">
                            <i class="fa-regular fa-clock"></i>
                            {{-- {{ $parking_place->daytime_to }} - {{ $parking_place->daytime_from }} --}}
                            22:00 - 8:00
                        </div>
                        <div class="col d-flex align-items-center">
                            <span class="color2_red h3 fw-bold me-1 mb-0">
                                {{-- ¥{{$parking_place->weekday_night_amount}} --}}
                                ¥100
                            </span>
                            <span>/30mins</span>
                        </div>
                        <div class="row h5 mt-3">
                            <div class="col">
                                {{-- MAX: ¥{{$parking_place->maximum_amount}} /24h --}}
                                MAX: ¥1500 /24h
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1 d-flex align-items-center">
                    <i class="fa-solid fa-heart text-danger fa-3x"></i>
                </div>
            </div>
            <div class="row border border-2 border-orange rounded-5 mx-5 my-4 p-4 shadow">
                <div class="col-3">
                    <a href="{{-- {{route('showParkingDetail', $parking_place->id)}} --}}">
                        <img
                            class="w-100"
                            {{-- src="{{$parking_place->image}}" --}}
                            src="{{asset('images/parking_space_image.jpg')}}"
                            {{-- alt="{{$parking_place->parking_place_name}}" --}}
                        >
                    </a>
                </div>
                <div class="col-3 border-end">
                    <a
                        href="{{-- {{route('showParkingDetail', $parking_place->id)}} --}}"
                        class="h3 fw-bold"
                    >
                        {{-- {{$parking_place->parking_place_name}} --}}
                        Parking space3
                    </a>
                    <h5 class="mt-2 mb-3">
                        <i class="fa-solid fa-location-dot"></i>&nbsp;
                        {{-- {{$parking_place->city}} --}}
                        Arakawa
                    </h5>
                    <div class="float-end mt-5 me-2">
                        <a
                            href="{{-- {{route('showReservationForm', $parking_place->id)}} --}}"
                            class="btn btn-sm rounded-pill px-3 btn-orange fw-bold"
                        >
                            Reserve now
                        </a>
                    </div>
                </div>
                <div class="col m-4">
                    <div class="row h5 d-flex align-items-center">
                        <div class="col">
                            <i class="fa-regular fa-clock"></i>
                            {{-- {{ $parking_place->daytime_from }} - {{ $parking_place->daytime_to }} --}}
                            8:00 - 22:00
                        </div>
                        <div class="col d-flex align-items-center">
                            <span class="color2_red h3 fw-bold me-1 mb-0">
                                {{-- ¥{{$parking_place->weekday_daytime_amount}} --}}
                                ¥400
                            </span>
                            <span>/30mins</span>
                        </div>
                    </div>
                    <div class="row h5 d-flex align-items-center">
                        <div class="col">
                            <i class="fa-regular fa-clock"></i>
                            {{-- {{ $parking_place->daytime_to }} - {{ $parking_place->daytime_from }} --}}
                            22:00 - 8:00
                        </div>
                        <div class="col d-flex align-items-center">
                            <span class="color2_red h3 fw-bold me-1 mb-0">
                                {{-- ¥{{$parking_place->weekday_night_amount}} --}}
                                ¥100
                            </span>
                            <span>/30mins</span>
                        </div>
                        <div class="row h5 mt-3">
                            <div class="col">
                                {{-- MAX: ¥{{$parking_place->maximum_amount}} /24h --}}
                                MAX: ¥1500 /24h
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1 d-flex align-items-center">
                    <i class="fa-solid fa-heart text-danger fa-3x"></i>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
