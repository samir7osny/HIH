<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers_workshops', function (Blueprint $table) {
            $table->integer('question_id')->unsigned();
            $table->integer('workshop_id')->unsigned();
            $table->integer('guest_id')->unsigned();
            $table->mediumText('answer_content')->nullable();

            
            $table->foreign('question_id')->references('id')->on('questions_events')->onDelete('cascade');
            $table->foreign('workshop_id')->references('id')->on('workshop')->onDelete('cascade');
            $table->foreign('guest_id')->references('id')->on('guest')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
