<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ScheduleMails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('schedule_mails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('request_type');
            $table->string('subject');
            $table->longText('mail_content');
            $table->dateTime('date');
            $table->string('status')->default(1);
            $table->date('req_from_date')->nullable();
            $table->date('req_to_date')->nullable();
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
