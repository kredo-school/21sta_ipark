@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<div class="container">
    <div class="row row-info">
        <div class="col-md-8 mb-4">
            <div class="h1 text-start page-title">
                <span class="underline">&nbsp;Use</span>r Profile
            </div>
        </div>
    </div>

    <div class="row ms-1 text-center">
        <div class="col-2 tab-active user-info-tab">
            <a
                href="{{route('profile', ['id' => $user->id])}}"
                class="tab-link-active"
            >
                Profile
            </a>
        </div>

        <div class="col-2 tab-inactive user-info-tab">
            <a
                href="{{route('reservation', ['id' => $user->id])}}"
                class="tab-link"
            >
                Reservation
            </a>
        </div>

        <div class="col-2 tab-inactive user-info-tab">
            <a
                href="{{route('favorite', ['id' => $user->id])}}"
                class="tab-link"
            >
                Favorite
            </a>
        </div>
    </div>

    <div class="card profile-card mt-0">
        <div class="card-body profile-card-body text-center">
            <table class="table table-profile table-border text-start">
                <tr class="">
                    <td class="fw-medium">User name</td>
                    <td>{{ $user->username }}</td>
                </tr>

                <tr>
                    <td class="fw-medium">Email</td>
                    <td>{{$user->email }}</td>
                </tr>

                <tr>
                    <td class="fw-medium">Password</td>
                    <td>********</td>
                </tr>

                <tr>
                    <td class="fw-medium">Phone Number</td>
                    <td>{{ $user->phone }}</td>
                </tr>

                <tr>
                    <td class="fw-medium">Car Type</td>
                    <td>
                    @if($user->car_type)
                        {{ $user->car_type }}
                    @endif
                    </td>
                </tr>
            </table>

            <div>
                <a
                    href="{{route('edit_profile', $user->id)}}"
                    class="btn btn-edit btn-orange rounded-pill px-5 mt-4 fw-bold"
                >
                    <i class="fa-solid fa-pen-to-square"></i>&nbsp;Edit Profile
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
