@extends('layouts.app')

@section('title', 'Admin: Users')

@section('content')

    <div class="container">
        <div class="row mt-4">
            <div class="col-2 d-flex align-items-center">
                <i class="fa-solid fa-car fa-2x"></i>
                <span class="ms-2">
                    <a href="{{ route('admin.parking.parkings_list') }}" class="admin-parking-link"><span class="admin-parking h4"> Parking Places</span></a>
                </span>
            </div>
            <div class="col-2 d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-user fa-2x admin-users-icon"></i>
                <span class="ms-2">
                    <span class="admin-users h4"> Users</span>
                </span>
            </div>
        </div>

        <form action="{{ route('admin.users_list')}}" method="get">
            <div class="card user-search mt-3">
                <div class="row justify-content-center">
                    <div class="col-10 mt-3">
                        <div class="card-body fw-bold h5">
                            <div class="row">
                                <div class="col-md-5 ms-5">
                                    <label for="inputUserName" class="form-label">User Name</label>
                                    <input type="text" class="form-control rounded-pill" name="username" value="{{ request('username') }}">
                                </div>
                                <div class="col-md-6 ms-3">
                                    <label class="form-label">Registered Date</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control rounded-pill" id="registeredDateFrom" name="registeredDateFrom" placeholder="From" value="{{ request('registeredDateFrom') }}">
                                        <span class="mx-2 pt-2">〜</span>
                                        <input type="date" class="form-control rounded-pill" id="registeredDateTo" name="registeredDateTo" placeholder="To" value="{{ request('registeredDateTo') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-5 ms-5">
                                    <label for="inputEmail" class="form-label">E-mail</label>
                                    <input type="text" class="form-control rounded-pill" name="email" value="{{ request('email') }}">
                                </div>
                                <div class="col-md-6 ms-3 select-icon">
                                    <label for="inputStatus" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control rounded-pill pic-icon custom-select-width">
                                        <option value="" disabled selected>Please select type</option>
                                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row my-4">
                                <div class="col-md-5 ms-5">
                                    <label for="inputPhone" class="form-label">Phone Number</label>
                                    <input type="number" class="form-control rounded-pill" name="phone" value="{{ request('phone') }}">
                                </div>
                                <div class="col-md-6 ms-3 apply-btn">
                                    <div class="d-flex">
                                        <a href="{{ route('admin.users_list') }}" class="btn btn-red me-2 rounded-pill">Clean All Filter</a>
                                        <button type="submit" class="btn btn-red-opposite rounded-pill apply-ft-btn">Apply Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="row mt-5">
            <div class="col-md-8">
                <div class="d-flex">
                    <form id="user-list-form-delete" action="{{route('admin.users.deactivate')}}" method="post">
                        @csrf
                        @method('DELETE')
                            <button class="btn btn-red-opposite rounded-pill me-3" type="submit">
                                <i class="fa-solid fa-trash-can"></i> Delete
                            </button>
                    </form>
                    
                    <form id="user-list-form-restore" action="{{ route('admin.users.activate')}}" method="post">
                        @csrf
                        @method('PATCH')
                        <button class="btn restore-btn rounded-pill" type="submit">
                            <i class="fa-solid fa-trash-can-arrow-up"></i> Restore
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-1 userList-pagination">
            {{ $all_users->links('pagination::bootstrap-4') }}
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
                    <th>Status</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse ($all_users as $user)
                    <tr>
                        @if ($user->deleted_at == null)
                            <td><input form="user-list-form-delete" type="checkbox" id="" name="user_ids[]" value="{{ $user->id }}"></td>
                        @else
                            <td><input form="user-list-form-restore" type="checkbox" id="" name="user_ids[]" value="{{ $user->id }}"></td>
                        @endif
                        <td>
                            <a href="{{ route('profile', $user->id)}}" class="text-decoration-none admin-username">{{ $user->username }}</a>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>
                            @if($user->car_type)
                                {{ $user->car_type }}
                            @endif
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            @if($user->trashed())
                                {{-- DEACTIVATE --}}
                                <div class="deactivate-logo">
                                    <i class="fa-solid fa-circle"></i>
                                </div>
                            @else
                                {{-- ACTIVATE --}}
                                <div class="activate-logo">
                                    <i class="fa-solid fa-circle"></i>
                                </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr class="text-center" aria-colspan="6">No users found.</tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-5 userList-pagination">
            {{ $all_users->links('pagination::bootstrap-4') }}
        </div>


    </div>

@endsection
