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

class CalculatingScoreTeamGameEditionSeeder extends Seeder
{

    public function run()
    {

        $matchGoalStats = new MatchGoalStats();
        $matchCardsStats = new MatchCardsStats();
        $teamGameEditionScore = new TeamGameEditionScore();

        $championship_edition_id = 1;
        $currentDateTime = Carbon::now();

        $teamGameEdition = new TeamGameEdition();
        $matchGameLineup = new MatchGameLineup();

        $teamIds = $teamGameEdition::pluck('id');

        $scores = [];

        foreach ($teamIds as $teamId) {
            $matchLineups = $matchGameLineup->where('team_game_edition_id', $teamId)->get();
            
            $scores[$teamId] = 0;
            foreach ($matchLineups as $matchLineup) {
                $player_lineup_id = $matchLineup->player_lineup_id;

                // GOLS
                $matchingGoals = $matchGoalStats::where('player_goal_id', $player_lineup_id)->get();
                foreach ($matchingGoals as $matchingGoal) {
                    echo $matchingGoal->player_goal_id. " fez gols aos " . $matchingGoal->minute . "\n";
                    $scores[$teamId] = $matchingGoal->awn ? $scores[$teamId] -= 2 : $scores[$teamId] += 5;
                }

                $matchingAssist = $matchGoalStats::where('player_assist_id', $player_lineup_id)->get();
                foreach ($matchingAssist as $matchingAssis) {
                    echo $matchingAssis->player_assist_id. " fez assistência aos " . $matchingAssis->minute . " para " . $matchingAssis->player_goal_id. "\n";
                    $scores[$teamId] += 3;
                }

                $matchCards = $matchCardsStats::where('player_commit_id', $player_lineup_id)->get();
                foreach ($matchCards as $matchCard) {
                    if($matchCard->card_yellow) $scores[$teamId] -= 1.5;
                    if($matchCard->card_red) $scores[$teamId] -= 3;               
                }

                $matchCardsSuffers = $matchCardsStats::where('player_commit_id', $player_lineup_id)->get();
                foreach ($matchCardsSuffers as $matchCardsSuffer) {
                    if($matchCardsSuffer->card_yellow) $scores[$teamId] += 0.5;
                    if($matchCardsSuffer->card_red) $scores[$teamId] += 1;   
                }
                
            }

        }


        foreach($scores as $key => $score){

            $scoreTeamGameEdition = $teamGameEditionScore::where('team_game_edition_id', $key)->first();


            if($scoreTeamGameEdition){
                echo "TeamGameEdtion " . $key . "  SCORE " . $scoreTeamGameEdition->score . "\n" ;

                $currentScore = $scoreTeamGameEdition->score;
                $newScore = $currentScore + $score;
                $scoreTeamGameEdition->score = $newScore;
                $scoreTeamGameEdition->save();

                echo "TeamGameEdtion " . $key . "  SCORE " . $scoreTeamGameEdition->score . "\n" ;

            }


        }


        $targetChampionshipRoundId = 1; // Substitua pelo ID desejado
        $newDateTime = '2023-10-24 16:00:00';

        $championshipRound = SoccerMatch::where('championship_round_id', $targetChampionshipRoundId)
            ->update(['date_time' => $newDateTime]);

    }

}