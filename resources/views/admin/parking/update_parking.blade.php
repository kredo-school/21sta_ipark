@extends('layouts.app')

@section('content')

<div class="col-8 mb-5">
    {{-- title --}}
    <div class="h1 mt-3 mb-5">
        <span class="underline ms-1">&nbsp;Upd</span>ate parking
    </div>
    <div class="row justify-content-center">
        <div class="col-10">
            {{-- Update parking --}}
            <div class="row main background-image-newparking">
                {{-- Parking place name --}}
                <form action="" method="get">
                    <div class="row justify-content-center py-5 px-5" style="font-family:'Inter'">
                        <div class="col-5">
                            <div class="table-background-color-none text-aline-center-d-inline">
                                <label for="plaename" class="h5 form-label fw-bold ms-2 my-0">
                                    Parking place name
                                    <span class="color2_red">*</span>
                                </label>

                                <input
                                    type="text"
                                    class="form-control rounded-pill"
                                    id="plaename"
                                    name="plaename"
                                >
                                <label for="postalcode" class="h5 form-label fw-bold mt-3 ms-2 mb-0">
                                    Address
                                    <span class="color2_red">*</span>
                                </label>
                                <div class="row">
                                    <div class="col-6">
                                        <input
                                            type="text"
                                            class="form-control rounded-pill"
                                            id="postalcode"
                                            name="postalcode" placeholder="Postalcode"
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
                                            id="feedaytime"
                                            name="feedaytime"
                                            placeholder="For daytime"
                                        >
                                    </div>
                                    <div class="col-6">
                                        <input
                                            type="text"
                                            class="form-control rounded-pill"
                                            id="feenighttime"
                                            name="feenighttime"
                                            placeholder="For night"
                                        >
                                    </div>
                                </div>
                                <label for="feemax" class="h5 form-label fw-bold ms-2 mt-3 mb-0">
                                    Max fee for 24 hours
                                    <span class="color2_red">*</span>
                                </label>
                                <input
                                    type="text"
                                    class="form-control rounded-pill"
                                    id="feenighttime"
                                    name="feemax"
                                >
                                <label for="period" class="h5 form-label fw-bold ms-2 mt-3 mb-0">
                                    Daytime Period
                                    <span class="color2_red">*</span>
                                </label>
                                <div class="row">
                                    <div class="col-6">
                                        <input
                                            type="text"
                                            class="form-control rounded-pill"
                                            id="periodfrom"
                                            name="periodfrom"
                                            placeholder="From"
                                        >
                                    </div>
                                    <div class="col-6">
                                            <input
                                            type="text"
                                            class="form-control rounded-pill"
                                            id="periodto"
                                            name="periodto"
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
                                id="contactnumber"
                                name="contactnumber"
                            >
                            <p class="pt-4"></p>
                            <input
                                type="text"
                                class="form-control rounded-pill"
                                id="street"
                                name="street"
                                placeholder="Street"
                            >
                            <label for="feeholi" class="h5 form-label fw-bold ms-2 mt-3 mb-0">
                                Fee for horiday
                                <span class="color2_red">*</span>
                            </label>
                            <div class="row">
                                <div class="col-6">
                                    <input
                                        type="text"
                                        class="form-control rounded-pill"
                                        id="feeholidaytime"
                                        name="feeholidaytime"
                                        placeholder="For daytime"
                                    >
                                </div>
                                <div class="col-6">
                                    <input
                                        type="text"
                                        class="form-control rounded-pill"
                                        id="feeholinighttime"
                                        name="feeholinighttime"
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
                                id="slotnumber"
                                name="slotnumber"
                            >
                            <label for="slotimage" class="h5 form-label fw-bold ms-2 mt-3 mb-0">
                                Image
                            </label>
                            <input
                                type="text"
                                class="form-control rounded-pill"
                                id="slotimage"
                                name="slotimage"
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
