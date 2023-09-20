<?php

namespace App\Http\Controllers\App\Lineup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Models\MatchGameLineup;
use App\Models\PlayerEdition;
use App\Repositories\Repository;

class LineupLineupController extends Controller
{
    protected $matchGameLineup;

    public function __construct(MatchGameLineup $matchGameLineup)
    {
        $this->matchGameLineup = $matchGameLineup;
    }

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

    public function storage(Request $request)
    {
        try {
            $team_game_edition_id = $request->input('team_game_edition_id');
            $championship_round_id = $request->input('championship_round_id');
            $gameLineup = $request->input('gameLineup');

            $validIds = $invalidIds = $createdIds = [];

            $result = [
                "team_game_edition_id" => $team_game_edition_id,
                "championship_round_id" =>  $championship_round_id,
                "gameLineup" => []
            ];

            $existingLineupCount = $this->matchGameLineup
                ->where('team_game_edition_id', $team_game_edition_id)
                ->where('championship_round_id', $championship_round_id)
                ->count();

            if ($existingLineupCount >= 11) {
                $this->matchGameLineup
                    ->where('team_game_edition_id', $team_game_edition_id)
                    ->where('championship_round_id', $championship_round_id)
                    ->delete();
            }

            foreach ($gameLineup as $playerEditionId) {
                
                if (PlayerEdition::where('id', $playerEditionId)->exists())
                    $validIds[] = $playerEditionId;
                else
                    $invalidIds[] = $playerEditionId;
            }

            if (count($invalidIds) > 0) {
                return response()->json(['message' => 'IDs Invalid PlayerEdition', 'invalidIds' => $invalidIds], 400);
            }

            // CREATED
            foreach ($validIds as $playerEditionId) {
                $data = [
                    'team_game_edition_id' => $team_game_edition_id,
                    'championship_round_id' => $championship_round_id,
                    'status' => 0,
                    'player_lineup_id' => $playerEditionId,
                ];
                
                $matchGameLineup = $this->matchGameLineup->create($data);
                $result['gameLineup'][] = $matchGameLineup->id;

            }
            return response()->json($result, 201);
        
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error creating championship edition.'], 500);
        }
    }

}