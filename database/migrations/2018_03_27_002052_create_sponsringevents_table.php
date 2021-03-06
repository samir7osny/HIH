<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsringeventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsring_events', function (Blueprint $table) {
            $table->integer('event_id')->unsigned();
            $table->integer('sponsor_id')->unsigned();

            
            $table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
            $table->foreign('sponsor_id')->references('id')->on('sponsor')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsring_events');
    }
}
