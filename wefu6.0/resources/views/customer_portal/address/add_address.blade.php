@extends('layouts.app')

{{-- @section('home')
    <li>
        <a href="{{ route('home') }}">Home</a>
    </li>
@endsection --}}

@push('style')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">    
@endpush

@section('content')
    <div class="col-lg-8 custom-radius-dashboard bg-white h-98 mt-1 float-right text-dark">

        <div class="pt-3 pl-4">
            <h3><strong> Add a new address </strong></h3>
            <p>Please fill all required fields correctly</p>
        </div>

        <div class="pl-4 pr-4 add-address-div">
        
            <form role="form" method="POST" action="{{ route('insertAddress', $user[0]->username) }}">
                {!! csrf_field() !!}
                
                <div class="form-group row">
                    <div class="form-group col-lg-6">
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
                    <div class="form-group col-lg-6">
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

                <div class="form-group row">
                    <div class="form-group col-lg-6">
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
                    <div class="form-group col-lg-6">
                        <label for="city" class="col-form-label"><strong> City </strong></label>
                        <div class="ui-widget" style="">
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
                    <div class="form-group col-lg-6">
                        <label for="province" class="col-form-label"><strong> Province </strong></label>
                        <div class="ui-widget">
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
    
                    <div class="form-group col-lg-6">
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

                <div class="form-group row">
                    <div class="form-group col-lg-6">
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

                <div class="row">
                    <div id="msg" class="pl-3 col-lg-6">
                        <p>
                            <strong>Make sure all your details are correct</strong><br/>
                            If the address contains any errors, your package may be undeliverable.
                            <br>
                            <a href="#">Tips for adding address</a>
                        </p>
                    </div>
    
                    <div class="col-lg-6 mt-5">
                        <button type="submit" class="btn btn-purple float-right" id="address_submit">
                            Add address
                        </button>
                    </div>
                </div>

            </form>

        </div>

    </div>
@endsection

@if($user[0]->phone_no != null)
    <script>
        window.onload = function(){
            var phone = document.getElementById("phone_no").setAttribute('disabled', 'disabled');
            $( "#dashboard-options li" ).removeClass( "dashboard-li-selected" );
            $( "#profile" ).addClass( "dashboard-li-selected" );
        } 

    </script>
@else
    <script>
        window.onload = function(){
            var phone = document.getElementById("phone_no").setAttribute('placeholder', "Please add a phone number");
            $( "#dashboard-options li" ).removeClass( "dashboard-li-selected" );
            $( "#profile" ).addClass( "dashboard-li-selected" );
        } 
    </script>
@endif 

@push('script')
    <script
    src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
    integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
    crossorigin="anonymous"></script>

    <script>

        var province_array = ["Balochistan","Punjab", "khyber pakhtunkhwa", "Sindh"];
        $("#province").autocomplete({
            source:province_array
        });
        console.log($("#city").val())        

        var cities_array = [
            // "Karachi","Lahore","Faisalabad","Serai","Rāwalpindi","Multān","Gujrānwāla","Hyderābād City",
            // "Peshāwar","Abbottābād","Islamabad","Quetta","Bannu","Bahāwalpur","Sargodha","Siālkot City",
            // "Sukkur","Lārkāna","Sheikhupura","Mīrpur Khās","Rahīmyār Khān","Kohāt","Jhang Sadr","Gujrāt",
            // "Bardār","Kasūr","Dera Ghāzi Khān","Masīwāla","Nawābshāh","Okāra","Gilgit","Chiniot","Sādiqābād",
            // "Turbat","Dera Ismāīl Khān","Chaman","Zhob","Mehra","Parachinār","Gwādar","Kundiān","Shahdād Kot",
            // "Harīpur","Matiāri","Dera Allāhyār","Lodhrān","Batgrām","Thatta","Bāgh","Badīn","Mānsehra","Ziārat",
            // "Muzaffargarh","Tando Allāhyār","Dera Murād Jamāli","Karak","Mardan","Uthal","Nankāna Sāhib",
            // "Bārkhān","Hāfizābād","Kotli","Loralai","Dera Bugti","Jhang City","Sāhīwāl","Sānghar","Pākpattan",
            // "Chakwāl","Khushāb","Ghotki","Kohlu","Khuzdār","Awārān","Nowshera","Chārsadda","Qila Abdullāh",
            // "Bahāwalnagar","Dādu","Alīābad","Lakki Marwat","Chilās","Pishin","Tānk","Chitrāl","Qila Saifullāh",
            // "Shikārpur","Panjgūr","Mastung","Kalāt","Gandāvā","Khānewāl","Nārowāl","Khairpur","Malakand",
            // "Vihāri","Saidu Sharif","Jhelum","Mandi Bahāuddīn","Bhakkar","Toba Tek Singh","Jāmshoro","Khārān","Umarkot",
            // "Hangu","Timargara","Gākuch","Jacobābād","Alpūrai","Miānwāli","Naushahro Fīroz","New Mīrpur",
            // "Daggar","Eidgāh","Sibi","Dālbandīn","Rājanpur","Leiah","Upper Dir","Tando Muhammad Khān",
            // "Attock City","Rāwala Kot","Swābi","Kandhkot","Dasu","Athmuqam",
        ]

        $("#city").autocomplete({
            source:cities_array
        });
    </script>

@endpush