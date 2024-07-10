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
        <a href="javascript:void(0);" class="col h1 text-end filter-button">
            <i class="fa-solid fa-filter"></i>
        </a>
    </div>

    {{-- filter search --}}
    <div class="row search-bar d-flex justify-content-center" style="display: none;">
        <div class="col-10">
            <form action="#" method="get">
                <div class="card parking-place-search">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <a
                                    href="javascript:void(0);"
                                    class="btn btn-red fw-bold rounded-pill btn-sm close-search-bar"
                                >
                                    <i class="fa-solid fa-angles-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-5">
                                <label
                                    for="parking_place_name"
                                    class="h5 form-label fw-bold mt-2 ms-2 mb-0"
                                >
                                    Parking place Name
                                </label>
                                <input
                                    type="text"
                                    class="form-control rounded-pill"
                                    id="parking_place_name"
                                    name="parking_place_name"
                                >
                                <div class="row">
                                    <div class="col-7">
                                        <label
                                            for="address"
                                            class="h5 form-label fw-bold mt-3 ms-2 mb-0"
                                        >
                                            Address
                                        </label>
                                        <div class="row">
                                            <div class="col-5">
                                                <input
                                                    type="text"
                                                    class="form-control rounded-pill"
                                                    id="postal_code"
                                                    name="postal_code"
                                                    placeholder="Postal code"
                                                >
                                            </div>
                                            <div class="col-7">
                                                <input
                                                    type="text"
                                                    id="city"
                                                    name="city"
                                                    class="form-control rounded-pill"
                                                    placeholder="City"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <label
                                            for="inputStatus"
                                            class="h5 form-label fw-bold mt-3 ms-2 mb-0"
                                        >
                                            Only Open
                                        </label><br>
                                        <input type="checkbox" name="only_open" value="open" class="form-check-input ms-2 mt-2">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-6">
                                        <label
                                            for="date"
                                            class="h5 form-label fw-bold mt-2 ms-2 mb-0"
                                        >
                                            Date
                                        </label>
                                        <input
                                            type="date"
                                            class="form-control rounded-pill"
                                            id="date"
                                            name="date"
                                        >
                                    </div>
                                </div>
                                <label
                                    class="h5 form-label fw-bold mt-3 ms-2 mb-0"
                                >
                                    Time
                                </label>
                                <div class="input-group">
                                    <select name="from_hour" id="from_hour" class="form-select rounded-pill" value="{{ old('from_hour') }}">
                                        <?php
                                        for ($i = 0; $i < 24; $i++) {
                                            $selected = old('from_hour') == $i ? 'selected' : '';
                                        ?>
                                            <option value="{{$i}}" <?php echo $selected; ?>>
                                                {{$i}}
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="text-center fw-bold mx-2 mt-1">:</span>
                                    <select name="from_minute" id="from_minute" class="form-select rounded-pill" value="{{ old('date') }}">
                                        <option value="00" {{ old('from_minute') == '00' ? 'selected' : '' }}>00</option>
                                        <option value="30" {{ old('from_minute') == '30' ? 'selected' : '' }}>30</option>
                                    </select>
                                    <span class="mx-2 mt-1">〜</span>
                                    <select name="to_hour" id="to_hour" class="form-select rounded-pill">
                                        <?php
                                        for ($i = 0; $i < 25; $i++) {
                                            $selected = old('to_hour') == $i ? 'selected' : '';
                                        ?>
                                            <option value="{{$i}}" <?php echo $selected; ?>>
                                                {{$i}}
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="text-center fw-bold mx-2 mt-1">:</span>
                                    <select name="to_minute" id="to_minute" class="form-select rounded-pill">
                                        <option value="00" {{ old('to_minute') == '00' ? 'selected' : '' }}>00</option>
                                        <option value="30" {{ old('to_minute') == '30' ? 'selected' : '' }}>30</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-4">
                                <div class="row my-3">
                                    <div class="col-6">
                                        <button
                                            type="button"
                                            class="btn btn-red rounded-pill w-100 fw-bold"
                                        >
                                            Clear All Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button
                                            type="button"
                                            class="btn btn-red-opposite rounded-pill w-100 fw-bold"
                                        >
                                            Apply Filter
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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
                            <a
                                href="{{route('showParkingDetail', $parking_place->id)}}"
                                class="text-decoration-none"
                            >
                                @if ($parking_place->image !== null)
                                    <img
                                        class="w-100"
                                        src="{{asset($parking_place->image)}}"
                                        alt="{{$parking_place->parking_place_name}}"
                                        style="height:150px; object-fit:cover;"
                                    >
                                @else
                                    <div class="no-image" style="height:150px">
                                        <p class="text-center h5">
                                            No image
                                        </p>
                                    </div>
                                @endif
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
            // favorite styles
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

            // filter button
            document.querySelector('.filter-button').addEventListener('click', function () {
                const searchBar = document.querySelector('.search-bar');
                if (searchBar.style.display === 'none' || searchBar.style.display === '') {
                    searchBar.style.display = 'flex';
                    searchBar.style.transition = 'all 0.5s';
                    searchBar.style.transform = 'translateY(0)';
                } else {
                    searchBar.style.display = 'none';
                    searchBar.style.transform = 'translateY(-100%)';
                }
            });

            // close search bar
            document.querySelector('.close-search-bar').addEventListener('click', function () {
                const searchBar = document.querySelector('.search-bar');
                searchBar.style.display = 'none';
                searchBar.style.transform = 'translateY(-100%)';
            });
        });
    </script>

@endsection
