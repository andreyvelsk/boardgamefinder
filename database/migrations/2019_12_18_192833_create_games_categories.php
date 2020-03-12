<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('idgame');
            $table->unsignedBigInteger('idcategory');
            $table->timestamps();
            $table->foreign('idgame')
            ->references('id')->on('games')
            ->onDelete('cascade');
            $table->foreign('idcategory')
            ->references('id')->on('categories')
            ->onDelete('cascade');
            $table->unique(['idgame', 'idcategory']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games_categories');
    }
}
