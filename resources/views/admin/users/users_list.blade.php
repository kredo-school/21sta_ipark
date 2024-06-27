@extends('layouts.app')

@section('title', 'Admin: Users')

@section('content')

    <div class="container">
        <div class="row mt-4 fs-5">
            <div class="col-2">
                <i class="fa-solid fa-car me-1"></i><span class="admin-parking"> Parking Places</span>
            </div>

            <div class="col-2">
                <i class="fa-solid fa-user me-1"></i><span class="admin-users"> Users</span>
            </div>
        </div>

        <form action="{{ route('admin.users_list')}}" method="get">

            <div class="card user-search mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5 ms-5">
                            <label for="inputUserName" class="form-label">User Name</label>
                            <input type="text" class="form-control rounded-pill">
                        </div>
                        <div class="col-md-6 ms-3">
                            <label class="form-label">Registered Date</label>
                            <div class="input-group">
                                <input type="date" class="form-control rounded-pill" id="registeredDateFrom" name="registeredDateFrom" placeholder="From">
                                <span class="mx-2 pt-2">〜</span>
                                <input type="date" class="form-control rounded-pill" id="registeredDateTo" name="registeredDateTo" placeholder="To">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-5 ms-5">
                            <label for="inputEmail" class="form-label">E-mail</label>
                            <input type="text" class="form-control rounded-pill">
                        </div>
                        <div class="col-md-6 ms-3 select-icon">
                            <label for="inputStatus" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control rounded-pill pic-icon custom-select-width">
                                <option value="" disabled selected></option>
                                <option value="activate">Activate</option>
                                <option value="inactivate">Inactivate</option>
                            </select>
                        </div>
                    </div>

                    <div class="row my-4">
                        <div class="col-md-5 ms-5">
                            <label for="inputPhone" class="form-label">Phone Number</label>
                            <input type="number" class="form-control rounded-pill">
                        </div>
                        <div class="col-md-6 ms-3 apply-btn">
                            <div class="d-flex">
                                <button type="button" class="btn btn-red me-2 rounded-pill">Clean All Filter</button>
                                <button type="button" class="btn btn-red-opposite rounded-pill apply-ft-btn">Apply Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-md-3">
                    <button class="btn btn-red-opposite rounded-pill dlt-user-btn">
                        <i class="fa-solid fa-trash-can"></i> Delete
                    </button>
                </div>
                <div class="col-md-6">
                    {{-- page bar --}}
                </div>
            </div>

            <table class="parking-list h6 table-hover align-center text-center w-100">
                <thead>
                    <tr>
                        <th>
                            <i class="fa-solid fa-check"></i>
                        </th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th><i class="fa-solid fa-car fa-2x"></i></th>
                        <th>Registered Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr>
                        <td><input type="checkbox" name="" id=""></td>
                        <td>ayane</td>
                        <td>ayane@gmail.com</td>
                        <td>09012345678</td>
                        <td>standard</td>
                        <td>2021/06/12</td>
                        <td>
                            <button class="btn btn-status rounded-pill">Activate</button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="" id=""></td>
                        <td>ayane</td>
                        <td>ayane@gmail.com</td>
                        <td>09012345678</td>
                        <td>standard</td>
                        <td>2021/06/12</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

        </form>
    </div>

@endsection
