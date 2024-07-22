@extends('layouts.app')

@section('title', 'Admin: Parking places')

@section('content')

    <div class="container">
        <div class="row mt-4">
            <div class="col-2 d-flex align-items-center admin-title-parking">
                <i class="fa-solid fa-car fa-2x admin-users-icon page-title"></i>
                <span class="ms-2">
                    <span class="admin-users h4 page-title">
                        Parking Places
                    </span>
                </span>
            </div>
            <div class="col-2 d-flex align-items-center admin-title-parking">
                <i class="fa-solid fa-user fa-2x page-title"></i>
                <span class="ms-2">
                    <a href="{{route('admin.users_list')}}" class="admin-parking-link">
                        <span class="admin-parking h4 page-title"> Users</span>
                    </a>
                </span>
            </div>
        </div>

        {{-- filter search --}}
        <form
            action="{{route('admin.parking.parkings_list')}}"
            method="get"
        >
            @csrf
            <div class="card user-search mt-3">
                <div class="card-body">
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-5 me-3">
                            <label
                                for="parking_place_name"
                                class="h5 form-label fw-bold mt-3 ms-2"
                            >
                                Parking place Name
                            </label>
                            <input
                                type="text"
                                class="form-control rounded-pill"
                                id="parking_place_name"
                                name="parking_place_name"
                                value="{{ request('parking_place_name') }}"
                            >
                            <div class="row mt-4">
                                <div class="col-7">
                                    <label
                                        for="address"
                                        class="h5 form-label fw-bold ms-2"
                                    >
                                        Address
                                    </label>
                                    <div class="row me-1">
                                        <div class="col-7">
                                            <input
                                                type="text"
                                                class="form-control rounded-pill"
                                                id="postal_code"
                                                name="postal_code"
                                                placeholder="Postal code"
                                                value="{{ request('postal_code') }}"
                                            >
                                        </div>
                                        <div class="col-5">
                                            <input
                                                type="text"
                                                id="city"
                                                name="city"
                                                class="form-control rounded-pill"
                                                placeholder="City"
                                                value="{{ request('city') }}"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <label
                                        for="status"
                                        class="h5 form-label fw-bold ms-2"
                                    >
                                        Status
                                    </label>
                                    <select
                                        name="status"
                                        id="status"
                                        class="form-select rounded-pill pic-icon"
                                    >
                                        <option
                                            value=""
                                            hidden>Please select type
                                        </option>
                                        <option
                                            value="open"
                                            {{ request('status') == 'open' ? 'selected' : '' }}
                                        >
                                            Open
                                        </option>
                                        <option
                                            value="closed"
                                            {{ request('status') == 'closed' ? 'selected' : '' }}
                                        >
                                            Closed
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 ms-3">
                            <label
                                class="h5 form-label fw-bold mt-3 ms-2"
                            >
                                Number of slots
                            </label>
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control rounded-pill"
                                    id="number_of_slots_from"
                                    name="number_of_slots_from"
                                    placeholder="From"
                                    value="{{ request('number_of_slots_from') }}"
                                >
                                <span class="mx-2 pt-2 fw-bold">〜</span>
                                <input
                                    type="text"
                                    class="form-control rounded-pill"
                                    id="number_of_slots_to"
                                    name="number_of_slots_to"
                                    placeholder="To"
                                    value="{{ request('number_of_slots_to') }}"
                                >
                            </div>
                            <div class="row apply-btn mt-4">
                                <div class="col-6">
                                    <a
                                        href="{{ route('admin.parking.parkings_list') }}"
                                        class="btn btn-red rounded-pill w-100 fw-bold"
                                    >
                                    Clear All Filter
                                    </a>
                                </div>
                                <div class="col-6">
                                    <button
                                        type="submit"
                                        class="btn btn-red-opposite rounded-pill w-100 fw-bold"
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

        {{-- button --}}
        <div class="row align-items-center mt-5">
            <div class="col-md-8">
                <div class="d-flex">
                    <a
                        href="{{route('admin.parking.index')}}"
                        class="btn btn-orange rounded-pill fw-bold me-3"
                    >
                        <i class="fa-solid fa-circle-plus"></i> Add
                    </a>
                    <form
                        id="parking-list-form-delete"
                        action="{{route('admin.parking.deactivate')}}"
                        method="post"
                    >
                        @csrf
                        @method('DELETE')
                        <button
                            class="btn btn-red-opposite rounded-pill fw-bold me-3"
                            type="submit"
                        >
                            <i class="fa-solid fa-trash-can"></i> Delete
                        </button>
                    </form>
                    <form
                        id="parking-list-form-restore"
                        action="{{ route('admin.parking.activate')}}"
                        method="post"
                    >
                        @csrf
                        @method('PATCH')
                        <button
                            class="btn restore-btn rounded-pill fw-bold"
                            type="submit"
                        >
                            <i class="fa-solid fa-trash-can-arrow-up"></i> Restore
                        </button>
                    </form>
                </div>
            </div>
            <div class="col">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="col"></div>
        </div>

        {{-- page number --}}
        <div class="d-flex justify-content-center mt-1 userList-pagination">
            {{ $all_parkings->links('pagination::bootstrap-4') }}
        </div>

        {{-- list --}}
        <div class="admin-table-responsive">
            <table class="parking-list h6 table-hover align-center text-center w-100">
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
                    @forelse ($all_parkings as $parkingPlace)
                        <tr>
                            @if ($parkingPlace->deleted_at == null)
                                <td>
                                    <input
                                        form="parking-list-form-delete"
                                        type="checkbox"
                                        id="parking-list-form-delete"
                                        name="parking_ids[]"
                                        value="{{ $parkingPlace->id }}"
                                    >
                                </td>
                            @else
                                <td>
                                    <input
                                        form="parking-list-form-restore"
                                        type="checkbox"
                                        id="parking-list-form-restore"
                                        name="parking_ids[]"
                                        value="{{ $parkingPlace->id }}"
                                    >
                                </td>
                            @endif
                            <td>{{$parkingPlace->parking_place_name}}</td>
                            <td>{{$parkingPlace->city}}</td>
                            <td>{{$parkingPlace->street}}</td>
                            <td>{{$parkingPlace->max_number}}</td>
                            <td>
                                @if ($parkingPlace->trashed())
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
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="{{ route('admin.parking.edit', $parkingPlace->id) }}">
                                        <i class="fa-solid fa-edit fa-2x me-1" style="color: #343A40"></i>
                                    </a>
                                    <span class="dropdown">
                                        <button class="btn btn-sm" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis fa-2x"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a
                                                href="{{route('admin.parking.show', $parkingPlace->id)}}"
                                                class="dropdown-item"
                                            >
                                                Detail
                                            </a>
                                        </div>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center" aria-colspan="6">No parking places found.</tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-1 userList-pagination pt-4">
            {{ $all_parkings->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
