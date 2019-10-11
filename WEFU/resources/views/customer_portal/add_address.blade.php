@extends('layouts.app')

@section('home')
    <li>
        <a href="{{ route('home') }}">Home</a>
    </li>
@endsection


@section('content')
    <div class="container p-4 mt-4">

        <div class="w-50 m-auto">
            <h3><strong> Add a new address </strong></h3>
            <p>Please fill all required fields correctly</p>

            <form role="form" method="POST" action="{{ route('insertAddress', $user[0]->username) }}">
                {!! csrf_field() !!}
                
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

                <div id="msg" class="p-3">
                    <p>
                        <strong>Make sure all your details are correct</strong><br/>
                        If the address contains any errors, your package may be undeliverable.
                    </p>

                    <a href="#">Tips for adding address</a>

                </div>

                <div class="form-group col mt-3">
                    <button type="submit" class="btn btn-secondary" id="address_submit">
                        Add address
                    </button>
                </div>
            </form>

        </div>

    </div>
@endsection

@if($user[0]->phone_no != null)
    <script>
        window.onload = function(){
            var phone = document.getElementById("phone_no").setAttribute('disabled', 'disabled');
        } 

    </script>
@else
    <script>
        window.onload = function(){
            var phone = document.getElementById("phone_no").setAttribute('placeholder', "Please add a phone number");
        } 
    </script>
@endif 
