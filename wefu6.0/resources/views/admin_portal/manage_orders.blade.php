@extends('layouts.app')

@section('content')

@php
    $active = 0;
    $unfulfilled = 0;
    $unpaid = 0;
    $completed_orders = 0;
@endphp

@foreach ($orders as $order)
    @if ($order->payment_completed == false)
        @php
            $unpaid = $unpaid + 1;
        @endphp

    @elseif($order->is_fulfilled == false)
        @php
            $unfulfilled = $unfulfilled + 1;
        @endphp

    @elseif($order->is_delivered == false)
        @php
            $active = $active + 1;
        @endphp
    @else
        @php
            $completed_orders = $completed_orders + 1;    
        @endphp
    @endif
@endforeach



<div class="col-lg-8 custom-radius-dashboard bg-white float-right h-98 mt-1 text-dark">
    <div class="container">
        <div class="pl-4 pt-4">
            <h2> <strong>Orders List</strong> </h2>
        </div>

        {{-- Simple four cards --}}

        <div class="container mt-4 d-flex">
            <div class="container col-lg-2 p-2">
                <div class="text-center p-2">
                    <h1 style="color:purple;">{{$orders->count()}}</h1>
                    <h6 class="text-muted">Total Orders</h6>
                </div>
            </div>
            <div class="container col-lg-2 p-2">
                <div class="text-center p-2">
                    <h1 style="color:Green;">{{$completed_orders}}</h1>
                    <h6 class="text-muted">Completed</h6>
                </div>
            </div>
            <div class="container col-lg-2 p-2">
                <div class="text-center p-2">
                    <h1 class="text-primary">{{$active}}</h1>
                    <h6 class="text-muted">Active Orders</h6>
                </div>
            </div>
            <div class="container col-lg-2 p-2">
                <div class="text-center p-2">
                    <h1 style="color:orange;">{{$unfulfilled}}</h1>
                    <h6 class="text-muted">Unfulfilled</h6>
                </div>
            </div>
            <div class="container col-lg-2 p-2">
                <div class="text-center p-2">
                    <h1 style="color:red;">{{$unpaid}}</h1>
                    <h6 class="text-muted">Unpaid Orders</h6>
                </div>
            </div>
        </div>

        {{-- ENDING OF CARDS  --}}

        <div class="container mt-5">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item nav-item-order">
                    <a class="nav-link nav-link-order active" id="all_orders-tab" data-toggle="tab" href="#all_orders" role="tab" aria-controls="all_orders" aria-selected="true">All orders</a>
                </li>
                <li class="nav-item nav-item-order">
                    <a class="nav-link nav-link-order" id="active_orders-tab" data-toggle="tab" href="#active_orders" role="tab" aria-controls="active_orders" aria-selected="false">Active</a>
                </li>
                <li class="nav-item nav-item-order">
                    <a class="nav-link nav-link-order" id="unpaid_orders-tab" data-toggle="tab" href="#unpaid_orders" role="tab" aria-controls="unpaid_orders" aria-selected="false">Unpaid</a>
                </li>
                <li class="nav-item nav-item-order">
                    <a class="nav-link nav-link-order" id="unfulfilled_orders-tab" data-toggle="tab" href="#unfulfilled_orders" role="tab" aria-controls="unfulfilled_orders" aria-selected="false">Unfulfilled</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                {{-- All Orders Section --}}
                <div class="tab-pane fade manage-orders-tab-layout show active" id="all_orders" role="tabpanel" aria-labelledby="all_orders-tab">

                    <div class="pt-3">
                        <table class="table table-borderless all-orders-table">
                            <thead class="text-muted">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Created</th>
                                    <th>Customer</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($orders as $order)
                                    
                                    <tr class="orders-row">
                                        <td class="text-primary">{{$order->id}}</td>
                                        <td>Aug 12, 2019</td>
                                        <td>{{$order->user->full_name}}</td>
                                        <td> <b>PKR</b> {{$order->total_price}}</td>
                                        <td>

                                            @if ($order->payment_completed == false)
                                                <div class="unpaid-order">
                                                    Unpaid
                                                </div>
                                            
                                            @elseif ($order->is_fulfilled == false)
                                                
                                                <div class="unfulfill-order">
                                                    Unfulfilled
                                                </div>

                                            @elseif ($order->is_delivered == false)
                                                <div class="pen-ship-order">
                                                    Shippment Due
                                                </div>
                                            @else
                                                <div class="completed-order">
                                                    Order Completed
                                                </div>
                                            @endif
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
{{-- ///////////////////////////////////////////////////// --}}

                {{-- Active Orders Section --}}
                <div class="tab-pane fade manage-orders-tab-layout" id="active_orders" role="tabpanel" aria-labelledby="active_orders-tab">
                    <div class="pt-3">
                        <table class="table table-borderless all-orders-table">
                            <thead class="text-muted">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Created</th>
                                    <th>Customer</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($orders as $order)
                                    
                                    @if ($order->payment_completed == true && $order->is_fulfilled == true && $order->is_delivered == false)
                                      <tr class="orders-row">
                                            <td class="text-primary">{{$order->id}}</td>
                                            <td>Aug 12, 2019</td>
                                            <td>{{$order->user->full_name}}</td>
                                            <td> <b>PKR</b> {{$order->total_price}}</td>
                                            <td>
                                                <div class="pen-ship-order">
                                                    Shippment Due
                                                </div>
                                            </td>
                                        </tr>                                        
                                    @endif

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
{{-- /////////////////////////////////////////////////// --}}

                {{-- unpaid Orders Section --}}
                <div class="tab-pane fade manage-orders-tab-layout" id="unpaid_orders" role="tabpanel" aria-labelledby="unpaid_orders-tab">
                    <div class="pt-3">
                        <table class="table table-borderless all-orders-table">
                            <thead class="text-muted">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Created</th>
                                    <th>Customer</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($orders as $order)
                                    
                                    @if ($order->payment_completed == false)
                                        <tr class="orders-row">
                                            <td class="text-primary">{{$order->id}}</td>
                                            <td>Aug 12, 2019</td>
                                            <td>{{$order->user->full_name}}</td>
                                            <td> <b>PKR</b> {{$order->total_price}}</td>
                                            <td>
                                                <div class="unpaid-order">
                                                    Unpaid
                                                </div>
                                            </td>
                                        </tr>                                        
                                    @endif

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- ///////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ --}}
                {{-- Unfulfilled Orders Section --}}
                <div class="tab-pane fade manage-orders-tab-layout" id="unfulfilled_orders" role="tabpanel" aria-labelledby="unfulfilled_orders-tab">
                    <div class="pt-3">
                        <table class="table table-borderless all-orders-table">
                            <thead class="text-muted">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Created</th>
                                    <th>Customer</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($orders as $order)
                                    
                                    @if ($order->payment_completed == true && $order->is_fulfilled == false)
                                        <tr class="orders-row">
                                            <td class="text-primary">{{$order->id}}</td>
                                            <td>Aug 12, 2019</td>
                                            <td>{{$order->user->full_name}}</td>
                                            <td> <b>PKR</b> {{$order->total_price}}</td>
                                            <td>
                                                <div class="unfulfill-order">
                                                    Unfulfilled
                                                </div>
                                            </td>
                                        </tr>                                        
                                    @endif

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>

        {{-- End of cards --}}
    </div>
</div>

@endsection

<script>

    window.onload = function(){
        $( "#dashboard-options li" ).removeClass( "dashboard-li-selected" );
        $( "#manageOrders" ).addClass( "dashboard-li-selected" );
    }

</script>














    
    
    
    
    
    
                            {{-- <table class="table table-borderless all-orders-table">
                            <thead class="text-muted">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Created</th>
                                    <th>Customer</th>
                                    <th>Items</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="orders-row">
                                    <td class="text-primary">1</td>
                                    <td>Aug 12, 2019</td>
                                    <td>AbdulRehman</td>
                                    <td>20x</td>
                                    <td><b>PKR</b> 1000,000</td>
                                    <td>
                                        <div class="completed-order">
                                            Order Completed
                                        </div> --}}
                                        {{-- <button class="btn btn-success" style="line-height: 10px; font-size: 12px;">complete Now</button> --}}
                                    {{-- </td>
                                </tr>
                                <tr class="orders-row">
                                    <td class="text-primary">1</td>
                                    <td>Aug 12, 2019</td>
                                    <td>AbdulRehman</td>
                                    <td>20x</td>
                                    <td><b>PKR</b> 1000,000</td>
                                    <td>
                                        <div class="unpaid-order">
                                            Unpaid
                                        </div>
                                        {{-- <button class="btn btn-outline-danger" style="line-height: 10px; font-size: 12px;">Unpaid</button> --}}
                                    {{-- </td>
                                </tr>
                                <tr class="orders-row">
                                    <td class="text-primary">1</td>
                                    <td>Aug 12, 2019</td>
                                    <td>AbdulRehman</td>
                                    <td>20x</td>
                                    <td><b>PKR</b> 1000,000</td>
                                    <td>
                                        <div class="pen-ship-order">
                                            Shippment Due
                                        </div> --}}
                                        {{-- <button class="btn btn-warning" style="line-height: 10px; font-size: 12px;">Pending Shippment</button> --}}
                                    {{-- </td>
                                </tr>
                                <tr class="orders-row">
                                    <td class="text-primary">1</td>
                                    <td>Aug 12, 2019</td>
                                    <td>AbdulRehman</td>
                                    <td>20x</td>
                                    <td> <b>PKR</b> 1000,000</td>
                                    <td>
                                        <div class="unfulfill-order">
                                            Unfulfilled --}}
                                        {{-- </div> --}}
                                        {{-- <button class="btn btn-warning" style="line-height: 10px; font-size: 12px;">Pending Shippment</button> --}}
                                    {{-- </td> --}}
                                {{-- </tr>
                            </tbody>
                        </table> --}}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    