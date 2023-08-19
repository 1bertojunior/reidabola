<?php

namespace App\Http\Controllers\App\Ranking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

use App\Models\TeamGameEditionScore;

use App\Repositories\App\Ranking\RankingRankingRepository;

class RankingRankingController extends Controller
{

    public function index(Request $request)
    {
        $customMessages = [
            'championship_edition_id.required' => 'The championship_edition_id parameter is required.',
            'championship_edition_id.integer' => 'The championship_edition_id parameter must be an integer.',
            'championship_edition_id.min' => 'The championship_edition_id parameter must be greater than 0.',
            'championship_edition_id.exists' => 'The value of the championship_edition_id field does not exist in the championship_editions table.',
        ];
    
        $validator = Validator::make($request->all(), [
            'championship_edition_id' => 'required|integer|min:1|exists:championship_editions,id',
        ], $customMessages);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $championship_edition_id = $request->query('championship_edition_id');
        
        try{
            $teamGameEditionScore = new TeamGameEditionScore();
        
            $rankingRankingRepository = new RankingRankingRepository($teamGameEditionScore);

            $rankingRankingRepository
                ->selectAttributes('team_game_edition_id, SUM(score) as score');
            $rankingRankingRepository
                ->groupByField('team_game_edition_id');
            $rankingRankingRepository
                ->selectAttributesRelated('teamGameEdition.teamGame.user');
            $rankingRankingRepository
                ->orderBy('score', 'desc');

            $rankingRankingRepository
                ->filter('teamGameEdition.championship_edition_id:=:' . $championship_edition_id);

            $result = $rankingRankingRepository->getResult();

            return response()->json($result, 200);
    
        }catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }

    }

}