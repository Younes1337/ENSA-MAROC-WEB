<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->string('sender_firstName');
            $table->string('sender_lastName');
            $table->string('email');
            $table->enum('sender_type', ["ENSA student", "External student", "Other", "ENSA Professor", "External Professor"]);
            $table->dateTime('date_time_sent');
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
        Schema::dropIfExists('messages');
    }
}