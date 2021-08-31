<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDayWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_works', function (Blueprint $table) {
            $table->id();
            $table->string('content', 10);
            $table->integer('character_id');
            $table->integer('before_rest');
            $table->integer('day');
            $table->dateTime('created_at', 0);

            $table->unique(['content', 'character_id', 'day']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('day_works');
    }
}
