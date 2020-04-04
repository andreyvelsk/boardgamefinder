<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Attributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idbgg');
            $table->string('name')->nullable($value = true)->unique();
            $table->string('bggname')->nullable($value = false)->unique();
            $table->unsignedBigInteger('idattribute_type');
            $table->timestamps();
            $table->foreign('idattribute_type')
            ->references('id')->on('attributes_types')
            ->onDelete('cascade');
            $table->unique(['idbgg', 'idattribute_type']);
         });
     }
 
     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
        Schema::dropIfExists('games_attributes');
        Schema::dropIfExists('attributes');
     }
}
