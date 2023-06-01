<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('user_settings', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->string('phone');
                $table->string('position');
                $table->integer('level');
                $table->string('profile')->nullable();
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
        Schema::drop('user_settings');
    }
}
