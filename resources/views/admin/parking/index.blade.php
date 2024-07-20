@extends('layouts.app')

@section('title', 'Register parking')

@section('content')

<div class="col-md-8">
    <a
        href="{{route('admin.parking.parkings_list')}}"
        class="btn btn-orange fw-bold rounded-pill btn-sm close-search-bar"
    >
        <i class="fa-solid fa-angles-left"></i>
        Back to parking places page
    </a>
    {{-- title --}}
    <div class="h1 mt-3 mb-5">
        <span class="underline ms-1">&nbsp;Reg</span>ister new parking
    </div>

    <div class="container justify-content-center background-image-newparking">

        {{-- Register new parking --}}
        <div class="content py-5 px-5">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Parking place name --}}
            <form action="{{ route('admin.parking.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-6 mt-3">
                        <label for="parking_place_name" class="h5 form-label fw-bold">
                            Parking place name <span class="color2_red">*</span>
                        </label>

                        <input type="text" class="form-control rounded-pill" id="parking_place_name" name="parking_place_name" value="{{ old('parking_place_name') }}">
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="contactnumber" class="h5 form-label fw-bold">
                            Contact Number<span class="color2_red">*</span>
                        </label>

                        <input type="text" class="form-control rounded-pill" id="contact_number" name="contact_number" value="{{ old('contact_number') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-3">
                        <label for="postal_code" class="h5 form-label fw-bold">
                            Address<span class="color2_red">*</span>
                        </label>

                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="form-control rounded-pill" id="postal_code" name="postal_code" placeholder="Postalcode" value="{{ old('postal_code') }}">
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control rounded-pill" id="city" name="city" placeholder="City" value="{{ old('city') }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mt-3">
                        <h5><br></h5>
                        <input type="text" class="form-control rounded-pill" id="street" name="street" placeholder="Street" value="{{ old('street') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-3">
                        <label for="fee" class="h5 form-label fw-bold">
                            Fee for Weekday
                            <span class="color2_red">*</span>
                        </label>

                        <div class="row">
                            <div class="col-6">
                                <input
                                    type="text"
                                    class="form-control rounded-pill"
                                    id="weekday_daytime_amount"
                                    name="weekday_daytime_amount"
                                    placeholder="For daytime"
                                    value="{{ old('weekday_daytime_amount') }}"
                                >
                            </div>
                            <div class="col-6">
                                <input
                                    type="text"
                                    class="form-control rounded-pill"
                                    id="weekday_night_amount"
                                    name="weekday_night_amount"
                                    placeholder="For night"
                                    value="{{ old('weekday_night_amount') }}"
                                >
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="holiday_amount" class="h5 form-label fw-bold">
                            Fee for holiday
                            <span class="color2_red">*</span>
                        </label>

                        <div class="row">
                            <div class="col-6">
                                <input
                                    type="text"
                                    class="form-control rounded-pill"
                                    id="holiday_daytime_amount"
                                    name="holiday_daytime_amount"
                                    placeholder="For daytime"
                                    value="{{ old('holiday_daytime_amount') }}"
                                >
                            </div>
                            <div class="col-6">
                                <input
                                    type="text"
                                    class="form-control rounded-pill"
                                    id="holiday_night_amount"
                                    name="holiday_night_amount"
                                    placeholder="For night"
                                    value="{{ old('holiday_night_amount') }}"
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-3">
                        <label for="maximum_amount" class="h5 form-label fw-bold">
                            Max fee for 24 hours
                        </label>
                        <input
                            type="text"
                            class="form-control rounded-pill"
                            id="maximum_amountv"
                            name="maximum_amount"
                            value="{{ old('maximum_amount') }}"
                        >
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="slotnumber" class="h5 form-label fw-bold">
                            Number of slots
                            <span class="color2_red">*</span>
                        </label>
                        <input
                            type="text"
                            class="form-control rounded-pill"
                            id="max_number"
                            name="max_number"
                            value="{{ old('max_number') }}"
                        >
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-3">
                        <label for="amount" class="h5 form-label fw-bold">
                            Daytime Period
                            <span class="color2_red">*</span>
                        </label>

                        <div class="row">
                            <div class="col-6">
                                <select
                                    class="form-select rounded-pill pic-icon"
                                    id="daytime_from"
                                    name="daytime_from"
                                >
                                    <option value="" hidden>From</option>
                                    @for ($i = 0; $i < 24; $i++)
                                        <option
                                            value="{{ sprintf('%02d:00', $i) }}"
                                            {{ old('daytime_from') == sprintf('%02d:00', $i) ? 'selected' : '' }}
                                        >
                                            {{ sprintf('%02d:00', $i) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-6">
                                <select
                                    class="form-select rounded-pill pic-icon"
                                    id="daytime_to"
                                    name="daytime_to"
                                >
                                    <option value="" hidden>To</option>
                                    @for ($i = 0; $i < 24; $i++)
                                        <option
                                            value="{{ sprintf('%02d:00', $i) }}"
                                            {{ old('daytime_to') == sprintf('%02d:00', $i) ? 'selected' : '' }}
                                        >
                                            {{ sprintf('%02d:00', $i) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="slotimage" class="h5 form-label fw-bold">
                            Image
                        </label>
                        <input
                            type="file"
                            name="image"
                            id="image"
                            class="form-control rounded-pill"
                            aria-describedby="image-info"
                        >
                        @error('image')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-12 mt-5">
                    <button type="submit" class="btn btn-orange w-100 rounded-pill fw-bold">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const daytimeFrom = document.getElementById('daytime_from');
    const daytimeTo = document.getElementById('daytime_to');

    function updateDaytimeToOptions() {
        const fromValue = parseInt(daytimeFrom.value.split(':')[0]);
        for (let option of daytimeTo.options) {
            const toValue = parseInt(option.value.split(':')[0]);
            option.disabled = !isNaN(fromValue) && toValue <= fromValue;
        }
    }

    function updateDaytimeFromOptions() {
        const toValue = parseInt(daytimeTo.value.split(':')[0]);
        for (let option of daytimeFrom.options) {
            const fromValue = parseInt(option.value.split(':')[0]);
            option.disabled = !isNaN(toValue) && fromValue >= toValue;
        }
    }

    daytimeFrom.addEventListener('change', updateDaytimeToOptions);
    daytimeTo.addEventListener('change', updateDaytimeFromOptions);

    updateDaytimeToOptions();
    updateDaytimeFromOptions();
});
</script>
@endsection
