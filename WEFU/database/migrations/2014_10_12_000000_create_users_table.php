<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('role_id');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('phone_no')->nullable();
            $table->string('profile_img')->default("default.jpg");
            $table->rememberToken(); //used for users which selects the "remember me" option
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
        Schema::dropIfExists('users');
    }
}
