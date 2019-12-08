<?php

namespace App\Http\Controllers\Admin;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Orders;
use App\Products;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //

    public function orders_list(){

        $orders = Orders::all();

        return view('admin_portal.orders_list', [
            "orders" => $orders,
        ]);
    }

    public function manage_orders(){

        // All orders are new paid orders
        $paid_orders = Orders::Where('payment_completed', true)
                               ->Where('is_fulfilled', false)->get(); 
        

        // dd($paid_orders);
        $product_array = [];

        foreach ($paid_orders as $order) {
            $carts = $order->shopping_carts;
            foreach($carts as $item){
                $product_object = new class{};
                $product_object->quantity = $item->quantity;
                $product_object->product = $item->product;
                array_push($product_array, $product_object);
            }
        }
        // Checkpoint sucessfull
        // dd($product_array);
        // compare_properties($product_array[0]->product, $product_array[1]->product);

        $products_cluster_array = [];
        $check_list = [];
        for ($i=0; $i < sizeof($product_array); $i++) {
            $id = $product_array[$i]->product->id;
            $product_ids = [];
            if(!(in_array($id, $check_list))){
                array_push($check_list, $product_array[$i]->product->id);
                array_push($products_cluster_array, $product_array[$i]);
                array_push($product_ids, $product_array[$i]->product->id);            
            } 
            $position = sizeof($products_cluster_array) - 1;

            for ($j=0; $j < sizeof($product_array); $j++) {
                $id = $product_array[$j]->product->id; 
                if(!(in_array($id, $check_list))){
                    // $flag = compare_properties(, );
                    $product1 = $product_array[$i]->product->getAttributes();
                    $product2 = $product_array[$j]->product->getAttributes();
                    // dd($product1);
                    // Comparison of products
                    $flag = true;
                    foreach ($product1 as $key => $value) {
                        // dd($product1[$key]);
                        if($key != "product_link" && $key != "product_img_link" && $key != "id" && $key != "price" && $key != "condition" && $key != "seller_info" && $key != "created_at" && $key != "updated_at"){
                            // dd($product2[$key]);
                            if($product1[$key] != $product2[$key]){
                                $flag = false;
                                break;
                                // dd($product2[$key]);
                            }
                        }
                    }
                    // Comparison finished
                    if($flag == true){
                        $products_cluster_array[$position]->quantity += $product_array[$j]->quantity;
                        // $products_cluster_array[$position]->quantity += $product_array[$j]->quantity;
                        array_push($check_list, $id);
                        array_push($product_ids, $id);
                    }

                }
            }
            if($product_ids != null){
                $products_cluster_array[$position]->product_id_list = $product_ids;
            }


        }
        // dd($products_cluster_array);
        // $object_array = [];

        // $object = new class{};
        // $object->name = "Abdulrehman";
        // $object->quantity = 112;
        // array_push($object_array, $object);

        // dd($paid_orders[1]->shopping_carts[1]->product_id);

        return view('admin_portal.manage_orders',[
            "products_cluster_array" => $products_cluster_array,
        ]);
    }

    public function cluster_confirmation(Request $request){
        // dd($request->all());
        $data = $request->all();
        $product_list = Cart::WhereIn('product_id', $data["id_list"])->get();
        // dd($product_list);
        $order_id_list = [];
        foreach ($product_list as $item) {
            $item->is_confirmed = true;
            $item->amazon_order_no = $data["amazon_order_number"];
            array_push($order_id_list, $item->order_id);
            //     $item->save();
        }

        // $order_lists = Cart::WhereIn('product_id', $data["id_list"])->get('order_id');
        // dd($order_id_list);
        $orders = Orders::WhereIn("id", $order_id_list)->get();
        foreach ($orders as $item) {
            $shopping_cart = Cart::Where("order_id", $item->id)->get();
            // dd($shopping_cart);
            $flag = true;
            foreach ($shopping_cart as $cart) {
                if($cart->is_confirmed == false){
                    $flag = false;
                    break;
                }
            }
            if($flag == true){
                // dd("create new Shippment");
                $item->is_fulfilled = true;
                
            }

        }
    }

}
