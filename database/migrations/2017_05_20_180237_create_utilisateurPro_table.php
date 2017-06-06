<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUtilisateurProTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilisateurpros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('tel')->nullable();
            $table->string('adresse')->nullable();
            $table->string('compagnie')->nullable();
            $table->string('identifiantLegale')->nullable();
            $table->string('statusEntreprise')->nullable();
            $table->double('valeurTVA', 15, 3);
            $table->double('soldeHT', 15, 3);
            $table->integer('role_id')->default(1);
            $table->integer('superieur')->default(0);
            $table->integer('typeUser')->default(1);
            $table->string('etat')->default('Attente');
            $table->rememberToken();
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
        Schema::dropIfExists('utilisateurpros');
    }
}
