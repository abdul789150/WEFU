@extends('layouts.app')

@push('style')
    <style>
        .marker{
            background-image: url("{{ URL::to('/storage/uploads/icons/map-marker.svg')}}");
            background-size: cover;
            height: 32px;
            width: 32px;
            cursor: pointer;
        }
        .dimensions{
            background-image: url("{{ URL::to('/storage/uploads/icons/box.svg')}}");
            background-size: cover;
            height: 24px;
            width: 24px;
        }
        .weight{
            background-image: url("{{ URL::to('/storage/uploads/icons/weight.svg')}}");
            background-size: cover;
            height: 24px;
            width: 24px;
        }
        .mypopup-class{
            width: 250px;
        }
        .mapboxgl-popup{
            width: 250px !important;
        }
        .mapboxgl-popup-content div{
            border: 2px solid #000000;
        }
        .mapboxgl-popup-close-button {
            display: none;
        }
        .mapboxgl-popup-content{
            text-align: left;
            font-size: 12px;
            height: 60px;
            border-radius: 0.7rem;
            vertical-align: middle;
        }
    </style>
@endpush

@section('content')

    <div class="col-lg-8 custom-radius-dashboard bg-white float-right h-98 mt-1 text-dark">
        <div class="custom-radius-dashboard-mapbox map-outer-div">
            <div id='map' class="map-div"></div>
        </div>
        <div class="" style="width: 100%; height:50px; margin-top: 400px;">
            <div class="map-blur-upper-div" style="width: 100%; height:50px;"></div>
            <div class="map-blur-lower-div" style="width: 100%; height:25px;"></div>
        </div>
        
        <div class="col-lg-12 shippment-destination-detail-card">
            <div class="card text-center rounded shadow">
                <div class="card-body">
                    <div class="col-lg-4 float-left text-left ml-n3" style="font-size: 12px;">
                        <p><strong class="text-muted">Departure</strong></p>
                        <div>
                            <div class="float-left">
                                <div style="width: 42px; height: 42px;">
                                    <img src="{{URL::to('/storage/uploads/icons/upward_arrow.png')}}" alt="Departure">
                                </div>
                            </div>
                            <div class="">
                                <span><strong>Amazon Fullfilment Store ONT2</strong></span><br>
                                <span class="text-muted">San Bernardino, California</span>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 text-left float-left" style="font-size: 12px;">
                        <div class="ml-2">
                            <p><strong class="text-muted">Destination</strong></p>
                            <div>
                                <div class="float-left">
                                    <div style="width: 42px; height: 42px;">
                                        <img src="{{URL::to('/storage/uploads/icons/downward-arrow.png')}}" alt="Departure">
                                    </div>
                                </div>
                                <div class="">
                                    <span class="d-inline-block text-truncate" style="max-width: 75%;">
                                        <strong>{{$order->address->delivery_address}}</strong>
                                    </span><br>
                                    <span class="text-muted">{{$order->address->city}}, Pakistan</span>
                                </div>
    
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4 text-left float-right" style="font-size: 12px;">
                        <div class="">
                            @if($order->is_delivered == false)
                                <p><strong class="text-muted">Currently at</strong></p>
                                <div>
                                    <div class="float-left">
                                        <div style="width: 36px; height: 36px;">
                                            <img src="{{URL::to('/storage/uploads/icons/current-location.png')}}" alt="Departure">
                                        </div>
                                    </div>
                                    <div class="">
                                        <span><strong>Ankara Esenboga Airport</strong></span><br>
                                        <span class="text-muted">Ankara, Turkey</span>
                                    </div>
        
                                </div>
                            @else
                                <p><strong class="text-muted">Delivered at</strong></p>
                                <div>
                                    <div class="float-left">
                                        <div style="width: 36px; height: 36px;">
                                            <img src="{{URL::to('/storage/uploads/icons/current-location.png')}}" alt="Departure">
                                        </div>
                                    </div>
                                    <div class="">
                                        <span class="d-inline-block text-truncate" style="max-width: 75%;">
                                            <strong>{{$order->address->delivery_address}}</strong>
                                        </span><br>
                                        <span class="text-muted">{{$order->address->city}}, Pakistan</span>
                                    </div>
        
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <div class="col-lg-4 float-left text-left ml-n3" style="font-size: 12px;">
                        <strong>Departured On : </strong>
                        <span>October 12, 2019</span>
                    </div>
                    <div class="col-lg-4 text-left float-left" style="font-size: 12px;">
                        <div class="ml-2">
                            <strong>Expected On : </strong>
                            <span>November 19, 2019</span>
                        </div>
                    </div>
                    @if($order->is_delivered == true)
                        <div class="col-lg-4 text-left float-left" style="font-size: 12px;">
                            <div class="ml-2">
                                <strong>Delivered On : </strong>
                                <span>November 19, 2019</span>
                            </div>
                        </div>                    
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-12 mt-4" style="height: 50px;">
            <div class="card text-left rounded shadow-sm">
            @if($order->is_delivered == false)
                <div class="card-header" style="background-color: #E16A2A; height: 35px;">
            @else
                <div class="card-header" style="background-color: #478543; height: 35px;">
            @endif
                    <div class="text-white mt-n1">
                        <span style="font-size: 14px; font-weight:600;">Order Number : {{$order->order_number}}</span>
                    </div>
                </div>
                <div class="card-body">

                    @php
                        $quantity = 0;
                    @endphp
                    @foreach ($order->shopping_carts as $item)
                        @php
                            $quantity = $item->quantity + $quantity;                                                    
                        @endphp

                    @endforeach

                    <div class="mt-n2 col-lg-2 float-left">
                        <span class="text-muted" style="font-size: 14px; font-weight:600;">Total Quantity: </span><br>
                        @if($quantity == 1)
                            <span class="ml-2" style="font-weight:600;"> {{$quantity}} item</span><br>                    
                        @else
                            <span class="ml-2" style="font-weight:600;"> {{$quantity}} items</span><br>
                        @endif

                    </div>

                    <div class="mt-n2 col-lg-3 float-left">
                        <span class="text-muted" style="font-size: 14px; font-weight:600;">Total Price: </span><br>
                        <span class="ml-2" style="font-weight:600;">PKR </span> <span id="price-span"></span><br>
                    </div>

                    <div class="mt-n2 col-lg-3 float-left">
                        <div class="ml-n3">
                            <span class="text-muted" style="font-size: 14px; font-weight:600;">Customer Name: </span><br>
                            <span class="ml-2" style="font-weight:600;">{{$order->user->full_name}}</span><br>
                        </div>

                    </div>

                    <div class="mt-n2 col-lg-4 float-right">
                        <div class="">
                            <span class="text-muted" style="font-size: 14px; font-weight:600;">Status: </span><br>
                            @if($order->is_delivered == false)
                                <div class="d-flex" style="color: #E55B2B;">
                                    <div style="width: 24px; height: 24px;">
                                        <img src="{{URL::to('/storage/uploads/icons/in-transit.png')}}" alt="">
                                    </div>
                                    <span class="ml-2" style="font-size: 18px; font-weight:500;">Shipment In Transit</span>
                                </div>
                            @else
                                <div class="d-flex" style="color: #478543;">
                                    <div style="width: 24px; height: 24px;">
                                        <img src="{{URL::to('/storage/uploads/icons/delivered.png')}}" alt="">
                                    </div>
                                    <span class="ml-2" style="font-size: 18px; font-weight:500;">Shipment Completed</span>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

