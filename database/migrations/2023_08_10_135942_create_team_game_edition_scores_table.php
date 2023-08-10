<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamGameEditionScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_g_e_scores', function (Blueprint $table) {
            $table->id();
            $table->decimal('score', 8, 2)->nullable(false);
            $table->unsignedBigInteger('team_game_edition_id');
            $table->unsignedBigInteger('championship_round_id');
            $table->timestamps();
        
            $table->foreign('team_game_edition_id')->references('id')->on('team_game_editions');
            $table->foreign('championship_round_id')->references('id')->on('championship_rounds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_g_e_scores', function (Blueprint $table) {
            $table->dropForeign(['team_game_edition_id']);
            $table->dropForeign(['championship_round_id']);
        });
    
        Schema::dropIfExists('t_g_e_scores');
    }
    
}
