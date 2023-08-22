<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\MatchGoalStats;
use App\Models\MatchCardsStats;


use App\Models\TeamGameEditionScore;

use App\Models\MatchGameLineup;
use App\Models\TeamGameEdition;
use App\Models\SoccerMatch;
use Illuminate\Support\Carbon;

class RoolbackScoreSeeder extends Seeder
{

    public function run()
    {

        $teamGameEditionScore = new TeamGameEditionScore();


        $teamGameEdition = new TeamGameEdition();
        $teamIds = $teamGameEdition::pluck('id');

        foreach ($teamIds as $teamId) {
            
            $scoreTeamGameEdition = $teamGameEditionScore::where('team_game_edition_id', $teamId)->first();
            if($scoreTeamGameEdition){
                $newScore = 0;
                $scoreTeamGameEdition->score = $newScore;
                $scoreTeamGameEdition->save();
            }

        }

        $targetChampionshipRoundId = 1; // Substitua pelo ID desejado
        $newDateTime = '2023-10-16 16:00:00';

        $championshipRound = SoccerMatch::where('championship_round_id', $targetChampionshipRoundId)
            ->update(['date_time' => $newDateTime]);

    }

}