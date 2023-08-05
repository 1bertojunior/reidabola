<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChampionshipRound;
use App\Models\MatchGameLineup;



class MatchGameLineupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roundNumber = 1;
        $championshipRound = ChampionshipRound::where('round', $roundNumber)->first();

        if (!$championshipRound) {
            $this->command->error('Championship round not found.');
            return;
        }
        $championshipRoundId = $championshipRound->id;

        for($i=1; $i<12; $i++){
            $matchLineup = MatchGameLineup::create([
                'team_game_edition_id' => 1,
                'player_lineup_id' => $i,
                'championship_round_id' => $championshipRoundId,
                'status' => 1
            ]);
        }

      
    }
}
