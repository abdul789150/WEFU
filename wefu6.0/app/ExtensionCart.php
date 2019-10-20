<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;


class ExtensionCart extends Model
{
    //
    protected $table = 'extension_cart';
    protected $fillable = [
        'user_id','product_name', 'product_link', 'product_img_link', 'size', 
        'variant','package','color', 'style',
        'length', 'ring_size', 'shape', 'display', 'case_diameter', 
        'band_material_type',
        'band_width', 'band_color', 'dial_color',
        'price', 'condition', 'seller_info'
    ];


    function user(){
        $this->belongsTo(User::class);
    }
}
