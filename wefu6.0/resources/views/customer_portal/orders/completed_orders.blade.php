@extends('layouts.app')

@section('content')

    <div class="col-lg-10 float-right">

        <div class="col-xl-6 col-lg-6 float-right d-inline-flex pt-4">
            <div class="search-container rounded-pill shadow-sm bg-white pl-4 pr-2">
                <i class="fa fa-search searchIcon mr-n4"></i> 
                <input class="order-search-bar rounded-pill" type="search" name="" id="order_search" value="" placeholder="Your order number example #123456" onkeyup="search_order()">
            </div>
            <button class="btn btn-orange rounded-pill ml-2 shadow-sm" style="width: 120px;">Search</button>
        </div>
        <div class="p-4 mt-3 mb-2">
            <div class="d-flex">
                <h3><strong>Completed Orders</strong></h3>
            </div>
        </div>

        @php
            $i = 0;    
        @endphp

        @foreach ($completed_orders as $order)
            @if($i == 0)
                <div class="ml-n4 mt-4 card-deck">
            @endif
            
            <div class="col-xl-4 col-lg-5 col-md-8 col-sm-8 col-12 order_card">
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
            @if($i == 3)
                </div>
                @php
                    $i = 0;
                @endphp
            @endif
        @endforeach
    </div>  

@endsection


<script>
    // main()

    window.onload = function(){
        
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










{{-- UNUSED CODE  --}}
{{-- /////////////////////////////////////////////////////////////////////// --}}

{{-- /////////////////////////////////////////////////// --}}
{{-- ////////////////////////////// --}}

{{-- </div> --}}
{{-- 
        <div class="card-deck">

            <div class="card mr-n1 bg-white shadow custom-radius">
                <div class="card-body">
                    <div class="card-title pb-3">
                        <div id="price_section" class="float-right d-flex">
                            <span class="mr-n3" style="font-size: 0.75rem; font-weight: bolder">
                                PKR 23,987,509
                            </span>
                            <span class="price-circle ml-n4 mt-n2"></span>
                        </div>
                        <span class="font-weight-bold" style="font-size: 0.9375rem;">#23987508</span>
                    </div>
                    {{-- <hr> --}}
                    {{-- <div id="purchase_section" class="mt-4">
                        <div class="col-lg-6 float-right">
                            <div class="d-flex order-th">
                                <span class="pl-2 pr-3">Date</span>
                                <span class="pl-4">Time</span>
                            </div>
                            <div class="d-flex order-tr pt-2">
                                <span class="pr-2">31/12/2019</span>
                                <span class="pl-3">7:32 <span class="p-1 bg-dark text-white rounded">PM</span></span>
                            </div>
                        </div>
                        <span class="section-text">Purchase</span>
                    </div>
                    <hr class="w-75">
                    <div id="payment_section" class="">
                        <div class="col-lg-6 float-right">
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
                        <div class="col-lg-6 float-right">
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
                    <div class="pl-5 pr-5">
                        <hr>
                    </div>
                    <div class="mt-5">
                        <div class="d-flex justify-content-center">
                            <a href="#" class="btn btn-orange custom-radius" style="font-size: 0.80rem;">See Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mr-n1 bg-white shadow custom-radius">
                    <div class="card-body">
                        <div class="card-title pb-3">
                            <div id="price_section" class="float-right d-flex">
                                <span class="mr-n3" style="font-size: 0.75rem; font-weight: bolder">
                                    PKR 23,987,509
                                </span>
                                <span class="price-circle ml-n4 mt-n2"></span>
                            </div>
                            <span class="font-weight-bold" style="font-size: 0.9375rem;">#23987508</span>
                        </div>
                        {{-- <hr> --}}
                        {{-- <div id="purchase_section" class="mt-4">
                            <div class="col-lg-6 float-right">
                                <div class="d-flex order-th">
                                    <span class="pl-2 pr-3">Date</span>
                                    <span class="pl-4">Time</span>
                                </div>
                                <div class="d-flex order-tr pt-2">
                                    <span class="pr-2">31/12/2019</span>
                                    <span class="pl-3">7:32 <span class="p-1 bg-dark text-white rounded">PM</span></span>
                                </div>
                            </div>
                            <span class="section-text">Purchase</span>
                        </div>
                        <hr class="w-75">
                        <div id="payment_section" class="">
                            <div class="col-lg-6 float-right">
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
                            <div class="col-lg-6 float-right">
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
                        <div class="pl-5 pr-5">
                            <hr>
                        </div>
                        <div class="mt-5">
                            <div class="d-flex justify-content-center">
                                <a href="#" class="btn btn-orange custom-radius" style="font-size: 0.80rem;">See Details</a>
                            </div>
                        </div>
                    </div>
                </div>  --}}
