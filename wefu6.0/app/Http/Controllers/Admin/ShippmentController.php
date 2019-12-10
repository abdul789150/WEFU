<?php

namespace App\Http\Controllers\Admin;

use App\AmazonShipment;
use App\Http\Controllers\Controller;
use App\Orders;
use Illuminate\Http\Request;

class ShippmentController extends Controller
{
    //

    public function manage_shippments(){
        
        $amazon_shipments = AmazonShipment::all();
        $orders_delivery = Orders::all();
        
        return view('admin_portal.manage_shippments',[
            "amazon_shipments" => $amazon_shipments,
            "orders_delivery" => $orders_delivery, 
        ]);
    }
}
