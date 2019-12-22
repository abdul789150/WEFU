@extends('layouts.app')

@section('content')

    <div class="col-lg-8 custom-radius-dashboard bg-white float-right h-98 mt-1 text-dark">

        <div class="pt-4 pl-4">
            <h2>Manage Orders</h2>
        </div>

        @if($products_cluster_array == null)
            <div class="container mt-4 text-center">
                <h4 class="text-danger">No Pending Orders</h4>
            </div>
        @else
            <div class="container mt-2">
                {{-- {{$products_cluster_array}} --}}
                <table class="table table-borderless all-orders-table">
                    <thead class="text-muted">
                        <tr class="text-center">
                            <th>S.No</th>
                            <th colspan="2">Product</th>
                            <th>Quantity</th>
                            <th colspan="2">Completed</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($products_cluster_array as $item)
                            <tr class="manage-orders-row" id="table_row_{{$i-1}}">
                                <th class="text-muted">{{$i}}</th>
                                <td>
                                    <div class="top-pick-img-div">
                                        <img src="{{$item->product->product_img_link}}" alt="{{$item->product->product_name}}">
                                    </div>
                                </td>   
                                <th class="text-muted">
                                    <div class="d-inline-block text-truncate ml-n4" style="max-width: 300px;">
                                        {{$item->product->product_name}}
                                    </div>
                                </th>
                                <td>
                                    {{$item->quantity}}
                                </td>
                                <td>
                                    <a href="#" class="btn btn-purple">Buy Now</a>
                                </td>
                                <td>
                                    <label class="pure-material-checkbox">
                                        <input type="checkbox" name="checkbox_{{$i-1}}" id="checkboxes" value="{{$i-1}}"/>
                                    </label>
                                    @php
                                        $j = 0;
                                    @endphp
                                    <form id="form_{{$i-1}}" class="product_listing_form">
                                        @csrf
                                        @foreach ($item->product_id_list as $id_list)
                                            <input type="text" name="id_list[{{$j}}]" class="for_{{$i-1}}" value="{{$id_list}}" hidden>
                                            @php
                                                $j++;
                                            @endphp
                                        @endforeach
                                    </form>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Button trigger modal -->
            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#amazon_order_confirmation">
                Launch static backdrop modal
            </button> --}}
            <!-- Modal -->
            <div class="modal fade" id="amazon_order_confirmation" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="amazon_order_confirmationLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="amazon_order_confirmationLabel">Order Confirmation</h5>
                            <button type="button" class="close cancel-btn" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <h3> <strong>Provide Details</strong></h3>
                                <p>
                                    Please provide order number given by amazon.
                                </p>
                                {{-- <form id="form_{{$i-1}}" class="product_listing_forssm" method="POST" action="{{route('clusterConfrimation')}}"> --}}
                                <div class="col-lg-8 m-auto">
                                
                                    {{-- @csrf
                                    @php
                                        $j = 0;
                                    @endphp
                                    @foreach ($products_cluster_array[0]->product_id_list as $id_list)
                                        <input type="text" name="id_list[{{$j}}]" class="for_{{$i-1}}" value="{{$id_list}}" hidden>
                                        @php
                                            $j++;
                                        @endphp
                                    @endforeach --}}
                                        {{-- <button type="submit">Subit Now</button> --}}
                                    <form id=""></form>
                                    <input type="text" id="amazon_order_number" class="form-control" name="amazon_order_number" placeholder="Enter Order Number" value="">
                                    <small class="text-danger" id="warning"></small>
                                </div>
                                <div class="mt-5">
                                    <button type="button" class="btn btn-secondary cancel-btn" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary" id="confirm_order_btn">Confirm Order</button>
                                </div>
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif




    </div>

@endsection

<script>
    window.onload = function(){
        $( "#dashboard-options li" ).removeClass( "dashboard-li-selected" );
        $( "#manageOrders" ).addClass( "dashboard-li-selected" );

        $(".product_listing_form").each(function(){
            $(this).submit(function(){
                return false;
            })
        });

        $("input[type='checkbox']").click(function(){
            console.log("check box clicked");
            var checkedVal = $("input[type='checkbox']:checked").val();
            // console.log(checkedVal);
            if(checkedVal != undefined){
                $(".for_"+checkedVal).each(function(){
                    // console.log("inside loop")
                    console.log($(this).val());
                });
                $("#amazon_order_confirmation").modal("show");
            }

        });
        $(".cancel-btn").click(function(){
            $("input[type='checkbox']:checked").prop("checked", false);
        });

        $("#confirm_order_btn").click(function(){
            var checkedVal = $("input[type='checkbox']:checked").val();
            var form_data = $("#form_"+checkedVal).serializeArray();
            
            if($("#amazon_order_number").val()){
                // console.log($("#amazon_order_number").val());
                var order_number = $("#amazon_order_number").serializeArray();
                form_data.push(order_number[0])
            }

            // console.log();
            // console.log(form_data);
            $.ajax({
                method: "POST",
                url: "{{route('clusterConfrimation')}}",
                data: form_data,
                cache: false,
                success: function(result){
                    console.log(result)
                    $("#amazon_order_confirmation").modal("hide");
                    // Remove the entry from table.
                    $("#table_row_"+checkedVal).remove();
                },
                error: function(result){
                    console.log(result)
                    console.log("Sorry bro try again");
                    $("#warning").html("Please Provide a valid Order Id Given by Amazon");
                }
        
            });
        });

    }
</script>