<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReferralSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('referral_offer_type', ['FLAT', 'PERCENT'])->default('PERCENT');
            $table->integer('referral_offer_amount');
            $table->integer('referral_offer_upto');
            $table->enum('status', [0, 1])->default(1);
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
