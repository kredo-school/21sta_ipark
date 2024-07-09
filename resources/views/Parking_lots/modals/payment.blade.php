<div class="container">
    <div class="row justify-content-center">
        <div class="modal fade" id="paymentModal" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-green">
                    <div class="modal-body">
                        <div class="header text-center">
                            <div class="row h1">
                                <i class="fa-solid fa-circle-check color5_green"></i>
                            </div>
                            <div class="row h1">
                                <div class="col">Reservation Success</div>
                            </div>
                        </div>
                        <div class="row justify-content-center mb-3">
                            <div class="col text-center mt-3">
                                Thank you for your reservation. <br>
                                You can check it from Reservation History.
                            </div>
                            <div class="bottom text-center justify-content-center">
                                <a href="{{ route('reservation',auth()->id()) }}" class="btn rounded-pill fw-bold px-4 btn-green fs-5 btn-sm mt-3">Go to History Page</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>