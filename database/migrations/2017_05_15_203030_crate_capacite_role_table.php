<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateCapaciteRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('capacite_role', function (Blueprint $table) {
             $table->increments('id');
             $table->unsignedInteger('capacite_id');
             $table->unsignedInteger('role_id');
             $table->timestamps();

             //$table->foreign('capacite_id')->references('id')->on('capacities');
             //$table->foreign('role_id')->references('id')->on('roles');
         });

         Schema::table('capacite_role', function (Blueprint $table) {
            
            $table->foreign('role_id')->references('id')->on('roles');
            //$table->foreign('capacite_id')->references('id')->on('capacities');
        });
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
         Schema::dropIfExists('capacite_role');
     }
}
