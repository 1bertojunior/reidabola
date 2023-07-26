<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Repositories\StateRepository;

class StateController extends Controller
{

    public $state;

    public function __construct(State $state){
        $this->state = $state;
    }
    public function index(Request $request)
    {
        try{
            $cityRepository = new StateRepository($this->state);

            if ($request->has('filter')) {
                $cityRepository->filter($request->filter);                
            }

            if($request->has('att')){
                $cityRepository->selectAttributes($request->att);
            }

            $result  = $cityRepository->getResult();
            return response()->json( $result, 200 );
        }catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $state = $this->state->with('state')->findOrFail($id);
            return response()->json($state, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Not found.'], 404);
        }
        
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, $this->state->rules(), $this->state->feedback());

            $state = $this->state->create($request->all());

            return response()->json($state, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error creating.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $state = $this->state->find($id);

            if ($state === null) {
                return response()->json(['error' => 'Not found'], 404);
            }

            if ($request->method() === "PATCH") {
                $requestData = $request->all();

                $rules = array();
                foreach ($state->rules() as $input => $rule) {
                    if (array_key_exists($input, $requestData)) {
                        $rules[$input] = $rule;
                    }
                }

                $request->validate($rules, $state->feedback());
            } else {
                $request->validate($state->rules(), $state->feedback());
            }

            $state->update($request->all());

            return response()->json([
                'msg' => 'Updated successfully',
                'state' => $state
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $result = $this->state->find($id);
            $result = ($result === null) ? 0 : $result->delete();
            return $result ? response()->json(['message' => 'Successfully removed.'], 200) : response()->json(['error' => 'No data found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while removing.'], 500);
        }
    }
}
