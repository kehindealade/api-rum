<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostelConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostel_conversations', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('status')->default();
            $table->integer('hostel_id');
            $table->integer('leaser_id')->default(0);
            $table->integer('roomer_id')->default(0);
            $table->longText('message');
            $table->timestamp('date');
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
        Schema::dropIfExists('hostel_conversations');
    }
}
