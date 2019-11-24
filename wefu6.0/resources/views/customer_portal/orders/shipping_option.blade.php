@extends('layouts.app')

@section('content')

    <div class="col-lg-10 float-right">
        <div class="container">
            <div class="p-4">
                <h2><strong>Last Step</strong></h2>
                <p>Review and choose an appropriate delivery option</p>
            </div>
        </div>


        <div class="col-lg-8 float-left shadow custom-radius">
            <div class="container pt-4">
                <h4>Choose a delivery option</h4>

                <div class="container">
                    <table class="table table-borderless col-lg-12">
                        <tr>
                            @foreach ($pricing_plans as $item)

                                @if($item->id != 3)
                                    @php
                                        $day = $item->delivery_days - 5;    
                                    @endphp
                                    <th>
                                        <h5>
                                            <strong>{{$day}}-{{$item->delivery_days}} days</strong>
                                        </h5>
                                        <span class="ml-3">{{$item->name}}</span>
                                    </th>
                                @else
                                    <th>
                                        <h5>
                                            <strong>Upto {{$item->delivery_days}} days</strong>
                                        </h5>
                                        <span class="ml-3">{{$item->name}}</span>
                                    </th>
                                @endif
                                
                            @endforeach

                            {{-- <th><h5 class=""><strong>25-30 days</strong></h5> <span class="font-italic ml-3">Basic</span></th>
                            <th><h5><strong>15-20 days</strong></h5><span class="font-italic ml-3">Standard</span></th>
                            <th><h5><strong>Upto 7 days</strong></h5><span class="font-italic ml-3">Premium</span></th> --}}
                        </tr>
                        <tr class="style-line">
                            <td>
                                <input id="radio_btn" class="selected-option" type="radio" name="pricing_selected_option" value="1" checked>
                            </td>
                            <td>
                                <input id="radio_btn" class="selected-option" type="radio" name="pricing_selected_option" value="2">
                            </td>
                            <td>
                                <input id="radio_btn" class="selected-option" type="radio" name="pricing_selected_option" value="3">
                            </td>
                        </tr>

                    </table>
                </div>
                
                <div class="m-5 pl-5 mt-n1">
                    <div class="ml-5 pl-5">
                        <div class="ml-3">
                            <p><strong>Total with Shippment Price</strong></p>
                            <h2 class="mt-n2" id="price_with_shippment"></h2>
                        </div>
                    </div>
                </div>

                <div class="m-5 border-top">
                    <div class="d-flex pt-3">
                        <div class="border-right">
                            <div class="pl-2 pr-3">
                                <p>Delivered to your door by <br>
                                <span class="font-weight-bold" id="shippment_day"></span>
                                </p>
                            </div>
                        </div>

                        <div class="ml-5">
                            <p>Shipping Cost<br>
                            <span class="font-weight-bold" id="shippment_cost"></span>
                            </p>
                        </div>

                        <form role="form" method="post" action="{{route('selectedPricingPlan')}}">
                            @csrf
                            <input id="address_id" type="text" name="address_id" value="{{$address->id}}" hidden>
                            <input id="pp_id" type="text" name="pp_id" value="" hidden>

                            <div class="ml-5 pl-4 pt-2">
                                <button class="btn btn-outline-purple p-2 rounded-pill" type="submit" >Confirm Order<i class="fa fa-long-arrow-right pl-1"></i></button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-4 float-right">
            <div class="container shadow bg-white custom-radius">
                <div class="p-3 pt-4">
                    <h4 class="">Order Summary</h4>
                    <table class="table table-borderless table-sm">
                        <tr>
                            <th>Total Products</th>
                            {{-- @php
                                $total_products = $order->shopping_carts->count();
                            @endphp --}}
                            <td>{{ $total_products }} items</td>
                        </tr>
                        <tr>
                            <th>Subtotal</th>
                            <td id="subtotal_price"></td>
                        </tr>
                    </table>
                    <hr>
                    <table class="table table-borderless table-sm">
                        <tr>
                            <th colspan="2">Delivery Address</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td colspan="2" class="pl-2">
                                {{ $address->delivery_address }}, 
                                {{ $address->city }}, 
                                {{ $address->province }}, 
                                Pakistan.
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Zipcode</th>
                            <td>{{ $address->zipcode }}</td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>

    </div>


    {{-- @php
        echo($pricing_plans);    
        echo($order->address);
    @endphp --}}

@endsection

<script>
    
    window.onload = function(){
        
        document.getElementById("subtotal_price").innerHTML = "<b>PKR</b> " + numberWithCommas({{$total_price}});

        var pricing_array = @json($pricing_plans);
        var value = $("input:radio[name='pricing_selected_option']:checked").val();

        pricing_array.forEach(element => {
            if(element["id"] == value){
                price_sum = parseFloat(element["price"]) + parseFloat({{$total_price}})
                document.getElementById("price_with_shippment").innerHTML = "<b>PKR </b> " + numberWithCommas(price_sum);
                document.getElementById("shippment_cost").innerHTML = numberWithCommas(parseFloat(element["price"]));

                // Setting date
                var delivery_date = new Date();
                delivery_date.setDate(delivery_date.getDate() + parseInt(element["delivery_days"]));
                // console.log(weekdays[delivery_date.getDay()]);
                // console.log(delivery_date.getDate())
                document.getElementById('shippment_day').innerHTML = weekdays[delivery_date.getDay()] + ", " + month_names[delivery_date.getMonth()] + " " + delivery_date.getDate();
            
                document.getElementById("pp_id").value = element["id"]
            }
        });

        
        $("input:radio[name=pricing_selected_option]").change(function(){
            pricing_array.forEach(element => {
                if(element["id"] == this.value){
                    price_sum = parseFloat(element["price"]) + parseFloat({{$total_price}})
                    document.getElementById("price_with_shippment").innerHTML = "<b>PKR </b> " + numberWithCommas(price_sum);
                    document.getElementById("shippment_cost").innerHTML = numberWithCommas(parseFloat(element["price"]));
                
                    // Setting date
                    var delivery_date = new Date();
                    delivery_date.setDate(delivery_date.getDate() + parseInt(element["delivery_days"]));
                    document.getElementById('shippment_day').innerHTML = weekdays[delivery_date.getDay()] + ", " + month_names[delivery_date.getMonth()] + " " + delivery_date.getDate();

                    document.getElementById("pp_id").value = element["id"]
                }
            });
        });

    }

    
</script>

