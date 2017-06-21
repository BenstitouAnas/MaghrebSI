<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesclientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messageclients', function (Blueprint $table) {
            $table->increments('id');
            $table->text('message');
            $table->unsignedInteger('ticket_id');
            $table->timestamps();

            $table->foreign('ticket_id')->references('id')->on('ticketclients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messageclients');
    }
}
