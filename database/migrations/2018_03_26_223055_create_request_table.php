<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deleting_request', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content');
            $table->string('deleted_user_name')->nullable();
            $table->integer('sender');
            $table->integer('member_to_delete_id');
            $table->boolean('answer')->nullable();
            $table->boolean('answered');
            $table->boolean('seen');
            $table->timpstamp('seen_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request');
    }
}
