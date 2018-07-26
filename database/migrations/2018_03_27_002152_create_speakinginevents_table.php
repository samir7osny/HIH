<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeakingineventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('speakers_in_events', function (Blueprint $table) {
            $table->integer('event_id')->unsigned();
            $table->integer('speaker_id')->unsigned();

            
            $table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
            $table->foreign('speaker_id')->references('id')->on('speaker')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('speakers_in_events');
    }
}
