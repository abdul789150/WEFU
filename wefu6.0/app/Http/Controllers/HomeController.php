<?php

namespace App\Http\Controllers;

use App\TopProducts;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $top_products = TopProducts::orderBy('rating', 'desc')->get();

        // dd($top_products);

        return view('customer_portal.home',[
            "top_products" => $top_products,
        ]);
    }
}
