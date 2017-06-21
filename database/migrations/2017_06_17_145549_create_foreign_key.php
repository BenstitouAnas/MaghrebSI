<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('capacite_role', function (Blueprint $table) {
            $table->foreign('capacite_id')->references('id')->on('capacities');
            $table->foreign('role_id')->references('id')->on('roles');
        });*/

        Schema::table('utilisateurpros', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('superieur')->references('id')->on('utilisateurpros');
        });

        Schema::table('retraits', function (Blueprint $table) {
            $table->foreign('utilisateur_id')->references('id')->on('utilisateurpros');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('utilisateur_id')->references('id')->on('utilisateurpros');
        });

        Schema::table('produits', function (Blueprint $table) {
            $table->foreign('categorie_id')->references('id')->on('categories');
        });

        Schema::table('deals', function (Blueprint $table) {
            $table->foreign('produit_id')->references('id')->on('produits');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('utilisateur_id')->references('id')->on('utilisateurpros');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->foreign('ticket_id')->references('id')->on('tickets');
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->foreign('utilisateur_send')->references('id')->on('utilisateurpros');
            $table->foreign('utilisateur_rece')->references('id')->on('utilisateurpros');

            $table->foreign('commande_id')->references('id')->on('commandes');

            $table->foreign('produit_id')->references('id')->on('produits');
        });

        Schema::table('lignecommandes', function (Blueprint $table) {
            $table->foreign('produit_id')->references('id')->on('produits');
            $table->foreign('commande_id')->references('id')->on('commandes');
        });

        Schema::table('commandes', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients');
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->foreign('codePromo')->references('id')->on('utilisateurpros');
        });

        Schema::table('bookings', function (Blueprint $table) {
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
        //
    }
}
