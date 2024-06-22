<style>
    .table-condensed th,
    .table-condensed td {
        padding: 2px 4px;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="modal fade" id="reservationCheckModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-orange">
                    <div class="modal-body">
                        <div class="header text-center">
                            <div class="row h1">
                                <i class="fa-solid fa-circle-exclamation color1_orange"></i>
                            </div>
                            <div class="row h1">
                                <div class=" color1_orange">Please check below</div>
                            </div>
                            <div class="row">
                                <p class="color2_red">*Reservation has not completed yet</p>
                                <hr>
                            </div>
                        </div>
                        <div class="row justify-content-center mb-3">
                            <div class="col">
                                <table class="table user-info mx-auto table-condensed table-borderless"> <!-- mx-auto を追加 -->
                                    <tr>
                                        <th>Name</th>
                                        <td>Nekota Neko</td>
                                    </tr>
                                    <tr>
                                        <th>Mail</th>
                                        <td>cat1@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>222-2222</td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td></td> 
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td></td> 
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td></td> 
                                    </tr>
                                    <tr>
                                        <th>Date</th>
                                        <td>2024/06/28</td>
                                    </tr>
                                    <tr>
                                        <th>Time</th>
                                        <td>8:00 - 18:00</td>
                                    </tr>
                                    <tr>
                                        <th>Car type</th>
                                        <td>Standard</td>
                                    </tr>
                                    <tr>
                                        <th>Fee</th>
                                        <td>￥ 1,500</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="bottom text-center justify-content-center">
                            <form action="" method="post">
                                @csrf
                                @method('PATCH')
                                <a class="btn rounded-pill fw-bold px-4 btn-white fs-5 btn-sm" 
                                    data-bs-dismiss="modal"
                                    onmouseover="this.style.color='#ff9900';"
                                    onmouseout="this.style.color='#ff9900';"
                                >
                                    Cancel
                                </a>
                                <button type="submit" class="btn rounded-pill fw-bold px-4 btn-orange fs-5 btn-sm">Proceed to Payment</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>