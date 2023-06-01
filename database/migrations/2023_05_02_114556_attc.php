<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Attc extends Migration
{

    public function up()
    {
        Schema::create('attcs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->nullable();
            $table->integer('activity_id')->nullable();
            $table->text('file')->nullable();
            $table->text('note')->nullable();
            });
    }

    public function down()
    {
        Schema::drop('attcs');
    }
}
