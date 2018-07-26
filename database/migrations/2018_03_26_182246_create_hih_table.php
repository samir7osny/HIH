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
            $table->integer('college_id')->unsigned();
            $table->mediumText('mission');
            $table->mediumText('vision');
            $table->mediumText('story')->nullable();
            $table->string('founder');
            $table->integer('president_id')->unsigned();
            
            
            $table->foreign('president_id')->references('id')->on('member')->onDelete('RESTRICT');
            $table->foreign('college_id')->references('id')->on('college')->onDelete('cascade');
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
