<?php

namespace App\Http\Controllers\API;

use App\ExtensionCart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Bridge\User;

class CartController extends Controller
{
    //

    // 
    public function products_in_cart(){
        
        $user_id = Auth::user()->id;
        $products = ExtensionCart::where('user_id', $user_id)->get();

        return response()->json(['products' => $products], 200);
    }

    public function add_to_cart(Request $request){

        $user_id = Auth::user()->id;
        
        $data = $request->all();
        $extension_cart = new ExtensionCart();

        $extension_cart->user_id = $user_id;
        foreach ($data as $key => $value) {
            $extension_cart->$key = $value;
        }

        $extension_cart->save();

        return response()->json(['success' => 'Added to cart'], 200);
    }

    public function delete_from_cart(Request $request){

        if($request->has("product_id")){
            $product_id = $request["product_id"];
            // echo($product_id);
            $product = ExtensionCart::find($product_id);
            if($product != null){
                $product->delete();
                return response()->json(['success' => 'Prodcut deleted fom cart'], 200);
            }
        }

        return response()->json(['error' => 'Product not Found'], 401);

    }

    public function update_product(){    }


}
