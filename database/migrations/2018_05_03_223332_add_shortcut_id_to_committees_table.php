<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShortcutIdToCommitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('committee', function($table) {
            $table->integer('shortcut_id')->unsigned();

            $table->foreign('shortcut_id')->references('id')->on('committees_codes')->onDelete('cascade');
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
            $table->dropColumn('shortcut_id');
        });
    }
}
