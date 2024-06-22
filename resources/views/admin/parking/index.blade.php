@extends('layouts.app')

@section('content')

<div class="col-8 mb-5">
    {{-- title --}}
    <div class="h1 mt-3 mb-5">
        <span class="underline ms-1">&nbsp;Reg</span>ister new parking
    </div>
    <div class="row justify-content-center">
        <div class="col-10">
            {{-- Register new parking --}}
            <div class="row main background-image-newparking">
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
                <form action="{{ route('admin.parking.store') }}" method="post">
                    <div class="row justify-content-center py-5 px-5" style="font-family:'Inter'">
                        <div class="col-5">
                            <div class="table-background-color-none text-aline-center-d-inline">
                                <label for="parking_place_name" class="h5 form-label fw-bold ms-2 my-0">
                                    Parking place name
                                    <span class="color2_red">*</span>
                                </label>

                                <input
                                    type="text"
                                    class="form-control rounded-pill"
                                    id="parking_place_name"
                                    name="parking_place_name"
                                >
                                <label for="postal_code" class="h5 form-label fw-bold mt-3 ms-2 mb-0">
                                    Address
                                    <span class="color2_red">*</span>
                                </label>
                                <div class="row">
                                    <div class="col-6">
                                        <input
                                            type="text"
                                            class="form-control rounded-pill"
                                            id="postal_code"
                                            name="postal_code" placeholder="Postalcode"
                                        >
                                    </div>
                                    <div class="col-6">
                                        <input
                                            type="text"
                                            class="form-control rounded-pill"
                                            id="city"
                                            name="city"
                                            placeholder="City"
                                        >
                                    </div>
                                </div>
                                <label for="fee" class="h5 form-label fw-bold mt-3 ms-2 mb-0">
                                    Fee for Weekday
                                    <span class="color2_red">*</span>
                                </label>
                                <div class="row">
                                    <div class="col-6">
                                        <input
                                            type="text"
                                            class="form-control rounded-pill"
                                            id="daytime_from"
                                            name="daytime_from"
                                            placeholder="For daytime"
                                        >
                                    </div>
                                    <div class="col-6">
                                        <input
                                            type="text"
                                            class="form-control rounded-pill"
                                            id="daytime_to"
                                            name="daytime_to"
                                            placeholder="For night"
                                        >
                                    </div>
                                </div>
                                <label for="maximum_amount" class="h5 form-label fw-bold ms-2 mt-3 mb-0">
                                    Max fee for 24 hours
                                    <span class="color2_red">*</span>
                                </label>
                                <input
                                    type="text"
                                    class="form-control rounded-pill"
                                    id="maximum_amountv"
                                    name="maximum_amount"
                                >
                                <label for="amount" class="h5 form-label fw-bold ms-2 mt-3 mb-0">
                                    Daytime Period
                                    <span class="color2_red">*</span>
                                </label>
                                <div class="row">
                                    <div class="col-6">
                                        <input
                                            type="text"
                                            class="form-control rounded-pill"
                                            id="weekday_daytime_amount"
                                            name="weekday_daytime_amount"
                                            placeholder="From"
                                        >
                                    </div>
                                    <div class="col-6">
                                            <input
                                            type="text"
                                            class="form-control rounded-pill"
                                            id="weekday_night_amount"
                                            name="weekday_night_amount"
                                            placeholder="To"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <label for="contactnumber" class="h5 form-label fw-bold ms-2 my-0">
                                Contact Number
                                <span class="color2_red">*</span>
                            </label>

                            <input
                                type="text"
                                class="form-control rounded-pill"
                                id="contact_number"
                                name="contact_number"
                            >
                            <p class="pt-4"></p>
                            <input
                                type="text"
                                class="form-control rounded-pill"
                                id="street"
                                name="street"
                                placeholder="Street"
                            >
                            <label for="holiday_amount" class="h5 form-label fw-bold ms-2 mt-3 mb-0">
                                Fee for horiday
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
                                    >
                                </div>
                                <div class="col-6">
                                    <input
                                        type="text"
                                        class="form-control rounded-pill"
                                        id="holiday_night_amount"
                                        name="holiday_night_amount"
                                        placeholder="For night"
                                    >
                                </div>
                            </div>
                            <label for="slotnumber" class="h5 form-label fw-bold ms-2 mt-3 mb-0">
                                Number of slots
                                <span class="color2_red">*</span>
                            </label>
                            <input
                                type="text"
                                class="form-control rounded-pill"
                                id="max_number"
                                name="max_number"
                            >
                            <label for="slotimage" class="h5 form-label fw-bold ms-2 mt-3 mb-0">
                                Image
                            </label>
                            <input
                                type="text"
                                class="form-control rounded-pill"
                                id="image"
                                name="image"
                                placeholder="Add slot image"
                            >
                        </div>

                        <div class="col-10 mt-4">
                            <button type="submit" class="btn btn-orange w-100 rounded-pill fw-bold">
                                Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
