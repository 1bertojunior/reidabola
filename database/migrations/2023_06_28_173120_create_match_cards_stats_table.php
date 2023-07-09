<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchCardsStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_cards_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('minute')->nullable(false);
            $table->boolean('card_yellow')->default(false);
            $table->boolean('card_red')->default(false);
            $table->unsignedBigInteger('soccer_match_id')->nullable(false);
            $table->unsignedBigInteger('player_commited_id')->nullable(false);
            $table->unsignedBigInteger('player_suffered_id')->nullable(false);
            $table->timestamps();
        
            $table->foreign('soccer_match_id')->references('id')->on('soccer_matches');
            $table->foreign('player_commited_id')->references('id')->on('match_lineup');
            $table->foreign('player_suffered_id')->references('id')->on('match_lineup');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('match_goal_stats', function (Blueprint $table) {
            $table->dropForeign(['soccer_match_id']);
            $table->dropForeign(['player_gol_id']);
            $table->dropForeign(['player_assist_id']);
        });

        Schema::dropIfExists('match_goal_stats');
    }

}
