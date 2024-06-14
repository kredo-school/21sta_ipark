@extends('layouts.app')

@section('content')
    <div class="col">
        <a href="" class="btn btn-red fw-bold rounded-pill btn-sm">
            <i class="fa-solid fa-angles-left"></i>
            Back to previous page
        </a>
    </div>
    <div class="row mt-4">
        <div class="col d-flex align-items-center">
            <div class="h1 fw-bold me-5">
                Parking space1
            </div>
            <div class="h4 color2_red">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-regular fa-star"></i>
            </div>
        </div>
        <div class="col h2 d-flex align-items-center justify-content-end">
            <i class="fa-regular fa-heart me-3"></i>
            <a
                href=""
                class="btn rounded-pill px-5 btn-orange fw-bold fs-5"
            >
                Reserve now
            </a>
        </div>
    </div>
    <div class="row my-4 px-5">
        <div class="col-6 px-5">
            <img
                class="w-100"
                {{-- src="{{$parking_place->image}}" --}}
                src="{{asset('images/parking_space_image.jpg')}}"
            >

            <h2 class="color3_bluegray mt-5 fw-bold">
                <i class="fa-solid fa-coins"></i>&nbsp; Price
            </h2>
            <div class="row bg-orange p-4 rounded-5 mt-3 mx-3">
                {{-- Weekday --}}
                <h3 class="color1_orange fw-bold border-bottom border-3 border-orange pb-2">Weekday</h3>
                <div class="row mt-3 h4 d-flex align-items-center">
                    <div class="col ms-3">
                        <i class="fa-regular fa-clock"></i> 8:00-22:00
                    </div>
                    <div class="col">
                        <span class="color2_red h3 fw-bold">¥400</span> /30mins
                    </div>
                </div>
                <div class="row h4 d-flex align-items-center">
                    <div class="col ms-3">
                        <i class="fa-regular fa-clock"></i> 22:00-8:00
                    </div>
                    <div class="col">
                        <span class="color2_red h3 fw-bold">¥100</span> /30mins
                    </div>
                </div>
                {{-- Holiday --}}
                <h3 class="mt-4 color1_orange fw-bold border-bottom border-3 border-orange pb-2">Holiday</h3>
                <div class="row mt-3 h4 d-flex align-items-center">
                    <div class="col ms-3">
                        <i class="fa-regular fa-clock"></i> 8:00-22:00
                    </div>
                    <div class="col">
                        <span class="color2_red h3 fw-bold">¥400</span> /30mins
                    </div>
                </div>
                <div class="row h4 d-flex align-items-center">
                    <div class="col ms-3">
                        <i class="fa-regular fa-clock"></i> 22:00-8:00
                    </div>
                    <div class="col">
                        <span class="color2_red h3 fw-bold">¥100</span> /30mins
                    </div>
                </div>
                {{-- Max --}}
                <h3 class="mt-4 color1_orange fw-bold border-bottom border-3 border-orange pb-2">Weekday</h3>
                <div class="row mt-3 h4 d-flex align-items-center">
                    <div class="col ms-3">
                        <span class="color2_red h3 fw-bold">¥1500</span> /24h
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 px-5">
            <h2 class="color3_bluegray my-3 fw-bold">
                <i class="fa-solid fa-location-dot"></i>&nbsp; Address
            </h2>
            <div class="h4 ms-3">
                3-22 Arakawa, Arakawa, 116-0002
            </div>

            <h2 class="color3_bluegray my-3 fw-bold mt-5">
                <i class="fa-solid fa-car"></i>&nbsp; Number of slots
            </h2>
            <div class="h4 ms-3">
                45 (<span class="color2_red h3 fw-bold">3</span> slots left)
            </div>

            <h2 class="color3_bluegray my-3 fw-bold mt-5">
                <i class="fa-solid fa-phone"></i>&nbsp; Contact
            </h2>
            <div class="h4 ms-3">
                090-0000-0000
            </div>

            <div class="reviews">
                <h2 class="color3_bluegray my-3 fw-bold mt-5">
                    <i class="fa-regular fa-comment-dots"></i>&nbsp; Reviews (4)
                </h2>
                <div class="row ms-3 d-flex align-items-center">
                    <div class="col-8 d-flex align-items-center">
                        <div class="h4 fw-bold me-4">Username</div>
                        <div class="color2_red h5">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                    <div class="col text-end h6">2024/06/13</div>
                </div>
                <div class="ms-5">
                    Comment Comment Comment Comment Comment Comment Comment Comment
                </div>
                <hr class="mx-4">
                <div class="row ms-3 d-flex align-items-center">
                    <div class="col-8 d-flex align-items-center">
                        <div class="h4 fw-bold me-4">Username</div>
                        <div class="color2_red h5">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                    <div class="col text-end h6">2024/06/13</div>
                </div>
                <div class="ms-5">
                    Comment Comment Comment Comment Comment Comment Comment Comment
                </div>
                <hr class="mx-4">
                <div class="row ms-3 d-flex align-items-center">
                    <div class="col-8 d-flex align-items-center">
                        <div class="h4 fw-bold me-4">Username</div>
                        <div class="color2_red h5">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                    <div class="col text-end h6">2024/06/13</div>
                </div>
                <div class="ms-5">
                    Comment Comment Comment Comment Comment Comment Comment Comment
                </div>
                <hr class="mx-4">
                <div class="row text-center h5">
                    <a href="" class="text-primary text-decoration-none">View more...</a>
                </div>
            </div>
        </div>
    </div>
@endsection
