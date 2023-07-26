<?php

namespace App\Http\Controllers;

use App\Models\StadiumFootball;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Repositories\StadiumFootballRepository;

class StadiumFootballController extends Controller
{
    public $stadium;

    public function __construct(StadiumFootball $stadium){
        $this->stadium = $stadium;
    }

    public function index(Request $request)
    {
        try{
            $stadiumFootballRepository = new StadiumFootballRepository($this->stadium);

            $stadiumFootballRepository->selectAttributesRelated('city.state');

            if ($request->has('filter')) {
                $stadiumFootballRepository->filter($request->filter);                
            }

            if($request->has('att')){
                $stadiumFootballRepository->selectAttributes($request->att);
            }

            $result  = $stadiumFootballRepository->getResult();
            return response()->json( $result, 200 );
        }catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $stadium = $this->stadium->with('city.state')->findOrFail($id);
            return response()->json($stadium, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Not found.'], 404);
        }
        
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, $this->stadium->rules(), $this->stadium->feedback());

            $stadium = $this->stadium->create($request->all());

            return response()->json($stadium, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error creating.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $stadium = $this->stadium->find($id);

            if ($stadium === null) {
                return response()->json(['error' => 'Not found'], 404);
            }

            if ($request->method() === "PATCH") {
                $requestData = $request->all();

                $rules = array();
                foreach ($stadium->rules() as $input => $rule) {
                    if (array_key_exists($input, $requestData)) {
                        $rules[$input] = $rule;
                    }
                }

                $request->validate($rules, $stadium->feedback());
            } else {
                $request->validate($stadium->rules(), $stadium->feedback());
            }

            $stadium->update($request->all());

            return response()->json([
                'msg' => 'Updated successfully',
                'citie' => $stadium
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $result = $this->stadium->find($id);
            $result = ($result === null) ? 0 : $result->delete();
            return $result ? response()->json(['message' => 'Successfully removed.'], 200) : response()->json(['error' => 'No data found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while removing.'], 500);
        }
    }
}
