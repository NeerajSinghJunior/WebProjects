<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MessageCampaign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('message_campaign', function (Blueprint $table) {
            $table->increments('id');
            $table->string('request_type');
            $table->longText('numbers')->nullable();
            $table->string('subject');
            $table->longText('message_content');
            $table->string('user_count')->nullable();
            $table->string('status')->default(1);
            $table->date('req_from_date')->nullable();
            $table->date('req_to_date')->nullable();
            $table->string('delivered_count')->nullable();
            $table->string('sent_count')->nullable();
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
