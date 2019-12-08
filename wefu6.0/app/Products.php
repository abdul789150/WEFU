<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $table = 'products';
    protected $fillable = [
        'product_name', 'product_link', 'product_img_link', 'size', 
        'variant','package','color', 'style',
        'length', 'ring_size', 'shape', 'display', 'case_diameter', 
        'band_material_type',
        'band_width', 'band_color', 'dial_color',
        'price', 'condition', 'seller_info'
    ];

    public function shopping_carts(){
        return $this->hasMany(Cart::class, 'product_id');
    }
}
