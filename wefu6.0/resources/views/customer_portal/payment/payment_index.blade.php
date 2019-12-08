@extends('layouts.app')

@section('content')


    <div class="col-lg-8 custom-radius-dashboard bg-white float-right h-98 mt-1 text-dark">
        <div class="p-4">
            <h2>Payment Methods</h2>
            <p>Selecct an appropiate payment method</p>
        </div>


        <div>
        {{-- Payment Stripe --}}

            <form action="/charge" method="post" id="payment-form">
                <div class="form-row">
                    <label for="card-element">
                        Credit or debit card
                    </label>
                    <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>
                
                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                </div>
            
                <button>Submit Payment</button>
            </form>

        {{-- Ending payment Stripe --}}
        </div>

    </div>

@endsection
<script>
</script>

@push('ScriptStack')
    

<script>

    // Create a Stripe client.
    var stripe = Stripe('pk_test_E01OrgvC1JKzEpKPzIGxhY8400nCIBmagQ');

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)


    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createToken(card).then(function(result) {
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

    // Submit the form
    form.submit();
    }
</script>
@endpush