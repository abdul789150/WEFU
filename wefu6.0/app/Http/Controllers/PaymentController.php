<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function payment_index(){
        return view('customer_portal.payment.payment_index');
    }
}
