<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHihTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hih', function (Blueprint $table) {
            $table->timestamp('date_of_foundation'); 
            $table->string('college_id');
            $table->string('mission');
            $table->string('vision');
            $table->string('founder');
            $table->integer('president_id'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hih');
    }
}
