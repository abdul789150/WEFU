@extends('layouts.app')

@section('content')

    @php
        
        // echo($user[0]->addresses);
        // echo($order[0]);

    @endphp


    <div class="container col-lg-8 bg-white custom-radius-dashboard h-98 mt-1 float-right text-dark" id="">

        <div class="p-4">
            <h4><strong>Select Shippment Address</strong></h4>
            <p>
                You can use the existing address, or you can also create a new address.<br>
                {{-- If you'd like to use an existing address so click the corresponding 
                "Deliver to this address" button.  --}}
            </p>

            @php
                $i = 2;
            @endphp
                
            {{-- If Condition If a user has added an address --}}
            <div class="card-deck">
                <div class="col-lg-6">
                    <div class="card dashed-card-border">
                        <div class="card-body">
                            <div class="p-4 m-4">
    
                                @php
                                    $username = $user[0]->username;
                                @endphp
    
                                <a href="#newaddress" data-toggle="modal" data-target=".address_model">
                                    <div class="pl-5 ml-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="36px" height="36px" viewBox="0 0 357 357" style="enable-background:new 0 0 357 357;" xml:space="preserve"><g><g>
                                            <g id="add">
                                                <path d="M357,204H204v153h-51V204H0v-51h153V0h51v153h153V204z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#BBBBBB"/>
                                            </g>
                                            </g></g> 
                                        </svg>
                                    </div>
                                    <h4 class="a-address pl-5 pt-4"><strong style="">New Address</strong></h4>
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
                    
                    <div class="col-lg-6">
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
                                    <strong>Phone Number: </strong> {{@$user[0]->phone_no}}
                                </p>
                            </div>
    
                            <div class="card-footer bg-white">
                                <a href="#" class="card-link float-left pt-2">Update</a>
                                <form role="form" method="POST" action="{{route('selectedAddress')}}">
                                    @csrf
                                    <div class="float-right">
                                        <input type="text" name="selected_address" value="{{$address->id}}" hidden>
                                        {{-- <input type="text" name="order_id" value="{{$order[0]->id}}" hidden> --}}
                                        <button class="btn btn-purple" type="submit">Deliver to this Address</button>
                                    </div>
                                </form>
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

            {{-- </div>     --}}
        </div>

    </div>



    {{-- MODEL BOX --}}
    <div class="modal fade address_model text-dark" tabindex="-1" role="dialog" aria-labelledby="address_model" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalCenterTitle"> <strong>Setup a new address</strong> </h4>
                    {{-- <p>Please fill all required fields correctly</p> --}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" method="POST" action="{{ route('saveSelectedAddress') }}">
                        {!! csrf_field() !!}
                    <div class="modal-body">

                        <div class="form-group row">
                            <div class="form-group col">
                                <label for="country" class="col-form-label"><strong> Country </strong></label>
                                <div class="">
                                    <input
                                        id="country"
                                        type="text"
                                        class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}"
                                        name="country"
                                        value="Pakistan"
                                        autofocus
                                        disabled
                                    >
                                </div>
                            </div>
                            <div class="form-group col">
                                <label for="full_name" class="col-form-label"><strong> Full Name </strong></label>
                                <div class="">
                                    <input
                                        id="full_name"
                                        type="text"
                                        class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}"
                                        name="full_name"
                                        value="{{$user[0]->full_name}}"
                                        autofocus
                                        disabled
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="form-goup row">
                            <div class="form-group col">
                                <label for="delivery_address" class="col-form-label"><strong> Delivery Address </strong></label>
                                <div class="">
                                    <input
                                        id="delivery_address"
                                        type="text"
                                        class="form-control{{ $errors->has('delivery_address') ? ' is-invalid' : '' }}"
                                        name="delivery_address"
                                        value=""
                                        placeholder="Street and House Number, Apartment, floor, etc"
                                        autofocus
                                    >
                                    @if ($errors->has('delivery_address'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('delivery_address') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col">
                                <label for="city" class="col-form-label"><strong> City </strong></label>
                                <div class="">
                                    <input
                                        id="city"
                                        type="text"
                                        class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}"
                                        name="city"
                                        value=""
                                        autofocus
                                    >
                                    @if ($errors->has('city'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="form-group col">
                                <label for="province" class="col-form-label"><strong> Province </strong></label>
                                <div class="">
                                    <input
                                        id="province"
                                        type="text"
                                        class="form-control{{ $errors->has('province') ? ' is-invalid' : '' }}"
                                        name="province"
                                        value=""
                                        autofocus
                                    >
                                    @if ($errors->has('province'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('province') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
            
                            <div class="form-group col">
                                <label for="zipcode" class="col-form-label"><strong>Zip Code</strong></label>
                                <div class="">
                                    <input
                                        id="zipcode"
                                        type="text"
                                        class="form-control{{ $errors->has('zipcode') ? ' is-invalid' : '' }}"
                                        name="zipcode"
                                        value=""
                                        autofocus
                                    >
                                    @if ($errors->has('zipcode'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('zipcode') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row w-50">
                            <div class="form-group col">
                                <label for="phone_no" class="col-form-label"><strong> Phone Number </strong></label>
                                <div class="">
                                    <input
                                        id="phone_no"
                                        type="text"
                                        class="form-control{{ $errors->has('phone_no') ? ' is-invalid' : '' }}"
                                        name="phone_no"
                                        value=""
                                        placeholder="{{$user[0]->phone_no}}"
                                        autofocus
                                    >
                                    <small class="form-text text-muted">
                                        May be used to assist delivery
                                    </small>
                                    @if ($errors->has('phone_no'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('phone_no') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        {{-- <input type="text" name="order_id" value="{{$order[0]->id}}" hidden> --}}

                        <div id="msg" class="">
                            <p>
                                <strong>Make sure all your details are correct</strong><br/>
                                If the address contains any errors, your package may be undeliverable.
                            </p>
                            <a href="#">Tips for adding address</a>
                        </div>
        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary">Deliver to this address</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@if($user[0]->phone_no != null)
    <script>
        window.onload = function(){
            var phone = document.getElementById("phone_no").setAttribute('disabled', 'disabled');
            $( "#dashboard-options li" ).removeClass( "dashboard-li-selected" );
            $( "#cart" ).addClass( "dashboard-li-selected" );
        } 

    </script>
@else
    <script>
        window.onload = function(){
            var phone = document.getElementById("phone_no").setAttribute('placeholder', "Please add a phone number");
            $( "#dashboard-options li" ).removeClass( "dashboard-li-selected" );
            $( "#cart" ).addClass( "dashboard-li-selected" );
        } 
    </script>
@endif 

<script>

</script>