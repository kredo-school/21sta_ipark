@extends('layouts.app')

@section('content')
<div class="col-8">
    {{-- title --}}
    <div class="h1 mt-3 mb-5">
        <span class="underline ms-1">&nbsp;Res</span>ervation form
    </div>

    {{-- Reservation --}}
    <div class="main background-image-parkinglot-reservation-top"> 
        {{-- Parking lot adress --}}
        <div class="row pt-5 px-5">
            <div class="title">
                <div class="h2 color3_bluegray fw-bold">
                    ABC Parking Space
                </div>
                <i class="fa-solid fa-location-dot "></i> 3-22 Arakawa,Arakawa
            </div>
        </div>

        {{-- Reservation form --}}
        <form action="" method="get">
            <div class="row p-3 mb-3">
                <div class="col-8">
                    <div class="form text-center fw-bold">
                        <table 
                            class="table table-background-color-none text-aline-center d-inline"
                        >
                            <tr>
                                <td style="font-family:'Inter'">
                                    <label for="cartype" class = "form-label">Car type</label>
                                </td>
                                <td colspan="3">
                                    <select 
                                        name="cartype" 
                                        id="cartype" 
                                        class ='form-select'
                                    >
                                        <option value="">standard</option>
                                        <option value="">compact</option>
                                        <option value="">large</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family:'Inter'">
                                    <label for="date" class = "form-label">Date</label>
                                </td>
                                <td colspan="3">
                                    <input 
                                        type="date"
                                        class="form-control"
                                        id="date"
                                        name="date"
                                    >
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family:'Inter'">
                                    <label for="from" class = "form-label">From</label>
                                </td>
                                <td>
                                    <select name="hour" id="hour" class="form-select">
                                        <?php    
                                        for ($i = 0; $i < 24; $i++) {
                                        ?>
                                            <option value="{{ $i;}}">
                                                <?php echo $i; ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="text-center fw-bold">:</td>
                                <td>
                                    <select name="minute" id="minute" class="form-select">
                                        <option value="00">00</option>
                                        <option value="30">30</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family:'Inter'">
                                    <label for="to" class = "form-label">To</label>
                                </td>
                                <td style="width: 25%;">
                                    <select name="hour" id="hour" class="form-select">
                                        <?php    
                                        for ($i = 0; $i < 25; $i++) {
                                        ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="text-center fw-bold">:</td>
                                <td style="width: 25%;">
                                    <select name="minute" id="minute" class="form-select">
                                        <option value="00">00</option>
                                        <option value="30">30</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-3 d-flex flex-column justify-content-end pb-1">
                    <button type="submit" class="btn rounded-pill fw-bold px-4 btn-navy fs-5 btn-sm">
                        Calculate
                    </button>
                </div>
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
@endsection
