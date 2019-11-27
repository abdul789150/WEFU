<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PricingPlans;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    //
    public function update_pricing_plan(){
        
        $pricing_plans = PricingPlans::all();
        
        return view("admin_portal.update_pricing_plan",[
            "pricing_plans" => $pricing_plans,
        ]);
    }

    public function save_pricing_plan(Request $request){
        dd($request->all());
    }
}
