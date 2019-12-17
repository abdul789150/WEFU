<?php

namespace App\Http\Controllers\API;

use App\ExtensionCart;
use App\Address;
use App\Http\Controllers\Controller;
use App\PricingPlans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public $success_status = 200;
    public $unauth_error = 401;

    public function checkout_save_quantity(Request $request){

        $data = $request->all();
        $proucts_in_cart = ExtensionCart::where('user_id', Auth::user()->id)->get();

        foreach($proucts_in_cart as $item){
            $item->quantity = $data[$item->id];
            $item->save();
        }

        return response()->json(['sucess' => "Data saved"], $this->success_status);
    }

    public function get_pricing_plan(){

        $pricing_plans = PricingPlans::all();

        return response()->json(['pricing_plans' => $pricing_plans], $this->success_status);
    }

}
