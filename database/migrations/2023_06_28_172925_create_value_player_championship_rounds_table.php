<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValuePlayerChampionshipRoundsTable extends Migration
{
    public function up()
    {
        Schema::create('value_player_championship_rounds', function (Blueprint $table) {
            $table->id();
            $table->decimal('score', 8, 2)->nullable(false);
            $table->unsignedBigInteger('player_edition_id')->nullable(false);
            $table->unsignedBigInteger('championship_edition_id')->nullable(false);
            $table->unsignedBigInteger('championship_round_id')->nullable(false);
            $table->timestamps();
        
            $table->foreign('player_edition_id')->references('id')->on('player_editions');
            $table->foreign('championship_edition_id')->references('id')->on('championship_editions');
            $table->foreign('championship_round_id')->references('id')->on('championship_rounds');
        });
        
    }

    public function down()
    {
        Schema::table('value_player_championship_rounds', function (Blueprint $table) {
            $table->dropForeign(['player_edition_id']);
            $table->dropForeign(['championship_edition_id']);
            $table->dropForeign(['championship_round_id']);
        });

        Schema::dropIfExists('value_player_championship_rounds');
    }

}
