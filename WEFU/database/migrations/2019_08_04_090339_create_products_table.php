<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->text('product_name');
            // general
            $table->string('size')->nullable();
            $table->string('variant')->nullable();
            $table->string('package')->nullable();
            $table->string('color')->nullable();
            $table->string('style')->nullable();
            // jewelry
            $table->string('length')->nullable();
            $table->string('ring_size')->nullable();
            // watch
            $table->string('shape')->nullable();
            $table->string('display')->nullable();
            $table->string('case_diameter')->nullable();
            $table->string('band_material_type')->nullable();
            $table->string('band_width')->nullable();
            $table->string('band_color')->nullable();
            $table->string('dial_color')->nullable();
            // Seller
            $table->decimal('price', 8, 2);
            $table->string('condition');
            $table->string('seller_info');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
