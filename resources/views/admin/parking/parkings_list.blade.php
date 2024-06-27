@extends('layouts.app')

@section('title', 'Admin: Parking places')

@section('content')
<style>

    .parking-list {
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 15px;
        overflow: hidden;
    }

    .parking-list th,
    .parking-list tbody td {
        padding: 10px;
        border-bottom: 3px solid #D9D9D9;
        text-align: center;
    }

    .parking-list th {
        background-color: #003566;
        color: white;
        border: solid 1px white;
    }

    .parking-list tbody tr:last-child th,
    .parking-list tbody tr:last-child td {
        border-bottom: none;
    }

</style>


    <div class="container">
        <div class="row mt-4 fs-5">
            <div class="col-3 d-lex">
                <i class="fa-solid fa-car fa-2x"></i>
                <span class="ms-1">
                    <span class="admin-users h4"> Parking Places</span>
                </span>
            </div>

            <div class="col-2">
                <i class="fa-solid fa-user fa-2x"></i>
                <span class="ms-1">
                    <span class="admin-parking h4"> Users</span>
                </span>
            </div>
        </div>

        <form action="#" method="get">
            <div class="card user-search mt-3">
                <div class="card-body">
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-5">
                            <label
                                for="parking_place_name"
                                class="h5 form-label fw-bold mt-3 ms-2 mb-0"
                            >
                                Parking place Name
                            </label>
                            <input
                                type="text"
                                class="form-control rounded-pill"
                                id="parking_place_name"
                                name="parking_place_name"
                            >
                            <div class="row">
                                <div class="col-7">
                                    <label
                                        for="address"
                                        class="h5 form-label fw-bold mt-3 ms-2 mb-0"
                                    >
                                        Address
                                    </label>
                                    <div class="row">
                                        <div class="col-7">
                                            <input
                                                type="text"
                                                class="form-control rounded-pill"
                                                id="postal_code"
                                                name="postal_code"
                                                placeholder="Postal code"
                                            >
                                        </div>
                                        <div class="col-5">
                                            <input
                                                type="text"
                                                id="city"
                                                name="city"
                                                class="form-control rounded-pill"
                                                placeholder="City"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <label
                                        for="inputStatus"
                                        class="h5 form-label fw-bold mt-3 ms-2 mb-0"
                                    >
                                        Status
                                    </label>
                                    <select
                                        name="status"
                                        id="status"
                                        class="form-control rounded-pill pic-icon"
                                        required
                                    >

                                        <option value="" selected>▼</option>
                                        <option value="opened">Opened</option>
                                        <option value="closed">Cloced</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label
                                class="h5 form-label fw-bold mt-3 ms-2 mb-0"
                            >
                                Number of slots
                            </label>
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control rounded-pill"
                                    id="max_numberFrom"
                                    name="max_numberFrom"
                                    placeholder="From"
                                >
                                <span class="mx-2 pt-2">〜</span>
                                <input
                                    type="number"
                                    class="form-control rounded-pill"
                                    id="max_numberTo"
                                    name="max_numberTo"
                                    placeholder="To"
                                >
                            </div>
                            <div class="row apply-btn mt-1">
                                <div class="col-6">
                                    <button
                                        type="button"
                                        class="btn btn-red rounded-pill w-100"
                                    >
                                        Clean All Filter
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button
                                        type="button"
                                        class="btn btn-red-opposite rounded-pill w-100"
                                    >
                                        Apply Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row align-items-center my-5">
            <div class="col">
                <div class="row">
                    <div class="col-5">
                        <button class="btn btn-orange rounded-pill w-100 fw-bold">
                            <i class="fa-solid fa-circle-plus me-1"></i> Add
                        </button>
                    </div>
                    <div class="col-5">
                        <i class="fa-solid fa-trash-can fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row fw-bold text-center justify-content-center">
                    <div class="col-1 border-bottom border-3 me-2">
                        <i class="fa-solid fa-angles-left"></i>
                    </div>
                    <div class="col-1 border-bottom border-3 border-orange me-2">1</div>
                    <div class="col-1 border-bottom border-3 me-2">2</div>
                    <div class="col-1 border-bottom border-3 me-2">3</div>
                    <div class="col-1 border-bottom border-3 me-2">
                        <i class="fa-solid fa-ellipsis"></i>
                    </div>
                    <div class="col-1 border-bottom border-3 me-2">5</div>
                    <div class="col-1 border-bottom border-3">
                        <i class="fa-solid fa-angles-right"></i>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
            <table class="parking-list h5 table-hover align-center text-center w-100">
                <thead>
                    <tr>
                        <th>
                            <i class="fa-solid fa-check"></i>
                        </th>
                        <th>Parking place Name</th>
                        <th>City</th>
                        <th>Street</th>
                        <th><i class="fa-solid fa-car fa-2x"></i></th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr>
                        <td><input type="checkbox" name="" id=""></td>
                        <td>Parking place 1</td>
                        <td>Tokyo,Shibuya</td>
                        <td>1-2-3</td>
                        <td>10</td>
                        <td>
                            <i class="fa-solid fa-circle text-secondary"></i>&nbsp; Closed
                            <i class="fa-solid fa-circle text-success"></i>&nbsp; Opened
                        </td>
                        <td >
                            <i class="fa-solid fa-edit fa-2x me-1"></i>
                            <span class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis fa-2x"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#">
                                        Detail
                                    </button>
                                    <hr class="horizontal-divider">
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#">
                                        Contact
                                    </button>
                                </div>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="" id=""></td>
                        <td>Parking place 1</td>
                        <td>Tokyo,Shibuya</td>
                        <td>1-2-3</td>
                        <td>10</td>
                        <td>
                            <i class="fa-solid fa-circle text-secondary"></i>&nbsp; Closed
                            <i class="fa-solid fa-circle text-success"></i>&nbsp; Opened
                        </td>
                        <td >
                            <i class="fa-solid fa-edit fa-2x me-1"></i>
                            <span class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis fa-2x"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#">
                                        Detail
                                    </button>
                                    <hr class="horizontal-divider">
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#">
                                        Contact
                                    </button>
                                </div>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>






    </div>

@endsection
