<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToNewbuyorder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_room_book_orders', function (Blueprint $table) {
            //udc = undecided
            //acc = accepted
            //ign = ignored
            $table->string('status')->default('udc')->after('hostel_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_room_book_orders', function (Blueprint $table) {
            //
        });
    }
}
