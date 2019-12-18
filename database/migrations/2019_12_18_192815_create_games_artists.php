<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesArtists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_artists', function (Blueprint $table) {
            $table->unsignedBigInteger('idgame');
            $table->unsignedBigInteger('idartist');
            $table->timestamps();
            $table->foreign('idgame')
            ->references('id')->on('games')
            ->onDelete('cascade');
            $table->foreign('idartist')
            ->references('id')->on('artists')
            ->onDelete('cascade');
            $table->unique(['idgame', 'idartist']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games_artists');
    }
}
