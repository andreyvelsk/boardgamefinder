<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idtesera')->nullable($value = true);
            $table->bigInteger('idbgg')->nullable($value = true);
            $table->string('title');
            $table->text('description')->nullable($value = true);
            $table->year('yearpublished')->nullable($value = true);
            $table->decimal('bgggeekrating', 5, 3)->nullable($value = true);
            $table->decimal('bggavgrating', 5, 3)->nullable($value = true);
            $table->integer('bggnumvotes')->nullable($value = true);
            $table->text('thumbnail')->nullable($value = true);
            $table->integer('mainplayers')->nullable($value = true);
            $table->integer('maxplayers')->nullable($value = true);
            $table->integer('suggestedplayers')->nullable($value = true);
            $table->integer('minage')->nullable($value = true);
            $table->integer('suggestedage')->nullable($value = true);
            $table->integer('minplaytime')->nullable($value = true);
            $table->integer('maxplaytime')->nullable($value = true);
            $table->decimal('gameweight', 3, 2)->nullable($value = true);
            $table->boolean('isexpansion')->nullable($value = true);
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
        Schema::dropIfExists('games');
    }
}
