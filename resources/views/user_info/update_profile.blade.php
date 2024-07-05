@extends('layouts.app')

@section('title', 'Update Profile')

@section('content')
    <div class="h1">
        <span class="underline ms-1">&nbsp;Upd</span>ate Profile
    </div>
    <div class="row justify-content-center my-4">
        <div class="col-8 bg-white border border-2 border-orange rounded-4">
            <form action="" method="post">
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
                                    name="name"
                                    id="name"
                                    class="form-control"
                                    value=""
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
                                    value=""
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
                                    value=""
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
                                <input
                                    type="text"
                                    name="car_type"
                                    id="car_type"
                                    class="form-control"
                                    value=""
                                >
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
            <form action="" method="post">
                <div class="row">
                    <h3 class="fw-bold mt-3 ms-5">
                        Password
                    </h3>
                </div>
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
                                    class="form-control"
                                    value=""
                                >
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
                                    class="form-control"
                                    value=""
                                >
                            </div>
                        </div>
                        <div class="row d-flex align-items-center mt-3">
                            <div class="col-4">
                                <label for="confirm_password" class="h5 form-label">
                                    Confirm Password
                                </label>
                            </div>
                            <div class="col-8">
                                <input
                                    type="password"
                                    name="confirm_password"
                                    id="confirm_password"
                                    class="form-control"
                                    value=""
                                >
                            </div>
                        </div>
                        <button
                            type="submit"
                            class="btn btn-orange float-end fw-bold rounded-pill px-5 mt-4 mb-5"
                        >
                            Update Password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-center mt-4 mb-5">
        <div class="col-8 bg-white border border-2 border-red rounded-4">
            <form action="" method="post">
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
                        <button
                            type="submit"
                            class="btn btn-red-opposite float-end fw-bold rounded-pill px-5 mb-4"
                        >
                            Delete Account
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
