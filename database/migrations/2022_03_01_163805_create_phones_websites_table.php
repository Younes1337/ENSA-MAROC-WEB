<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonesWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones_websites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_id')
                        ->references('id')->on('websites')
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
        Schema::dropIfExists('phones_websites');
    }
}
