<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GamesExpansions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_expansions', function (Blueprint $table) {
            $table->unsignedBigInteger('idgame');
            $table->unsignedBigInteger('idexpansion');
            $table->timestamps();
            $table->foreign('idgame')
            ->references('id')->on('games')
            ->onDelete('cascade');
            $table->foreign('idexpansion')
            ->references('id')->on('games')
            ->onDelete('cascade');
            $table->unique(['idgame', 'idexpansion']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games_expansions');
    }
}
