<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchGoalStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_goal_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('minute')->nullable(false);
            $table->boolean('awn')->default(false);
            $table->unsignedBigInteger('soccer_match_id')->nullable(false);
            $table->unsignedBigInteger('player_gol_id')->nullable(false);
            $table->unsignedBigInteger('player_assist_id')->nullable();
            $table->timestamps();
        
            $table->foreign('soccer_match_id')->references('id')->on('soccer_matches');
            $table->foreign('player_gol_id')->references('id')->on('match_lineup');
            $table->foreign('player_assist_id')->references('id')->on('match_lineup');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_goal_stats');
    }
}