<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRetrait extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retraits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('etat')->default('envoye');
            $table->string('facture', 250);
            $table->double('montant', 15, 3)->default(0.0);
            $table->unsignedInteger('utilisateur_id');
            $table->timestamps();

            //$table->foreign('utilisateur_id')->references('id')->on('utilisateurpros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retraits');
    }
}
