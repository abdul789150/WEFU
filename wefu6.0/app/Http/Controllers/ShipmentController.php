<?php

namespace App\Http\Controllers;

use App\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipmentController extends Controller
{
    //

    public function my_shipments(){

        $pending_orders = Orders::where('user_id', Auth::user()->id)
                        ->where('is_delivered', false)->get();

        return view('customer_portal.shipment.my_shipment',[
            "pending_orders" => $pending_orders,
        ]);
    }

    public function shipment_detail($id){

        $order = Orders::Where('id', $id)->first();

        // dd($order);
        return view('customer_portal.shipment.shipment_detail',[
            "order" => $order,
        ]);
    }
}
