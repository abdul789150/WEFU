@extends('layouts.app')

@push("style")
    <style>
        .StripeElement {
            box-sizing: border-box;

            height: 40px;

            padding: 10px 12px;

            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;

            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }
        .custom-inputs{
            width: 100%;
            box-sizing: border-box;

            height: 40px;

            padding: 10px 12px;

            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;

            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }
        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
@endpush

@section('content')


    <div class="col-lg-8 custom-radius-dashboard bg-white float-right h-98 mt-1 text-dark">

        @if ($message = Session::get('success'))
            <div id="alert" class="mt-4 alert alert-success alert-block col-lg-6 float-right">
                {{$message}}
            </div>

        @elseif ($message = Session::get('error'))
            
            <div id="alert" class="mt-4 alert alert-danger alert-block col-lg-6 float-right">
                {{ $message }}
            </div>
        @endif

        <div class="pt-4 pl-4">
            <h2>Pay With Card</h2>
            <p>You can pay the amount by using debit or credit card.</p>
        </div>

        <div class="col-lg-8 m-auto custom-radius shadow" style="background-color: #F9FBFD;">
        {{-- Payment Stripe --}}
            <form action="{{route('paymentCheckout')}}" method="post" id="payment-form">
                @csrf
                <div class="p-4">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" type="text" class="custom-inputs" value="{{$order->user->full_name}}" name="full_name">
                    </div>
                    <div class="row mt-n1">
                        <div class="col-lg-6 from-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="custom-inputs" value="{{$order->user->email}}" name="email">
                        </div>
                        <div class="col-lg-6 from-group">
                            <label for="phone">Phone</label>
                            <input id="phone" type="text" class="custom-inputs" value="{{$order->user->phone_no}}" name="phone_no">
                        </div>
                    </div>
                    
                    <div class="form-group mt-2">
                        <label for="address">Address</label>
                        <input id="address" type="text" class="custom-inputs" value="{{$order->address->delivery_address}}" name="address">
                    </div>

                    <div class="row mt-n1">
                        <div class="col-lg-4 from-group">
                            <label for="city">City</label>
                            <input id="city" type="text" class="custom-inputs" value="{{$order->address->city}}" name="city">
                        </div>
                        <div class="col-lg-4 from-group">
                            <label for="province">Province</label>
                            <input id="province" type="text" class="custom-inputs" value="{{$order->address->province}}" name="province">
                        </div>
                        <div class="col-lg-4 from-group">
                            <label for="zipcode">Zipcode</label>
                            <input id="zipcode" type="text" class="custom-inputs" value="{{$order->address->zipcode}}" name="zipcode">
                        </div>
                    </div>
                    <div class="form-group mt-2"> 
                        <label for="card-element">
                            Card Information
                        </label>
                        <div id="card-element" class="">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>
                    
                        <!-- Used to display form errors. -->
                        <div id="card-errors" class="text-danger" role="alert"></div>
                    </div>
                    <input type="text" name="order_id" id="order" value="{{$order->id}}" hidden>
                    <button id="price_btn" class="btn btn-stripepayment w-100" style="height: 40px;"></button>
                </div>     
            </form>
        {{-- Ending payment Stripe --}}
        </div>

    </div>

@endsection

<script>
    window.onload = function(){
        $( "#dashboard-options li" ).removeClass( "dashboard-li-selected" );
        $( "#payments" ).addClass( "dashboard-li-selected" );

        $("#alert").fadeTo(1000, 500).slideUp(500, function(){
            $("#alert").slideUp(500);
        });
        
        $("#price_btn").html("Pay PKR "+numberWithCommas({{$order->total_price}} + {{$order->pricing_plan->price}}));

    }

</script>

@push('script')
    <script src="https://js.stripe.com/v3/"></script>
    <script>

        // Create a Stripe client.
        var stripe = Stripe('pk_test_E01OrgvC1JKzEpKPzIGxhY8400nCIBmagQ');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
            color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style,
            hidePostalCode: true,
        });

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        var options = {
            name: document.getElementById("name").value,
            address_line1: document.getElementById("address").value,
        }
        
        stripe.createToken(card, options).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            
            // alert(token.id);
            // Submit the form
            form.submit();
        }
    </script>    
@endpush
