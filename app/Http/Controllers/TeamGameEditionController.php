<?php

namespace App\Http\Controllers;

use App\Models\TeamGameEdition;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Repositories\TeamGameEditionRepository;

class TeamGameEditionController extends Controller
{
    public $teamGameEdition;

    public function __construct(TeamGameEdition $teamGameEdition)
    {
        $this->teamGameEdition = $teamGameEdition;
    }

    public function index(Request $request)
    {
        try{
            $teamGameEditionRepository = new TeamGameEditionRepository($this->teamGameEdition);

            $teamGameEditionRepository
                ->selectAttributesRelated([
                    'teamGame',
                    'championshipEdition'
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
            $teamGameEdition = $this->teamGameEdition
                ->with([
                    'teamGame',
                    'championshipEdition'
                ])->findOrFail($id);
            return response()->json($teamGameEdition, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Not found.'], 404);
        }
        
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, $this->teamGameEdition->rules(), $this->teamGameEdition->feedback());

            $teamGameEdition = $this->teamGameEdition->create($request->all());

            return response()->json($teamGameEdition, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error creating.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $teamGameEdition = $this->teamGameEdition->find($id);

            if ($teamGameEdition === null) {
                return response()->json(['error' => 'Not found'], 404);
            }

            if ($request->method() === "PATCH") {
                $requestData = $request->all();

                $rules = array();
                foreach ($teamGameEdition->rules() as $input => $rule) {
                    if (array_key_exists($input, $requestData)) {
                        $rules[$input] = $rule;
                    }
                }

                $request->validate($rules, $teamGameEdition->feedback());
            } else {
                $request->validate($teamGameEdition->rules(), $teamGameEdition->feedback());
            }

            $teamGameEdition->update($request->all());

            return response()->json($teamGameEdition, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $result = $this->teamGameEdition->find($id);
            $result = ($result === null) ? 0 : $result->delete();
            return $result ? response()->json(['message' => 'Successfully removed.'], 200) : response()->json(['error' => 'No data found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while removing.'], 500);
        }
    }

}
