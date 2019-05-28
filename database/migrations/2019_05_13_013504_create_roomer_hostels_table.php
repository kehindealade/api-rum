<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomerHostelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roomer_hostels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('roomer_id');
            $table->integer('no_of_roommates');
            $table->integer('no_left');
            $table->longText('description');
            $table->string('location');
            $table->string('image');
            $table->integer('amount');
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
        Schema::dropIfExists('roomer_hostels');
    }
}
