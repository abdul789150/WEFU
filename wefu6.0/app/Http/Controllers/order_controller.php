<?php

namespace App\Http\Controllers;

use App\Orders;
use App\User;
use App\Address;
use App\ExtensionCart;
use App\PricingPlans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as IlluminateSession;
use Illuminate\Support\Facades\Session as IlluminateSupportSession;
use Symfony\Component\HttpFoundation\Session\Session;

class order_controller extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        $user = User::where('id', Auth::user()->id)->get();

        return view('customer_portal.orders', [
            'user' => $user,
        ]);
    }


    public function shippment_details(){
        
        $user = User::where('id', Auth::user()->id)->get();
        
        return view('customer_portal.shippment_details',[
            'user' => $user,
        ]);
    }

    public function selected_address(Request $request){
        // dd($request->all());
        $data = $request->all();

        // Redirect Remains
        return redirect('shippingOption/'.$data["selected_address"]);

    }

    public function save_selected_address(Request $request){
        // dd($request->all());
        
        $data = $request->all();
        // dd($data);
        if(array_key_exists("phone_no", $data)){
            $data = request()->validate([
                'delivery_address' => 'required',
                'city' => 'required',
                'province' => 'required',
                'phone_no' => 'required',
                'zipcode' => 'required',
            ]);

            $user = User::where('id', Auth::user()->id)->first();
            foreach ($data as $key => $value) {
                if($value != null){
                    if($key == "phone_no"){
                        $user->phone_no = $value;
                    }
                }
            }    
            $user->save();

            $address = new Address();
            $address->user_id = $user->id;
            $address->delivery_address = $data['delivery_address'];
            $address->province = $data['province'];
            $address->city = $data['city'];
            $address->zipcode = $data['zipcode'];
            
            $address->save();

            return redirect('shippingOption/'.$address->id);

        }else{

            $data = request()->validate([
                'delivery_address' => 'required',
                'city' => 'required',
                'province' => 'required',
                'zipcode' => 'required',
            ]);

            $user = User::where('id', Auth::user()->id)->first();
            $address = new Address();
            $address->user_id = $user->id;
            $address->delivery_address = $data['delivery_address'];
            $address->province = $data['province'];
            $address->city = $data['city'];
            $address->zipcode = $data['zipcode'];

            $address->save();
  
            return redirect('shippingOption/'.$address->id);
        }

    }


    public function shipping_option($address_id){
        
        $pricing_plans = PricingPlans::all();
        $address = Address::where('id', $address_id)->first();
        $cart_products = ExtensionCart::where('user_id',Auth::user()->id)->get();

        $total_price = 0;
        $total_products = $cart_products->count();

        foreach ($cart_products as $key => $value) {

            $pkr_price = preg_replace("/(\,)/", "", $value->price);
            $pkr_price = str_replace("$", "",$pkr_price);
            $pkr_price = (float) $pkr_price; 
            $pkr_price = $pkr_price * 150;

            $product_price = $pkr_price * $value->quantity;
            $total_price = $total_price + $product_price;
            
        }

        return view('customer_portal.shipping_option',[
            'pricing_plans' => $pricing_plans,
            'total_price' => $total_price,
            'total_products' => $total_products,
            'address' => $address,
        ]);
    }

}
