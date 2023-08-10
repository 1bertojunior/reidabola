<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamGameEditionScore;

class TeamGameEditionScoreSeeder extends Seeder
{

    public function run()
    {
        TeamGameEditionScore::create([
            'score' => 100,
            'team_game_edition_id' => 1,
            'championship_round_id' => 1
        ]);
    }
    
}
