<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchLineupScoresTable extends Migration
{
    public function up()
    {
        Schema::create('match_lineup_scores', function (Blueprint $table) {
            $table->id();
            $table->decimal('score', 8, 2)->nullable(false);
            $table->unsignedBigInteger('match_lineup_id');
            $table->timestamps();

            $table->foreign('match_lineup_id')->references('id')->on('player_editions');
        });
    }

    public function down()
    {
        Schema::table('match_lineup_scores', function (Blueprint $table) {
            $table->dropForeign(['match_lineup_id']);
        });

        Schema::dropIfExists('match_lineup_scores');
    }
}
