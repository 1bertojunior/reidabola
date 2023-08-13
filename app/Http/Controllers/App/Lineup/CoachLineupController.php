<?php

namespace App\Http\Controllers\App\Lineup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Models\TeamEdition;
use App\Models\TeamGame;
use App\Repositories\App\Lineup\CoachLineupRepository;

class CoachLineupController extends Controller
{

    public function index(Request $request)
    {        
        $teamEdition = new TeamEdition();

        try{
            $teamEditionRepository = new CoachLineupRepository($teamEdition);
            
            $teamEditionRepository->leftJoin(
                'coaches', 'team_editions.coach_id', 'coaches.id', ['name']
            );

            $teamEditionRepository
                ->selectAttributesRelated([
                    'championshipEdition'
            ]);
            
            if ($request->has('filter')) {
                $teamEditionRepository->filter($request->filter);                
            }

            if($request->has('att')){
                $teamEditionRepository->selectAttributes($request->att);
            }

            $result = $teamEditionRepository->getResult();
            return response()->json($result, 200);

        }catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }

    }

}