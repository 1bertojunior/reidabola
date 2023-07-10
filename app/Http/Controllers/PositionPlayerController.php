<?php

namespace App\Http\Controllers;

use App\Models\PositionPlayer;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PositionPlayerController extends Controller
{
    public function store(Request $request)
    {
        try {
            $this->validate($request, PositionPlayer::rules(), PositionPlayer::feedback());
            
            $positionPlayer = PositionPlayer::create($request->all());
            
            return response()->json($positionPlayer, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar a posição do jogador.'], 500);
        }
    }

    public function show($id)
    {
        $positionPlayer = PositionPlayer::findOrFail($id);
        
        return response()->json($positionPlayer);
    }

    public function update(Request $request, $id)
    {
        try {
            $positionPlayer = PositionPlayer::findOrFail($id);

            $this->validate($request, PositionPlayer::rules(), PositionPlayer::feedback());

            $positionPlayer->update($request->all());

            return response()->json($positionPlayer);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar a posição do jogador.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $positionPlayer = PositionPlayer::findOrFail($id);
            
            $positionPlayer->delete();

            return response()->json(['message' => 'Posição do jogador removida com sucesso.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao remover a posição do jogador.'], 500);
        }
    }
}

