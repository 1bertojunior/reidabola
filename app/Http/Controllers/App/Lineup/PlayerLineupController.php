<?php

namespace App\Http\Controllers\App\Lineup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Models\MatchLineup;
use App\Models\MatchLineupScore;

// use App\Repositories\App\Lineup\PlayerLineupRepository;
use App\Repositories\MatchLineupRepository;

class PlayerLineupController extends Controller
{

    public function index(Request $request)
    {        
        $matchLineup = new MatchLineup();

        try{
            $matchLineupRepository = new MatchLineupRepository($matchLineup);

            $matchLineupRepository->joinRelated(
                'match_lineup_scores', 'match_lineup.id', 'match_lineup_scores.match_lineup_id'
            );

            $matchLineupRepository
                ->selectAttributesRelated([
                    'playerEdition.player.position',
                    'playerEdition.teamEdition.team',
                    'soccerMatch.championshipEdition.championship',
                    'soccerMatch.championshipRound',
                    'statusLineup',
            ]);

            if ($request->has('filter')) {
                $matchLineupRepository->filter($request->filter);                
            }

            if($request->has('att')){
                $matchLineupRepository->selectAttributes($request->att);
            }

            $result = $matchLineupRepository->getResult();
            return response()->json($result, 200);
        }catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }

    }

}