<?php

namespace App;

// use Faker\Provider\Address;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    protected $table = 'orders';
    protected $fillable = [
        'user_id','pp_id', 'address_id', 'total_price','payment_completed', 'is_delivered'
    ];

    function user(){
        return $this->belongsTo(User::class);
    }
    
    function address(){
        return $this->belongsTo(Address::class);
    }

    function pricing_plan(){
        return $this->belongsTo(PricingPlans::class, "pp_id");
    }

    function shopping_carts(){ 
        return $this->hasMany(Cart::class, "order_id");
    }




}
