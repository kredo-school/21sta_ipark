@extends('layouts.app')

@section('content')
<div class="col-8">
    {{-- title --}}
    <div class="h1 mt-3 mb-5">
        <span class="underline ms-1">&nbsp;Res</span>ervation form
    </div>

    {{-- Reservation --}}
<<<<<<< HEAD
    <div class="main background-image-parkinglot-reservation-top"> 
=======
    <div class="main background-image-parkinglot-reservation-top">
>>>>>>> c7cdff2c3c131fb7cb30d0cf8444de430e967c4b
        {{-- Parking lot adress --}}
        <div class="row pt-5 px-5">
            <div class="title">
                <div class="h2 color3_bluegray fw-bold">
<<<<<<< HEAD
                    ABC Parking Space
                </div>
                <i class="fa-solid fa-location-dot "></i> 3-22 Arakawa,Arakawa
=======
                    {{$parking_places->parking_place_name}}
                </div>
                <i class="fa-solid fa-location-dot "></i>
                {{$parking_places->parking_place_name}} , {{$parking_places->city}}
>>>>>>> c7cdff2c3c131fb7cb30d0cf8444de430e967c4b
            </div>
        </div>

        {{-- Reservation form --}}
<<<<<<< HEAD
        <form action="" method="get">
            <div class="row p-3 mb-3">
                <div class="col-8">
                    <div class="form text-center fw-bold">
                        <table 
=======
        <form action="{{ route('reservation.create',$parking_places->id) }}" method="post">
            @csrf
            <input type="hidden" name="parking_places_id" value="{{ $parking_places->id }}">
            <div class="row p-3 mb-3">
                <div class="col-8">
                    <div class="form text-center fw-bold">
                        <table
>>>>>>> c7cdff2c3c131fb7cb30d0cf8444de430e967c4b
                            class="table table-background-color-none text-aline-center d-inline"
                        >
                            <tr>
                                <td style="font-family:'Inter'">
                                    <label for="cartype" class = "form-label">Car type</label>
                                </td>
                                <td colspan="3">
<<<<<<< HEAD
                                    <select 
                                        name="cartype" 
                                        id="cartype" 
                                        class ='form-select'
                                    >
                                        <option value="">standard</option>
                                        <option value="">compact</option>
                                        <option value="">large</option>
=======
                                    <select
                                        name="cartype"
                                        id="cartype"
                                        class ='form-select'
                                        value="{{ old('cartype') }}"
                                    >
                                        <option value="standard">standard</option>
                                        <option value="compact">compact</option>
                                        <option value="large">large</option>
>>>>>>> c7cdff2c3c131fb7cb30d0cf8444de430e967c4b
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family:'Inter'">
                                    <label for="date" class = "form-label">Date</label>
                                </td>
                                <td colspan="3">
<<<<<<< HEAD
                                    <input 
=======
                                    <input
>>>>>>> c7cdff2c3c131fb7cb30d0cf8444de430e967c4b
                                        type="date"
                                        class="form-control"
                                        id="date"
                                        name="date"
<<<<<<< HEAD
=======
                                        value="{{ old('date') }}"
>>>>>>> c7cdff2c3c131fb7cb30d0cf8444de430e967c4b
                                    >
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family:'Inter'">
                                    <label for="from" class = "form-label">From</label>
                                </td>
                                <td>
