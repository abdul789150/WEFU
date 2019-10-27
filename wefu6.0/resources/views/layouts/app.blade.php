<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Config::get('APP_NAME', 'WEFU') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app1.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{-- {{ config('app.name', 'APP_NAME') }} --}}

                {{ Config::get('APP_NAME', 'WEFU') }}

            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    @if (Auth::guest())
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                    @else
                        <a href="{{ route('logout') }}" class="dropdown-item"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            {{ csrf_field() }}
                        </form>

                        {{-- <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->first_name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

                            </div>
                        </li> --}}
                    @endif
                </ul>
            </div>

        </div>
    </nav>

    {{-- Side bar --}}
    @if (Auth::user())
        <div class="col-lg-2 align-items-strech flex-column float-left border-right-2 border-bottom-2 vh-100">

            <div class="user_profile pt-3 pl-5">
                <img src="{{ URL::to('/storage/uploads/profile_pic/'.Auth::user()->profile_img) }} " alt="placeholder" class="rounded-circle" width="100px" height="100px"  />
                <p class="pt-3"> 
                    <strong> 
                        {{ Auth::user()->full_name }} 
                    </strong> 
                    <br>
                    @php
                        $user = Auth::user();
                        $role = $user->role()->get(['role_name'])[0];
                        echo $role->role_name;
                        $username = $user->username
                    @endphp
                    <br>
                    <a href="{{ route('profile', $username) }}">Edit Profile</a>
                </p>
            </div>
            <hr>
            <div class="options pt-2 pl-3">
                <p><h5> <strong>Options</strong> </h5></p>
                <ul class="list-unstyled p-2">
                    @yield('home')

                    <li> <a href="{{ route('cart', $username) }}"> Shopping Cart</a></li>
                    <li> <a href="{{ route('ordersIndex') }}"> Orders</a></li>
                    <li> <a href="#"> Pricing Plans</a></li>
                    <li> <a href="#"> Payment</a></li>
                    <li>
                        <a href="#CC_submenu" 
                            data-toggle="collapse" 
                            aria-expanded="false" 
                            class="dropdown-toggle">Customer Care</a>

                        <ul id="CC_submenu" class="collapse list-unstyled pl-2">
                            <li> <a href="#">Help Center</a></li>
                            <li> <a href="#">Order Information</a></li>
                            <li> <a href="#" class="d-flex">Shipping Information</a></li>
                            <li> <a href="#">Refund Policy</a></li>
                            <li> <a href="#">FAQ</a></li>
                        </ul>
                    </li>
                
                </ul>
            </div>
        </div>

    @endif

    @yield('content')

</div>

<!-- Scripts -->
<script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>
