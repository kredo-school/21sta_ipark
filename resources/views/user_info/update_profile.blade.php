@extends('layouts.app')

@section('title', 'Update Profile')

@section('content')
    <div class="col">
        <a
            href="{{route('profile', $user->id)}}"
            class="btn btn-red fw-bold rounded-pill btn-sm"
        >
            <i class="fa-solid fa-angles-left"></i>
            Back to profile page
        </a>
    </div>
    <div class="h1 mt-3">
        <span class="underline ms-1">&nbsp;Upd</span>ate Profile
    </div>
    <div class="row justify-content-center my-4">
        <div class="col-8 bg-white border border-2 border-orange rounded-4">
            {{-- update profile --}}
            <form action="{{route('update_profile', $user->id)}}" method="post">
                @csrf
                @method('PATCH')
                <div class="row">
                    <h3 class="fw-bold mt-5 ms-5">
                        Profile
                    </h3>
                </div>
                <div class="row mt-3 px-5 justify-content-center">
                    <div class="col-10">
                        <div class="row d-flex align-items-center">
                            <div class="col-4">
                                <label for="username" class="h5 form-label">
                                    Username
                                    <span class="text-danger">*</span>
                                </label>
                            </div>
                            <div class="col-8">
                                <input
                                    type="text"
                                    name="username"
                                    id="username"
                                    class="form-control"
                                    value="{{$user->username}}"
                                >
                            </div>
                        </div>
                        <div class="row d-flex align-items-center mt-3">
                            <div class="col-4">
                                <label for="email" class="h5 form-label">
                                    Email
                                    <span class="text-danger">*</span>
                                </label>
                            </div>
                            <div class="col-8">
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    class="form-control"
                                    value="{{$user->email}}"
                                >
                            </div>
                        </div>
                        <div class="row d-flex align-items-center mt-3">
                            <div class="col-4">
                                <label for="phone" class="h5 form-label">
                                    Phone Number
                                    <span class="text-danger">*</span>
                                </label>
                            </div>
                            <div class="col-8">
                                <input
                                    type="text"
                                    name="phone"
                                    id="phone"
                                    class="form-control"
                                    value="{{$user->phone}}"
                                >
                            </div>
                        </div>
                        <div class="row d-flex align-items-center mt-3">
                            <div class="col-4">
                                <label for="car_type" class="h5 form-label">
                                    Car Type
                                </label>
                            </div>
                            <div class="col-8">
                                <select id="car_type" name="car_type" class="form-control">
                                    <option value="{{$user->car_type}}" hidden>{{$user->car_type}}</option>
                                    <option value="Standard">Standard</option>
                                    <option value="Compact">Compact</option>
                                    <option value="Large">Large</option>
                                </select>
                            </div>
                        </div>
                        <button
                            type="submit"
                            class="btn btn-orange float-end fw-bold rounded-pill px-5 mt-4 mb-3"
                        >
                            Save
                        </button>
                    </div>
                </div>
                <hr class="mt-3">
            </form>

            {{-- update password --}}
            <form action="{{route('update_password', $user->id)}}" method="post">
                @csrf
                @method('PATCH')
                <div class="row">
                    <h3 class="fw-bold mt-3 ms-5">
                        Password
                    </h3>
                </div>
                @if (session('success_message'))
                    <h5 class="text-success text-center mb-3">{{ session('success_message') }}</h5>
                @endif
                <div class="row mt-3 px-5 justify-content-center">
                    <div class="col-10">
                        <div class="row d-flex align-items-center">
                            <div class="col-4">
                                <label for="old_password" class="h5 form-label">
                                    Old Password
                                </label>
                            </div>
                            <div class="col-8">
                                <input
                                    type="password"
                                    name="old_password"
                                    id="old_password"
                                    class="form-control @error('old_password') is-invalid @enderror"
                                >
                                @error('old_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row d-flex align-items-center mt-3">
                            <div class="col-4">
                                <label for="new_password" class="h5 form-label">
                                    New Password
                                </label>
                            </div>
                            <div class="col-8">
                                <input
                                    type="password"
                                    name="new_password"
                                    id="new_password"
                                    class="form-control @error('new_password') is-invalid @enderror"
                                >
                                @if(session('same_password_error'))
                                    <p class="mb-0 text-danger small">{{ session('same_password_error') }}</p>
                                @endif
                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row d-flex align-items-center mt-3">
                            <div class="col-4">
                                <label for="new_password_confirmation" class="h5 form-label">
                                    Confirm Password
                                </label>
                            </div>
                            <div class="col-8">
                                <input
                                    type="password"
                                    name="new_password_confirmation"
                                    id="new_password_confirmation"
                                    class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                >
                                @error('new_password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button
                            type="submit"
                            class="btn btn-orange float-end fw-bold rounded-pill px-5 mt-4 mb-5"
                        >
                            Update Password
                        </button>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- delete account --}}
    <div class="row justify-content-center mt-4 mb-5">
        <div class="col-8 bg-white border border-2 border-red rounded-4">
            <div class="row">
                <h3 class="fw-bold mt-4 ms-5">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    Delete Account
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </h3>
            </div>
            <div class="row mt-3 px-5 justify-content-center">
                <div class="col-10">
                    <p class="h5">
                        Deleting your account will result in removing all the data on your iPark account from our services.
                    </p>
                    <a
                        type="button"
                        class="btn btn-red-opposite float-end fw-bold rounded-pill px-5 mb-4"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteAccount"
                    >
                        Delete Account
                    </a>
                </div>
            </div>
        </div>

        {{-- modal --}}
        <div
            class="modal fade border border-2 border-red modal-deleteAccount"
            id="deleteAccount"
            tabindex="-1"
            data-bs-backdrop="static"
            data-bs-keyboard="false"

            role="dialog"
            aria-labelledby="modalTitleId"
            aria-hidden="true"
        >
            <div
                class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                role="document"
            >
                <div class="modal-content">
                    <div class="modal-header">
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <h1 class="fw-bold">Are you sure?</h1>
                        <br>
                        <p>
                            Do you really want to delete your account?<br>
                            This action cannot be undone.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-red rounded-pill fw-bold me-5 px-5"
                            data-bs-dismiss="modal"
                        >
                            Cancel
                        </button>
                        <form action="{{route('delete_profile', $user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="btn btn-red-opposite rounded-pill fw-bold px-3"
                            >
                                Delete Account
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
