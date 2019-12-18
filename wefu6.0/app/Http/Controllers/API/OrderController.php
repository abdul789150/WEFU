<?php

namespace App\Http\Controllers\API;

use App\ExtensionCart;
use App\Address;
use App\Orders;
use App\Products;
use App\Cart;
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

    public function confirm_order(Request $request){
         
        // $address = Address::where('id', 'address_id')->get();
        $data = $request->all();
        $order = new Orders();
        $order->user_id = Auth::user()->id;
        $order->address_id = $data["address_id"];
        $order->pp_id = $data["pp_id"];
        $order->save();

        // $order_id = $order->id;

        $cart_products = ExtensionCart::where('user_id', Auth::user()->id)->get();

        $total_price = 0;
        foreach ($cart_products as $key => $value) {
            // dd($value->product_name);
            $product = new Products();
            $values = $value->getAttributes();

            foreach ($values as $key1 => $value1) {
                if($key1 == "price"){
                    $pkr_price = preg_replace("/(\,)/", "", $value1);
                    $pkr_price = str_replace("$", "",$pkr_price);
                                        
                    $pkr_price = (float) $pkr_price;
                    
                    $pkr_price = $pkr_price * 150;

                    // Mulitply price with quantity;
                    // dd($value->quantity); 
                    $pkr_price = $pkr_price * $value->quantity;

                    $total_price = $total_price + $pkr_price;
                    // dd($total_price);
                    
                    $product->$key1 = $pkr_price;
                }
                else if($key1 != "id" && $key1 != "user_id" && $key1 != "created_at" && $key1 != "updated_at" && $key1 != "quantity" && $value1 != null){
                    $product->$key1 = $value1;
                }
            }
            
            $product->save();
            
            $shopping_cart = new Cart();
            $shopping_cart->order_id = $order->id;
            $shopping_cart->product_id = $product->id;
            $shopping_cart->quantity = $value->quantity;
            $shopping_cart->save();

        }

        $order->total_price = $total_price;
        $order->save();
        $address = Address::Where('id', $data["address_id"])->first();
        $array_order = [$order->id, $address->delivery_address];

        return response()->json(['details' => $array_order], 200);

    }
}
