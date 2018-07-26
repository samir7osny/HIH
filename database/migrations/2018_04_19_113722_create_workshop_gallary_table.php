<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopGallaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshop_gallary', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->integer('workshop_id')->unsigned();

            
            $table->foreign('workshop_id')->references('id')->on('workshop')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workshop_gallary');
    }
}
