<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->text('short_description');
            $table->geometry('location');
            $table->string('city');
            $table->string('tags');
            $table->string('image');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->timestamps();

            $table->foreignId('e_n_s_a_id')->references('id')
                        ->on('e_n_s_a_s')
                            ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
