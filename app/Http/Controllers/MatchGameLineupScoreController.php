<?php

namespace App\Http\Controllers;

use App\Models\MatchGameLineupScore;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Repositories\MatchGameLineupScoreRepository;

class MatchGameLineupScoreController extends Controller
{

    private $matchGameLineupScore;

    public function __construct(MatchGameLineupScore $matchGameLineupScore)
    {
        $this->matchGameLineupScore = $matchGameLineupScore;
    }

    public function index(Request $request)
    {        
        try{
            $matchGameLineupScoreRepository = new MatchGameLineupScoreRepository($this->matchGameLineupScore);
            
            $matchGameLineupScoreRepository
                ->selectAttributesRelated([
                    'matchGameLineup',
                ]);

            if ($request->has('filter')) {
                $matchGameLineupScoreRepository->filter($request->filter);                
            }

            if($request->has('att')){
                $matchGameLineupScoreRepository->selectAttributes($request->att);
            }

            $result  = $matchGameLineupScoreRepository->getResult();
            return response()->json( $result, 200 );
        }catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }

    
    }

    public function show($id)
    {
        try {
            $matchGameLineupScore = $this->matchGameLineupScore
                ->with([
                    'matchGameLineup',
                ])->find($id);

            if ($matchGameLineupScore === null) {
                return response()->json(['error' => 'Match game lineup not found'], 404);
            }

            return $matchGameLineupScore;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve match game lineup'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, $this->matchGameLineupScore->rules(), $this->matchGameLineupScore->feedback());

            $matchGameLineupScore = $this->matchGameLineupScore->create($request->all());

            return response()->json($matchGameLineupScore, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error creating.'], 500);
        }
    }

    public function update(Request $request, $id)
    {        
        try {
            $matchGameLineupScore = $this->matchGameLineupScore->find($id);

            if ($matchGameLineupScore === null) {
                return response()->json(['error' => 'Not found'], 404);
            }

            if ($request->method() === "PATCH") {
                $requestData = $request->all();

                $rules = array();
                foreach ($matchGameLineupScore->rules() as $input => $rule) {
                    if (array_key_exists($input, $requestData)) {
                        $rules[$input] = $rule;
                    }
                }

                $request->validate($rules, $matchGameLineupScore->feedback());
            } else {
                $request->validate($matchGameLineupScore->rules(), $matchGameLineupScore->feedback());
            }

            $matchGameLineupScore->update($request->all());

            return response()->json($matchGameLineupScore, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update'], 500);
        }
    
    }

    public function destroy($id)
    {
        try {
            $matchGameLineupScore = $this->matchGameLineupScore->find($id);

            if ($matchGameLineupScore === null) {
                return response()->json(['error' => 'Match game lineup not found'], 404);
            }

            $matchGameLineupScore->delete();

            return response()->json(['msg' => 'Match game lineup deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete match game lineup'], 500);
        }
    }

}
