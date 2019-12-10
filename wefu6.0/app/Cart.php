<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "shopping_cart";
    protected $fillable = [
        "order_id", "product_id", "quantity", "amazon_shipment_id"
    ];
    
    function order(){
        return $this->belongsTo(Orders::class);
    }

    function product(){
        return $this->belongsTo(Products::class);
    }

    public function amazon_shipment(){
        return $this->belongsTo(AmazonShipment::class);
    }

}
