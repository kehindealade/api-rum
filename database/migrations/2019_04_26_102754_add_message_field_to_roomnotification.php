<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMessageFieldToRoomnotification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('room_notifications', function (Blueprint $table) {
            $table->string('message')->after('roomer_id')->default("Now you can proceed to pay to us");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('room_notificationd', function (Blueprint $table) {
            //
        });
    }
}
