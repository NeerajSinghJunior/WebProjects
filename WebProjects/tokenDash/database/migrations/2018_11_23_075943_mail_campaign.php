<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MailCampaign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('mail_campaign', function (Blueprint $table) {
            $table->increments('id');
            $table->string('request_type');
            $table->string('emails')->nullable();
            $table->string('subject');
            $table->longText('mail_content');
            $table->string('user_count')->nullable();
            $table->string('status')->default(1);
            $table->string('is_updated')->default(0);
            $table->date('req_from_date')->nullable();
            $table->date('req_to_date')->nullable();
            $table->string('delivered_count')->nullable();
            $table->string('rejected_count')->nullable();
            $table->string('failed_count')->nullable();
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
