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
            $table->bigIncrements('id');

            $table->string('fb_id')->nullable();
            $table->string('vk_id')->nullable();

            $table->string('avatar')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
//            $table->string('phone',12)->nullable();
            
            $table->string('password');
            $table->string('confirm_token')->nullable();
            $table->smallInteger('type');
            $table->boolean('active')->nullable();
            $table->boolean('send_mail')->nullable();
            $table->rememberToken();
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
