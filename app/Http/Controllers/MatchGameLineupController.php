<?php

namespace App\Http\Controllers;

use App\Models\MatchGameLineup;
use Illuminate\Http\Request;

class MatchGameLineupController extends Controller
{
    private $matchGameLineup;

    public function __construct(MatchGameLineup $matchGameLineup)
    {
        $this->matchGameLineup = $matchGameLineup;
    }

    public function index()
    {
        try {
            $matchGameLineups = $this->matchGameLineup->with(['teamGameEdition', 'playerLineup', 'championshipRound'])->get();
            return $matchGameLineups;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve match game lineups'], 500);
        }
    }

    public function show($id)
    {
        try {
            $matchGameLineup = $this->matchGameLineup->with(['teamGameEdition', 'playerLineup', 'championshipRound'])->find($id);

            if ($matchGameLineup === null) {
                return response()->json(['error' => 'Match game lineup not found'], 404);
            }

            return $matchGameLineup;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve match game lineup'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $matchGameLineup = $this->matchGameLineup->create($data);
            return response()->json([
                'msg' => 'Match game lineup created successfully',
                'matchGameLineup' => $matchGameLineup
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create match game lineup'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $matchGameLineup = $this->matchGameLineup->find($id);

            if ($matchGameLineup === null) {
                return response()->json(['error' => 'Match game lineup not found'], 404);
            }

            $request->validate($this->matchGameLineup->rules(), $this->matchGameLineup->feedback());
            $matchGameLineup->update($request->all());

            return response()->json([
                'msg' => 'Match game lineup updated successfully',
                'matchGameLineup' => $matchGameLineup
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update match game lineup'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $matchGameLineup = $this->matchGameLineup->find($id);

            if ($matchGameLineup === null) {
                return response()->json(['error' => 'Match game lineup not found'], 404);
            }

            $matchGameLineup->delete();

            return response()->json(['msg' => 'Match game lineup deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete match game lineup'], 500);
        }
    }
}
