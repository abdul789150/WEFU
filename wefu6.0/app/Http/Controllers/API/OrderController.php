<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public $success_status = 200;
    public $unauth_error = 401;

    public function checkout_save_quantity(Request $request){
        return response()->json(['success' => $request->all()], $this->success_status);
    }
}
