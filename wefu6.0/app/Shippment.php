<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shippment extends Model
{
    //
    protected $table = "shippment";
    protected $fillable = [
        "order_id", "delivered_by", "destination_long", "destination_lat",
    ];

    public function shippment_destinations(){
        return $this->hasMany(ShippmentDestination::class, "shippment_id");
    }
}
