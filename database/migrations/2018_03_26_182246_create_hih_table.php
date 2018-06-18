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
            $table->date('date_of_foundation'); 
            $table->integer('college_id');
            $table->mediumText('mission');
            $table->mediumText('vision');
            $table->mediumText('story')->nullable();
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
