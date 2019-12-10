<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    //
    protected $table = "route";
    protected $fillable = [
        "location_name", "location_long", "location_lat",
    ];

    public function shippment_destinations(){
        return $this->hasMany(ShippmentDestination::class, "route_id");        
    }
}
