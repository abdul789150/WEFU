@extends('layouts.app')

@section('content')

    <div class="col-lg-10 float-right">
        <div class="container pt-4">

            <h3> <strong> Update Pricing Plans </strong> </h3> 
            <p>
                Please fill up the details correctly  
            </p>
            
            <div class="container col-lg-7">

                <form role="form" method="POST" action="{{route('savePricingPlan')}}">

                    <table class="table table-hover all-orders-table">
                        <thead class="text-muted">
                            <tr>
                                <th>Plan</th>
                                <th>Delivery Days</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($pricing_plans as $plan)
                                <tr class="orders-row">
                                    <th class="">
                                        <span>{{$plan->name}}</span>
                                    </th>
                                    <td>
                                        <input type="text" class="form-control col-lg-6 m-auto" name="delivery_date" id="delivery_date" value="{{$plan->delivery_days}}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control col-lg-6 m-auto" name="price" id="price" value="{{$plan->price}}">
                                    </td>
                                </tr>                                
                            @endforeach

                        </tbody>
                    </table>

                    {{-- <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> --}}
                    <button type="submit" class="btn btn-purple">Update</button>
                </form>

            </div>

        </div>
    </div>

@endsection