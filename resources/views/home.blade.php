@extends('layouts.app')
<link rel="stylesheet" href="{{asset('css/style.css')}}">

@section('content')
    <div class="row">
        <div class="col-7">
            <h1 class="mt-5 fw-bold text-center display-5 text-shadow">
                You can <span class="color2_red">FIND and RESERVE</span><br>parking spaces soon!
            </h1>
            <div class="row mt-5 mx-5">
                <div class="col-8 d-flex align-items-center color3_bluegray">
                    <span class="h2 me-2"><i class="fa-solid fa-car"></i></span>
                    <p class="fw-bold mb-2 h5">
                        more than 100k parking spaces
                    </p>
                </div>
                <div class="col-4 d-flex align-items-center color3_bluegray">
                    <span class="h2 me-2"><i class="fa-brands fa-creative-commons-nc-jp"></i></span>
                    <p class="fw-bold mb-2 h5">
                        free to register
                    </p>
                </div>
            </div>
            <div class="row mt-4"></div>
            <div class="row mt-5 justify-content-center">
                <div class="col-7">
                    <form action="" method="get">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text rounded-pill rounded-end"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <input type="text" name="search" placeholder="Search by place name" class="form-control rounded-pill rounded-start">
                        </div>
                        <div class="text-center mt-4">
                            <a href="" class="btn rounded-pill fw-bold px-4 btn-navy fs-5 btn-sm">Show parking spaces</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-5">
            <img src="{{asset('images/Parking-illustration.png')}}" alt="main_img" class="img-fluid">
        </div>
    </div>

    {{-- Recommendation --}}
    <div class="h1 fw-bold mt-5"><span class="underline ms-1">&nbsp;Rec</span>ommendation</div>
    <div class="row mt-4">
        <div class="col-4">
            <div class="row">
                <div class="col bg-white p-4 shadow m-3">
                    <div class="row">
                        <div class="col-10">
                            <h3>Parking space1</h3>
                        </div>
                        <div class="col-2 text-end h2">
                            <i class="fa-regular fa-heart"></i>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <img src="{{asset('images/parking_space_image.jpg')}}" alt="parking_space1" style="height:200px">
                    </div>
                    <div class="row mt-3">
                        <div class="h4 color2_red">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <h4>
                            <i class="fa-solid fa-location-dot"></i>&nbsp;
                            Minato city
                        </h4>
                    </div>
                    <div class="row mt-2">
                        <h4>Price</h4>
                    </div>
                    <div class="row px-2">
                        <div class="row h5 d-flex align-items-center">
                            <div class="col">
                                <i class="fa-regular fa-clock"></i>
                                8:00-22:00
                            </div>
                            <div class="col d-flex align-items-center">
                                <span class="color2_red h3 fw-bold me-1 mb-0">¥400</span>
                                <span>/30mins</span>
                            </div>
                        </div>
                        <div class="row h5 d-flex align-items-center">
                            <div class="col">
                                <i class="fa-regular fa-clock"></i>
                                22:00-8:00
                            </div>
                            <div class="col d-flex align-items-center">
                                <span class="color2_red h3 fw-bold me-1 mb-0">¥100</span>
                                <span>/30mins</span>
                            </div>
                        </div>
                        <div class="row h5 mt-1">
                            <div class="col">
                                MAX: ¥1500 /24h
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="" class="btn rounded-pill px-5 btn-orange fw-bold fs-5">Reserve now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="row">
                <div class="col bg-white p-4 shadow m-3">
                    <div class="row">
                        <div class="col-10">
                            <h3>Parking space1</h3>
                        </div>
                        <div class="col-2 text-end h2">
                            <i class="fa-regular fa-heart"></i>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <img src="{{asset('images/parking_space_image.jpg')}}" alt="parking_space1" style="height:200px">
                    </div>
                    <div class="row mt-3">
                        <div class="h4 color2_red">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <h4>
                            <i class="fa-solid fa-location-dot"></i>&nbsp;
                            Minato city
                        </h4>
                    </div>
                    <div class="row mt-2">
                        <h4>Price</h4>
                    </div>
                    <div class="row px-2">
                        <div class="row h5 d-flex align-items-center">
                            <div class="col">
                                <i class="fa-regular fa-clock"></i>
                                8:00-22:00
                            </div>
                            <div class="col d-flex align-items-center">
                                <span class="color2_red h3 fw-bold me-1 mb-0">¥400</span>
                                <span>/30mins</span>
                            </div>
                        </div>
                        <div class="row h5 d-flex align-items-center">
                            <div class="col">
                                <i class="fa-regular fa-clock"></i>
                                22:00-8:00
                            </div>
                            <div class="col d-flex align-items-center">
                                <span class="color2_red h3 fw-bold me-1 mb-0">¥100</span>
                                <span>/30mins</span>
                            </div>
                        </div>
                        <div class="row h5 mt-1">
                            <div class="col">
                                MAX: ¥1500 /24h
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="" class="btn rounded-pill px-5 btn-orange fw-bold fs-5">Reserve now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="row">
                <div class="col bg-white p-4 shadow m-3">
                    <div class="row">
                        <div class="col-10">
                            <h3>Parking space1</h3>
                        </div>
                        <div class="col-2 text-end h2">
                            <i class="fa-regular fa-heart"></i>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <img src="{{asset('images/parking_space_image.jpg')}}" alt="parking_space1" style="height:200px">
                    </div>
                    <div class="row mt-3">
                        <div class="h4 color2_red">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <h4>
                            <i class="fa-solid fa-location-dot"></i>&nbsp;
                            Minato city
                        </h4>
                    </div>
                    <div class="row mt-2">
                        <h4>Price</h4>
                    </div>
                    <div class="row px-2">
                        <div class="row h5 d-flex align-items-center">
                            <div class="col">
                                <i class="fa-regular fa-clock"></i>
                                8:00-22:00
                            </div>
                            <div class="col d-flex align-items-center">
                                <span class="color2_red h3 fw-bold me-1 mb-0">¥400</span>
                                <span>/30mins</span>
                            </div>
                        </div>
                        <div class="row h5 d-flex align-items-center">
                            <div class="col">
                                <i class="fa-regular fa-clock"></i>
                                22:00-8:00
                            </div>
                            <div class="col d-flex align-items-center">
                                <span class="color2_red h3 fw-bold me-1 mb-0">¥100</span>
                                <span>/30mins</span>
                            </div>
                        </div>
                        <div class="row h5 mt-1">
                            <div class="col">
                                MAX: ¥1500 /24h
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="" class="btn rounded-pill px-5 btn-orange fw-bold fs-5">Reserve now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="" class="mt-4 text-end me-5 h3 text-decoration-none">
        View more
        <i class="fa-solid fa-angles-right"></i>
    </a>
@endsection
