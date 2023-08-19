<?php

namespace App\Http\Controllers\App\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;


use App\Models\TeamGameEdition;
use App\Models\SoccerMatch;
use App\Models\TeamGameEditionScore;

use App\Repositories\App\Home\HomeHomeRepository;

class HomeHomeController extends Controller
{

    public function index(Request $request)
    {
        $customMessages = [
            'team_game_edition_id.required' => 'The team_game_edition_id parameter is required.',
            'team_game_edition_id.integer' => 'The team_game_edition_id parameter must be an integer.',
            'team_game_edition_id.min' => 'The team_game_edition_id parameter must be greater than 0.',
            'team_game_edition_id.exists' => 'The value of the team_game_id field does not exist in the team_game_editions table.',
        ];
    
        $validator = Validator::make($request->all(), [
            'team_game_edition_id' => 'required|integer|min:1|exists:team_game_editions,id',
        ], $customMessages);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $team_game_edition_id = $request->query('team_game_edition_id');

        $teamGameEdition = new TeamGameEdition();

        $teamGameEdition = $teamGameEdition->find($team_game_edition_id);   
        
        $result = $teamGameEdition;

        try{
            $teamGameEditionRepository = new HomeHomeRepository($teamGameEdition);

            $teamGameEditionRepository
                ->selectAttributesRelated([
                    'teamGame.user',
                    'championshipEdition.championship'
            ]);

            $teamGameEditionRepository->filter('id:=:' . $team_game_edition_id);                

            $resultTeamGameEdition = $teamGameEditionRepository->getResult()[0];

            $currentDateTime = Carbon::now();
            $closestMatch = SoccerMatch::with('championshipRound')
                ->where('date_time', '>=', $currentDateTime)
                ->where('championship_edition_id', '=', $resultTeamGameEdition->championship_edition_id) // Substitua pelo ID desejado
                ->orderBy('date_time')
                ->first();

            $teamGameEditionScore = $sum = TeamGameEditionScore::where('team_game_edition_id', $resultTeamGameEdition->championship_edition_id)
                ->sum('score');
                
            $result = [
                'team_game_edition' => $resultTeamGameEdition,
                'score' => [
                    'patrimony' => $teamGameEditionScore,
                ],
                'championship_round' => $closestMatch,

            ];
            
            return response()->json($result, 200);
    
        }catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }

    }

}