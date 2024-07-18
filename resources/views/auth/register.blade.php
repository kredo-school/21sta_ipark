@extends('layouts.app')

<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@section('title', 'Register')

@section('content')
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="card card-register shadow">
                <div class="card-body-register">
                    <div class="row">
                        <div class="col-md-6 ms-6 mt-5">
                            <form id="registerForm">
                                @csrf
                                <div
                                    class="fs-1 fw-bold ms-4"
                                    style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);"
                                >
                                    <span class="underline">&nbsp;Cre</span>ate your account
                                </div>

                                <div class="row mb-3 mt-5">
                                    <div class="col-md ms-4">
                                        <div class="pic-icon">
                                            <input
                                                id="username"
                                                type="text"
                                                class="form-control form-element @error('username') is-invalid @enderror name-icon"
                                                name="username"
                                                value="{{ old('username') }}"
                                                required autocomplete="username"
                                                autofocus placeholder="User Name *"
                                            >
                                            <i class="fas fa-user"></i>
                                        </div>

                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md ms-4">
                                        <div class="pic-icon">
                                            <input
                                                id="email"
                                                type="email"
                                                class="form-control form-element @error('email') is-invalid @enderror"
                                                name="email"
                                                value="{{ old('email') }}"
                                                required autocomplete="email"
                                                placeholder="Email *"
                                            >
                                            <i class="fa-solid fa-envelope"></i>
                                        </div>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md ms-4">
                                        <div class="pic-icon">
                                            <input
                                                id="password"
                                                type="password"
                                                class="form-control form-element @error('password') is-invalid @enderror"
                                                name="password"
                                                required autocomplete="new-password"
                                                placeholder="Password *"
                                            >
                                            <i class="fa-solid fa-lock"></i>
                                        </div>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md ms-4">
                                        <div class="pic-icon">
                                            <input
                                                id="password-confirm"
                                                type="password"
                                                class="form-control form-element"
                                                name="password_confirmation"
                                                required autocomplete="new-password"
                                                placeholder="Confirm Password *"
                                            >
                                            <i class="fa-solid fa-lock"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md ms-4">
                                        <div class="pic-icon">
                                            <input
                                                id="phone"
                                                type="tel"
                                                class="form-control form-element @error('phone') is-invalid @enderror"
                                                name="phone"
                                                value="{{ old('phone') }}"
                                                required autocomplete="tel"
                                                placeholder="Phone Number *"
                                            >
                                            <i class="fa-solid fa-phone"></i>
                                        </div>

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">

                                    <div class="col-md ms-4">
                                        <select id="car_type" name="car_type" class="form-control">
                                            <option value="" hidden>
                                                <i class="fa-solid fa-car"></i>Please select your car type *
                                            </option>
                                            <option value="standard">Standard</option>
                                            <option value="compact">Compact</option>
                                            <option value="large">Large</option>
                                            <option value="na">No answer</option>
                                        </select>

                                        @error('car_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>


                                <div class="row mb-0">
                                    <div class="col-md ms-4">
                                        <button type="button" id="registerButton" class="btn btn-r w-100">
                                            {{ __('Register') }}
                                        </button>
                                        <p class="text-center mt-2">Already have an account?
                                            <span>
                                                <a href="{{ route('login') }}" style="color: #F54B31">
                                                    Login here
                                                </a>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-6">
                            <img
                                src="{{asset('images/view-3d-car-with-city__1_-removebg-previewのコピー.png')}}"
                                alt="register"
                                class="register_img ms-5 m-auto"
                                style="max-width: 100%;"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div
        class="modal fade custom-modal"
        id="successModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <i class="fa fa-check-circle"></i>
                <h1 style="font-weight: bold;">Success</h1>
                <br>
                <p>Congratulations, your account has been successfully created.</p>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    id="continueButton"
                    class="btn"
                >
                    Continue
                </button>
            </div>
        </div>
        </div>
    </div>

    <script>
        document.getElementById('registerButton').addEventListener('click', function() {
            const form = document.getElementById('registerForm');
            const formData = new FormData(form);

            fetch('{{ route('register') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': formData.get('_token')
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        throw err;
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.errors) {
                    // Handle validation errors
                    console.log(data.errors);
                    // Display errors to the user (e.g., append error messages to the form fields)
                } else {
                    // Show success modal
                    $('#successModal').modal('show');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Display server errors (e.g., show them in a specific div)
            });
        });

        document.getElementById('continueButton').addEventListener('click', function() {
            window.location.href = '{{ url('/') }}';
        });
    </script>
@endsection

