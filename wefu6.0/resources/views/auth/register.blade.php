@extends('layouts.app')

@section('content')
{{-- <div class="container"> --}}
    {{-- <div class="row justify-content-md-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <form role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}
                        
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Full Name</label>

                            <div class="col-lg-6">
                                <input
                                        type="text"
                                        class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}"
                                        name="full_name"
                                        value="{{ old('full_name') }}"
                                >
                                @if ($errors->has('full_name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('full_name') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Username</label>

                            <div class="col-lg-6">
                                <input
                                        type="text"
                                        class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                        name="username"
                                        value="{{ old('username') }}"
                                >
                                @if ($errors->has('username'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">E-Mail Address</label>

                            <div class="col-lg-6">
                                <input
                                        type="email"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="email"
                                        value="{{ old('email') }}"
                                >

                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Password</label>

                            <div class="col-lg-6">
                                <input
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
                            <label class="col-lg-4 col-form-label text-lg-right">Confirm Password</label>

                            <div class="col-lg-6">
                                <input
                                        type="password"
                                        class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                        name="password_confirmation"
                                >
                                @if ($errors->has('password_confirmation'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 offset-lg-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
{{-- </div> --}}



    <div class="container col-xl-8 col-lg-10">
        <div class="mt-4 custom-radius shadow border" style="height: 480px;">
            
            <div class="col-xl-6 col-lg-6 float-left ml-n5">
                <div class="login-img-div">
                    <img src="{{ URL::to('/storage/uploads/web_images/Limage.JPG') }}" alt="" class="custom-radius-dashboard">
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 float-right">
                <div>
                    <div class="container text-center pt-2">
                        <h2>Hey there! let's</h2>
                        {{-- <span><strong>it's always a pleasure to see you</strong></span> --}}
                    </div>
    
                    <div class="mt-4 text-center">
                        <h1><strong>SIGN UP</strong></h1>
                        <div class="register-div" style="height: 300px; overflow: scroll;">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group row col-xl-8 col-lg-8 m-auto">
                                    <div class="mt-2 w-100">
                                        <input
                                            type="text"
                                            class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}"
                                            name="full_name"
                                            value="{{ old('full_name') }}"
                                            placeholder="Your Full Name"
                                        >
                                        @if ($errors->has('full_name'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('full_name') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row col-xl-8 col-lg-8 m-auto">
                                    <div class="mt-2 w-100">
                                        <input
                                            type="text"
                                            class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                            name="username"
                                            value="{{ old('username') }}"
                                            placeholder="Username"
                                        >
                                        @if ($errors->has('username'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row col-xl-8 col-lg-8 m-auto">
                                    <div class="mt-2 w-100">
                                        <input
                                            id="email"
                                            type="email"
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email"
                                            placeholder="Your Email"
                                            value="{{ old('email') }}"
                                            title="test@test.com"
                                            autofocus
                                        >
                                        <div class="mt-2">
                                            <small id="email-error"></small>
                                        </div>
                                        @if ($errors->has('email'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
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
                                <div class="form-group row col-xl-8 col-lg-8 m-auto">
                                    <div class="mt-2 w-100">
                                        <input
                                            type="password"
                                            class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                            name="password_confirmation"
                                            placeholder="Confirm Password"
                                        >
                                        @if ($errors->has('password_confirmation'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row col-xl-8 col-lg-8 m-auto">
                                    <div class="flex-column w-100 mt-4">
                                        <button id="sign" type="submit" class="btn btn-purple w-60">
                                            Sign up
                                        </button>
                                    </div>
                                </div>
        
                            </form>
                        </div>
                        <div class="mt-4">
                            Already a WEFU member?
                            <span class="ml-1">
                                <a href="{{ route('login') }}">Login</a>
                            </span>
                        </div>
                    
                    </div>
                </div>
            </div>                

        </div>
    </div>




@endsection

<script>

    window.onload = function(){

        function isEmail(email) {

            var count = (email.match(/.com./g) || []).length

            return count;
        }

        function isEmail_atrate(email) {

            var count = (email.match(/@/g) || []).length

            return count;
        }

        $("#email").on('keyup', function(){
            
            // console.log(isEmail($(this).val()));
            
            if(isEmail($(this).val()) >= 1 || isEmail_atrate($(this).val()) > 1){
                $("#sign").attr('disabled', true);
                $("#email-error").attr("class", "text-danger");
                $("#email-error").html("Not valid email");
            }else if(isEmail($(this).val()) == 0 && isEmail_atrate($(this).val()) == 1){
                $("#sign").attr('disabled', false);
                $("#email-error").attr("class", "text-success");
                $("#email-error").html("It is a valid email");
            }

            if($(this).val() == ""){
                $("#email-error").attr("hidden", true);
            }else{
                $("#email-error").attr("hidden", false);
            }

        });

    }

</script>
