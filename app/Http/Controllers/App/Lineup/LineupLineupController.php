<?php

namespace App\Http\Controllers\App\Lineup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Models\MatchGameLineup;
use App\Repositories\App\Lineup\LineupLineupRepository;

class LineupLineupController extends Controller
{

    public function index(Request $request)
    {        
        // $result = MatchGameLineup::join(
        //     'match_lineup_scores', 'match_game_lineups.id', '=', 'match_lineup_scores.match_lineup_id'
        // )->with(['playerLineup.playerEdition.player.position'])
        // ->get();

        // return response()->json($result, 200);

        
        $matchGameLineup = new MatchGameLineup();

        // try{
            $lineupLineupRepository = new LineupLineupRepository($matchGameLineup);

            $lineupLineupRepository->joinRelated(
                'match_lineup_scores', 'match_game_lineups.id', 'match_lineup_scores.match_lineup_id'
            );

            $lineupLineupRepository
                ->selectAttributesRelated([
                    'playerLineup.playerEdition.player.position'
            ]);

            // if ($request->has('filter')) {
            //     $lineupLineupRepository->filter($request->filter);                
            // }
            
            if ($request->has('filter')) {
                $lineupLineupRepository->filter($request->filter, 'match_game_lineups');                
            }

            if($request->has('att')){
                $lineupLineupRepository->selectAttributes($request->att);
            }

            $result = $lineupLineupRepository->getResult();
            return response()->json($result, 200);
        // }catch (\Exception $e) {
        //     return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        // }

        // try{
           
        // }catch (\Exception $e) {
        //     return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        // }

    }

}