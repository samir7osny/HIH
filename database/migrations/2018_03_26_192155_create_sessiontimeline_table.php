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
            $table->date('dateofsession'); 
            $table->timestamp('to')->nullable(); 
            $table->timestamp('from')->nullable(); 
           
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
