@extends('layouts.app')

@section('content')

    <div class="col-lg-8 custom-radius-dashboard bg-white h-98 mt-1 float-right text-dark">
        
        <div class="p-4">
            <h2>My Shipments</h2>
        </div>

        <div class="">
            <ul class="nav nav-tabs mt-2 font-weight-bold" id="myTab" role="tablist">
                <li class="nav-item nav-item-order">
                    <a class="nav-link nav-link-order active" id="pending_orders_tab" data-toggle="tab" href="#pending_orders_info" role="tab" aria-controls="pending_orders" aria-selected="true">Orders to be delivered</a>
                </li>
            </ul>
            {{-- TAB CONTENT DIV --}}
            <div class="tab-content" id="myTabContent">
                {{-- STARTING OF DIV PENDING ORDERS --}}
                <div class="tab-pane fade show active" id="pending_orders_info" role="tabpanel" aria-labelledby="pending_orders_tab">
                    
                    @if ($pending_orders->count() == 0)
                        <div class="mt-4 text-danger text-center">
                            <h5>No Record Found</h5>
                        </div>
                    @else
                        <div class="invoice-deck">

                            @php
                                $i = 0;
                            @endphp
    
                            @foreach ($pending_orders as $order)
                                @foreach ($order->shipments as $shipment)
                                    {{-- STARTING OF LOOP  --}}
                                    
                                    @if ($i == 0)
                                        <div class="card-deck col-lg-12 mt-4">
                                    @endif
    
                                    <div class="card bg-white invoice-card-1 col-lg-4 shadow" style="font-size: 12px;">
                                        <div class="invoice-card-head">
                                            <div class="pl-4 pt-4 ml-2 col-lg-12 float-left">
                                                <h4>Track Shipment</h4>
                                                <div class="mt-n2">
                                                    <span>#373-17101996</span> <br>
                                                    {{-- <span><strong>22 Apr 2019</strong></span> --}}
                                                    <span><strong id="date-{{$shipment->id}}"></strong></span>
                                                    <script>
                                                        var temp_date = "{{$shipment->created_at}}";
                                                        var str = temp_date.split(" ");
                                                        var final_date = str[0].split("-");
                                                        document.getElementById("date-{{$shipment->id}}").innerHTML = final_date[2] +" "+month_names[final_date[1] -1].slice(0, 3)+" "+final_date[0];
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
                                                <div class="col-lg-12 text-center">
                                                    <span style="font-weight:600;">Details</span>
                                                </div>
                                            </div>
                                            
                                            <div class="row ml-4 mt-3 pl-1">
                                                {{--  --}}
                                                <div class="d-flex" style="color: #E55B2B;">
                                                    <div style="width: 24px; height: 24px;">
                                                        <img src="{{URL::to('/storage/uploads/icons/in-transit.png')}}" alt="">
                                                    </div>
                                                    <span class="ml-2" style="font-size: 18px; font-weight:500;">Shipment In Transit</span>
                                                </div>
                                            </div>
                
                                            <hr class="ml-3 mr-3">
                                            <div class="row ml-1 mr-1 mt-1 rounded pl-2 pr-2">
                                                <div class="col-lg-6 text-left">
                                                    <span>Expected On</span><br>
                                                </div>
                                                <div class="col-lg-6 text-right">
                                                    <strong id="date-num-{{$shipment->id}}"></strong>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 text-center mt-3">
                                                <span style="font-size: 14px;" id="date-name-{{$shipment->id}}">Wednesday, November 12</span> 
                                                <script>
                                                    var temp_date = "{{$shipment->created_at}}";
                                                    var delivery_days = "{{$order->pricing_plan->delivery_days}}"
                                                    var int_delivery_days = parseInt(delivery_days);
                                                    console.log(delivery_days)
                                                    var str = temp_date.split(" ");
                                                    var final_date = str[0].split("-");
                                                    console.log(final_date)
                                                    // document.getElementById("date-{{$shipment->id}}").innerHTML = final_date[2] +" "+month_names[final_date[1] -1].slice(0, 3)+" "+final_date[0];
                                                    var d = new Date(final_date[0], final_date[1]-1, final_date[2]);
                                                    console.log(d);
                                                    d.setDate(d.getDate() + int_delivery_days);
                                                    month = d.getMonth() + 1;
                                                    document.getElementById("date-num-{{$shipment->id}}").innerHTML = d.getDate() +"/"+month+"/"+d.getFullYear();
                                                    document.getElementById("date-name-{{$shipment->id}}").innerHTML = weekdays[d.getDay()] +","+month_names[d.getMonth()]+" "+d.getDate();
                                                    console.log(d)
                                                </script>
                                            </div>
                                            <div class="row ml-3 mr-3 mt-2 rounded p-2">
                                                <div class="col-lg-12 text-center">
                                                    <a class="btn btn-invoice-card" href="{{route('shipmentDetail', $order->id)}}" style="width: 100%;">Track my order</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                    
                                    @php
                                        $i += 1;
                                    @endphp
    
                                    @if ($i == 3)
                                        @php
                                            $i = 0;                                    
                                        @endphp
                                        </div>
                                    @endif
    
                                    {{-- ENDING OF LOOP --}}
                                @endforeach
                            @endforeach
                            @if ($i != 0)
                                </div>
                            @endif
                        </div>                        
                    @endif


                </div>
                {{-- ENDING OF DIV PENDING ORDERS --}}
            </div>

        </div>

    </div>

@endsection

<script>

    var month_names = new Array(
        "January", "Feburary", "March", "April", "May", "June", "July", "August", "September",
        "October", "November", "December"  
    );
    var weekdays = new Array(
        "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
    );
    
    window.onload = function(){
        $( "#dashboard-options li" ).removeClass( "dashboard-li-selected" );
        $( "#shippments" ).addClass( "dashboard-li-selected" );
    }

</script>