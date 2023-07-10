<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CoachController extends Controller
{
    protected $coach;
    
    public function __construct(Coach $coach)
    {
        $this->coach = $coach;
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, $this->coach->rules(), $this->coach->feedback());
            
            $coach = $this->coach->create($request->all());
            
            return response()->json($coach, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar o técnico.'], 500);
        }
    }

    public function show($id)
    {
        $coach = $this->coach->findOrFail($id);
        
        return response()->json($coach);
    }

    public function update(Request $request, $id)
    {
        try {
            $coach = $this->coach->findOrFail($id);

            $this->validate($request, $this->coach->rules(), $this->coach->feedback());

            $coach->update($request->all());

            return response()->json($coach);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar o técnico.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $coach = $this->coach->findOrFail($id);
            
            $coach->delete();

            return response()->json(['message' => 'Técnico removido com sucesso.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao remover o técnico.'], 500);
        }
    }
}
