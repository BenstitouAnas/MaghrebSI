<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketclientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticketclients', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('utilisateur_send')->unsigned();
            $table->unsignedInteger('utilisateur_rece')->unsigned();
            $table->string('titre');
            $table->string('objet');
            $table->integer('priorite')->default(3);
            $table->string('support');
            $table->unsignedInteger('commande_id');
            $table->integer('typeProduit')->unsigned();
            $table->unsignedInteger('produit_id')->nullable();
            $table->timestamps();

            $table->foreign('utilisateur_send')->references('id')->on('clients');
            $table->foreign('utilisateur_rece')->references('id')->on('utilisateurpros');

            $table->foreign('commande_id')->references('id')->on('commandes');

            $table->foreign('produit_id')->references('id')->on('produits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticketclients');
    }
}
