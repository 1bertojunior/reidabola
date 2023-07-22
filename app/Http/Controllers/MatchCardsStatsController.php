<?php

namespace App\Http\Controllers;

use App\Models\MatchGoalStats;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Repositories\MatchGoalStatsRepository;

class MatchGoalStatsController extends Controller
{
    private $matchGoalStats;

    public function __construct(matchGoalStats $matchGoalStats)
    {
        $this->matchGoalStats = $matchGoalStats;
    }

    public function index(Request $request)
    {
        try{
            $matchGoalStatsRepository = new MatchGoalStatsRepository($this->matchGoalStats);

            if ($request->has('att_soccer')) {
                $att_soccer = 'soccer:id,' .  $request->att_soccer;
                $matchGoalStatsRepository->selectAttributesRelated($att_soccer);
            } else {
                $matchGoalStatsRepository->selectAttributesRelated('soccer');
            }

            if ($request->has('filter')) {
                $matchGoalStatsRepository->filter($request->filter);                
            }

            if($request->has('att')){
                $matchGoalStatsRepository->selectAttributes($request->att);
            }

            $result  = $matchGoalStatsRepository->getResult();
            return response()->json( $result, 200 );
        }catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $matchGoalStats = $this->matchGoalStats->find($id);

            if ($matchGoalStats === null) {
                return response()->json(['error' => 'Match cards stat not found'], 404);
            }

            return $matchGoalStats;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve match cards stat'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $request->validate($this->matchGoalStats->rules(), $this->matchGoalStats->feedback());

            $matchGoalStats = new matchGoalStats([
                'minute' => isset($data['minute']) ? $data['minute'] : null,
                'card_yellow' => isset($data['card_yellow']) ? $data['card_yellow'] : false,
                'card_red' => isset($data['card_red']) ? $data['card_red'] : false,
                'soccer_match_id' => isset($data['soccer_match_id']) ? $data['soccer_match_id'] : null,
                'player_commit_id' => isset($data['player_commit_id']) ? $data['player_commit_id'] : null,
                'player_suffer_id' => isset($data['player_suffer_id']) ? $data['player_suffer_id'] : null,
            ]);

            $matchGoalStats->save();

            return response()->json([
                'msg' => 'Match cards stat created successfully',
                'match_cards_stat' => $matchGoalStats
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create match cards stat'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $matchGoalStats = $this->matchGoalStats->find($id);

            if ($matchGoalStats === null) {
                return response()->json(['error' => 'Match cards stat not found'], 404);
            }

            if ($request->method() === "PATCH") {
                $requestData = $request->all();

                $rules = array();
                foreach ($matchGoalStats->rules() as $input => $rule) {
                    if (array_key_exists($input, $requestData)) {
                        $rules[$input] = $rule;
                    }
                }

                $request->validate($rules, $matchGoalStats->feedback());
            } else {
                $request->validate($matchGoalStats->rules(), $matchGoalStats->feedback());
            }

            $matchGoalStats->update($request->all());

            return response()->json([
                'msg' => 'Match cards stat updated successfully',
                'match_cards_stat' => $matchGoalStats
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update match cards stat'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $matchGoalStats = $this->matchGoalStats->find($id);

            if ($matchGoalStats === null) {
                return response()->json(['error' => 'Match cards stat not found'], 404);
            }

            $matchGoalStats->delete();

            return response()->json(['msg' => 'Match cards stat deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete match cards stat'], 500);
        }
    } 
}
