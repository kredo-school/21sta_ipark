@extends('layouts.app')

@section('title', 'Parking List')

@section('content')
    <h1 class="mt-5 fw-bold text-center display-5">Parking spaces in {{ $search }}</h1>
    <div class="row mt-5">
        @forelse ($parking_places as $parking_place)
            <div class="col-4">
                <div class="card mb-4 shadow-sm">
                    <img src="{{ asset('images/parking_space_image.jpg') }}" class="card-img-top" alt="{{ $parking_place->parking_place_name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $parking_place->parking_place_name }}</h5>
                        <p class="card-text"><i class="fa-solid fa-location-dot"></i> {{ $parking_place->city }}</p>
                        <p class="card-text">Price: ¥{{ $parking_place->price }}</p>
                        <p class="card-text">
                            {{ $parking_place->daytime_from }} - {{ $parking_place->daytime_to }}
                        </p>
                        <a href="{{ route('showParkingDetail', ['id' => $parking_place->id]) }}" class="btn btn-primary">Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">No parking spaces found in {{ $search }}.</p>
            </div>
        @endforelse
    </div>
@endsection
