@extends('layouts.app')

@section('content')

    <div class="container bg-white col-lg-8 custom-radius-dashboard h-98 mt-1 float-right text-dark">
        
        <div class="pt-3 pl-5">
            <h2>My Cart</h2>
        </div>

        @php
            $length = $user[0]->extension_cart->count();    
        @endphp
        
        @if ($length == 0)
        
            <div id="empty_cart" class="text-center mt-5 text-danger">
                <h5>Your cart is Empty</h5>
            </div>
        
        @else
            
            <div id="data" class="p-4 col-lg-12">

                <form role="form" method="POST" action="{{ route('checkout') }}">
                    {!! csrf_field() !!}

                    <div class="cart-div">
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
                                
                                @php
                                    $i=0;
                                @endphp
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
                                    <td> <input type="number" class="form-control text-center quantity" name="quantity[{{ $item->id }}]" value="1" max="10" min="1"></td>
                                    <td>
                                        <input id="price-{{$i}}" type="text" class="form-control text-center" name="price[{{ $item->id }}]" value="{{$item->price}}" hidden>
                                        {{ $item->price }} 
                                    </td>
                                    <td> <a id="del" href="{{route('cartDelete', $item->id)}}" class="btn btn-danger"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-4 float-right">
                        <hr>
                        <div class="d-flex">
                            <h5 class="ml-n2 text-muted"> <strong>SubTotal:</strong> </h5>
                            <span id="sub-total" class="ml-3 mt-n1" style="font-size: 18px;"></span>
                        </div>

                        <br>
                        <button type="submit" class="btn btn-purple ml-n2" style="width: 80%;">Checkout</button>
                    </div>

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


        var i = 0;
        var sum = 0;
        $(".quantity").each(function(){
            console.log($(this).val());
            console.log($("#price-"+i).val());
            quantity = $(this).val();
            str_price = $("#price-"+i).val().replace(/,/g,"");
            price = str_price.replace(/\$/g,"");
            
            float_price = parseFloat(price)
            result = quantity * float_price;
            sum = result + sum;
            i = i + 1;
        });

        $("#sub-total").html("$"+ numberWithCommas(Math.round(sum)));


        $(".quantity").on('click', function(){
            var i = 0;
            var sum = 0;
            $(".quantity").each(function(){
                console.log($(this).val());
                console.log($("#price-"+i).val());
                quantity = $(this).val();
                str_price = $("#price-"+i).val().replace(/,/g,"");
                price = str_price.replace(/\$/g,"");
                
                float_price = parseFloat(price)
                result = quantity * float_price;
                sum = result + sum;
                i = i + 1;
            });

            $("#sub-total").html("$"+ numberWithCommas(Math.round(sum)));

            console.log("sum is: " + Math.round(sum));
        });

    }

</script>