<script>
    window.onload = function(){
        $( "#dashboard-options li" ).removeClass( "dashboard-li-selected" );
        $( "#manageShippments" ).addClass( "dashboard-li-selected" );

        var price = {{$order->total_price}}
        document.getElementById("price-span").innerHTML = numberWithCommas(price);

        var add = @json($order->address->city);
        var prov = @json($order->address->province);
        
        var search_query = encodeURIComponent(add +","+ prov);
        // console.log(search_query)

        $.ajax({
            url: "https://api.mapbox.com/geocoding/v5/mapbox.places/"+search_query+".json?access_token=pk.eyJ1IjoiYWJkdWw3ODkxNTAiLCJhIjoiY2s0MTg3cHVtMDh5ZjNucGZtem1uemg0dSJ9.YsP2a37a6IeD90ATrUtZNQ",
            type: "GET",
            success: function(result){
                console.log(result["features"][0]["geometry"]);
                var geojson = {
                    type: 'FeatureCollection',
                    features: [
                        {
                            type: 'Feature',
                            geometry:{
                                type: 'Point',
                                coordinates:[73.0479, 33.6844]
                            },
                            properties:{
                                title: 'WEFU Warehouse',
                                description: 'Islamabad, Pakistan'
                            },
                        },
                        {
                            type: 'Feature',
                            geometry:{
                                type: 'Point',
                                coordinates:[-117.2458, 34.0884]
                            },
                            properties:{
                                title: 'Amazon Fullfilment Center',
                                description: 'San Bernardino, California'
                            },
                        },{
                            type: 'Feature',
                            geometry: result["features"][0]["geometry"],
                            properties:{
                                title: @json($order->address->city),
                                description: @json($order->address->province),
                            }
                        }
                    ]
                }

                geojson.features.forEach(function(marker){
                // Create an HTML element for each feature
                var element = document.createElement('div');
                element.className = 'marker';

                // Now make a marker for each feature
                new mapboxgl.Marker(element)
                            .setLngLat(marker.geometry.coordinates)
                            .setPopup(new mapboxgl.Popup({ offset:25})
                                                .setHTML('<strong>' + marker.properties.title + '</strong><br/>'+
                                                        '<span class="text-muted">'+marker.properties.description+'</span>'))
                            .addTo(map);
                });

                map.on('load', function(){
                // map.addLayer()            
                map.addLayer({
                    'id' : 'route1',
                    'type':'line',
                    'source':{
                        'type':'geojson',
                        'data':{
                            'type':'Feature',
                            'properties':{},
                            'geometry':{
                                'type':'LineString',
                                'coordinates':[
                                    [73.0479, 33.6844],
                                    result["features"][0]["geometry"]["coordinates"],
                                ]
                            }
                        }
                    },
                    'layout':{
                    },
                    'paint':{
                        'line-color':'#f57c00',
                        'line-dasharray': [5.0, 4.0], 
                        'line-width' : 3.5,
                        'line-offset': 2,
                        'line-translate-anchor': "map",
                    }
                })
            });

            },
            error: function(result){
                console.log(result);
            } 
        })



        mapboxgl.accessToken = 'pk.eyJ1IjoiYWJkdWw3ODkxNTAiLCJhIjoiY2s0MTg3cHVtMDh5ZjNucGZtem1uemg0dSJ9.YsP2a37a6IeD90ATrUtZNQ';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/outdoors-v11',
            center:[17.2283, 26.3351],
            zoom: 1.9,
            bearing: -30,
            pitch: 53,
        });

        map.addControl(new mapboxgl.NavigationControl());

        map.on('load', function(){
            // map.addLayer()            
            map.addLayer({
                'id' : 'route',
                'type':'line',
                'source':{
                    'type':'geojson',
                    'data':{
                        'type':'Feature',
                        'properties':{},
                        'geometry':{
                            'type':'LineString',
                            'coordinates':[
                                [-117.2458, 34.0884],
                                [73.0479, 33.6844],
                            ]
                        }
                    }
                },
                'layout':{
                },
                'paint':{
                    'line-color':'#f57c00',
                    'line-dasharray': [5.0, 4.0], 
                    'line-width' : 3.5,
                    'line-offset': 2,
                    'line-translate-anchor': "map",
                }
            })
        });

    }
</script>