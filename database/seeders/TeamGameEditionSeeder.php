<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamGameEdition;
use App\Models\TeamGameEditionScore;


class TeamGameEditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $team1 = TeamGameEdition::create([
            'team_game_id' => 1,
            'championship_edition_id' => 1
        ]);

        $team1Score = TeamGameEditionScore::create([
            'score' => 0,
            'team_game_edition_id' => $team1->id,
            'championship_round_id' => 1
        ]);

        $team2 = TeamGameEdition::create([
            'team_game_id' => 2,
            'championship_edition_id' => 1
        ]);

        $team2Score = TeamGameEditionScore::create([
            'score' => 0,
            'team_game_edition_id' => $team2->id,
            'championship_round_id' => 1
        ]);

    }
}
