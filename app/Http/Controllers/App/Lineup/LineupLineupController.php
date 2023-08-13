<?php

namespace App\Http\Controllers\App\Lineup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Models\MatchGameLineup;
use App\Models\MatchLineup;
// use App\Repositories\App\Lineup\PlayerLineupRepository;
// use App\Repositories\MatchLineupRepository;

class LineupLineupController extends Controller
{

    public function index(Request $request)
    {        
        $result = MatchGameLineup::join(
            'match_lineup_scores', 'match_game_lineups.id', '=', 'match_lineup_scores.match_lineup_id'
        )->with(['playerLineup.playerEdition.player.position'])
        ->get();

        return response()->json($result, 200);
        try{
           
        }catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }

    }

}