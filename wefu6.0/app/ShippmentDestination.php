<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippmentDestination extends Model
{
    //
    protected $table = "shippment_destination";
    protected $fillable = [
        "shippment_id", "route_id",    
    ];

    public function shippment(){
        return $this->belongsTo(Shippment::class);
    }

    public function route(){
        return $this->belongsTo(Route::class);
    }

}
