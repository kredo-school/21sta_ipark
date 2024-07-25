
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Bootstrap Datepicker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

<!-- jQuery (必要であれば読み込み) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Bootstrap Bundle (含む Popper.js) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap Datepicker JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

@extends('layouts.app')

@section('title', 'Reservation Form')

@section('content')
<div class="col-md-8">
    {{-- title --}}
    <div class="page-title h1 mt-3 mb-5">
        <span class="underline ms-1">&nbsp;Res</span>ervation form
    </div>

    {{-- Reservation --}}
    <div class="main background-image-parkinglot-reservation-top">
        {{-- Parking lot adress --}}
        <div class="row pt-5 px-5">
            <div class="title">
                <div class="h2 color3_bluegray fw-bold">
                    {{$parking_places->parking_place_name}}
                </div>
                <i class="fa-solid fa-location-dot "></i>
                {{$parking_places->parking_place_name}} , {{$parking_places->city}}
            </div>
        </div>

        {{-- Reservation form --}}
        <form action="{{ route('reservation.create',$parking_places->id) }}" method="post">
            @csrf
            <input type="hidden" name="parking_places_id" value="{{ $parking_places->id }}">
            <div class="row p-3 mb-3">
                <div class="col-lg-8">
                    <div class="form text-center fw-bold">
                        <table
                            class="table 
                                    table-background-color-none
                                    text-aline-center
                                    d-inline
                                    reserve-table"
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
                                        value="{{ old('cartype') }}"
                                    >
                                        <option value="Standard">Standard</option>
                                        <option value="Compact">Compact</option>
                                        <option value="Large">Large</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family:'Inter'">
                                    <label for="date" class = "form-label">Date</label>
                                </td>
                                <td colspan="3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="datepicker"
                                        name="date"
                                        value="{{ old('date') }}"
                                    >
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family:'Inter'">
                                    <label for="from" class = "form-label">From</label>
                                </td>
                                <td class="col-4">
                                    <select name="from_hour" id="from_hour" class="form-select" value="{{ old('from_hour') }}">
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
                                </td>
                                <td class="text-center fw-bold col-2">:</td>
                                <td class="col-4">
                                    <select name="from_minute" id="from_minute" class="form-select" value="{{ old('date') }}">
                                        <option value="00" {{ old('from_minute') == '00' ? 'selected' : '' }}>00</option>
                                        <option value="30" {{ old('from_minute') == '30' ? 'selected' : '' }}>30</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family:'Inter'">
                                    <label for="to" class = "form-label">To</label>
                                </td>
                                <td style="width: 25%;">
                                    <select name="to_hour" id="to_hour" class="form-select">
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
                                </td>
                                <td class="text-center fw-bold">:</td>
                                <td style="width: 25%;">
                                    <select name="to_minute" id="to_minute" class="form-select">
                                        <option value="00" {{ old('to_minute') == '00' ? 'selected' : '' }}>00</option>
                                        <option value="30" {{ old('to_minute') == '30' ? 'selected' : '' }}>30</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                    @if ($errors->any())
                        <div class="alert text-center color2_red fw-bold">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    {{ $error }} <br>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col-lg-3 d-flex flex-column justify-content-end pb-1">
                    <button type="submit" class="btn ad-btn rounded-pill fw-bold px-4 btn-navy fs-5 btn-sm">
                        Calculate
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if (session('date'))
        {{-- Reservation result fee/date --}}
        <div class="main background-image-parkinglot-reservation-bottom">
            <div class="row">
                <div class="col-md-8 mt-5 mb-1">
                    {{-- Reservation result date --}}
                    <div class="row">
                        <div class="col-md-3 h4 color3_bluegray fw-bold text-end">
                            Date
                        </div>
                        <div class="col-md-9 h4 fw-bold  text-end">
                            {{-- Display in red on weekends --}}
                            {{ date('Y/m/d', strtotime(session('date'))) }}&nbsp;
                            @if ( session('isWeekend') )
                                <span class="color2_red">{{ session('dayOfWeek') }}</span>
                            @else
                                {{ session('dayOfWeek') }}
                            @endif
                            {{ session('from_time') }} - {{ session('to_time') }}
                        </div>
                    </div>
                    {{-- Reservation result fee --}}
                    <div class="row mt-1 d-flex align-items-center">
                        <div class="col-md-3 h4 color3_bluegray fw-bold text-end">
                            Fee
                        </div>
                        <div class="col-md-9 h1 fw-bold text-end">
                            <i class="fa-solid fa-yen-sign"></i>
                            <span class= "color2_red">&nbsp;&nbsp; {{ session('fee') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3  mb-3 d-flex flex-column justify-content-end">
                    @auth {{-- ユーザーがログインしている場合 --}}
                        <button type="submit" class="btn ad-btn rounded-pill fw-bold px-4 btn-orange fs-5 btn-sm" data-bs-toggle="modal" data-bs-target="#reservationCheckModal">
                            Reserve
                        </button>
                        @include('Parking_lots.modals.Reservation_check')
                    @else {{-- ユーザーがログインしていない場合 --}}
                        <form action="{{ route('login') }}" method="GET">
                            <button type="submit" class="btn ad-btn rounded-pill fw-bold px-4 btn-orange fs-5 btn-sm">
                                Reserve
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    @endif
</div>

@endsection

<script>
    $(document).ready(function() {
        // Datepickerの初期化
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd', // 日付のフォーマット
            todayHighlight: true, // 今日の日付を強調表示
            autoclose: true, // 日付が選択されたら自動で閉じる
            startDate: new Date(), // 選択可能な最小の日付を今日に設定
        }).on('changeDate', function(selected) {
            var currentDate = new Date();
            var selectedDate = new Date(selected.date);

            // 選択された日付が今日と同じ場合
            if (selectedDate.setHours(0,0,0,0) === currentDate.setHours(0,0,0,0)) {
                var currentHour = currentDate.getHours();
                $('#from_hour option').each(function() {
                    if ($(this).val() < currentHour) {
                        $(this).prop('disabled', true);
                    } else {
                        $(this).prop('disabled', false);
                    }
                });
            } else {
                // 選択された日付が今日でない場合、全てのオプションを有効にする
                $('#from_hour option').prop('disabled', false);
            }
        });

        // 初期状態ではFROMの時間を現在の時間以降に制限する
        var currentHour = new Date().getHours();
        $('#from_hour option').each(function() {
            if ($(this).val() < currentHour) {
                $(this).prop('disabled', true);
            }
        });
    });
    </script>

<script>
    $('form').submit(function(){
        $('button[type=submit]').prop('disabled', true);
    });

</script>
