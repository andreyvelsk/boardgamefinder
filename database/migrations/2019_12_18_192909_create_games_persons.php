<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesPersons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_persons', function (Blueprint $table) {
            $table->unsignedBigInteger('idgame');
            $table->unsignedBigInteger('idperson');
            $table->timestamps();
            $table->foreign('idgame')
            ->references('id')->on('games')
            ->onDelete('cascade');
            $table->foreign('idperson')
            ->references('id')->on('persons')
            ->onDelete('cascade');
            $table->unique(['idgame', 'idperson']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games_persons');
    }
}
