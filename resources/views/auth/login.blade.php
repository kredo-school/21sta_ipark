@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12 py-5 text-center">
            <div class="card card-login p-5 shadow">
                <div class="card-body card-body-login">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <img src="{{asset('images/iPark_logo_ss.png')}}" alt="logo" class="ipark-logo mb-3">
                        <h2 class="fw-bold">Welcome Back</h2>
                        <p>Please login to your account</p>

                    
                        <div class="mb-4">
                            <input id="email" type="email" class="form-control shadow @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <input id="password" type="password" class="form-control shadow @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        
                        <div class="mb-3">
                            <button type="submit" class="btn btn-orange w-100 shadow">
                                {{ __('Sign in') }}
                            </button>
                        </div>

                        @if (Route::has('password.request'))
                            <div>
                                <a href="{{ route('password.request') }}" style="color: #403734;">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        @endif

                        <div>
                            <p>Don't have an account yet? <span><a href="{{ route('register') }}" style="color: #F54B31">Create an account</a></span></p>
                        </div>
                        
                        
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <img src="{{asset('images/login-removebg-preview.png')}}" alt="login-img" class="ms-5 my-5 login-img">
        </div>
    </div>
</div>
@endsection
