@extends('layouts.app')

@section('content')

    <div class="col-lg-10 float-right">
        <div class="p-4 pl-4">
            <h3><strong>Order Confirmation</strong></h3>
            <p>Thanks for your order!</p>
        </div>

    </div>

    <div class="container mt-5">

        <div class="col-lg-10 float-right shadow custom-radius">

            <div class="pt-4">
                
                <div class="p-2">
                    
                    <div class="col-lg-8 float-left border-right rounded">
    
                        <h3>Order Details</h3>
    
                        <div class="confirm-table-div pt-1" id="scroll-bar">
                            <table class="table table-borderless table-sm" style="font-size: 0.9rem;">
                                <tr class="confirm-tr border-bottom">
                                    <th class="text-muted">#</th>
                                    <th class="text-muted">Description</th>
                                    <th class="text-muted">Quantity</th>
                                    <th class="text-muted">Price</th>
                                </tr>
        
                                @php
                                    $i = 1;
                                @endphp                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
        
                                @foreach ($cart_products as $item)
                                    
                                    <tr class="confirm-tr confirm-tr-products border-bottom">
                                        <td class="text-muted">{{$i}}</td>
                                        <td>
                                            <div class="d-flex pl-3">
                                                <div class="img-container">
                                                    <img src="{{$item->product_img_link}}" alt="{{$item->product_name}}">
                                                </div>
                                                <p class="d-inline-block text-truncate font-weight-bold pl-3" style="max-width: 180px; font-size: 0.85rem;">
                                                    {{$item->product_name}}
                                                </p>
                                            </div>
                                        </td>
                                        <td>
                                            {{$item->quantity}}x
                                        </td>
                                        <td>
                                            <b>PKR</b> {{$products_pkr_price[$item->id]}}
                                        </td>
                                    </tr>
            
                                    @php
                                        $i = $i + 1;                                
                                    @endphp
        
                                @endforeach
        
                            </table>
                            
                        </div>
    
                    </div>
        
                    <div class="col-lg-4 float-right">
                        <h4>Order Summary</h4>
                        
                        <div class="confirm-order-summary">
                            <table class="table table-borderless table-sm" style="font-size: 0.87rem;">
                                <tr>
                                    <th class="text-muted">Total Items</th>
                                    <td>{{$total_products}}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Products Price</th>
                                    <td id="total_price"></td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Custom Tax Total</th>
                                    <td>PKR 1,499</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted">Shippment Fee</th>
                                    <td id="shippment_fee"></td>
                                </tr>
                                <tr>
                                    <th class="text-muted pt-3">Order Total</th>
                                    <td id="order_total_price" class="pt-3"></td>
                                </tr>
    
                            </table>
                                
                            {{-- Another table --}}
                            <table class="table table-borderless table-sm" style="font-size: 0.87rem;">
                                <tr>
                                    <th class="">We will deliver to</th>
                                </tr>
                                <tr>
                                    <th class="text-muted">
                                        {{$address->user->full_name}}<br>
                                        {{$address->delivery_address}}, <br>
                                        {{$address->city}} - {{$address->zipcode}} <br>
                                        Pakistan <br>
                                        {{$address->user->phone_no}}
                                    </th>
                                </tr>
                            </table>
    
                        </div>
                        {{-- <hr> --}}
                        <div class="p-1 float-right">
                            <button id="place_order" class="btn btn-outline-purple p-2">
                                Place Order
                            </button>
                        </div>

                    </div>
                    
                    <div class="col-lg-8 float-left">
                        <div class="p-4 mt-1">
                            <p>
                                Delivered to your door by <br>
                                <span class="font-weight-bold" id="shippment_day"></span>
                            </p>

                        </div>
                    </div>



                </div>
                
    
            </div>
    
        </div>

    </div>


    {{-- ///////////////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\ --}}
    <!-- Modal -->
    <div class="modal fade" id="confirmationModel" tabindex="-1" role="dialog" aria-labelledby="confirmationModelTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <a href="{{route('home')}}" class="btn close">
                    <span aria-hidden="true">&times;</span>
                </a>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    
                </button> --}}
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <div class="success-checkmark">
                        <div class="check-icon">
                            <span class="icon-line line-tip"></span>
                            <span class="icon-line line-long"></span>
                            <div class="icon-circle"></div>
                            <div class="icon-fix"></div>
                        </div>
                    </div>

                    <p>
                        Hey {{$address->user->full_name}},
                        <h5><strong>Your Order is Confirmed!</strong></h5>
                        We will send you a confirmation email, with your order receipt
                    </p>

                </div>
                <div class="mt-2">
                    <div class="float-left mt-2">
                        <a href="#" class="btn btn-purple ml-2">Pay Later</a>
                    </div>
                    <div class="float-right mt-2">
                        <a href="#" class="btn btn-orange mr-2">Pay Now</a>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>

    {{-- Error Modal --}}
    <div class="modal fade" id="errorModel" tabindex="-1" role="dialog" aria-labelledby="errorModelTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <p>
                        Sorry {{$address->user->full_name}},
                        <h5 style="color: red"><strong>Your Order is Not Confirmed!</strong></h5>
                        please try again
                    </p>

                </div>

            </div>
            </div>
        </div>
    </div>

    <form id="place_order_form">
        @csrf
        <input type="text" name="pp_id" id="pricing_plan_id" value="{{$pricing_plan->id}}" hidden>
        <input type="text" name="address_id" id="address_id" value="{{$address->id}}" hidden>
        {{-- <input type="text" name="total_price" id="total_price_id" value="{{$total_price}}" hidden> --}}
        {{-- <button type="submit">place</button> --}}
    </form>



@endsection

<script>

    window.onload = function(){
        $("#confirmationModel").modal('show');
        document.getElementById("total_price").innerHTML = "PKR " + numberWithCommas({{$total_price}})
        document.getElementById("shippment_fee").innerHTML = "PKR " + numberWithCommas({{$pricing_plan->price}})                

        price_sum = parseFloat({{$pricing_plan->price}}) + parseFloat({{$total_price}})
        document.getElementById("order_total_price").innerHTML = "PKR "+ numberWithCommas(price_sum);

        var delivery_date = new Date();
        delivery_date.setDate(delivery_date.getDate() + parseInt({{$pricing_plan->delivery_days}}));
        document.getElementById('shippment_day').innerHTML = weekdays[delivery_date.getDay()] + ", " + month_names[delivery_date.getMonth()] + " " + delivery_date.getDate();
   
   
        $("#place_order").click(function () {
            $("#place_order").prop("disabled",true);
            var form_data = $("#place_order_form").serializeArray();
            $.ajax({
                method: "POST",
                url: "{{route('placeOrder')}}",
                data: form_data,
                cache: false,
                success: function(result){
                    $("#confirmationModel").modal('show');
                    $(".check-icon").hide();
                    setTimeout(function () {
                        $(".check-icon").show();
                    }, 25);
                    $("#pp_id").attr('value', ' ');
                    $("address_id").attr('value', ' ');
                },
                error: function(result){
                    console.log("Sorry bro try again");
                    $("#errorModel").modal('show');
                    $("#place_order").prop("disabled",false);
                }
        
            });

        });

        $('#place_order_form').submit(function(){
            return false;
        });
   
    }
    // var value = @json($products_pkr_price)
    // document.getElementById("price_td").innerHTML = "<b>PKR</b> " + numberWithCommas(value[{{}}]);

</script>