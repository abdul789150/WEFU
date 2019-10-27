<?php

namespace App\Http\Controllers;

use App\Cart;
use App\ExtensionCart;
use App\Orders;
use App\Products;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class cart_controller extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function cart($username){

        $user = User::where('username', $username)->get();
        // dd($user);

        return view('customer_portal.shopping_cart', [
            'user' => $user,
        ]);
    }

    // public function checkout(Request $request){
        
    //     // $str = "1,42,32.00";
    //     // dd();


    //     $data = $request->all();
    //     // dd($data["quantity"][]);
    //     $cart_products = ExtensionCart::where('user_id', Auth::user()->id)->get();
    //     // dd($products);
    //     $order = Orders::where('user_id',Auth::user()->id)->where('address_id', null)->first();

    //     if($order == null){
    //         $order = new Orders();
    //         $order->user_id = Auth::user()->id;
    //         $order->save();
    //     }
        
    //     $total_price = 0;
    //     if($order->total_price != null){
    //         $total_price = $order->total_price;
    //     }

    //     foreach ($cart_products as $key => $value) {
    //         // dd($value->product_name);
    //         $product = new Products();
    //         $values = $value->getAttributes();
    //         // dd($value->id);
    //         foreach ($values as $key1 => $value1) {
    //             if($key1 == "price"){
    //                 $pkr_price = preg_replace("/(\,)/", "", $value1);
    //                 $pkr_price = str_replace("$", "",$pkr_price);
                                        
    //                 $pkr_price = (float) $pkr_price;
                    
    //                 $pkr_price = $pkr_price * 150;

    //                 // Mulitply price with quantity; 
    //                 $pkr_price = $pkr_price * $data["quantity"][$value->id];

    //                 $total_price = $total_price + $pkr_price;
    //                 // dd($total_price);
                    
    //                 $product->$key1 = $pkr_price;
    //             }
    //             else if($key1 != "id" && $key1 != "user_id" && $key1 != "created_at" && $key1 != "updated_at" && $value1 != null){
    //                 $product->$key1 = $value1;
    //             }
    //         }
    //         $product->save();

    //         $shopping_cart = new Cart();
    //         $shopping_cart->order_id = $order->id;
    //         $shopping_cart->product_id = $product->id;
    //         $shopping_cart->quantity = $data["quantity"][$value->id];
    //         $shopping_cart->save();
    //     }

    //     // Save total price in orders table
    //     $order = Orders::where('user_id',Auth::user()->id)->where('address_id', null)->first();

    //     $order->total_price = $total_price;
    //     $order->save();

    //     // dd($order);

    //     // $total_price = 0;

    //     return redirect('/shippmentDetails');
    // }

    public function checkout(Request $request){

        $cart_products = ExtensionCart::where('user_id', Auth::user()->id)->get();
        $data = $request->all();

        foreach ($cart_products as $key => $value) {
            $value->quantity = $data["quantity"][$value->id];
            $value->save();
        }

        return redirect('/shippmentDetails');
    }    


}
