<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('libelle', 100);
            $table->unsignedInteger('categorie_id');
            $table->string('image', 250);
            $table->text('documentation');
            $table->text('documentationTechnique');
            $table->integer('typeProduit')->default(0);
            $table->double('prix', 15, 8)->nullable();
            $table->unsignedInteger('qte')->nullable();
            $table->integer('public')->default(1);
            $table->timestamps();

            //$table->foreign('categorie_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produit');
    }
}
