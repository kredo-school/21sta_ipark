@extends('layouts.app')

@section('title', 'About Us')

@section('content')

    <div class="container">
        <div class="col-md-8 my-4">
            <div class="h1 text-start"><span class="underline">&nbsp;Abo</span>ut Us</div>
        </div>

        <div class="row justify-content-center">
            <div class="card card-aboutus text-center mt-2">
                <div class="card-body text-center">
                    <h3 class="overview_aboutus">Company Overview</h3>
                    <hr class="custom-hr-a">

                   <table class="aboutus-table mt-4">
                        <tbody>
                            <tr>
                                <td class="fw-bold">Company Name</td>
                                <td>iPark Co.,Ltd.</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Location</td>
                                <td>1-2-3 Nihonbashi, Chuo City, Tokyo, 103-0027</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Contact</td>
                                <td>03-1234-5678</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Established</td>
                                <td>May,2024</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <h3 class="text-center mt-5 overview_aboutus">What you can do with iPark</h3>
            <hr class="custom-hr-a">
            
            <div class="table-aboutus-img my-4">
                <div class="aboutus-container">
                    <div class="aboutus-img-group">
                        <img class="img-aboutus" src="{{asset('images/search_parking_space.png')}}" alt="">
                        <p><span class="text-danger"><strong>Find parking spaces</strong></span> whenever you want</p>
                    </div>
                    <div class="aboutus-img-group">
                        <img class="img-aboutus" src="{{asset('images/booking.png')}}" alt="">
                        <p><span class="text-danger"><strong> Reserve</strong></span> parking slot in advance</p>
                    </div>
                    <div class="aboutus-img-group">
                        <img class="img-aboutus" src="{{asset('images/payment.png')}}" alt="">
                        <p><span class="text-danger"><strong>Pay in advance</strong></span> for your reservation</p>
                    </div>
                    <div class="aboutus-img-group">
                        <img class="img-aboutus" src="{{asset('images/register.png')}}" alt="">
                        <p>Register your account for <span class="text-danger"><strong> FREE</strong></span></p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

@endsection