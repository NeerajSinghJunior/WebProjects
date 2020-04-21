<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('ether')->nullable();
            $table->string('bitcoin')->nullable();
            $table->string('site_title')->nullable();
            $table->string('site_logo')->nullable();
            $table->string('fav_ico')->nullable();
            $table->string('captcha_key')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_ifsc')->nullable();
            $table->string('selling_coin_name')->nullable();
            $table->integer('coin_value')->nullable();
            $table->string('recaptcha_public_key')->nullable();
            $table->string('recaptcha_private_key')->nullable();
            $table->string('payments_types')->default(2);
            $table->string('default_token_price')->default(1);
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
        Schema::drop('admins');
    }
}
