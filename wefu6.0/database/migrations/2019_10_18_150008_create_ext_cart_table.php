<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extension_cart', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');

            $table->text('product_name');
            // general
            $table->string('product_link')->nullable();
            $table->string('product_img_link')->nullable();
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
            $table->string('price');
            $table->string('condition')->nullable();
            $table->string('seller_info')->nullable();

            $table->unsignedInteger('quantity')->default(1);

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extension_cart');
    }
}
