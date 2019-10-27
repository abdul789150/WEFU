@extends('layouts.app')

@section('content')

    <div class="container">
        
        <h4><strong>My Cart</strong></h4>

        @php
            $length = $user[0]->extension_cart->count();    
        @endphp
        
        @if ($length == 0)
        
            <div id="empty_cart" class="">
                <h5><strong>Your cart is empty</strong></h5>
            </div>
        
        @else
            
            <div id="data" class="p-4">

                <form role="form" method="POST" action="{{ route('checkout') }}">
                    {!! csrf_field() !!}

                    <table class="table table-borderless col-lg-8">
                        <thead>
                            <tr>
                                <th colspan="2">Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($user[0]->extension_cart as $item)
                                <tr>
                                    <td> <img src="{{$item->product_img_link}}" alt="{{$item->product_name}}" width="100px" height="100px"> </td>
                                    <td class="d-inline-block text-truncate" style="max-width: 300px;"> {{ $item->product_name }} </td>
                                    <td> {{ $item->price }} </td>
                                    <td> <input type="number" name="quantity[{{ $item->id }}]" value="1"></td>
                                    <td> {{ $item->price }} </td>
                                    <td> <button id="del" class="btn btn-danger">Delete</button> </td>
                                </tr>
                            @endforeach
                            
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th colspan="2" class="border-top">
                                    SubTotal
                                </th>
                                <td> $5999</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td colspan="3">
                                    <button type="submit" class="btn btn-outline-primary">
                                        Checkout
                                    </button>
                                </td>
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
</script>