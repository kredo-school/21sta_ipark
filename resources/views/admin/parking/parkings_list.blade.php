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

    .checked-row {
        background-color: #F9E8C4;
    }

</style>
<script>
    function toggleRowColor(checkbox) {
        const row = checkbox.parentElement.parentElement;
        if (checkbox.checked) {
            row.classList.add('checked-row');
        } else {
            row.classList.remove('checked-row');
        }
    }
</script>

    <div class="container">
        <div class="row mt-4">
            <div class="col-2 d-flex align-items-center">
                <i class="fa-solid fa-car fa-2x"></i>
                <span class="ms-2">
                    <span class="admin-users h4"> Parking Places</span>
                </span>
            </div>

            <div class="col-2 d-flex align-items-center justify-content-center">
                <a href="{{route('admin.users_list')}}">
                    <i class="fa-solid fa-user fa-2x"></i>
                    <span class="ms-2">
                        <span class="admin-parking h4">Users</span>
                    </span>
                </a>
            </div>
        </div>
        <form action="{{route('admin.parking.search')}}" method="post">
            @csrf
            <div class="card user-search mt-3">
                <div class="card-body">
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-6">
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
                                value="{{ old('parking_place_name') }}"
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
                                                value="{{ old('postal_code') }}"
                                            >
                                        </div>
                                        <div class="col-5">
                                            <input
                                                type="text"
                                                id="city"
                                                name="city"
                                                class="form-control rounded-pill"
                                                placeholder="City"
                                                value="{{ old('city') }}"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <label
                                        for="status"
                                        class="h5 form-label fw-bold mt-3 ms-2 mb-0"
                                    >
                                        Status
                                    </label>
                                    <select
                                        name="status"
                                        id="status"
                                        class="form-control rounded-pill pic-icon"
                                    >
                                        <option value="">▼</option>
                                        <option
                                            value="open"
                                            {{ old('status') == 'open' ? 'selected' : '' }}
                                        >
                                            Open
                                        </option>
                                        <option
                                            value="closed"
                                            {{ old('status') == 'closed' ? 'selected' : '' }}
                                        >
                                            Cloced
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label
                                class="h5 form-label fw-bold mt-3 ms-2 mb-0"
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
                                    value="{{ old('number_of_slots_from') }}"
                                >
                                <span class="mx-2 pt-2">〜</span>
                                <input
                                    type="text"
                                    class="form-control rounded-pill"
                                    id="number_of_slots_to"
                                    name="number_of_slots_to"
                                    placeholder="To"
                                    value="{{ old('number_of_slots_to') }}"
                                >
                            </div>
                            <div class="row apply-btn mt-1">
                                <div class="col-6">
                                    <a
                                        href="{{ route('admin.parking.parkings_list') }}"
                                        class="btn btn-red rounded-pill w-100"
                                    >
                                    Clean All Filter
                                    </a>
                                </div>
                                <div class="col-6">
                                    <button
                                        type="submit"
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
        <div class="row d-flex align-items-center my-5">
            <div class="col">
                <div class="row">
                    <div class="col-5">
                        <a
                            href="{{route('admin.parking.index')}}"
                            class="btn btn-orange rounded-pill w-100 fw-bold"
                        >
                            <i class="fa-solid fa-circle-plus me-1"></i>
                            Add
                        </a>
                    </div>
                    <div class="col-5">
                        <form action="{{route('admin.parking.deactivate')}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-md">
                                <i class="fa-solid fa-trash-can fa-2x"></i>
                            </button>

                    </div>
                </div>
            </div>
            {{-- @if ($parkingPlaces->lastPage > 1) --}}
                {{-- <div class="col d-flex pt-2 justify-content-center">
                    <div class="userList-pagination fw-bold">
                        {{ $parkingPlaces->links('pagination::bootstrap-4') }}
                    </div>
                </div> --}}
            {{-- @endif --}}
            <div class="col"></div>
        </div>
        @if (isset($parkingPlaces) && count($parkingPlaces) > 0)
        <table class="parking-list h5 table-hover align-center text-center w-100">
            <thead>
                <tr>
                    <th>
                        <input
                            type="checkbox"
                            name=""
                        >
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
                @foreach($parkingPlaces as $parkingPlace)
                    <tr>
                        <td>
                            @if (! $parkingPlace->trashed())
                                <input
                                    type="checkbox"
                                    name="selected[]"
                                    id= "custom-checkbox"
                                    onclick="toggleRowColor(this)"
                                    value="{{ $parkingPlace->id }}"
                                    class="custom-checkbox"
                                >
                            @endif
                        </td>

                        <td>{{$parkingPlace->parking_place_name}}</td>
                        <td>{{$parkingPlace->city}}</td>
                        <td>{{$parkingPlace->street}}</td>
                        <td>{{$parkingPlace->max_number}}</td>
                        <td>
                            @if ($parkingPlace->trashed())
                                <i class="fa-solid fa-circle text-secondary"></i>&nbsp; Closed
                            @else
                                <i class="fa-solid fa-circle text-success"></i>&nbsp; Opened
                            @endif
                        </td>
                        <td class="d-flex align-items-center justify-content-center" >
                            <i class="fa-solid fa-edit fa-2x me-1"></i>
                            <span class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis fa-2x"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <button
                                        class="dropdown-item"
                                        data-bs-toggle="modal"
                                        data-bs-target="#"
                                    >
                                        Detail
                                    </button>
                                    <hr class="horizontal-divider">
                                    <button
                                        class="dropdown-item"
                                        data-bs-toggle="modal"
                                        data-bs-target="#"
                                    >
                                        Contact
                                    </button>
                                    @if ($parkingPlace->trashed())
                                        <hr class="horizontal-divider">
                                        </form>
                                        <form
                                            action="{{route('admin.parking.activate', $parkingPlace->id)}}"
                                            method="post"
                                        >
                                            @csrf
                                            @method('PATCH')
                                            <button class="dropdown-item">
                                                Restore
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @else
            <p>No parking places found.</p>
        @endif
        {{-- @if ($parkingPlaces->lastPage > 1) --}}
            {{-- <div class="d-flex justify-content-center mt-5 userList-pagination fw-bold">
                {{ $parkingPlaces->links('pagination::bootstrap-4') }}
            </div> --}}
        {{-- @endif --}}
    </div>
@endsection
