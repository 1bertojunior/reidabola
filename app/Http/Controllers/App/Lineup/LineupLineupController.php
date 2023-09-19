<?php

namespace App\Http\Controllers\App\Lineup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Models\MatchGameLineup;
use App\Repositories\Repository;

class LineupLineupController extends Controller
{

    public function index(Request $request)
    {        
        try{

            $matchGameLineup = new MatchGameLineup();

            $lineupLineupRepository = new Repository($matchGameLineup);

            $lineupLineupRepository
                    ->selectAttributesRelated([
                        'teamGameEdition',
                        'playerEdition.player.position'
                ]);

            if ($request->has('filter')) {
                $lineupLineupRepository->filter($request->filter);                
            }
            
            if($request->has('att')){
                $lineupLineupRepository->selectAttributes($request->att);
            }

            $result = $lineupLineupRepository->getResult();

            return response()->json($result, 200);
        }catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }

    }

}