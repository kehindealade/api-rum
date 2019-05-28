<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookedRoomerHostelOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booked_roomer_hostel_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id');
            $table->integer('roomer_id');
            $table->integer('roomer_hostel_id');
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
        Schema::dropIfExists('booked_roomer_hostel_orders');
    }
}
