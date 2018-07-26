<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopsRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshops_rate', function (Blueprint $table) {
            $table->integer('workshop_id')->unsigned();
            $table->integer('guest_id')->unsigned();
            $table->float('rate');
            
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
        Schema::dropIfExists('workshops_rate');
    }
}
