<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "shopping_cart";
    // 
    function order(){
        $this->belongsTo(Orders::class);
    }

    function product(){
        $this->belongsTo(Products::class);
    }

}
