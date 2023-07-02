<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoccerMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soccer_matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team1_edition_id')->nullable(false);
            $table->unsignedBigInteger('team2_edition_id')->nullable(false);
            $table->unsignedBigInteger('championship_edition_id')->nullable(false);
            $table->unsignedBigInteger('stadium_football_id')->nullable(false);
            $table->unsignedBigInteger('championship_round_id')->nullable(false);
            $table->timestamps();
        
            $table->foreign('team1_edition_id')->references('id')->on('team_editions');
            $table->foreign('team2_edition_id')->references('id')->on('team_editions');
            $table->foreign('championship_edition_id')->references('id')->on('championship_editions');
            $table->foreign('stadium_football_id')->references('id')->on('stadium_footballs');
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
    Schema::dropIfExists('soccer_matches');
}

}
