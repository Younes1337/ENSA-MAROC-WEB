<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrientationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orientations', function (Blueprint $table) {
            $table->id();
            $table->string('title_exam');
            $table->enum('level_exam', ["Baccalaureate", "Baccalaureate +2"]);
            $table->string('link_exam');

            $table->foreignId("e_n_s_a_id")
                ->references("id")
                ->on("e_n_s_a_s")
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.git push
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orientations');
    }
}
