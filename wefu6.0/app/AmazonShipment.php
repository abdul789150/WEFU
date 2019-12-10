<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AmazonShipment extends Model
{
    //
    protected $table = "amazon_shippment";
    protected $fillable = [
        "amazon_order_no", "is_confirmed", "is_delivered_myUs", "is_delivered_warehouse",
    ];

    public function shopping_carts(){
        return $this->hasMany(Cart::class, "amazon_shipment_id");
    }
}
