@extends('layouts.app')

@push('style')
    <style>
        .paid-emoji{
            background-image: url("{{ URL::to('/storage/uploads/icons/greed.svg')}}");
            background-size: cover;
            height: 48px;
            width: 48px;
            margin-top: 45%;
        }
        .sad-emoji{
            background-image: url("{{ URL::to('/storage/uploads/icons/sad.svg')}}");
            background-size: cover;
            height: 48px;
            width: 48px;
            margin-top: 45%;
        }
    </style>
@endpush

@section('content')

    <div class="col-lg-8 custom-radius-dashboard bg-white h-98 mt-1 float-right text-dark">
        
        @if ($message = Session::get('success'))
            <div id="alert" class="mt-4 alert alert-success alert-block col-lg-6 float-right">
                {{$message}}
            </div>
        @endif

        <div class="p-4">
            <h2 class="float-left">My Payments</h2>
        </div>

        <div class="mt-5">
            <ul class="nav nav-tabs mt-3 font-weight-bold" id="myTab" role="tablist">
                <li class="nav-item nav-item-order">
                    <a class="nav-link nav-link-order active" id="payment_history_tab" data-toggle="tab" href="#payment_history_info" role="tab" aria-controls="payment_history" aria-selected="true">Payment History</a>
                </li>
                <li class="nav-item nav-item-order">
                    <a class="nav-link nav-link-order" id="incomplete_payment_tab" data-toggle="tab" href="#incomplete_payment_info" role="tab" aria-controls="incomplete_payment" aria-selected="false">Incomplete Payments</a>
                </li>
            </ul>
        {{-- Tab layout div --}}
        <div class="tab-content" id="myTabContent">
            {{-- PAYMENT HISTORY SECTION --}}
            <div class="tab-pane fade show active" id="payment_history_info" role="tabpanel" aria-labelledby="payment_history_tab">
                @php
                    $i = 0;
                @endphp

                @if ($completed_payments->count() == 0)
                    <div class="mt-4 text-danger text-center">
                        <h5>No Record Found</h5>
                    </div>  
                @else
                    <div class="invoice-deck">
                        @foreach ($completed_payments as $item)
                        @if ($i == 0)
                            <div class="card-deck col-lg-12 mt-4">
                        @endif
                            {{-- //////////////////////////////////////// --}}
                            {{-- card --}}
                            <div class="card bg-white invoice-card col-lg-4 shadow" style="font-size: 12px;">
                                <div class="invoice-card-head">
                                    <div class="pl-4 pt-4 ml-2 col-lg-6 float-left">
                                        <h4>Invoice</h4>
                                        <div class="mt-n2">
                                            <span>{{$item->order_number}}</span> <br>
                                            <span><strong id="date-{{$item->id}}"></strong></span>
                                            <script>
                                                var temp_date = "{{$item->updated_at}}";
                                                var str = temp_date.split(" ");
                                                var final_date = str[0].split("-");
                                                console.log('{{$item->id}} : ' + final_date)
    
                                                document.getElementById("date-{{$item->id}}").innerHTML = final_date[2] +" "+month_names[final_date[1] -1].slice(0, 3)+" "+final_date[0];
                                            </script>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 float-right">
                                        <div class="paid-emoji">
                                        </div>
                                    </div>
                                </div>
                                <div class="invoice-card-body">
                                    <div class="row ml-3 mr-3 rounded mt-4 p-2 invoice-custom-back shadow-sm">
                                        <div class="col-lg-6 text-left">
                                            <span style="font-weight:600;">Details</span>
                                        </div>
                                        <div class="col-lg-6 text-right mt-1">
                                            <span><strong class="invoice-text">PRICE</strong></span>
                                        </div>
                                    </div>
            
                                    <div class="row ml-1 mr-1 mt-3 rounded pl-2 pr-2">
                                        <div class="col-lg-6 text-left">
                                            <span>Billing Amount</span><br>
                                            {{-- Calculating cart products --}}
                                            
                                            @php
                                                $quantity = 0;
                                            @endphp
    
                                            @foreach ($item->shopping_carts as $cart)
                                                @php
                                                    $quantity = $cart->quantity + $quantity;                                                
                                                @endphp
                                            @endforeach
    
                                            @if ($quantity > 1)
                                                <strong>{{$quantity}} items</strong>                                            
                                            @else
                                                <strong>{{$quantity}} item</strong>
                                            @endif
                                        </div>
                                        <div class="col-lg-6 text-right">
                                            <br>
                                            <strong>PKR </strong><span id="item-price-{{$item->id}}"></span>
                                            <script>
                                                document.getElementById("item-price-{{$item->id}}").innerHTML = numberWithCommasInvoice({{$item->total_price}}); 
                                            </script>
    
                                        </div>
                                    </div>
                                    <hr class="ml-3 mr-3">
                                    <div class="row ml-1 mr-1 mt-n1 rounded pl-2 pr-2">
                                        <div class="col-lg-6 text-left">
                                            Selected Plan <br>
                                            <strong>{{$item->pricing_plan->name}}</strong>
                                        </div>
                                        <div class="col-lg-6 text-right">
                                            <br>
                                            <strong>PKR </strong><span id="item-plan-{{$item->id}}"></span>
                                            <script>
                                                document.getElementById("item-plan-{{$item->id}}").innerHTML = numberWithCommasInvoice({{$item->pricing_plan->price}}); 
                                            </script>
                                        </div>
                                    </div>
                                    <div class="row ml-2 mr-2 mt-4 rounded p-2 invoice-custom-back shadow-sm">
                                        <div class="col-lg-6 text-left">
                                            <span class="invoice-text">TOTAL PRICE:</span>
                                        </div>
                                        <div class="col-lg-6 text-right ml-n2">
                                            <strong>PKR </strong><span id="item-total-price-{{$item->id}}"></span>
                                            <script>
                                                document.getElementById("item-total-price-{{$item->id}}").innerHTML = numberWithCommasInvoiceTotal({{$item->total_price}} , {{$item->pricing_plan->price}});                                        
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- card --}}
                            {{-- </div> --}}
                
                            {{-- /////////////////////////////////////// --}}
                            @php
                                $i = $i + 1;
                            @endphp
                
                            @if ($i == 3)
                                </div>
                                @php
                                    $i = 0;
                                @endphp
                            @endif
                
                        @endforeach
            
                        @if($i != 0)
                            </div>
                        @endif
    
                    </div>                    
                @endif

       
            </div>
        

            {{-- Payment Completed SECTION --}}
            <div class="tab-pane fade" id="incomplete_payment_info" role="tabpanel" aria-labelledby="incomplete_payment_tab">
                {{-- INCOMPLETE SECTION STARTING --}}
                @php
                    $i = 0;
                @endphp

                @if ($incomplete_payments->count() == 0)
                    <div class="mt-4 text-danger text-center">
                        <h5>No Record Found</h5>
                    </div>
                @else
                    <div class="invoice-deck">
                        @foreach ($incomplete_payments as $item)
                            @if ($i == 0)
                                <div class="card-deck col-lg-12 mt-4">
                            @endif
                            {{-- //////////////////////////////////////// --}}
                            {{-- card --}}
                            <div class="card bg-white invoice-card col-lg-4 shadow" style="font-size: 12px;">
                                <div class="invoice-card-head">
                                    <div class="pl-4 pt-4 ml-2 col-lg-6 float-left">
                                        <h4>Invoice</h4>
                                        <div class="mt-n2">
                                            <span>{{$item->order_number}}</span> <br>
                                            <span><strong id="date-{{$item->id}}"></strong></span>
                                            <script>
                                                var temp_date = "{{$item->updated_at}}";
                                                var str = temp_date.split(" ");
                                                var final_date = str[0].split("-");
                                                console.log('{{$item->id}} : ' + final_date)
    
                                                document.getElementById("date-{{$item->id}}").innerHTML = final_date[2] +" "+month_names[final_date[1] -1].slice(0, 3)+" "+final_date[0];
                                            </script>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 float-right">
                                        <div class="sad-emoji">
                                        </div>
                                    </div>
                                </div>
                                <div class="invoice-card-body">
                                    <div class="row ml-3 mr-3 rounded mt-4 p-2 invoice-custom-back shadow-sm">
                                        <div class="col-lg-6 text-left">
                                            <span style="font-weight:600;">Details</span>
                                        </div>
                                        <div class="col-lg-6 text-right mt-1">
                                            <span><strong class="invoice-text">PRICE</strong></span>
                                        </div>
                                    </div>
            
                                    <div class="row ml-1 mr-1 mt-3 rounded pl-2 pr-2">
                                        <div class="col-lg-6 text-left">
                                            <span>Billing Amount</span><br>
                                            {{-- Calculating cart products --}}
                                            
                                            @php
                                                $quantity = 0;
                                            @endphp
    
                                            @foreach ($item->shopping_carts as $cart)
                                                @php
                                                    $quantity = $cart->quantity + $quantity;                                                
                                                @endphp
                                            @endforeach
    
                                            @if ($quantity > 1)
                                                <strong>{{$quantity}} items</strong>                                            
                                            @else
                                                <strong>{{$quantity}} item</strong>
                                            @endif
                                        </div>
                                        <div class="col-lg-6 text-right">
                                            <br>
                                            <strong>PKR </strong><span id="item-price-{{$item->id}}"></span>
                                            <script>
                                                document.getElementById("item-price-{{$item->id}}").innerHTML = numberWithCommasInvoice({{$item->total_price}}); 
                                            </script>
    
                                        </div>
                                    </div>
                                    <hr class="ml-3 mr-3">
                                    <div class="row ml-1 mr-1 mt-n1 rounded pl-2 pr-2">
                                        <div class="col-lg-6 text-left">
                                            Selected Plan <br>
                                            <strong>{{$item->pricing_plan->name}}</strong>
                                        </div>
                                        <div class="col-lg-6 text-right">
                                            <br>
                                            <strong>PKR </strong><span id="item-plan-{{$item->id}}"></span>
                                            <script>
                                                document.getElementById("item-plan-{{$item->id}}").innerHTML = numberWithCommasInvoice({{$item->pricing_plan->price}}); 
                                            </script>
                                        </div>
                                    </div>
                                    <div class="row ml-3 mr-3 mt-4 rounded p-2">
                                        <a href="{{route('payNow', $item->id)}}" class="btn btn-invoice-card" style="width: 100%;">Pay Now</a>
                                    </div>
                                </div>
                            </div>
                            {{-- card --}}
                            {{-- </div> --}}
                
                            {{-- /////////////////////////////////////// --}}
                            @php
                                $i = $i + 1;
                            @endphp
                
                            @if ($i == 3)
                                </div>
                                @php
                                    $i = 0;
                                @endphp
                            @endif
                
                        @endforeach
            
                        @if($i != 0)
                            </div>
                        @endif
    
                    </div>                    
                @endif


                {{-- INCOMPLETE SECTION EDING --}}
            </div>
            {{-- Ending of tab-content --}}    
        </div>
        
    </div>


@endsection


<script>

    function numberWithCommasInvoice(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function numberWithCommasInvoiceTotal(total_price, pp_price){
        sum = total_price + pp_price;
        return sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    var month_names = new Array(
        "January", "Feburary", "March", "April", "May", "June", "July", "August", "September",
        "October", "November", "December"  
    );

    // main()
    window.onload = function(){
        $( "#dashboard-options li" ).removeClass( "dashboard-li-selected" );
        $( "#payments" ).addClass( "dashboard-li-selected" );

        $("#alert").fadeTo(1000, 500).slideUp(500, function(){
            $("#alert").slideUp(500);
        });
    }
    // function search_payment(){
    //     var input = document.getElementById("order_search").value;
    //     var orders = document.getElementsByClassName("order_card");
    //     var order_num = document.getElementsByClassName("order_number");
    //     console.log("ok");
    //     for(i = 0; i<order_num.length; i++){
    //         if(!order_num[i].innerHTML.includes(input)){
    //             orders[i].style.display = "none";
    //         }else{
    //             orders[i].style.display = "block";
    //         }
    //     }
    // }
</script>