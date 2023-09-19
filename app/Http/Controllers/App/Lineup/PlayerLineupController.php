<?php

namespace App\Http\Controllers\App\Lineup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Models\Player;
use App\Models\PlayerEdition;
use App\Repositories\Repository;

class PlayerLineupController extends Controller
{

    public function index(Request $request)
    {        
        $playerEdition = new PlayerEdition();

        try{
            $playerEditionRepository = new Repository($playerEdition);

            $playerEditionRepository
                ->selectAttributesRelated([
                    'player.position',
                    'teamEdition.team',
            ]);

            if ($request->has('filter')) {
                $playerEditionRepository->filter($request->filter);                
            }

            if($request->has('att')){
                $playerEditionRepository->selectAttributes($request->att);
            }

            $result = $playerEditionRepository->getResult();

            return response()->json($result, 200);
        }catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }

    }

}