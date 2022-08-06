<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonesEnsasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones_ensas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('e_n_s_a_id')
                ->references('id')->on('e_n_s_a_s')
                ->cascadeOnDelete();
            $table->foreignId('phone_id')
                ->references('id')->on('phones')
                ->cascadeOnDelete();
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
        Schema::dropIfExists('phones_ensas');
    }
}
