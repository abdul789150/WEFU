<?php

namespace App\Http\Controllers;

use App\Orders;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    //
    public function payment_index($id){

        $order = Orders::where('id', $id)->first();

        return view('customer_portal.payment.payment_index',[
            "order" => $order,
        ]);
    }

    public function payment_checkout(Request $request){
        // dd($request->all()); 
        $data = $request->all();

        $order = Orders::where('id', $data["order_id"])->first();

        $total_price =  $order->total_price + $order->pricing_plan->price;
        $total_price = $total_price / 150;
        // dd($total_price);

        try{
            $charge = Stripe::charges()->create([
                'amount' => $total_price,
                'currency' => 'USD',
                'source' => $data["stripeToken"],
                'description' => 'Order Payment',
                'receipt_email' => $data["email"],
            ]);
            
            $order->payment_completed = true;
            $order->save();

            return redirect('customer/myPayments')->with('success', 'Thank you Your Payment has been accepted.');
        }catch(CardErrorException $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function my_payments(){

        $completed_payments = Orders::Where('user_id', Auth::user()->id)
                                      ->where('payment_completed', true)
                                      ->orderBy('updated_at', 'DESC')->get();
        // dd($completed_payments);
        $incomplete_payments = Orders::Where('user_id', Auth::user()->id)
                                       ->Where('payment_completed', false)->get();

        return view('customer_portal.payment.my_payment', [
            "completed_payments" => $completed_payments,
            "incomplete_payments" => $incomplete_payments,
        ]);
    }
}
