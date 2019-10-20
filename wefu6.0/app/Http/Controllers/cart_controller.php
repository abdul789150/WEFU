<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
}
