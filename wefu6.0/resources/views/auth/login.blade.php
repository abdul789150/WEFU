@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-md-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="username_email" class="col-lg-4 col-form-label text-lg-right">Username or E-Mail</label>

                            <div class="col-lg-6">
                                <input
                                        id="username_email"
                                        type="text"
                                        class="form-control{{ $errors->has('username_email') ? ' is-invalid' : '' }}"
                                        name="username_email"
                                        value="{{ old('email') }}"
                                        autofocus
                                >

                                @if ($errors->has('username_email'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('username_email') }}</strong>
                                    </div>
                                @endif

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-lg-4 col-form-label text-lg-right">Password</label>

                            <div class="col-lg-6">
                                <input
                                        id="password"
                                        type="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password"
                                >

                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6 offset-lg-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-8 offset-lg-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

    <div class="container col-xl-8 col-lg-9">
        <div class="mt-4 custom-radius shadow border" style="height: 480px;">
            
            <div class="col-xl-6 col-lg-6 float-left">

                <div class="login-img-div" style="display: none;">
                    <img src="{{ URL::to('/storage/uploads/web_images/Limage.JPG') }}" alt="" class="custom-radius-dashboard">
                </div>

                <div >
                    <div class="container text-center pt-4">
                            <h2><strong>Welcome Back!</strong></h2>
                            <span><strong>it's always a pleasure to see you</strong></span>
                        </div>
        
                        <div class="mt-4 text-center">
                            <h1><strong>LOGIN</strong></h1>
        
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group row col-xl-8 col-lg-8 m-auto">
        
                                    <div class="mt-4 w-100">
                                        <input
                                            id="username_email"
                                            type="text"
                                            class="form-control{{ $errors->has('username_email') ? ' is-invalid' : '' }}"
                                            name="username_email"
                                            placeholder="Your Email/Username"
                                            value="{{ old('email') }}"
                                            autofocus
                                        >
        
                                        @if ($errors->has('username_email'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('username_email') }}</strong>
                                            </div>
                                        @endif
        
                                    </div>
                                </div>
                                <div class="form-group row col-xl-8 col-lg-8 m-auto">
                                    <div class="mt-2 w-100">
                                        <input
                                            id="password"
                                            type="password"
                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password"
                                            placeholder="Your Password"
                                        >
        
                                        @if ($errors->has('password'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a> --}}
                                <div class="form-group row col-xl-8 col-lg-8 m-auto">
                                    <div class="flex-column w-100 ml-n1 mt-4">
                                        <button type="submit" class="btn btn-purple w-60">
                                            Login
                                        </button>
                                        {{-- <button class="btn btn-primary w-60 mt-2">
                                            facebook
                                        </button> --}}
                                    </div>
                                </div>
        
                            </form>
                            
                            <div class="mt-5 pt-5">
                                Not a WEFU member?
                                <span class="">
                                    <a href="{{ route('register') }}">Sign up</a>
                                </span>
                            </div>
                        
                        </div>
                </div>

            </div>

            <div class="col-xl-6 col-lg-6 float-right">
                <div class="login-img-div">
                    <img src="{{ URL::to('/storage/uploads/web_images/Simage.JPG') }}" alt="" class="custom-radius-1">
                </div>
            </div>

        </div>
    </div>



@endsection
