<?php

namespace App\Http\Controllers;

use App\Models\teamGameEditionScore;
use Illuminate\Http\Request;
use App\Http\Requests\StoreteamGameEditionScoreRequest;
use App\Http\Requests\UpdateteamGameEditionScoreRequest;
use App\Repositories\TeamGameEditionScoreRepository;

class TeamGameEditionScoreController extends Controller
{
    public $teamGameEditionScore;

    public function __construct(teamGameEditionScore $teamGameEditionScore)
    {
        $this->teamGameEditionScore = $teamGameEditionScore;
    }

    public function index(Request $request)
    {
        try{
            $teamGameEditionRepository = new TeamGameEditionScoreRepository($this->teamGameEditionScore);

            $teamGameEditionRepository
                ->selectAttributesRelated([
                    'teamGameEdition.teamGame',
                    'championshipRound',
                ]);

            if ($request->has('filter')) {
                $teamGameEditionRepository->filter($request->filter);                
            }

            if($request->has('att')){
                $teamGameEditionRepository->selectAttributes($request->att);
            }

            $result  = $teamGameEditionRepository->getResult();
            return response()->json( $result, 200 );
        }catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }
    }

}
