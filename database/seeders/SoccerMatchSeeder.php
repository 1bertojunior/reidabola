<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SoccerMatch;
use App\Models\Championship;
use App\Models\ChampionshipEdition;
use App\Models\ChampionshipRound;
use App\Models\StadiumFootball;
use App\Models\TeamEdition;
use App\Models\City;
use App\Models\Team;

class SoccerMatchSeeder extends Seeder
{
    public function run()
    {
        $championshipName = 'Belenense';
        $championshipYear = 2023;
    
        $championship = Championship::where('name', $championshipName)->first();
    
        if ($championship) {
            $championshipEdition = ChampionshipEdition::where('championship_id', $championship->id)
                ->whereYear('start', $championshipYear)
                ->first();
    
            $stadiumFootballName = 'Estádio Belém do Piauí';
            $stadiumFootball = StadiumFootball::where('name', $stadiumFootballName)->first();
    
            if ($championshipEdition && $stadiumFootball) {
                $matches = [
                    // 1ª Rodada
                    ['date' => '2023-10-16', 'time' => '16:00', 'team1' => 'Villa Real', 'team2' => 'Russim', 'round' => 1],
                    ['date' => '2023-10-16', 'time' => '18:00', 'team1' => 'Corinthians', 'team2' => 'Carquejo', 'round' => 1],
                    // 2ª Rodada
                    ['date' => '2023-10-23', 'time' => '16:00', 'team1' => 'TDS', 'team2' => 'Palmeiras', 'round' => 2],
                    ['date' => '2023-10-23', 'time' => '18:00', 'team1' => 'Russim', 'team2' => 'Corinthians', 'round' => 2],
                    // 3ª Rodada
                    ['date' => '2023-11-06', 'time' => '16:00', 'team1' => 'Villa Real', 'team2' => 'Carquejo', 'round' => 3],
                    ['date' => '2023-11-06', 'time' => '18:00', 'team1' => 'TDS', 'team2' => 'Russim', 'round' => 3],
                    // 4ª Rodada
                    ['date' => '2023-11-13', 'time' => '16:00', 'team1' => 'Palmeiras', 'team2' => 'Carquejo', 'round' => 4],
                    ['date' => '2023-11-13', 'time' => '18:00', 'team1' => 'Villa Real', 'team2' => 'Corinthians', 'round' => 4],
                    // 5ª Rodada
                    ['date' => '2023-11-15', 'time' => '18:00', 'team1' => 'Palmeiras', 'team2' => 'Russim', 'round' => 5],
                    // 6ª Rodada
                    ['date' => '2023-11-20', 'time' => '16:00', 'team1' => 'TDS', 'team2' => 'Carquejo', 'round' => 6],
                    ['date' => '2023-11-20', 'time' => '18:00', 'team1' => 'Villa Real', 'team2' => 'Palmeiras', 'round' => 6],
                    // 7ª Rodada
                    ['date' => '2023-11-27', 'time' => '16:00', 'team1' => 'Russim', 'team2' => 'Carquejo', 'round' => 7],
                    ['date' => '2023-11-27', 'time' => '18:00', 'team1' => 'TDS', 'team2' => 'Corinthians', 'round' => 7],
                    // 8ª Rodada
                    ['date' => '2023-12-04', 'time' => '16:00', 'team1' => 'Palmeiras', 'team2' => 'Corinthians', 'round' => 8],
                    ['date' => '2023-12-04', 'time' => '18:00', 'team1' => 'Villa Real', 'team2' => 'TDS', 'round' => 8],
                ];
                

                foreach ($matches as $matchData) {
                    $t1Name = $matchData['team1'];
                    $t2Name = $matchData['team2'];        
                    $team1EditionId = $this->getIdTeamEditionByNameTeam($t1Name, $championshipEdition->id);
                    $team2EditionId = $this->getIdTeamEditionByNameTeam($t2Name, $championshipEdition->id);
                    $dateTime = $matchData['date'] . ' ' . $matchData['time'];

                    $match = new SoccerMatch();
                    $match->date_time = $dateTime;
                    $match->team1_edition_id = $team1EditionId;
                    $match->team2_edition_id = $team2EditionId;
                    $match->championship_edition_id = $championshipEdition->id;
                    $match->stadium_football_id = $stadiumFootball->id;
                    $match->championship_round_id = ChampionshipRound::where('round', $matchData['round'])->first()->id;
                    $match->save();               
    
                }
            }
        }
    }

    public function getIdTeamEditionByNameTeam($name = "", $championshipEditionId = null){
        return Team::join('team_editions', 'teams.id', '=', 'team_editions.team_id')
            ->where('teams.name', $name)
            ->where('team_editions.championship_edition_id', $championshipEditionId)
            ->pluck('team_editions.id')
            ->first();
    }
    

}
