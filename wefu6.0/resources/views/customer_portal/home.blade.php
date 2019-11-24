@extends('layouts.app')

@section('content')
<div class="col-lg-8 custom-radius-dashboard bg-white float-right h-98 mt-1">
    
    <div class="container" style="color: black;">
        <div class="mt-5">
            <h2>Welcome Back</h2>

            <div class="container mt-4 custom-radius shadow">
                <div class="d-flex pt-4">
                    <div class="col-lg-4 ml-4">
                        <h3>Shop Now on</h3>
                    </div>

                    <div class="amazon-logo-div mt-n3 col-lg-4">
                        <img src="{{ URL::to('/storage/uploads/icons/amazon-logo.png') }}" alt="">
                    </div>
    
                    <div class="ml-5 d-flex col-lg-3">
                        <span class="yellow-circle mr-n3 mt-n3"></span>
                        <h3 class="ml-n4">Let's Go</h3>
                    </div>
                </div>

            </div>

            <div class="container mt-5 custom-radius home-page-box-shadow">
                <div class="">
                    <ul id="calender-list" class="list-inline">
                    </ul>
                </div>
            </div>

            <div class="container mt-4 custom-radius shadow">

                <div class="p-2 pt-3">
                    @if ($top_products->count() == 0)
                        <h5>Sorry currently we have no top picks</h5>
                    @else
    
                        <h5>Our Top Picks on Amazon</h5>
                        
                        <div class="mt-4 top-pick-div">
                            <table class="table table-hover">
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($top_products as $item)
                                        <tr>
                                            <td>
                                                @if ($item->rating >= $item->prev_rating)
                                                    <div class="arrow-up mt-2">
                                                    </div>
                                                
                                                @elseif ($item->rating < $item->prev_rating)
                                                    <div class="arrow-down mt-2">
                                                    </div>
                                                   
                                                @endif 
                                            </td>
                                            <td>{{$i}}</td>
                                            <td>
                                                <div class="top-pick-img-div">
                                                    <img src="{{$item->img_link}}" alt="{{$item->name}}">
                                                </div>    
                                            </td> 
                                            <td>
                                                <span class="d-inline-block text-truncate" style="max-width: 500px;">
                                                    <a href="{{$item->product_link}}" target="_blank" class="custom-a">{{$item->name}}</a>
                                                </span>
                                            </td>
                                        </tr>
                                        
                                        @php
                                            $i++;
                                        @endphp                    
                                    
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    @endif
                </div>

            </div>


        </div>

    </div>

</div>

@endsection


<script>

    window.onload = function(){
        console.log("Window loaded")
        $( "#dashboard-options li" ).removeClass( "dashboard-li-selected" );
        $( "#home" ).addClass( "dashboard-li-selected" );

        var day = new Date();
        // Adding calender
        for(i=0; i < 7; i++){

            var nextDay = new Date(day);
            nextDay.setDate(day.getDate() + i);

            if( i == 0){
                $("#calender-list").append('<li class="list-inline-item text-center ml-4 mr-n2 purple-circle">'+
                                        ''+
                                        weekdays[nextDay.getDay()] + '<br>' + 
                                        nextDay.getDate() + '<span class="ml-2">' +
                                        month_names[nextDay.getMonth()].slice(0,3) +'</span></li>'
                                        )
            }else{
                $("#calender-list").append('<li class="list-inline-item text-center ml-5">'+
                                        weekdays[nextDay.getDay()] + '<br>' + 
                                        nextDay.getDate() + '<span class="ml-2">' +
                                        month_names[nextDay.getMonth()].slice(0,3) +'</span></li>') 
            }

        }

    }

</script>