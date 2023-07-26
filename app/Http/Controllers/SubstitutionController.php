<?php

namespace App\Http\Controllers;

use App\Models\Substitution;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Repositories\SubstitutionRepository;

class SubstitutionController extends Controller
{
    private $substitution;

    public function __construct(Substitution $substitution)
    {
        $this->substitution = $substitution;
    }

    public function index(Request $request)
    {
        try{
            $substitutionRepository = new SubstitutionRepository($this->substitution);

            if ($request->has('filter')) {
                $substitutionRepository->filter($request->filter);                
            }

            if($request->has('att')){
                $substitutionRepository->selectAttributes($request->att);
            }

            $result  = $substitutionRepository->getResult();
            return response()->json( $result, 200 );
        }catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $substitution = $this->substitution->find($id);

            if ($substitution === null) {
                return response()->json(['error' => 'Substitution not found'], 404);
            }

            return $substitution;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve substitution'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, $this->substitution->rules(), $this->substitution->feedback());

            $substitution = $this->substitution->create($request->all());

            return response()->json($substitution, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error creating.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $substitution = $this->substitution->find($id);

            if ($substitution === null) {
                return response()->json(['error' => 'Substitution not found'], 404);
            }

            if ($request->method() === "PATCH") {
                $requestData = $request->all();

                $rules = array();
                foreach ($substitution->rules() as $input => $rule) {
                    if (array_key_exists($input, $requestData)) {
                        $rules[$input] = $rule;
                    }
                }

                $request->validate($rules, $substitution->feedback());
            } else {
                $request->validate($substitution->rules(), $substitution->feedback());
            }

            $substitution->update($request->all());

            return response()->json([
                'msg' => 'Substitution updated successfully',
                'substitution' => $substitution
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update substitution'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $substitution = $this->substitution->find($id);

            if ($substitution === null) {
                return response()->json(['error' => 'Substitution not found'], 404);
            }

            $substitution->delete();

            return response()->json(['msg' => 'Substitution deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete substitution'], 500);
        }
    }
}
