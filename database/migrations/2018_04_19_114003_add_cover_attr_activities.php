<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoverAttrActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event', function($table) {
            $table->integer('cover_id')->unsigned()->nullable();
            
            $table->foreign('cover_id')->references('id')->on('event_gallary')->onDelete('set null');
        });

        Schema::table('workshop', function($table) {
            $table->integer('cover_id')->unsigned()->nullable();
            
            $table->foreign('cover_id')->references('id')->on('workshop_gallary')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event', function (Blueprint $table) {
            $table->dropColumn('cover_id');
        });
        
        Schema::table('workshop', function (Blueprint $table) {
            $table->dropColumn('cover_id');
        });
    }
}
