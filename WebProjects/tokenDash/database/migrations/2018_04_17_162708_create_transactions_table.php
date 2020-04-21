<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('amount');
            $table->string('coins');
            $table->string('txn_id');
            $table->string('date');
            $table->string('trans_token')->nullable();
            $table->string('payer_id')->nullable();
            $table->string('pay_mode')->nullable();
            $table->string('pay_type')->default(1);
            $table->string('pay_status')->nullable();
            $table->string('description');
            $table->string('screenshot');
            $table->string('ether')->nullable();
            $table->string('wallet_address')->nullable();
            $table->string('wallet_name')->nullable();
            $table->string('new_transaction_id')->nullable();
            $table->enum('status', ['PENDING','COMPLETED','CANCELLED'])->default('PENDING');
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
        Schema::dropIfExists('transactions');
    }
}
