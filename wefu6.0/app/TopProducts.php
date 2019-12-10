<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopProducts extends Model
{
    //
    protected $table = "top_products";

    protected $fillable = [
        "name", "img_link", "rating", "prev_rating",
    ];
}
