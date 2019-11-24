<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //

    public function manage_orders(){

        $orders = Orders::all();

        return view('admin_portal.manage_orders', [
            "orders" => $orders,
        ]);
    }

}