<<<<<<< HEAD
                                    <select name="hour" id="hour" class="form-select">
                                        <?php    
                                        for ($i = 0; $i < 24; $i++) {
                                        ?>
                                            <option value="{{ $i;}}">
                                                <?php echo $i; ?>
=======
                                    <select name="from_hour" id="from_hour" class="form-select" value="{{ old('from_hour') }}">
                                        <?php
                                        for ($i = 0; $i < 24; $i++) {
                                            $selected = old('from_hour') == $i ? 'selected' : '';
                                        ?>
                                            <option value="{{$i}}" <?php echo $selected; ?>>
                                                {{$i}}
>>>>>>> c7cdff2c3c131fb7cb30d0cf8444de430e967c4b
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="text-center fw-bold">:</td>
                                <td>
<<<<<<< HEAD
                                    <select name="minute" id="minute" class="form-select">
                                        <option value="00">00</option>
                                        <option value="30">30</option>
=======
                                    <select name="from_minute" id="from_minute" class="form-select" value="{{ old('date') }}">
                                        <option value="00" {{ old('from_minute') == '00' ? 'selected' : '' }}>00</option>
                                        <option value="30" {{ old('from_minute') == '30' ? 'selected' : '' }}>30</option>
>>>>>>> c7cdff2c3c131fb7cb30d0cf8444de430e967c4b
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family:'Inter'">
                                    <label for="to" class = "form-label">To</label>
                                </td>
                                <td style="width: 25%;">
<<<<<<< HEAD
                                    <select name="hour" id="hour" class="form-select">
                                        <?php    
                                        for ($i = 0; $i < 25; $i++) {
                                        ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
=======
                                    <select name="to_hour" id="to_hour" class="form-select">
                                        <?php
                                        for ($i = 0; $i < 25; $i++) {
                                            $selected = old('to_hour') == $i ? 'selected' : '';
                                        ?>
                                            <option value="{{$i}}" <?php echo $selected; ?>>
                                                {{$i}}
                                            </option>
>>>>>>> c7cdff2c3c131fb7cb30d0cf8444de430e967c4b
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="text-center fw-bold">:</td>
                                <td style="width: 25%;">
<<<<<<< HEAD
                                    <select name="minute" id="minute" class="form-select">
                                        <option value="00">00</option>
                                        <option value="30">30</option>
=======
                                    <select name="to_minute" id="to_minute" class="form-select">
                                        <option value="00" {{ old('to_minute') == '00' ? 'selected' : '' }}>00</option>
                                        <option value="30" {{ old('to_minute') == '30' ? 'selected' : '' }}>30</option>
>>>>>>> c7cdff2c3c131fb7cb30d0cf8444de430e967c4b
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
<<<<<<< HEAD
=======
                    @if ($errors->any())
                        <div class="alert text-center color2_red fw-bold">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    {{ $error }} <br>
                                @endforeach
                            </ul>
                        </div>
                    @endif
>>>>>>> c7cdff2c3c131fb7cb30d0cf8444de430e967c4b
                </div>
                <div class="col-3 d-flex flex-column justify-content-end pb-1">
                    <button type="submit" class="btn rounded-pill fw-bold px-4 btn-navy fs-5 btn-sm">
                        Calculate
                    </button>
                </div>
<<<<<<< HEAD
            </div>  
        </form> 
    </div>

    {{-- Reservation result fee/date --}}
    <div class="main background-image-parkinglot-reservation-bottom"> 
        <div class="row">
            <div class="col-8 mt-5 mb-5">
                {{-- Reservation result date --}}
                <div class="row">
                    <div class="col-3 h4 color3_bluegray fw-bold text-end">
                        Date
                    </div>
                    <div class="col-5 h4 fw-bold  text-end">
                        26th May <span class= "color2_red ">Sun</span>
                    </div>
                    <div class="col-4 h4 fw-bold">
                        8:00-18:00
                    </div>
                </div>
                {{-- Reservation result fee --}}
                <div class="row mt-1 d-flex align-items-center">
                    <div class="col-3 h4 color3_bluegray fw-bold text-end">
                        Fee
                    </div>
                    <div class="col-5 h1 fw-bold text-end">
                        <i class="fa-solid fa-yen-sign"></i>
                        <span class= "color2_red">&nbsp;&nbsp;1,500</span>
                    </div>
                </div>
            </div>
            <div class="col-3 mt-5 mb-5 d-flex flex-column justify-content-end">
                <button type="submit" class="btn rounded-pill fw-bold px-4 btn-orange fs-5 btn-sm">
                    Reserve
                </button>
            </div>
        </div>
    </div>
</div>
=======
            </div>
        </form>
    </div>

    @if (session('date'))
        {{-- Reservation result fee/date --}}
        <div class="main background-image-parkinglot-reservation-bottom">
            <div class="row">
                <div class="col-8 mt-5 mb-5">
                    {{-- Reservation result date --}}
                    <div class="row">
                        <div class="col-3 h4 color3_bluegray fw-bold text-end">
                            Date
                        </div>
                        <div class="col-5 h4 fw-bold  text-end">
                            {{-- Display in red on weekends --}}
                            {{ date('Y/m/d', strtotime(session('date'))) }}&nbsp;
                            @if ( session('isWeekend') )
                                <span class="color2_red">{{ session('dayOfWeek') }}</span>
                            @else
                                {{ session('dayOfWeek') }}
                            @endif
                        </div>
                        <div class="col-4 h4 fw-bold">
                            {{ session('from_time') }} - {{ session('to_time') }}
                        </div>
                    </div>
                    {{-- Reservation result fee --}}
                    <div class="row mt-1 d-flex align-items-center">
                        <div class="col-3 h4 color3_bluegray fw-bold text-end">
                            Fee
                        </div>
                        <div class="col-5 h1 fw-bold text-end">
                            <i class="fa-solid fa-yen-sign"></i>
                            <span class= "color2_red">&nbsp;&nbsp; {{ session('fee') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-3 mt-5 mb-5 d-flex flex-column justify-content-end">
                    <button type="submit" class="btn rounded-pill fw-bold px-4 btn-orange fs-5 btn-sm" data-bs-toggle="modal" data-bs-target="#reservationCheckModal">
                        Reserve
                    </button>
                    @include('Parking_lots.models.Reservation_check')
                </div>
            </div>
        </div>
    @endif
</div>

>>>>>>> c7cdff2c3c131fb7cb30d0cf8444de430e967c4b
@endsection
