<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_types', function (Blueprint $table) {
            $table->unsignedBigInteger('idgame');
            $table->unsignedBigInteger('idtype');
            $table->timestamps();
            $table->foreign('idgame')
            ->references('id')->on('games')
            ->onDelete('cascade');
            $table->foreign('idtype')
            ->references('id')->on('types')
            ->onDelete('cascade');
            $table->unique(['idgame', 'idtype']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games_types');
    }
}
