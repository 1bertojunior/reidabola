<?php

namespace App\Http\Controllers;

use App\Models\teamGameEditionScore;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
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

    public function show($id)
    {
        try {
            $teamGameEditionScore = $this->teamGameEditionScore
                ->with([
                    'teamGameEdition.teamGame',
                    'championshipRound',
                ])->findOrFail($id);
            return response()->json($teamGameEditionScore, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Not found.'], 404);
        }
        
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, $this->teamGameEditionScore->rules());

            $teamGameEditionScore = $this->teamGameEditionScore->create($request->all());

            return response()->json($teamGameEditionScore, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error creating.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $teamGameEditionScore = $this->teamGameEditionScore->find($id);

            if ($teamGameEditionScore === null) {
                return response()->json(['error' => 'Not found'], 404);
            }

            if ($request->method() === "PATCH") {
                $requestData = $request->all();

                $rules = array();
                foreach ($teamGameEditionScore->rules() as $input => $rule) {
                    if (array_key_exists($input, $requestData)) {
                        $rules[$input] = $rule;
                    }
                }

                $request->validate($rules);
            } else {
                $request->validate($teamGameEditionScore->rules(), $teamGameEditionScore->feedback());
            }

            $teamGameEditionScore->update($request->all());

            return response()->json($teamGameEditionScore, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $result = $this->teamGameEditionScore->find($id);
            $result = ($result === null) ? 0 : $result->delete();
            return $result ? response()->json(['message' => 'Successfully removed.'], 200) : response()->json(['error' => 'No data found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while removing.'], 500);
        }
    }

}
