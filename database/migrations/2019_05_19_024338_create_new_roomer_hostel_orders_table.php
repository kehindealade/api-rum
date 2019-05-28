<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewRoomerHostelOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_roomer_hostel_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id');
            $table->integer('roomer_hostel_id');
            $table->integer('roomer_id');
            $table->string('status')->default('udc');
            $table->longText('order_notes')->nullable();
            $table->timestamp('book_date');
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
        Schema::dropIfExists('new_roomer_hostel_orders');
    }
}
