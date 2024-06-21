@extends('layouts.app')

@section('title', 'Register')

@section('content')
<style>
.card{
    color: #403734; 
    background-color: #ff99002a;
    border-radius: 30px;
}

.btn-r{
    background-color: #ff9900;
    color: white;
}

.btn-r:hover {
    background-color: #cc7a00;
    color: white;
}

.register_img{
    max-width: 600px;
    height: 600px;
}

.pic-icon {
    position: relative;
    width: 100%;
}

.form-element {
    padding: .5rem .5rem .5rem 2rem;
    width: 100%;
}

.form-element+i {
    position: absolute;
    top: 50%;
    left: .5rem;
    transform: translateY(-50%);
    content: '';
    transition: .3s;
}

.form-element:focus+i {
    color: #FF9900;
}

</style>
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 ms-6 mt-5"> 
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="fs-1 fw-bold ms-4" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);"><span class="underline">&nbsp;Cre</span>ate your account</div>

                            <div class="row mb-3 mt-5">
                                <div class="col-md ms-4">
                                   <div class="pic-icon">
                                        <input id="username" type="text" class="form-control form-element @error('username') is-invalid @enderror name-icon" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="User Name *">
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
                                        <input id="email" type="email" class="form-control form-element @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email *">
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
                                        <input id="password" type="password" class="form-control form-element @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password *">
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
                                        <input id="password-confirm" type="password" class="form-control form-element" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password *">
                                        <i class="fa-solid fa-lock"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md ms-4">
                                    <div class="pic-icon">
                                        <input id="phone" type="tel" class="form-control form-element @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="tel" placeholder="Phone Number *">
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
                                        <option value="null" disabled selected><i class="fa-solid fa-car"></i>Please select your car type</option>
                                        <option value="standard">Standard</option>
                                        <option value="compact">Compact</option>
                                        <option value="large">Large</option>
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
                                    <button type="submit" class="btn btn-r w-100">
                                        {{ __('Register') }}
                                    </button>
                                    <p class="text-center mt-2">Already have an account? <span><a href="{{ route('login') }}" style="color: #F54B31">Login here</a></span></p>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    
                    <div class="col-md-6">
                        <img src="{{asset('images/view-3d-car-with-city__1_-removebg-previewのコピー.png')}}" alt="register" class="register_img ms-5 m-auto" style="max-width: 100%;">
                    </div>
                </div>
            </div>     
        </div>
        
    </div>
</div>
@endsection

