<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessiontimelineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessiontimeline', function (Blueprint $table) {
            $table->integer('workshop_id');
            $table->integer('session_number');
            $table->date('date_of_session'); 
            $table->time('to')->nullable(); 
            $table->time('from')->nullable(); 
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessiontimeline');
    }
}
