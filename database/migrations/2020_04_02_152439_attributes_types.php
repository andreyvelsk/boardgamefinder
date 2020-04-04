<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AttributesTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('attributes_types', function (Blueprint $table) {
             $table->bigIncrements('id');
             $table->string('name')->nullable($value = true)->unique();
             $table->string('bggname')->nullable($value = false)->unique();
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
         Schema::dropIfExists('attributes_types');
     }
}
