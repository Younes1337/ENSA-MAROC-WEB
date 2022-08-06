<?php

use Faker\Factory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateENSASTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('e_n_s_a_s', function (Blueprint $table) {
            $faker = Factory::create();
            $table->id();
            $table->string('title')->unique();
            $table->string('logo');
            $table->string('cover_picture')->nullable()->default('/storage/images/cover_pictures/default.png');
            $table->longText('intro');
            $table->string('city')->nullable();
            $table->string('type');
            $table->string('website')->unique();
            $table->string('address');
            $table->enum('campus', ['girls', 'boys', 'girls_and_boys', 'none']);
            $table->enum('restaurants', ['girls', 'boys', 'girls_and_boys', 'none']);
            $table->text('carte');
            $table->longText('initial_education');
            $table->longText('continuing_education');
            $table->longText('cooperation');
            $table->boolean('published')->default(1);
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
        Schema::dropIfExists('e_n_s_a_s');
    }
}
