<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchGameLineupScoresTable extends Migration
{

    public function up()
    {
        Schema::create('match_game_lineup_scores', function (Blueprint $table) {
            $table->id();
            $table->decimal('score', 8, 2)->nullable(false);
            $table->unsignedBigInteger('match_game_lineup_id');
            $table->timestamps();

            $table->foreign('match_game_lineup_id')->references('id')->on('match_game_lineups');
        });
    }

    public function down()
    {
        Schema::table('match_game_lineup_scores', function (Blueprint $table) {
            $table->dropForeign(['match_game_lineup_id']);
        });
    
        Schema::dropIfExists('match_game_lineup_scores');
    }
}
