<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\TeamEdition;
use App\Repositories\TeamEditionRepository;

class TeamEditionController extends Controller
{
    protected $teamEdition;

    public function __construct(TeamEdition $teamEdition)
    {
        $this->teamEdition = $teamEdition;
    }

    public function index(Request $request)
    {
        try{
            $teamEditionRepository = new TeamEditionRepository($this->teamEdition);

            $teamEditionRepository
                ->selectAttributesRelated([
                    'team',
                    'championshipEdition.championship',
                    'coach'
                ]);

            if ($request->has('filter')) {
                $teamEditionRepository->filter($request->filter);                
            }

            if($request->has('att')){
                $teamEditionRepository->selectAttributes($request->att);
            }

            $result  = $teamEditionRepository->getResult();
            return response()->json( $result, 200 );
        }catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $teamEdition = $this->teamEdition
                ->with([
                    'team',
                    'championshipEdition.championship',
                    'coach'
                ])->findOrFail($id);
            return response()->json($teamEdition, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Not found.'], 404);
        }
        
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, $this->teamEdition->rules(), $this->teamEdition->feedback());

            $teamEdition = $this->teamEdition->create($request->all());

            return response()->json($teamEdition, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error creating team edition.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $teamEdition = $this->teamEdition->find($id);

            if ($teamEdition === null) {
                return response()->json(['error' => 'Not found'], 404);
            }

            if ($request->method() === "PATCH") {
                $requestData = $request->all();

                $rules = array();
                foreach ($teamEdition->rules() as $input => $rule) {
                    if (array_key_exists($input, $requestData)) {
                        $rules[$input] = $rule;
                    }
                }

                $request->validate($rules, $teamEdition->feedback());
            } else {
                $request->validate($teamEdition->rules(), $teamEdition->feedback());
            }

            $teamEdition->update($request->all());

            return response()->json($teamEdition, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $teamEdition = $this->teamEdition->findOrFail($id);

            $teamEdition->delete();

            return response()->json(['message' => 'Team edition removed successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error removing team edition.'], 500);
        }
    }
}
