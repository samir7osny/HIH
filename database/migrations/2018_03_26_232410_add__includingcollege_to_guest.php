<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIncludingcollegeToGuest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::table('guest',function($table){
            $table->integer('id_college'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guest', function (Blueprint $table) {
            $table->dropColumn('id_college');
        });
    }
}
