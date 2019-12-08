<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "shopping_cart";
    // 
    function order(){
        return $this->belongsTo(Orders::class);
    }

    function product(){
        return $this->belongsTo(Products::class);
    }

}
