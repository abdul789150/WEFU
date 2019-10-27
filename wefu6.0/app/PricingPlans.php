<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PricingPlans extends Model
{
    protected $table = 'pricing_plans';
    protected $fillable = [
        'name','delivery_days', 'price',
    ];

    function orders(){ 
        return $this->hasMany(Orders::class, 'pp_id');
    }

}
 