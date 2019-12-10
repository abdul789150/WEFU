<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmazonShippmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amazon_shippment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('amazon_order_no');
            $table->boolean('is_confirmed')->default(false);
            $table->boolean('is_delivered_myUs')->default(false);
            $table->boolean('is_delivered_warehouse')->default(false);
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
        Schema::dropIfExists('amazon_shippment');
    }
}
