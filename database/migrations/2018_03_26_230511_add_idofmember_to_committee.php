<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdofmemberToCommittee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('committee', function($table) {
            $table->integer('head_id')->unsigned()->unique()->nullable();
            
            $table->foreign('head_id')->references('id')->on('member')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('committee', function (Blueprint $table) {
            $table->dropColumn('head_id');
        });
    }
}
