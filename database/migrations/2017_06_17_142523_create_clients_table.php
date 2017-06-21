<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom', 50);
            $table->string('prenom', 50);
            $table->string('password');
            $table->string('email')->unique();
            $table->string('tel')->nullable();
            $table->string('adresse')->nullable();
            $table->unsignedInteger('codePromo')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();

            //$table->foreign('codePromo')->references('id')->on('utilisateurpros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
