
<div class="container">
    <div class="row justify-content-center">
        <div class="modal fade" id="reviewModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content btn-navy:hover">
                    <div class="modal-body">
                        <form action="#" method="GET">
                            @csrf
                            <div class="header text-center">
                                <div class="row h1">
                                    <i class="fa-solid fa-pen-to-square color4_navy"></i>
                                </div>
                                <div class="row h1">
                                    <div class=" color4_navy mb-1">Write a Review</div>
                                    <hr>
                                </div>
                            </div>
                            <div class="row h3 px-4 mb-3 fw-bold">
                                {{$past_reservation->ParkingPlace->parking_place_name}}
                            </div>
                            <div class="row justify-content-center mb-3">
                                <div class="col">
                                    <div class="h3 color2_red">
                                        {{-- <input type="hidden" name="parking_places_id" value="{{ $parking_places->id }}"> --}}
                                        @for ($i = 1; $i <= 5; $i++)
                                            {{-- @if ($i <= floor($parking_place->average_star)) --}}
                                            <i class="fa-regular fa-star"></i>
                                        @endfor
                                    </div>
                                    <div class="row justify-content-center">
                                        <label for="comment" class="col-form-label h5 col-8 text-start">Comment</label>
                                        <div class="col-8">
                                            <textarea name="comment" id="comment" class="form-control" rows="3" placeholder="Enter your comment here"></textarea>
                                        </div>
                                    </div>
                                </div>
                                

                            </div>
                            <div class="bottom text-center justify-content-center">
                                @csrf
                                <button type="submit" class="btn rounded-pill fw-bold px-4 btn-navy fs-5 btn-sm">
                                    Post
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>