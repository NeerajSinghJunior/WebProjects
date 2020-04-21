<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
       public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('cash_type')->nullable();
            $table->string('currency')->nullable();
            $table->string('others')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
