@extends('layouts.app')

@section('content')

    <div class="col-lg-8 custom-radius-dashboard bg-white h-98 mt-1 float-right text-dark">

        {{-- <a href="{{route('completedOrders')}}" class="btn btn-outline-purple">Completed Orders</a>
        <a href="{{route('incompleteOrders')}}" class="btn btn-outline-orange">Incomplete Orders</a> --}}

        <div class="p-4">
            <h2 class="float-left">My Orders</h2>

            <div class="col-xl-6 col-lg-6 float-right d-flex">
                <div class="search-container rounded-pill shadow-sm bg-white pl-4 pr-2">
                    <i class="fa fa-search searchIcon mr-n4"></i> 
                    <input class="order-search-bar rounded-pill" type="search" name="" id="order_search" value="" placeholder="Your order number example #123456" onkeyup="search_order()">
                </div>
                <button class="btn btn-orange rounded-pill ml-2 shadow-sm" style="width: 120px;">Search</button>
            </div>

        </div>

        <div class="mt-5">
            <ul class="nav nav-tabs mt-3 font-weight-bold" id="myTab" role="tablist">
                <li class="nav-item nav-item-order">
                    <a class="nav-link nav-link-order active" id="completed_order_info_tab" data-toggle="tab" href="#completed_order_info" role="tab" aria-controls="completed_order_information" aria-selected="true">Completed Orders</a>
                </li>
                <li class="nav-item nav-item-order">
                    <a class="nav-link nav-link-order" id="incomplete_order_tab" data-toggle="tab" href="#incomplete_order_info" role="tab" aria-controls="incomplete_order" aria-selected="false">Incomplete Orders</a>
                </li>
            </ul>


            <div class="tab-content" id="myTabContent">
                {{-- This for Completed Orders --}}
        
                <div class="tab-pane fade orders-tab-layout show active" id="completed_order_info" role="tabpanel" aria-labelledby="completed_order_info_tab">
                    
                    @php
                        $i = 0;    
                    @endphp

                    @if ($completed_orders->count() == 0)
                        <div class="mt-4 text-danger text-center">
                            <h5>No Record Found</h5>
                        </div>                        
                    @else
                        @foreach ($completed_orders as $order)
                            @if($i == 0)
                                <div class="ml-n4 mt-4 card-deck">
                            @endif
                            
                            <div class="col-xl-5 col-lg-6 col-md-10 col-sm-10 col-12 order_card">
                                <div class="card mr-n4 bg-white shadow custom-radius">
                                    <div class="card-body">
                                        <div class="card-title pb-3">
                                            <div id="price_section" class="float-right d-flex">
                                                <span class="mr-n3" id="price" style="font-size: 0.75rem; font-weight: bolder">
                                                    PKR {{$order->formatted_price}}
                                                </span>
                                                <span class="price-circle ml-n4 mt-n2"></span>
                                            </div>
                                            <span class="font-weight-bold order_number" style="font-size: 0.9375rem;">#{{$order->id}}</span>
                                        </div>
                                        {{-- <hr> --}}
                                        <div id="purchase_section" class="mt-4">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-sxm-6 col-6 float-right">
                                                <div class="d-flex order-th">
                                                    <span class="pl-2 pr-3">Date</span>
                                                    <span class="pl-4">Time</span>
                                                </div>
                                                <div class="d-flex order-tr pt-2">
                                                    <span class="pr-2">{{$order->date}}</span>
                                                    <span class="pl-3 pr-1">{{$order->time}}<span class="p-1 bg-dark text-white rounded">{{$order->midday_val}}</span></span>
                                                </div>
                                            </div>
                                            <span class="section-text">Purchase</span>
                                        </div>
                                        <hr class="w-75">
                                        <div id="payment_section" class="">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-sxm-6 col-6 float-right">
                                                <div class="d-flex order-th">
                                                    <span class="pl-2 pr-3">Date</span>
                                                    <span class="pl-4">Using</span>
                                                </div>
                                                <div class="d-flex order-tr pt-1">
                                                    <span class="pt-1">31/12/2019</span>
                                                    <div class="ml-3 order-logo-section-2">
                                                        <img class="rounded-circle" src="{{ URL::to('/storage/uploads/web_images/easypaisa_logo.png') }}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="section-text">Payment</span>
                                        </div>
                                        <hr class="w-75">
                                        <div id="shippment_section" class="">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-sxm-6 col-6 float-right">
                                                <div class="d-flex order-th">
                                                    <span class="pl-2">Date</span>
                                                    <span class="pl-3">FULLFILLED BY</span>
                                                </div>
                                                <div class="d-flex order-tr pt-1">
                                                    <span class="pt-1">31/12/2019</span>
                                                    <div class="ml-4 order-logo-section">
                                                        <img class="rounded-circle" src="{{ URL::to('/storage/uploads/web_images/tcs.png') }}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="section-text">Shipped to You</span>
                                        </div>
                                        {{-- <div class="pl-5 pr-5">
                                            <hr>
                                        </div> --}}
                                        <div class="mt-5 pt-2">
                                            <div class="d-flex justify-content-center">
                                                <a href="#" class="btn btn-orange custom-radius" style="font-size: 0.80rem;">See Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            {{-- END OF LOOP --}}
                            @php
                                $i = $i + 1;
                            @endphp
                            @if($i == 2)
                                </div>
                                @php
                                    $i = 0;
                                @endphp
                            @endif
                        @endforeach
                        @if($i != 0)                            
                            </div>
                        @endif                        
                    @endif

                </div>


                {{-- INCOMPLETE ORDERS SECTION --}}
                <div class="tab-pane fade orders-tab-layout" id="incomplete_order_info" role="tabpanel" aria-labelledby="incomplete_order_tab">

                    @php
                        $i = 0;    
                    @endphp

                    @if ($incomplete_orders->count() == 0)
                        <div class="mt-4 text-danger text-center">
                            <h5>No Record Found</h5>
                        </div>                        
                    @else
                        @foreach ($incomplete_orders as $order)
                            @if($i == 0)
                                <div class="m-auto card-deck">
                            @endif
                            
                            @if ($order->is_delivered == flase || $order->payment_completed == false)
                                <div class="col-xl-5 col-lg-6 col-md-10 col-sm-10 col-12 order_card mt-4 ml-4">
                                    <div class="card mr-n4 bg-white shadow custom-radius">
                                        <div class="card-body">
                                            <div class="card-title pb-3">
                                                <div id="price_section" class="float-right d-flex">
                                                    <span class="mr-n3" id="price" style="font-size: 0.75rem; font-weight: bolder">
                                                        PKR {{$order->formatted_price}}
                                                    </span>
                                                    <span class="price-circle ml-n4 mt-n2"></span>
                                                </div>
                                                <span class="font-weight-bold order_number" style="font-size: 0.9375rem;">#{{$order->id}}</span>
                                            </div>
                                            {{-- <hr> --}}
                                            <div id="purchase_section" class="mt-4">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-sxm-6 col-6 float-right">
                                                    <div class="d-flex order-th">
                                                        <span class="pl-2 pr-3">Date</span>
                                                        <span class="pl-4">Time</span>
                                                    </div>
                                                    <div class="d-flex order-tr pt-2">
                                                        <span class="pr-2">{{$order->date}}</span>
                                                        <span class="pl-3 pr-1">{{$order->time}}<span class="p-1 bg-dark text-white rounded">{{$order->midday_val}}</span></span>
                                                    </div>
                                                </div>
                                                <span class="section-text">Purchase</span>
                                            </div>
                                            <hr class="w-75">
                                            <div id="payment_section" class="">
                    
                                                @if ($order->payment_completed == true)
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-sxm-6 col-6 float-right">
                                                        <div class="d-flex order-th">
                                                            <span class="pl-2 pr-3">Date</span>
                                                            <span class="pl-4">Using</span>
                                                        </div>
                                                        <div class="d-flex order-tr pt-1">
                                                            <span class="pt-1">31/12/2019</span>
                                                            <div class="ml-3 order-logo-section-2">
                                                                <img class="rounded-circle" src="{{ URL::to('/storage/uploads/web_images/easypaisa_logo.png') }}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="section-text">Payment</span>                                
                                                @else
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-sxm-6 col-6 float-right">
                                                        <div class="border-danger-2 order-th-1">
                                                            <span class="due-error pl-3">Payment due</span>
                                                        </div>
                                                    </div>
                                                    <span class="section-text">Payment</span>
                                                @endif
                    
                                            </div>
                                            <hr class="w-75">
                                            <div id="shippment_section" class="">
                    
                                                @if ($order->is_delivered == true)
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-sxm-6 col-6 float-right">
                                                        <div class="d-flex order-th">
                                                            <span class="pl-2">Date</span>
                                                            <span class="pl-3">FULLFILLED BY</span>
                                                        </div>
                                                        <div class="d-flex order-tr pt-1">
                                                            <span class="pt-1">31/12/2019</span>
                                                            <div class="ml-4 order-logo-section">
                                                                <img class="rounded-circle" src="{{ URL::to('/storage/uploads/web_images/tcs.png') }}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                        
                                                @else
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-sxm-6 col-6 float-right">
                                                        <div class="border-danger-2 order-th-1">
                                                            <span class="due-error pl-3">Shippment due</span>
                                                        </div>
                                                    </div>
                                                    <span class="section-text">Shipped to You</span>
                                                @endif
                        
                                            </div>
                                            <div class="mt-5 pt-2">
                                                <div class="d-flex justify-content-center">
                                                    <a href="#" class="btn btn-orange custom-radius" style="font-size: 0.80rem;">See Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                            
                            @endif

                
                            {{-- END OF LOOP --}}
                            @php
                                $i = $i + 1;
                            @endphp
                            @if($i == 2)
                                </div>
                                @php
                                    $i = 0;
                                @endphp
                            @endif
                        @endforeach
                        @if($i != 0)                            
                            </div>
                        @endif                        
                    @endif

 

                </div>

                {{-- END OF INCOMPLETE SECTION --}}
            </div>   
        </div>


    </div>


@endsection


<script>
    // main()
    window.onload = function(){
        $( "#dashboard-options li" ).removeClass( "dashboard-li-selected" );
        $( "#orders" ).addClass( "dashboard-li-selected" );
    }
    function search_order(){
        var input = document.getElementById("order_search").value;
        var orders = document.getElementsByClassName("order_card");
        var order_num = document.getElementsByClassName("order_number");
        console.log("ok");
        for(i = 0; i<order_num.length; i++){
            if(!order_num[i].innerHTML.includes(input)){
                orders[i].style.display = "none";
            }else{
                orders[i].style.display = "block";
            }
        }
    }
</script>