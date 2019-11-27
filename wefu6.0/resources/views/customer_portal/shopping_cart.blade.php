@extends('layouts.app')

@section('content')

    <div class="container bg-white col-lg-8 custom-radius-dashboard h-98 mt-1 float-right text-dark">
        
        <div class="pt-5 pl-5">
            <h2><strong>My Cart</strong></h2>
        </div>

        @php
            $length = $user[0]->extension_cart->count();    
        @endphp
        
        @if ($length == 0)
        
            <div id="empty_cart" class="">
                <h5><strong>Your cart is empty</strong></h5>
            </div>
        
        @else
            
            <div id="data" class="p-4 col-lg-12">

                <form role="form" method="POST" action="{{ route('checkout') }}">
                    {!! csrf_field() !!}

                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($user[0]->extension_cart as $item)
                                <tr>
                                    <td> 
                                        <div class="top-pick-img-div">
                                            <img src="{{$item->product_img_link}}" alt="{{$item->product_name}}"> 
                                        </div>
                                    </td>
                                    <td class="d-inline-block text-truncate" style="max-width: 350px;"> {{ $item->product_name }} 
                                        <br/> <span class="text-success">In Stock</span>
                                    </td>
                                    <td> <input type="number" class="form-control text-center" name="quantity[{{ $item->id }}]" value="1" max="10" min="1"></td>
                                    <td> {{ $item->price }} </td>
                                    <td> <button id="del" class="btn btn-danger"><i class="fa fa-trash-o"></i></button> </td>
                                </tr>
                            @endforeach
                            
                            <tr>
                                <td></td>
                                <td></td>
                                <th colspan="1" class="border-top">
                                    SubTotal
                                </th>
                                <td class="border-top"> $5999</td>
                                <td class="border-top">                                    
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="submit" class="btn btn-outline-purple">
                                        Checkout
                                    </button>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                </form>

            </div>

        @endif
    </div>
@endsection


<script>
    // main()

    window.onload = function(){
        $( "#dashboard-options li" ).removeClass( "dashboard-li-selected" );
        $( "#cart" ).addClass( "dashboard-li-selected" );
    }

</script>