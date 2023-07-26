<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\StatusLineup;
use App\Repositories\StatusLineupRepository;


class StatusLineupController extends Controller
{
    protected $statusLineup;

    public function __construct(StatusLineup $statusLineup)
    {
        $this->statusLineup = $statusLineup;
    }

    public function index(Request $request)
    {
        try{
            $statusLineupRepository = new StatusLineupRepository($this->statusLineup);

            if ($request->has('filter')) {
                $statusLineupRepository->filter($request->filter);                
            }

            if($request->has('att')){
                $statusLineupRepository->selectAttributes($request->att);
            }

            $result  = $statusLineupRepository->getResult();
            return response()->json( $result, 200 );
        }catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, $this->statusLineup->rules(), $this->statusLineup->feedback());

            $statusLineup = $this->statusLineup->create($request->all());

            return response()->json($statusLineup, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar o status do lineup.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $statusLineup = $this->statusLineup->findOrFail($id);

            return response()->json($statusLineup);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Status do lineup não encontrado.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $statusLineup = $this->statusLineup->find($id);

            if ($statusLineup === null) {
                return response()->json(['error' => 'Not found'], 404);
            }

            if ($request->method() === "PATCH") {
                $requestData = $request->all();

                $rules = array();
                foreach ($statusLineup->rules() as $input => $rule) {
                    if (array_key_exists($input, $requestData)) {
                        $rules[$input] = $rule;
                    }
                }

                $request->validate($rules, $statusLineup->feedback());
            } else {
                $request->validate($statusLineup->rules(), $statusLineup->feedback());
            }

            $statusLineup->update($request->all());

            return response()->json([
                'msg' => 'Updated successfully',
                'statusLineup' => $statusLineup
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $statusLineup = $this->statusLineup->findOrFail($id);

            $statusLineup->delete();

            return response()->json(['message' => 'Status do lineup removido com sucesso.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao remover o status do lineup.'], 500);
        }
    }
}
