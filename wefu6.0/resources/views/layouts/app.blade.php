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
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
</head>
<body class="custom-body">
<div id="app">

    @if (Auth::user())
        @php
            $user = Auth::user();
            $username = $user->username;
        @endphp
    @endif

    {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"> --}}
                {{-- {{ config('app.name', 'APP_NAME') }} --}}

                {{-- {{ Config::get('APP_NAME', 'WEFU') }}

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
                        </form> --}}

                        {{-- <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->first_name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

                            </div>
                        </li> --}}
                    {{-- @endif
                </ul>
            </div>

        </div>
    </nav> --}}

    {{-- Side bar --}}
    {{-- @if (Auth::user())
        <div class="col-lg-2 align-items-strech flex-column float-left border-right-2 border-bottom-2 vh-100">
            @if(Auth::user()->can('edit profile'))
            <div class="user_profile pt-3 pl-5">
                <img src="{{ URL::to('/storage/uploads/profile_pic/'.Auth::user()->profile_img) }} " alt="placeholder" class="rounded-circle" width="100px" height="100px"  />
                <p class="pt-3"> 
                    <strong> 
                        {{ Auth::user()->full_name}} 
                    </strong> 
                    <br>

                    <br>
                    <a href="{{ route('profile', $username) }}">Edit Profile</a>
                </p>
            </div>                
            @endif

            <hr>
            <div class="options pt-2 pl-3">
                <p><h5> <strong>Options</strong> </h5></p>
                @hasrole('customer')
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
                @endhasrole
                @hasrole('admin')
                    <ul class="list-unstyled p-2">
                        <li> <a href="{{route('home')}}">Home</a></li>
                        <li> <a href="{{route('manageOrders')}}">Manage Orders</a></li>
                        <li> <a href="#">Manage Shippments</a></li>
                        <li> <a href="{{route('updatePricingPlan')}}">Update Pricing Plans</a></li>
                        <li> <a href="#">Update Customs Tax</a></li>
                        <li> <a href="#">Create user</a></li>
                    </ul>
                @endhasrole
            </div>
        </div>

    @endif --}}
    
    <div class="col-lg-2 flex-column fixed-top">
        
        <div class="p-4 ml-4">
            <h2> <strong>W</strong>efu</h2>
        </div>
        {{-- <div class="mt-4">
            <div class="img-container-dashboard m-auto">
                <img src="{{ URL::to('/storage/uploads/profile_pic/default.jpg') }} " alt="placeholder" class="rounded-circle"/>
            </div>
            <div class="mt-2 text-center">
                <strong>AbdulRehman</strong>
            </div>
        </div> --}}
        @hasrole("customer")
        <div class="text-left mr-n2 ml-n3 mt-5">
            <ul id="dashboard-options" class="list-unstyled">
                <li class="dashboard-li" id="home"> <a class="dashboard-anchor ml-3" href="{{ route('home') }}">Home</a></li>
                <li class="dashboard-li" id="profile"> <a class="dashboard-anchor ml-3" href="{{ route('profile', $username) }}">My Profile</a></li>
                <li class="dashboard-li" id="cart"> <a class="dashboard-anchor ml-3" href="{{ route('cart', $username) }}">Shopping Cart</a></li>
                <li class="dashboard-li" id="orders"> <a class="dashboard-anchor ml-3" href="{{ route('ordersIndex') }}">My Orders</a></li>
                <li class="dashboard-li" id="payments"> <a class="dashboard-anchor ml-3" href="#">My Payments</a></li>
                <li class="dashboard-li" id="shippments"> <a class="dashboard-anchor ml-3" href="#">My Shippments</a></li>
                <li class="dashboard-li" id="pricing_plans"> <a class="dashboard-anchor ml-3" href="#">Pricing Plans</a></li>

            </ul>
        </div>

        @endhasrole
    </div>

    @if(Auth::user())
        <div class="col-lg-2 float-right h-98 bg-gray mt-1 mr-2 custom-radius-1">
            <div class="flex-column profile-card">
                <div class="mt-5">
                    <div class="img-container-dashboard m-auto">
                        <img src="{{ URL::to('/storage/uploads/profile_pic/default.jpg') }} " alt="placeholder" class="rounded-circle"/>
                    </div>
                    <div class="mt-3 text-center">
                        <h5>{{Auth::user()->full_name}}</h5>
                    </div>

                    <div class="mt-4 pt-2 d-flex">
                        <div class="text-center info-tab-head" id="notification-icon" onclick="notification_div_clicked()">
                            <img src="{{ URL::to('/storage/uploads/icons/bell24.png')}} " alt="" class="">
                            <small class="">Notifications</small>
                        </div>
                        <div class="text-center pl-2 info-tab-head" id="logout-icon" onclick="logout_div_clicked()">
                            <img src="{{ URL::to('/storage/uploads/icons/logout.png')}} " alt="" class="">
                            <small class="">Logout</small>
                        </div>
                        <div class="text-center pl-2 info-tab-head" id="wishlist-icon" onclick="wishlist_div_clicked()">
                            <img src="{{ URL::to('/storage/uploads/icons/heart.png')}} " alt="" class="">
                            <br>
                            <small class="">My Wish-list</small>
                        </div>
    
                    </div>
                    <div class="mt-5 pt-2" id="notification-div">
                        <h5>Notifications</h5>
                        <hr>
                    </div>
                    <div class="mt-5 pt-2" id="logout-div">
                        <h5>Logout</h5>
                        <hr>
                        <div class="">
                            <p>Are you sure you want to logout?</p>
                            <div class="mt-5">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="flex-column mt-5">
                                        <button type="button" class="btn btn-light w-100" onclick="cancel_clicked()">Cancel</button>
                                        <button type="submit" class="btn btn-purple w-100 mt-2">Confirm</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 pt-2" id="wishlist-div">
                        <h5>My Wish-list</h5>
                        <hr>
                    </div>
                </div>
    
            </div>
        </div>

    @endif

    @yield('content')

</div>

<!-- Scripts -->
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script>

    var logout_div = document.getElementById("logout-div")
    var wishlist_div = document.getElementById("wishlist-div")
    var notification_div = document.getElementById("notification-div") 

    // Defaults
    logout_div.style.display = "none"
    wishlist_div.style.display = "none"

    var weekdays = new Array(
        "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
    );

    var month_names = new Array(
        "January", "Feburary", "March", "April", "May", "June", "July", "August", "September",
        "October", "November", "December"  
    );

    function numberWithCommas(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function logout_div_clicked(){
        logout_div.style.display = "block"
        wishlist_div.style.display = "none"
        notification_div.style.display = "none"
    }

    function notification_div_clicked(){
        notification_div.style.display = "block"
        logout_div.style.display = "none"
        wishlist_div.style.display = "none"
    }
    
    function wishlist_div_clicked(){
        wishlist_div.style.display = "block"
        notification_div.style.display = "none"
        logout_div.style.display = "none"
    }

    function cancel_clicked(){
        document.getElementById("notification-div").style.display = "block";
        document.getElementById("logout-div").style.display = "none";
        document.getElementById("wishlist-div").style.display = "none";
    }

</script>
</body>
</html>
