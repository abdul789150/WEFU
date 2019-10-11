<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $table = 'address';
    protected $fillable = [
        'user_id','delivery_address', 'province', 'city',
    ];


    function user(){
        $this->belongsTo(User::class);
    }
} 
