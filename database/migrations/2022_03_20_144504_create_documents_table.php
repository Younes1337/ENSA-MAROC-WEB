<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('doc_title')->unique();
            $table->enum('doc_type', ["courses", "practical_directed_work", "exams"]);
            $table->string('doc_link')->unique();
            $table->timestamps();

            $table->foreignId('module_id')
                ->references('id')->on('modules')
                ->cascadeOnDelete();
            $table->foreignId('element_id')
                ->references('id')->on('elements')
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
        Schema::dropIfExists('documents');
    }
}