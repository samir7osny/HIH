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
            $table->string('University');
            $table->timestamp('date_of_foundation'); 
            $table->string('Faculty');
            $table->string('Mission');
            $table->string('Vision');
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
