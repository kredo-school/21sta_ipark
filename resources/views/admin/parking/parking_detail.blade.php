@extends('layouts.app')

@section('content')
    <div class="col">
        <a href="javascript:history.back()" class="btn btn-red fw-bold rounded-pill btn-sm">
            <i class="fa-solid fa-angles-left"></i>
            Back to previous page
        </a>
    </div>
    <div class="row mt-4">
        <div class="col d-flex align-items-center">
            <div class="h1 fw-bold me-5">
                {{$parking_place->parking_place_name}}
            </div>
        </div>
    </div>
    <div class="row my-4 px-5">
        <div class="col-6 px-5">
            @if ($parking_place->image !== null)
                <img
                    class="w-100"
                    src="{{asset($parking_place->image)}}"
                    alt="{{$parking_place->parking_place_name}}"
                    style="height:300px"
                >
            @else
                <div class="no-image" style="height:300px">
                    <p class="text-center h5">
                        No image
                    </p>
                </div>
            @endif

            <h2 class="color3_bluegray mt-5 fw-bold">
                <i class="fa-solid fa-coins"></i>&nbsp;
                Price
            </h2>
            <div class="row bg-orange p-4 rounded-5 mt-3 mx-3">
                {{-- Weekday --}}
                <h3 class="color1_orange fw-bold border-bottom border-3 border-orange pb-2">
                    Weekday
                </h3>
                @if ( $parking_place->daytime_from == '00:00' && $parking_place->daytime_to == '24:00')
                    <div class="row mt-3 h4 d-flex align-items-center">
                        <div class="col ms-3">
                            <i class="fa-regular fa-clock"></i>
                            {{ $parking_place->daytime_from }} - {{ $parking_place->daytime_to }}
                        </div>
                        <div class="col">
                            <span class="color2_red h3 fw-bold">
                                ¥{{$parking_place->weekday_daytime_amount}}
                            </span> /30mins
                        </div>
                    </div>
                @else
                    <div class="row mt-3 h4 d-flex align-items-center">
                        <div class="col ms-3">
                            <i class="fa-regular fa-clock"></i>
                            {{ $parking_place->daytime_from }} - {{ $parking_place->daytime_to }}
                        </div>
                        <div class="col">
                            <span class="color2_red h3 fw-bold">
                                ¥{{$parking_place->weekday_daytime_amount}}
                            </span> /30mins
                        </div>
                    </div>
                    <div class="row h4 d-flex align-items-center">
                        <div class="col ms-3">
                            <i class="fa-regular fa-clock"></i>
                            {{ $parking_place->daytime_to }} - {{ $parking_place->daytime_from }}
                        </div>
                        <div class="col">
                            <span class="color2_red h3 fw-bold">
                                ¥{{$parking_place->weekday_night_amount}}
                            </span> /30mins
                        </div>
                    </div>
                @endif
                {{-- Holiday --}}
                <h3 class="mt-4 color1_orange fw-bold border-bottom border-3 border-orange pb-2">
                    Holiday
                </h3>
                @if ( $parking_place->daytime_from == '00:00' && $parking_place->daytime_to == '24:00')
                    <div class="row mt-3 h4 d-flex align-items-center">
                        <div class="col ms-3">
                            <i class="fa-regular fa-clock"></i>
                            {{ $parking_place->daytime_from }} - {{ $parking_place->daytime_to }}
                        </div>
                        <div class="col">
                            <span class="color2_red h3 fw-bold">
                                ¥{{$parking_place->holiday_daytime_amount}}
                            </span> /30mins
                        </div>
                    </div>
                @else
                    <div class="row mt-3 h4 d-flex align-items-center">
                        <div class="col ms-3">
                            <i class="fa-regular fa-clock"></i>
                            {{ $parking_place->daytime_from }} - {{ $parking_place->daytime_to }}
                        </div>
                        <div class="col">
                            <span class="color2_red h3 fw-bold">
                                ¥{{$parking_place->holiday_daytime_amount}}
                            </span> /30mins
                        </div>
                    </div>
                    <div class="row h4 d-flex align-items-center">
                        <div class="col ms-3">
                            <i class="fa-regular fa-clock"></i>
                            {{ $parking_place->daytime_to }} - {{ $parking_place->daytime_from }}
                        </div>
                        <div class="col">
                            <span class="color2_red h3 fw-bold">
                                ¥{{$parking_place->holiday_night_amount}}
                            </span> /30mins
                        </div>
                    </div>
                @endif
                {{-- Max --}}
                <h3 class="mt-4 color1_orange fw-bold border-bottom border-3 border-orange pb-2">
                    Max
                </h3>
                <div class="row mt-3 h4 d-flex align-items-center">
                    <div class="col ms-3">
                        <span class="color2_red h3 fw-bold">
                            ¥{{$parking_place->maximum_amount}}
                        </span> /24h
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 px-5">
            <h2 class="color3_bluegray my-3 fw-bold">
                <i class="fa-solid fa-location-dot"></i>&nbsp;
                Address
            </h2>
            <div class="h4 ms-3">
                {{$parking_place->street}},
                {{$parking_place->city}},
                {{$parking_place->postal_code}}
            </div>

            <h2 class="color3_bluegray my-3 fw-bold mt-5">
                <i class="fa-solid fa-car"></i>&nbsp;
                Number of slots
            </h2>
            <div class="h4 ms-3">
                {{$parking_place->max_number}}
                (<span class="color2_red h3 fw-bold">{{$parking_place->slotsLeft()}}</span> slots left)
            </div>

            <h2 class="color3_bluegray my-3 fw-bold mt-5">
                <i class="fa-solid fa-phone"></i>&nbsp;
                Contact
            </h2>
            <div class="h4 ms-3">
                {{$parking_place->contact_number}}
            </div>

            <h2 class="color3_bluegray my-3 fw-bold mt-5">
                <i class="fa-regular fa-comment-dots"></i>&nbsp;
                Reviews ({{$parking_place->reviews->count()}})
            </h2>
            <div class="reviews collapsed">
                @if ($parking_place->reviews->isEmpty())
                    <h4 class="ms-3">No review yet</h4>
                @else
                    @foreach ($parking_place->reviews as $index => $review)
                        <div class="review-item" @if($index >= 3) style="display:none;" @endif>
                            <div class="row ms-3 d-flex align-items-center">
                                <div class="col-8 d-flex align-items-center">
                                    <div class="h4 fw-bold me-4">
                                        {{$review->user->username}}
                                    </div>
                                    <div class="color2_red h5">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->star)
                                                <i class="fa-solid fa-star"></i>
                                            @else
                                                <i class="fa-regular fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <div class="col text-end h6 me-3">
                                    {{$review->created_at->format('Y/m/d')}}
                                </div>
                            </div>
                            <div class="ms-5">
                                {{$review->comment}}
                            </div>
                            <hr class="mx-4">
                        </div>
                    @endforeach
                @endif

                @if ($parking_place->reviews->count() > 3)
                    <div class="row text-center h5">
                        <a href="#" class="text-decoration-none" id="viewMoreReviews">
                            View more...
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Review section toggle
            const viewMoreButton = document.querySelector('#viewMoreReviews');

            if (viewMoreButton) {
                viewMoreButton.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelectorAll('.review-item').forEach(function (item) {
                        item.style.display = 'block';
                    });
                    document.querySelectorAll('.reviews > div').forEach(function (item) {
                        if (item.getAttribute('style') && item.getAttribute('style').includes('display:none')) {
                            item.style.display = 'block';
                        }
                    });
                    viewMoreButton.style.display = 'none';
                });
            }
        });
    </script>
@endsection
