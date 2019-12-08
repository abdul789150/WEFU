<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippmentDestinationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippment_destination', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shippment_id')->nullable();
            $table->unsignedInteger('route_id')->nullable();
            $table->timestamps();

            $table->foreign('shippment_id')
            ->references('id')->on('shippment')
            ->onDelete('cascade');
            $table->foreign('route_id')
            ->references('id')->on('route')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shippment_destination');
    }
}
