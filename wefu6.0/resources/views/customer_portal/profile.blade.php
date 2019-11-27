@extends('layouts.app')

@section('content')

<div class="col-lg-8 custom-radius-dashboard bg-white float-right h-98 mt-1 text-dark">

    <div class="p-2">
        
        <ul class="nav nav-tabs mt-3 font-weight-bold" id="myTab" role="tablist">
            <li class="nav-item nav-item-order">
            <a class="nav-link nav-link-order active" id="profile_info_tab" data-toggle="tab" href="#profile_info" role="tab" aria-controls="profile_information" aria-selected="true">Profile Information</a>
            </li>
            <li class="nav-item nav-item-order">
                <a class="nav-link nav-link-order" id="pass_tab" data-toggle="tab" href="#pass_info" role="tab" aria-controls="pass" aria-selected="false">Update Password</a>
            </li>
            <li class="nav-item nav-item-order">
                <a class="nav-link nav-link-order" id="img_tab" data-toggle="tab" href="#img_info" role="tab" aria-controls="img" aria-selected="false">Update Image</a>
            </li>
            <li class="nav-item nav-item-order">
            <a class="nav-link nav-link-order" id="address_tab" data-toggle="tab" href="#add_info" role="tab" aria-controls="addresses" aria-selected="false">Your Addresses</a>
            </li>
        </ul>




        {{-- Tab contents --}}

        <div class="tab-content" id="myTabContent">

            {{-- This for profile information --}}

            <div class="tab-pane fade show active" id="profile_info" role="tabpanel" aria-labelledby="profile_info_tab">
                <div id="infomation" class="p-4">
                    <h4><strong>Profile Information</strong></h4>
                    <p>Setup your profile details</p>
                    
                    <form role="form" method="POST" action="{{ route('profileUpdate', $user[0]->username ) }}" enctype="multipart/form-data">
                        {!! csrf_field() !!}    
                        {{-- <div id="img_div" class="float-right flex-column mr-5">
                            <p class="pl-4 pt-2"> <label for="img_up" class="col-form-label font-weight-bold"> Profile Picture</label></p>
                            <p id="img_up_div" class="pl-2">
                                <img id="img_up" src="{{ URL::to('/storage/uploads/profile_pic/'.$user[0]->profile_img) }}" alt="placeholder" class="rounded-circle" width="150px" height="150px"  />
                            </p>
                            <div class="form-group col mr-3">
                                <label for="profile_img" class="btn btn-light mr-2"> <i class="fa fa-cloud-upload"></i><strong> Upload Image</strong> </label>
                                <input type="file" class="icon-upload" id="profile_img" name="profile_img">
                                <br>
                                @if ($errors->has('profile_img'))
                                    <strong>{{ $errors->first("profile_img") }}</strong>
                                @endif
                            </div>
                            
                        </div> --}}

                        <div class="form-row mt-4">
                            <div class="form-group col-md-5">
                                <label for="full_name">Full Name</label>
                                <input
                                    id="full_name"
                                    type="text"
                                    class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}"
                                    name="full_name"
                                    value="{{$user[0]->full_name}}"
                                    autofocus
                                >

                                @if ($errors->has('full_name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('full_name') }}</strong>
                                    </div>
                                @endif
                                
                            </div>

                            <div class="form-group col-md-5 ml-4">
                                <label for="email">Email</label>
                                <div class="">
                                    <input
                                        id="email"
                                        type="text"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="email"
                                        placeholder="{{$user[0]->email}}"
                                        value=""
                                        autofocus
                                    >
                                    
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                        {{-- NEW Row --}}
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="username" class="col-form-label">Username</label>
                                <div class="input-group mb-3">
                                    <input
                                        id="username"
                                        type="text"
                                        class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}"
                                        name="username"
                                        value="{{$user[0]->username}}"
                                        placeholder=""
                                        autofocus
                                        aria-label="username"
                                        disabled
                                    >
                                    
                                    @if ($errors->has('username'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <small>
                                    You cannot modify username!
                                </small>
                            </div>

                            <div class="form-group col-md-5 ml-4">
                                <label for="phone_no" class="col-form-label">Phone Number</label>
                                <div class="input-group mb-3 d-flex">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-white" id="basic-addon1"> <img src="{{ URL::to('/storage/uploads/icons/phone-alt-solid.svg')}}" alt="" width="15"> </div>
                                    </div>
                                    <input
                                        id="phone_no"
                                        type="text"
                                        class="form-control{{ $errors->has('phone_no') ? ' is-invalid' : '' }}"
                                        name="phone_no"
                                        placeholder=""
                                        value="{{$user[0]->phone_no}}"
                                        autofocus
                                        onkeyup="check_phone_no()"
                                    >
                                    
                                    @if ($errors->has('phone_no'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('phone_no') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <small id="help_text" class="form-text text-muted">
                                    Phone number must be of 11 digits without any special characters.
                                    <br>
                                    <span id="message_phone"></span>
                                </small>
                            </div>
                        </div>
                            
                        <div class="form-row pl-5 mt-3">
                            <div class="form-group col mt-3">
                                <button type="submit" class="btn btn-purple float-right" id="profile_submit">
                                    Update Information
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>              

            {{-- This is for updating password --}}
            <div class="tab-pane fade" id="pass_info" role="tabpanel" aria-labelledby="pass_tab">
            
                <div class="p-4">
                    <h4><strong>Change Password</strong></h4>
                    <p>Fillup all the fields below!</p>

                    <form role="form" method="POST" action="{{ route('profileUpdatePass', $user[0]->username ) }}" enctype="multipart/form-data">
                        {!! csrf_field() !!}

                        <div class="">
                            <div class="form-group col-lg-6">
                                <label for="current_password" class="col-form-label">Current Password</label>
                                <div class="input-group mb-3">
                                    <input
                                        id="current_password"
                                        type="password"
                                        class="form-control {{ $errors->has('current_password') ? ' is-invalid' : '' }}"
                                        name="current_password"
                                        value=""
                                        placeholder="Enter current Password"
                                        autofocus
                                        aria-label="password"
                                        aria-describedby="password"
                                    >
                                    <div class="input-group-postpend">
                                        <button class="btn btn-default border" type="button" id="pass_eye" onclick="change_eye()"><i class="fa fa-eye p-1" id="eye_icon"></i></button>
                                    </div>
                                    @if ($errors->has('current_password'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('current_password') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
        
                            <div class="form-group col-lg-6">
                                <label for="password" class="col-form-label">Password</label>
                                <div class="input-group mb-3">
                                    <input
                                        id="password"
                                        type="password"
                                        class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password"
                                        placeholder="Enter a new password"
                                        value=""
                                        autofocus
                                        onkeyup='check()'
                                        aria-label="password"
                                        aria-describedby="password"
                                    >
                                    <div class="input-group-postpend">
                                        <button class="btn btn-default border" type="button" id="pass_eye" onclick="change_eye()"><i class="fa fa-eye p-1" id="eye_icon"></i></button>
                                    </div>
                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <small id="pass_help" class="form-text text-muted">
                                    Password must be 8 characters long.
                                </small>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="password_confirmation" class="col-form-label">Confirm Password</label>
                                <div class="input-group mb-3">
                                    <input
                                            id="password_confirmation"
                                            type="password"
                                            class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                            name="password_confirmation"
                                            value=""
                                            placeholder="Confirm Password"
                                            onkeyup='check()'
                                            autofocus
                                    >
                                    <div class="input-group-postpend">
                                        <button class="btn btn-default border" type="button" id="confirm_eye" onclick="change_eye_confirm()"><i class="fa fa-eye p-1" id="eye_icon_confirm"></i></button>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <small id="help_text" class="form-text text-muted">
                                    <span id="message"></span>
                                </small>
                            </div>
            
                        </div>
                        
                        <div class="float-right mt-4">
                            <button id="upd_pass" type="submit" class="btn btn-purple">save changes</button>
                        </div>

                    </form>

                </div>
            </div>


            {{-- This one is for address information --}}
            <div class="tab-pane fade address-tab-layout" id="add_info" role="tabpanel" aria-labelledby="address_tab">
                {!! csrf_field() !!}
                <div class="p-4">
                    <h4><strong>Your Addresses</strong></h4>
                    <p>Setup your adress details</p>
                    
                    @php
                        $i = 2;
                    @endphp
                                
                    {{-- If Condition If a user has added an address --}}
                    <div class="card-deck">
                        <div class="col-md-6">
                            <div class="card dashed-card-border">
                                <div class="card-body">
                                    <div class="p-4 m-3">
    
                                        @php
                                            $username = $user[0]->username;
                                        @endphp
    
                                        <a href="{{ route('addAddressPage', $username) }}">
                                            <div class="pl-5 ml-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="36px" height="36px" viewBox="0 0 357 357" style="enable-background:new 0 0 357 357;" xml:space="preserve"><g><g>
                                                    <g id="add">
                                                        <path d="M357,204H204v153h-51V204H0v-51h153V0h51v153h153V204z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#BBBBBB"/>
                                                    </g>
                                                    </g></g> 
                                                </svg>
                                            </div>
                                            <h4 class="a-address pl-5 pt-4"><strong>New Address</strong></h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

  

                        @php
                            $j = 0;                
                        @endphp                  
            
                        @foreach ($user[0]->addresses as $address)

                            @php
                                $j = 0;                
                            @endphp
                            {{-- This is for the first box, Box for adding new address --}}
                            @if($i == 1)        
                                <div class="card-deck mt-4">
                            @endif
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><strong>{{$user[0]->full_name}}</strong></h5>
                                        <p class="card-text">
                                            {{$address->delivery_address}}
                                            <br/>
                                            {{$address->city}}, {{$address->province}}, {{$address->zipcode}}  
                                            <br/>
                                            Pakistan
                                            <br/>
                                            <strong>Phone Number: </strong> {{$user[0]->phone_no}}
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="card-link">Update</a>
                                        <a href="#" class="card-link">Delete</a>
                                    </div>
                                </div>
                            </div>

                            @if($i == 2)
                                </div>
                                @php
                                    $j = 1;    
                                    $i = 0;
                                @endphp

                            @endif

                            @php
                                $i = $i + 1;                
                            @endphp

                        @endforeach

                        @if($j == 0)
                            </div>
                        @endif            
                </div>
                

            </div>
            {{-- FOR UPLOADING IMAGE --}}
            <div class="tab-pane fade" id="img_info" role="tabpanel" aria-labelledby="img_tab">
                
                <div id="infomation" class="p-4">
                    <h4><strong>Update Profile Picture</strong></h4>
                    <p>Upload your profile picture</p>
                    
                    <form role="form" method="POST" action="{{ route('profileUpdate', $user[0]->username ) }}" enctype="multipart/form-data">
                        {!! csrf_field() !!}    
                        <div id="img_div" class="flex-column">
                            <p class="pl-4 pt-2"> <label for="img_up" class="col-form-label font-weight-bold"> Profile Picture</label></p>
                            <p id="img_up_div" class="pl-2">
                                <img id="img_up" src="{{ URL::to('/storage/uploads/profile_pic/'.$user[0]->profile_img) }}" alt="placeholder" class="rounded-circle" width="150px" height="150px"  />
                            </p>
                            <div class="form-group col mr-3">
                                <label for="profile_img" class="btn btn-light mr-2"> <i class="fa fa-cloud-upload"></i><strong> Upload Image</strong> </label>
                                <input type="file" class="icon-upload" id="profile_img" name="profile_img">
                                <br>
                                @if ($errors->has('profile_img'))
                                    <strong>{{ $errors->first("profile_img") }}</strong>
                                @endif
                            </div>
                            
                        </div>
                    </form>    
                </div>    

                {{--  --}}
            </div>
        </div>
    </div>
</div>




@endsection


    <script>

        function imgUpload(){
            console.log("IMG Upload Is Called: ");
        }

        function change_eye(){
            // console.log("In EYE");
            var pwd = document.getElementById("password");
            var icon = document.getElementById("eye_icon")
            if(pwd.getAttribute("type") == "password"){
                pwd.setAttribute("type", "text")
                icon.setAttribute("class", "fa fa-eye-slash p-1");
            }else{
                pwd.setAttribute("type", "password")
                icon.setAttribute("class", "fa fa-eye p-1");
            }
        }

        function change_eye_confirm(){
            // console.log("In EYE");
            var pwd = document.getElementById("password_confirmation");
            var icon = document.getElementById("eye_icon_confirm")
            if(pwd.getAttribute("type") == "password"){
                pwd.setAttribute("type", "text")
                icon.setAttribute("class", "fa fa-eye-slash p-1");
            }else{
                pwd.setAttribute("type", "password")
                icon.setAttribute("class", "fa fa-eye p-1");
            }
        }

        var check = function() {
            var pass = document.getElementById('password');
            var conf_pass = document.getElementById('password_confirmation');
            if ( pass.value == conf_pass.value && pass.value.length >= 8) {
                conf_pass.setAttribute("class", "form-control")                
                document.getElementById('message').style.color = 'green';
                document.getElementById('message').innerHTML = 'Both password matched';
                document.getElementById("upd_pass").setAttribute("type", "submit");
            } 
            else if (pass.value != ""){
                if(pass.value.length < 8){
                    conf_pass.setAttribute("class", "form-control")                
                    document.getElementById('message').style.color = 'red';
                    document.getElementById('message').innerHTML = 'Password must be 8 characters long';                
                }
                else if( pass.value != conf_pass.value){
                    conf_pass.setAttribute("class", "form-control is-invalid")
                    document.getElementById('message').style.color = 'red';
                    document.getElementById('message').innerHTML = 'Password not matched';
                }
                document.getElementById("upd_pass").setAttribute("type", "button");
            }
            else if( pass.value == "" && conf_pass.value == ""){
                document.getElementById('message').innerHTML = '';
            }
        }

        function check_phone_no(){
            var reg = /^\d+$/
            value = document.getElementById("phone_no").value;
            console.log(value.match(reg))
            if(value != ""){
                if(value.match(reg) == null || value.length > 11){
                document.getElementById('message_phone').style.color = 'red';
                document.getElementById('message_phone').innerHTML = 'Please enter a correct phone number';
                return -1;
                }else{
                    document.getElementById('message_phone').innerHTML = '';                
                    return 1;
                }
            }else{
                document.getElementById('message_phone').innerHTML = '';
                return 1;
            }
            
        }


        window.onload = function(){
    
            $( "#dashboard-options li" ).removeClass( "dashboard-li-selected" );
            $( "#profile" ).addClass( "dashboard-li-selected" );
    
            $("#profile_img").change(function (){
                var fileName = $(this).val();
                console.log(fileName);
                // $("#img_up").attr("src", fileName)
                // $(".filename").html(fileName);
            })
        }

    </script>