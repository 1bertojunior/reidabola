<?php

namespace App\Http\Controllers;

use App\Models\ChampionshipRound;
use Illuminate\Http\Request;

class ChampionshipRoundController extends Controller
{
    public function index()
    {
        try {
            $rounds = ChampionshipRound::all();
            return $rounds;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve championship rounds'], 500);
        }
    }

    public function show($id)
    {
        try {
            $round = ChampionshipRound::find($id);

            if ($round === null) {
                return response()->json(['error' => 'Championship round not found'], 404);
            }

            return $round;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve championship round'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $round = new ChampionshipRound([
                'name' => isset($data['name']) ? $data['name'] : null,
                'round' => isset($data['round']) ? $data['round'] : null,
            ]);

            $round->save();

            return response()->json([
                'msg' => 'Championship round created successfully',
                'round' => $round
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create championship round'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $round = ChampionshipRound::find($id);

            if ($round === null) {
                return response()->json(['error' => 'Championship round not found'], 404);
            }

            if ($request->method() === "PATCH") {
                $requestData = $request->all();

                $rules = array();
                foreach ($round->rules() as $input => $rule) {
                    if (array_key_exists($input, $requestData)) {
                        $rules[$input] = $rule;
                    }
                }

                $request->validate($rules, $round->feedback());
            } else {
                $request->validate($round->rules(), $round->feedback());
            }

            $round->update($request->all());

            return response()->json([
                'msg' => 'Championship round updated successfully',
                'round' => $round
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update championship round'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $round = ChampionshipRound::find($id);

            if ($round === null) {
                return response()->json(['error' => 'Championship round not found'], 404);
            }

            $round->delete();

            return response()->json(['msg' => 'Championship round deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete championship round'], 500);
        }
    }
}
