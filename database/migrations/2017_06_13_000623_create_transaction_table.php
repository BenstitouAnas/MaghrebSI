<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('evaluation', 1);
            $table->double('montant', 15, 8);
            $table->string('motif');
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
        Schema::dropIfExists('transactions');
    }
}
