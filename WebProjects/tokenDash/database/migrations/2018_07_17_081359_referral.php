<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Referral extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('referrer');
            $table->integer('user');
            $table->integer('user_bought_amount');
            $table->integer('referer_earning_amount');
            $table->integer('referel_txn_id');
            $table->enum('status', ['COMPLETED', 'PENDING', 'CANCELLED'])->default('PENDING');
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
        //
    }
}
