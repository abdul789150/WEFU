<?php

namespace App\Http\Controllers;

use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    //
    public function payment_index(){
        return view('customer_portal.payment.payment_index');
    }

    public function payment_checkout(Request $request){
        // dd($request->all());
        $data = $request->all();
        try{
            $charge = Stripe::charges()->create([
                'amount' => 400,
                'currency' => 'USD',
                'source' => $data["stripeToken"],
                'description' => 'Order Payment',
                'receipt_email' => $data["email"],
            ]);

            return back()->with('success', 'Thank you Your Payment has been accepted.');
        }catch(CardErrorException $e){
            return back()->with('error', $e->getMessage());
        }
    }
}
