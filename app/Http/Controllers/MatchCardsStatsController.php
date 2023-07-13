<?php

namespace App\Http\Controllers;

use App\Models\MatchGoalStats;
use Illuminate\Http\Request;

class MatchGoalStatssController extends Controller
{
    private $MatchGoalStats;

    public function __construct(MatchGoalStats $MatchGoalStats)
    {
        $this->MatchGoalStats = $MatchGoalStats;
    }

    public function index()
    {
        try {
            $MatchGoalStats = $this->MatchGoalStats->all();
            return $MatchGoalStats;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve match cards stats'], 500);
        }
    }

    public function show($id)
    {
        try {
            $MatchGoalStats = $this->MatchGoalStats->find($id);

            if ($MatchGoalStats === null) {
                return response()->json(['error' => 'Match cards stat not found'], 404);
            }

            return $MatchGoalStats;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve match cards stat'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $request->validate($this->MatchGoalStats->rules(), $this->MatchGoalStats->feedback());

            $MatchGoalStats = new MatchGoalStats([
                'minute' => isset($data['minute']) ? $data['minute'] : null,
                'card_yellow' => isset($data['card_yellow']) ? $data['card_yellow'] : false,
                'card_red' => isset($data['card_red']) ? $data['card_red'] : false,
                'soccer_match_id' => isset($data['soccer_match_id']) ? $data['soccer_match_id'] : null,
                'player_commit_id' => isset($data['player_commit_id']) ? $data['player_commit_id'] : null,
                'player_suffer_id' => isset($data['player_suffer_id']) ? $data['player_suffer_id'] : null,
            ]);

            $MatchGoalStats->save();

            return response()->json([
                'msg' => 'Match cards stat created successfully',
                'match_cards_stat' => $MatchGoalStats
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create match cards stat'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $MatchGoalStats = $this->MatchGoalStats->find($id);

            if ($MatchGoalStats === null) {
                return response()->json(['error' => 'Match cards stat not found'], 404);
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
                'msg' => 'Match cards stat updated successfully',
                'match_cards_stat' => $MatchGoalStats
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update match cards stat'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $MatchGoalStats = $this->MatchGoalStats->find($id);

            if ($MatchGoalStats === null) {
                return response()->json(['error' => 'Match cards stat not found'], 404);
            }

            $MatchGoalStats->delete();

            return response()->json(['msg' => 'Match cards stat deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete match cards stat'], 500);
        }
    } 
}
