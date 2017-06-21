<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLignecommandeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lignecommandes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('produit_id');
            $table->integer('typeProduit');
            $table->integer('qte');
            $table->unsignedInteger('commande_id');
            $table->timestamps();

            //$table->foreign('produit_id')->references('id')->on('produits');
            //$table->foreign('commande_id')->references('id')->on('commandes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lignecommandes');
    }
}
