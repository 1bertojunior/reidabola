<?php

namespace App\Http\Controllers;

use App\Models\MatchGoalStats;
use Illuminate\Http\Request;

class MatchGoalStatsController extends Controller
{
    private $MatchGoalStats;

    public function __construct(MatchGoalStats $MatchGoalStats)
    {
        $this->MatchGoalStats = $MatchGoalStats;
    }

    public function index()
    {
        try {
            $MatchGoalStatss = $this->MatchGoalStats->all();
            return $MatchGoalStatss;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve match goal stats'], 500);
        }
    }

    public function show($id)
    {
        try {
            $MatchGoalStats = $this->MatchGoalStats->find($id);

            if ($MatchGoalStats === null) {
                return response()->json(['error' => 'Match goal stat not found'], 404);
            }

            return $MatchGoalStats;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve match goal stat'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $MatchGoalStats = new MatchGoalStats([
                'minute' => isset($data['minute']) ? $data['minute'] : null,
                'awn' => isset($data['awn']) ? $data['awn'] : false,
                'soccer_match_id' => isset($data['soccer_match_id']) ? $data['soccer_match_id'] : null,
                'player_goal_id' => isset($data['player_goal_id']) ? $data['player_goal_id'] : null,
                'player_assist_id' => isset($data['player_assist_id']) ? $data['player_assist_id'] : null,
            ]);

            $MatchGoalStats->save();

            return response()->json([
                'msg' => 'Match goal stat created successfully',
                'match_goal_stat' => $MatchGoalStats
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create match goal stat'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $MatchGoalStats = $this->MatchGoalStats->find($id);

            if ($MatchGoalStats === null) {
                return response()->json(['error' => 'Match goal stat not found'], 404);
            }

            if ($request->method() === "PATCH") {
                $requestData = $request->all();

                $rules = array();
                foreach ($MatchGoalStats->rules() as $input => $rule) {
                    if (array_key_exists($input, $requestData)) {
                        $rules[$input] = $rule;
                    }
                }

                $request->validate($rules, $MatchGoalStats->feedback());
            } else {
                $request->validate($MatchGoalStats->rules(), $MatchGoalStats->feedback());
            }

            $MatchGoalStats->update($request->all());

            return response()->json([
                'msg' => 'Match goal stat updated successfully',
                'match_goal_stat' => $MatchGoalStats
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update match goal stat'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $MatchGoalStats = $this->MatchGoalStats->find($id);

            if ($MatchGoalStats === null) {
                return response()->json(['error' => 'Match goal stat not found'], 404);
            }

            $MatchGoalStats->delete();

            return response()->json(['msg' => 'Match goal stat deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete match goal stat'], 500);
        }
    }

}
