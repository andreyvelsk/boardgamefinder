<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GamesAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('games_attributes', function (Blueprint $table) {
             $table->unsignedBigInteger('idgame');
             $table->unsignedBigInteger('idattribute');
             $table->timestamps();
             $table->foreign('idgame')
             ->references('id')->on('games')
             ->onDelete('cascade');
             $table->foreign('idattribute')
             ->references('id')->on('attributes')
             ->onDelete('cascade');
             $table->unique(['idgame', 'idattribute']);
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
    }
}
