<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- css --}}
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <style>
        .navbar{
            color: #343A40;
            font-family: "Inter";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        body {
            padding-top: 70px;
        }

        footer{
            font-family: "Inter";
            color:white
        }

        .sidebar_font{
            font-family: "Inter";
            color: white;
        }

        .white_line {
            padding-left: 10px;
            margin-left: 12px;
            border-left: 1px solid white;
        }

        #sidebar {
            position: fixed;
            right:0;
            width: 250px;
            height: 100%;
            transition: transform 0.3s ease;
            transform: translateX(100%);
            flex-direction: column;
            background-color: #003566;
            z-index: 1000;
        }

        #sidebarToggle:checked ~ #sidebar {
            transform: translateX(0);
        }

        #sidebarToggle {
            display: none;
        }

        .sidebar a {
            color: white;
            font-family: "Inter";
            text-decoration: none;
            padding: 10px 2px;
        }

        .bg_footer{
            background-color: #343A40;
        }

    </style>

</head>
<body>
    <div id="app">
        <div class="row">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container-fluid">
                    <div class="col-3">
                        <a class="navbar-brand ms-5" href="{{ route('home') }}">
                            {{-- Logo imege and link of home --}}
                            <img
                                src="{{ asset('images/logo.png') }}"
                                alt="iPark"
                                style="height: 50px;"
                            >
                        </a>
                    </div>
                    {{-- Serch-bar --}}
                    <div class="col-6 justify-content-center d-flex align-items-center">
                        <form
                            action="{{route('showParkingList')}}"
                            method="get"
                        >
                            <div class="input-group input-group-sm">
                                <span class="input-group-text rounded-pill rounded-end">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                                <input
                                    type="text"
                                    name="search"
                                    placeholder="Search by place name"
                                    class="form-control rounded-pill rounded-start"
                                    style="width: 300px;"
                                >
                                <button
                                    type="submit"
                                    class="btn rounded-pill fw-bold px-4 btn-navy fs-7 btn-sm ms-3"
                                >
                                Show parking spaces
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-3">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto">
                                @guest
                                    @if (Route::has('login'))
                                        <li class="nav-item">
                                            <a
                                                class="nav-link"
                                                href="{{ route('login') }}"
                                            >
                                                {{ __('Login') }}
                                            </a>
                                        </li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a
                                                class="nav-link"
                                                href="{{ route('register') }}"
                                            >
                                                {{ __('Register') }}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            {{-- Add Bars icon for sidebar --}}
                                            <label
                                                for="sidebarToggle"
                                                class="btn custom_btn ms-2 me-5"
                                                style="width: 50px;"
                                            >
                                                <i class="fa fa-bars fa-2x"></i>
                                            </label>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown">
                                        <a
                                            id="navbarDropdown"
                                            class="nav-link dropdown-toggle d-flex align-items-center border rounded-pill shadow-sm"
                                            href="#"
                                            role="button"
                                            data-bs-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                        >
                                            <i class="fas fa-user-circle fa-2x"></i>
                                            <span class="mx-2">
                                                {{ Auth::user()->username }}
                                            </span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="account-dropdown">
                                            @auth
                                                @if (Auth::user()->role_id == 1 || request()->is('admin/*'))
                                                {{-- Admin Controls --}}
                                                <a href="{{route('admin.parking.parkings_list')}}" class="dropdown-item">
                                                    Admin
                                                </a>
                                                <hr class="horizontal-divider">
                                                {{-- Logout Button/Link --}}
                                                <a
                                                    class="dropdown-item"
                                                    href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                                >
                                                {{ __('Logout') }}
                                                </a>
                                                @else
                                                {{-- Profile Button/Link --}}
                                                <a
                                                    href="{{ route('profile', ['id' => auth()->user()->id]) }}"
                                                    class="dropdown-item"
                                                >
                                                    Profile
                                                </a>
                                                <hr class="horizontal-divider">
                                                {{-- Logout Button/Link --}}
                                                <a
                                                    class="dropdown-item"
                                                    href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                                >
                                                    {{ __('Logout') }}
                                                </a>

                                                <form
                                                    id="logout-form"
                                                    action="{{ route('logout') }}"
                                                    method="POST"
                                                    class="d-none"
                                                >
                                                    @csrf
                                                </form>
                                                @endif
                                            @endauth
                                            <li class="nav-item">
                                                {{-- Add Bars icon for sidebar --}}
                                                <label
                                                    for="sidebarToggle"
                                                    class="btn custom_btn ms-2 me-5"
                                                    style="width: 50px;"
                                                >
                                                    <i class="fa fa-bars fa-2x"></i>
                                                </label>
                                            </li>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <input type="checkbox" id="sidebarToggle">

        <div  id="sidebar" class="sidebar d-flex bg_navy p-3 vh-100 ">
            @guest
                {{-- Guest Sidebar --}}
                <a
                    href="{{ route('home') }}"
                    class="d-flex align-items-center ms-3 mb-3 mt-4 text-decoration-none fw-bold"
                >
                    <i class="fa fa-home me-3 fa-2x"></i> Home
                </a>
                <a
                    href="{{ route('showParkingList') }}"
                    class="d-flex align-items-center ms-3 mb-3 text-decoration-none fw-bold"
                >
                    <i class="fa fa-car me-3 fa-2x"></i> Parking list
                </a>
                <a
                    href="{{route('login')}}"
                    class="d-flex align-items-center ms-3 mb-3 text-decoration-none fw-bold"
                >
                    <i class="fa fa-sign-in-alt me-3 fa-2x"></i> Login
                </a>
                <a
                    href="{{route('register')}}"
                    class="d-flex align-items-center ms-3 mb-3 text-decoration-none fw-bold"
                >
                    <i class="fa fa-registered me-3 fa-2x"></i> Register
                </a>
                <a
                    href="{{ route('faq') }}"
                    class="d-flex align-items-center ms-3 mb-3 text-decoration-none fw-bold"
                >
                    <i class="fa fa-question-circle me-3 fa-2x"></i> FAQ
                </a>
                <a
                    href="{{route('aboutUs')}}"
                    class="d-flex align-items-center ms-3 mb-3 text-decoration-none fw-bold"
                >
                    <i class="fa fa-info-circle me-3 fa-2x"></i> About us
                </a>
            @else
                {{-- Registered User Sidebar --}}
                <a
                    href="{{ route('home') }}"
                    class="d-flex align-items-center ms-3 mb-2 mt-3 text-decoration-none fw-bold"
                >
                    <i class="fa fa-home me-3 fa-2x"></i> Home
                </a>
                <a
                    href="{{ route('showParkingList') }}"
                    class="d-flex align-items-center ms-3 mb-2 text-decoration-none fw-bold"
                >
                    <i class="fa fa-car me-3 fa-2x"></i> Parking list
                </a>
                <a
                    href="{{route('profile', ['id' => auth()->user()->id])}}"
                    class="d-flex align-items-center text-decoration-none fw-bold ms-3"
                >
                    <i class="fa fa-user me-3 fa-2x"></i> User Information
                </a>
                <div class="ms-3 mb-2">
                    <div class="ps-3 white_line">
                        <a
                            href="{{route('profile', ['id' => auth()->user()->id])}}"
                            class="d-flex align-items-center text-decoration-none"
                        >
                            Profile
                        </a>
                        <a
                            href="{{route('favorite', ['id' => auth()->user()->id])}}"
                            class="d-flex align-items-center text-decoration-none"
                        >
                            Favorite
                        </a>
                        <a
                            href="{{route('reservation', ['id' => auth()->user()->id])}}"
                            class="d-flex align-items-center text-decoration-none"
                        >
                            Reservation History
                        </a>
                    </div>
                </div>
                {{-- Admin Controls --}}
                @if (Auth::user()->isAdmin())
                    <div class="sidebar-section admin">
                        <a
                            href="{{route('admin.parking.parkings_list')}}"
                            class="d-flex align-items-center text-decoration-none fw-bold ms-3"
                        >
                            <i class="fa fa-user-cog me-3 fa-2x"></i> Admin
                        </a>
                        <div class="ms-3 mb-2">
                            <div class="ps-3 white_line">
                                <a
                                    href="{{route('admin.users_list')}}"
                                    class="d-flex align-items-center text-decoration-none text-white"
                                >
                                    User List
                                </a>
                                <a
                                    href="{{route('admin.parking.parkings_list')}}"
                                    class="d-flex align-items-center text-decoration-none text-white"
                                >
                                    Parking places list
                                </a>
                                <a
                                    href="{{route('admin.parking.index')}}"
                                    class="d-flex align-items-center text-decoration-none text-white"
                                >
                                    Register new parking
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                <a
                    href="{{ route('logout') }}"
                    class="d-flex align-items-center my-2 ms-3 text-white text-decoration-none fw-bold"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                >
                    <i class="fa fa-sign-out-alt me-3 fa-2x"></i> Logout
                </a>
                <form
                    id="logout-form"
                    action="{{ route('logout') }}"
                    method="POST"
                    class="d-none"
                >
                    @csrf
                </form>
                <a
                    href="{{ route('faq') }}"
                    class="d-flex align-items-center ms-3 mb-2 text-decoration-none fw-bold"
                >
                    <i class="fa fa-question-circle me-3 fa-2x"></i> FAQ
                </a>
                <a
                    href="{{route('aboutUs')}}"
                    class="d-flex align-items-center ms-3 text-decoration-none fw-bold"
                >
                    <i class="fa fa-info-circle me-3 fa-2x"></i> About us
                </a>

                @can('admin')
                    <!-- Admin Sidebar -->
                    <a
                        href="{{ route('home') }}"
                        class="d-flex align-items-center ms-3 mb-3 mt-4 text-decoration-none fw-bold"
                    >
                    <i class="fa fa-home me-3 fa-2x"></i> Home
                    </a>
                    <a
                        href="{{route('showParkingList')}}"
                        class="d-flex align-items-center ms-3 mb-3 text-decoration-none fw-bold"
                    >
                        <i class="fa fa-car me-3 fa-2x"></i> Parking list
                    </a>
                    <a
                        href="{{route('profile', ['id' => auth()->user()->id])}}"
                        class="d-flex align-items-center ms-3 mb-1 text-decoration-none fw-bold"
                    >
                        <i class="fa fa-user me-3 fa-2x"></i> User Information
                    </a>
                    <div class="ms-3">
                        <div class="ps-3 white_line">
                            <a
                                href="{{route('profile', ['id' => auth()->user()->id])}}"
                                class="d-flex align-items-center text-decoration-none"
                            >
                                Profile
                            </a>
                            <a
                                href="{{route('favorite', ['id' => auth()->user()->id])}}"
                                class="d-flex align-items-center text-decoration-none"
                            >
                                Favorite
                            </a>
                            <a
                                href="{{route('reservation', ['id' => auth()->user()->id])}}"
                                class="d-flex align-items-center text-decoration-none"
                            >
                                Reservation History
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-section admin mt-3">
                        <a
                            href="{{route('admin.parking.parkings_list')}}"
                            class="d-flex align-items-centere text-decoration-none fw-bold ms-3 text-white"
                        >
                            <i class="fa fa-user-cog me-3 fa-2x"></i> Admin
                        </a>
                        <div class="ms-3">
                            <div class="ps-4 white_line">
                                <a
                                    href="{{route('admin.users_list')}}"
                                    class="d-flex align-items-center text-decoration-none text-white"
                                >
                                    User List
                                </a>
                                <a
                                    href="{{route('admin.parking.parkings_list')}}"
                                    class="d-flex align-items-center text-decoration-none text-white"
                                >
                                    Parking places list
                                </a>
                                <a
                                    href="{{route('admin.parking.index')}}"
                                    class="d-flex align-items-center text-decoration-none text-white"
                                >
                                    Register new parking
                                </a>
                        </div>
                    </div>
                    <a
                        href="{{ route('logout') }}"
                        class="d-flex align-items-center mt-3 mb-3 ms-3 text-white text-decoration-none fw-bold"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    >
                    <i class="fa fa-sign-out-alt me-3 fa-2x"></i> Logout
                    </a>
                    <a
                        href="{{ route('faq') }}"
                        class="d-flex align-items-center ms-3 mb-3 text-decoration-none fw-bold"
                    >
                    <i class="fa fa-question-circle me-3 fa-2x"></i> FAQ
                    </a>
                    <a
                        href="{{ route('aboutUs') }}"
                        class="d-flex align-items-center ms-3 mb-3 text-decoration-none fw-bold"
                    >
                        <i class="fa fa-info-circle me-3 fa-2x"></i> About us
                    </a>
                @endcan
            @endguest
        </div>
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    @yield('content')
                </div>
            </div>
        </main>
        {{-- Footer --}}
        <footer class="bg_footer text-white">
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-md-4">
                        <a
                            class="navbar-brand ms-5"
                            href="{{ route('home') }}"
                        >
                            <img
                                src="{{ asset('images/logo.png') }}"
                                alt="iPark Logo"
                                style="height: 50px;"
                            >
                        </a>
                    </div>
                    <div class="col-md-8 d-flex justify-content-end align-items-center">
                        <ul class="nav">
                            <li class="nav-item">
                                <a
                                    class="nav-link text-white"
                                    href="{{ route('home') }}"
                                >
                                    Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link text-white mx-5"
                                    href="{{ route('faq') }}"
                                >
                                    FAQ
                                </a>
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link text-white me-5"
                                    href="{{ route('aboutUs')}}"
                                >
                                    About Us
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col d-flex justify-content-center align-items-center">
                        <p class="mb-0">&copy; iPark co.,Ltd. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
