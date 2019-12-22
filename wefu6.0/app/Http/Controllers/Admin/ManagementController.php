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
        // dd($request->all());
        $data = $request->all();
        $pricing_plans = PricingPlans::all();
        // $i = 1;
        foreach($pricing_plans as $plan){
            $plan->delivery_days = $data["delivery_date"][$plan->id];
            $plan->price = $data["price"][$plan->id];
            $plan->save();
        };

        return redirect()->back()->with("success", "Pricing Plans has been updated");
    }
}
