@extends('layouts.app')

@section('title', 'Parking Lot Detail')

@section('content')
    <div class="col">
        <a
            href="javascript:history.back()"
            class="btn btn-red fw-bold rounded-pill btn-sm"
        >
            <i class="fa-solid fa-angles-left"></i>
            Back to previous page
        </a>
    </div>
    <div class="row mt-4">
        <div class="col-9 d-flex align-items-center">
            <div class="h1 fw-bold me-5">
                {{$parking_place->parking_place_name}}
            </div>
            <div class="h4 color2_red">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= floor($average_star))
                        <i class="fa-solid fa-star"></i>
                    @elseif ($i == ceil($average_star))
                        <i class="fa-solid fa-star-half-stroke"></i>
                    @else
                        <i class="fa-regular fa-star"></i>
                    @endif
                @endfor
            </div>
        </div>
        <div class="col d-flex align-items-center justify-content-end">
            <div class="me-3">
                @guest
                    <a
                        href="{{route('login_to_favorite')}}"
                        style="color: #343A40;"
                    >
                        <i class="fa-regular fa-heart fa-2x"></i>
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
            <a
                href="{{route('showReservationForm', $parking_place->id)}}"
                class="btn rounded-pill px-5 btn-orange fw-bold fs-5"
            >
                Reserve now
            </a>
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
                <h3
                    class="color1_orange fw-bold border-bottom border-3 border-orange pb-2"
                >
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
                <h3
                    class="mt-4 color1_orange fw-bold border-bottom border-3 border-orange pb-2"
                >
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
                <h3
                    class="mt-4 color1_orange fw-bold border-bottom border-3 border-orange pb-2"
                >
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
                (<span class="color2_red h3 fw-bold">{{$parking_place->slotsLeft()}}</span>
                slots left for now)
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
                        <div
                            class="review-item"
                            @if($index >= 3) style="display:none;" @endif
                        >
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
                                <div class="row mt-3">
                                    <div class="col">{{$review->comment}}</div>
                                    @if (auth()->check() && $review->user_id == auth()->id())
                                        <a 
                                            href="{{route('review.destroy',$review->id)}}"
                                            class="col text-end mx-4 text-decoration-none"
                                        >
                                            delete
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <hr class="mx-4">
                        </div>
                    @endforeach
                @endif

                @if ($parking_place->reviews->count() > 3)
                    <div class="row text-center h5">
                        <a
                            href="#"
                            class="text-decoration-none"
                            id="viewMoreReviews"
                        >
                            View more...
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // favorited styles
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
