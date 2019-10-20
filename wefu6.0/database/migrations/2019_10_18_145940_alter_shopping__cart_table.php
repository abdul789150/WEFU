<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterShoppingCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('shopping_cart', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
