<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsringworkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsring_workshops', function (Blueprint $table) {
            $table->integer('workshop_id')->unsigned();
            $table->integer('sponsor_id')->unsigned();

            
            $table->foreign('workshop_id')->references('id')->on('workshop')->onDelete('cascade');
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
        Schema::dropIfExists('sponsring_workshops');
    }
}
