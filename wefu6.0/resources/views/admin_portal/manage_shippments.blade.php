@extends('layouts.app')

@section('content')

    <div class="col-lg-8 custom-radius-dashboard bg-white float-right h-98 mt-1 text-dark">

        <div class="pt-4 pl-4">
            <h2>All Shippments</h2>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item nav-item-order">
                    <a class="nav-link nav-link-order active" id="in_transit-tab" data-toggle="tab" href="#in_transit" role="tab" aria-controls="in_transit" aria-selected="true">In Transit Shipments</a>
                </li>
                <li class="nav-item nav-item-order">
                    <a class="nav-link nav-link-order" id="completed_shipments-tab" data-toggle="tab" href="#completed_shipments" role="tab" aria-controls="completed_shipments" aria-selected="false">Completed Shipments</a>
                </li>
                <li class="nav-item nav-item-order">
                    <a class="nav-link nav-link-order" id="orders_to_be_delivered-tab" data-toggle="tab" href="#orders_to_be_delivered" role="tab" aria-controls="orders_to_be_delivered" aria-selected="false">Orders to be delivered</a>
                </li>
                <li class="nav-item nav-item-order">
                    <a class="nav-link nav-link-order" id="completed_orders-tab" data-toggle="tab" href="#completed_orders" role="tab" aria-controls="completed_orders" aria-selected="false">Completed Orders</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                {{-- IN TRANSIT SHIPMENTS DIV --}}
                <div class="tab-pane fade manage-shippments-tab-layout show active" id="in_transit" role="tabpanel" aria-labelledby="in_transit-tab">
                    <div class="pt-2 pl-2 pr-2">
                        <table class="table table-borderless all-orders-table">
                            <thead class="text-muted">
                                <tr>
                                    <th>S.No</th>
                                    <th>Amazon Order No</th>
                                    <th>Product Name</th>
                                    <th>Total Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($amazon_shipments as $shipment)
                                    
                                    @if ($shipment->is_delivered_warehouse == false)
                                        
                                        <tr class="shipment-orders-row">
                                            <td class="text-primary">{{$i}}</td>
                                            <td> <strong>#</strong>{{$shipment->amazon_order_no}}</td>
                                            <td>
                                                <div class="d-inline-block text-truncate ml-n4" style="max-width: 250px;"> 
                                                    {{$shipment->shopping_carts[0]->product->product_name}} 
                                                </div>    
                                            </td>
                                            <td>
                                                @php
                                                    $quantity = 0;
                                                @endphp
                                                @foreach ($shipment->shopping_carts as $item)
                                                    @php
                                                        $quantity = $item->quantity + $quantity;                                                    
                                                    @endphp
    
                                                @endforeach
                                                {{$quantity}}
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-purple">Details</a>
                                            </td>
                                        </tr>
                                        @php
                                            $i += 1;
                                        @endphp

                                    @endif

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- COMPLETED SHIPMENTS DIV --}}
                <div class="tab-pane fade manage-shippments-tab-layout" id="completed_shipments" role="tabpanel" aria-labelledby="completed_shipments-tab">
                    <div class="pt-2 pl-2 pr-2">
                        <table class="table table-borderless all-orders-table">
                            <thead class="text-muted">
                                <tr>
                                    <th>S.No</th>
                                    <th>Amazon Order No</th>
                                    <th>Product Name</th>
                                    <th>Total Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($amazon_shipments as $shipment)
                                    
                                    @if ($shipment->is_delivered_warehouse == true)
                                        
                                        <tr class="shipment-orders-row">
                                            <td class="text-primary">{{$i}}</td>
                                            <td> <strong>#</strong>{{$shipment->amazon_order_no}}</td>
                                            <td>
                                                <div class="d-inline-block text-truncate ml-n4" style="max-width: 250px;"> 
                                                    {{$shipment->shopping_carts[0]->product->product_name}} 
                                                </div>    
                                            </td>
                                            <td>
                                                @php
                                                    $quantity = 0;
                                                @endphp
                                                @foreach ($shipment->shopping_carts as $item)
                                                    @php
                                                        $quantity = $item->quantity + $quantity;                                                    
                                                    @endphp
    
                                                @endforeach
                                                {{$quantity}}
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-purple">Details</a>
                                            </td>
                                        </tr>
                                        @php
                                            $i += 1;
                                        @endphp

                                    @endif

                                @endforeach
                                @if ($i == 1)
                                    <div class="text-danger">
                                        Currently there are no completed shipments. 
                                    </div>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- ORDERS TO BE DELIVERED DIV --}}
                <div class="tab-pane fade manage-shippments-tab-layout" id="orders_to_be_delivered" role="tabpanel" aria-labelledby="orders_to_be_delivered-tab">
                    <div class="pt-2 pl-2 pr-2">
                        <table class="table table-borderless all-orders-table">
                            <thead class="text-muted">
                                <tr>
                                    <th>S.No</th>
                                    <th>Order No</th>
                                    <th>Customer Name</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($orders_delivery as $order)
                                    
                                    @if($order->is_delivered == false)
                                        
                                        <tr class="shipment-orders-row">
                                            <td class="text-primary">{{$i}}</td>
                                            <td> <strong>#</strong>{{$order->id}}</td>
                                            <td>
                                                {{-- <div class="d-inline-block text-truncate ml-n4" style="max-width: 250px;">  --}}
                                                {{$order->user->full_name}} 
                                                {{-- </div>     --}}
                                            </td>
                                            <td>
                                                {{$order->total_price}}
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-purple">Details</a>
                                            </td>
                                        </tr>
                                        @php
                                            $i += 1;
                                        @endphp
    
                                    @endif
    
                                @endforeach
                                @if ($i == 1)
                                    <div class="text-danger">
                                        Currently there are no completed shipments. 
                                    </div>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            
                {{-- COMPLETED ORDERS DIV --}}
                <div class="tab-pane fade manage-shippments-tab-layout" id="completed_orders" role="tabpanel" aria-labelledby="completed_orders-tab">
                    <div class="pt-2 pl-2 pr-2">
                        <table class="table table-borderless all-orders-table">
                            <thead class="text-muted">
                                <tr>
                                    <th>S.No</th>
                                    <th>Order No</th>
                                    <th>Customer Name</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($orders_delivery as $order)
                                    
                                    @if($order->is_delivered == true)
                                        
                                        <tr class="shipment-orders-row">
                                            <td class="text-primary">{{$i}}</td>
                                            <td> <strong>#</strong>{{$order->id}}</td>
                                            <td>
                                                {{-- <div class="d-inline-block text-truncate ml-n4" style="max-width: 250px;">  --}}
                                                {{$order->user->full_name}} 
                                                {{-- </div>     --}}
                                            </td>
                                            <td>
                                                {{$order->total_price}}
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-purple">Details</a>
                                            </td>
                                        </tr>
                                        @php
                                            $i += 1;
                                        @endphp
    
                                    @endif
    
                                @endforeach
                                @if ($i == 1)
                                    <div class="text-danger">
                                        Currently there are no completed shipments. 
                                    </div>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Ending of tab layout --}}


        </div>


        </div>

    </div>

@endsection

<script>
    window.onload = function(){
        $( "#dashboard-options li" ).removeClass( "dashboard-li-selected" );
        $( "#manageShippments" ).addClass( "dashboard-li-selected" );
    }
</script>