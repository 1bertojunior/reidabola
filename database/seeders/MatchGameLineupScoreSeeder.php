<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChampionshipRound;
use App\Models\MatchGameLineup;

class MatchGameLineupScoreSeeder extends Seeder
{

    public function run()
    {

        // $matchGameLineup = MatchGameLineup::first();

        $roundNumber = 1;
        $championshipRound = ChampionshipRound::where('round', $roundNumber)->first();

        if (!$championshipRound) {
            $this->command->error('Championship round not found.');
            return;
        } 
        $championshipRoundId = $championshipRound->id;
        
        $matchLineup = MatchGameLineup::where('championship_round_id', $championshipRoundId)->first();

        // dd($matchLineup->getAttributes());

    }
    
}
