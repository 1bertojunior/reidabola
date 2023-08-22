<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\MatchGoalStats;

use App\Models\MatchCardsStats;

class MatchGoalStatsSeeder extends Seeder
{
 
    public function run()
    {
        
        $matchGoalStatsSeeder = new MatchGoalStats();

        $matchGoalStatsSeeder::create([
            'minute' => 34,
            'soccer_match_id' => 1,
            'player_goal_id' => 11,
            'player_assist_id' => 9
        ]);



        $cards = [
            [
                'minute' => 7,
                'card_yellow' => 1,
                'card_red' => 0,
                'soccer_match_id' => 1,
                'player_commit_id' => 2,
                'player_suffer_id' => 21,
            ],
            [
                'minute' => 13,
                'card_yellow' => 1,
                'card_red' => 0,
                'soccer_match_id' => 1,
                'player_commit_id' => 5,
                'player_suffer_id' => 19,
            ],

            [
                'minute' => 24,
                'card_yellow' => 1,
                'card_red' => 0,
                'soccer_match_id' => 1,
                'player_commit_id' => 7,
                'player_suffer_id' => 22,
            ],

            [
                'minute' => 37,
                'card_yellow' => 1,
                'card_red' => 0,
                'soccer_match_id' => 1,
                'player_commit_id' => 12,
                'player_suffer_id' => 11,
            ],

            // red

            [
                'minute' => 39,
                'card_yellow' => 0,
                'card_red' => 1,
                'soccer_match_id' => 1,
                'player_commit_id' => 16,
                'player_suffer_id' => 8,
            ],

        ];

        $matchCardsStats = new MatchCardsStats();

        foreach ($cards as $card) {
            $minute = $card['minute'];
            $card_yellow = $card['card_yellow'];
            $card_red = $card['card_red'];
            $soccer_match_id = $card['soccer_match_id'];
            $player_commit_id = $card['player_commit_id'];
            $player_suffer_id = $card['player_suffer_id'];

            $matchCardsStats::create([
                'minute' => $minute,
                'card_yellow' => $card_yellow,
                'card_red' => $card_red,
                'soccer_match_id' => $soccer_match_id,
                'player_commit_id' => $player_commit_id,
                'player_suffer_id' => $player_suffer_id,
            ]);

        }


        

    }



}
