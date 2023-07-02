<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamGameEditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_game_editions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_game_id');
            $table->unsignedBigInteger('championship_edition_id');
            $table->timestamps();
        
            $table->foreign('team_game_id')->references('id')->on('team_games');
            $table->foreign('championship_edition_id')->references('id')->on('championship_editions');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_game_editions');
    }
}
