<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $table = 'address';
    protected $fillable = [
        'user_id','delivery_address', 'province', 'city','zipcode'
    ];


    function user(){
        return $this->belongsTo(User::class);
    }
}
