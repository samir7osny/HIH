<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollmentInEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollment_in_events', function (Blueprint $table) {
            $table->integer('event_id')->unsigned();
            $table->integer('guest_id')->unsigned(); 
            $table->timestamps();

            
            $table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
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
        Schema::dropIfExists('enrollment_in_events');
    }
}
