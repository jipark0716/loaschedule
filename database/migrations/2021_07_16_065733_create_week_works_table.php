<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeekWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('week_works', function (Blueprint $table) {
            $table->id();
            $table->integer('content_id');
            $table->integer('target_id');
            $table->string('type', 10);
            $table->integer('week');
            $table->dateTime('created_at', 0);

            $table->unique(['content_id', 'target_id', 'week']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('week_works');
    }
}
