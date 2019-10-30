<?php

namespace App\Http\Controllers;

use App\Orders;
use App\User;
use App\Address;
use App\ExtensionCart;
use App\PricingPlans;
use App\Products;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as IlluminateSession;
use Illuminate\Support\Facades\Session as IlluminateSupportSession;
use Illuminate\Support\Facades\Validator;
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

    public function selected_pricing_plan(Request $request){
        // dd($request->all());
        $data = $request->all();
        return redirect('orderConfirmation/'.$data["address_id"].'/'.$data["pp_id"]);
    }


    public function order_confirmation($address_id, $pp_id){
        
        $pricing_plan = PricingPlans::where('id', $pp_id)->first();
        $address = Address::where('id', $address_id)->first();

        $cart_products = ExtensionCart::where('user_id',Auth::user()->id)->get();

        $total_price = 0;
        $total_products = $cart_products->count();
        $products_pkr_price = array();

        foreach ($cart_products as $key => $value) {

            $pkr_price = preg_replace("/(\,)/", "", $value->price);
            $pkr_price = str_replace("$", "",$pkr_price);
            $pkr_price = (float) $pkr_price; 
            $pkr_price = $pkr_price * 150;
            
            $products_pkr_price[$value->id] = number_format($pkr_price);

            $product_price = $pkr_price * $value->quantity;
            $total_price = $total_price + $product_price;
            
        }

        // $total_price = number_format($total_price);
        // dd($products_pkr_price);

        return view('customer_portal.order_confirmation',[
            'cart_products' => $cart_products,
            'pricing_plan' => $pricing_plan,
            'total_price' => $total_price,
            'total_products' => $total_products,
            'products_pkr_price' => $products_pkr_price,
            'address' => $address,
        ]);
    }

    public function place_order(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            "pp_id" => "required",
            "address_id" => "required",
        ]);

        if($validator->fails()){
            return response()->json(['error' => 'Email/Username or Password Error'], 401);
        }    

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

        return response()->json(['success' => 'Order confirmed'], 200);
    }
}
