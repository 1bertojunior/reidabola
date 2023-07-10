<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PlayerController extends Controller
{
    public function store(Request $request)
    {
        try {
            $this->validate($request, Player::rules(), Player::feedback());
            
            $player = Player::create($request->all());
            
            return response()->json($player, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar o jogador.'], 500);
        }
    }

    public function show($id)
    {
        $player = Player::findOrFail($id);
        
        return response()->json($player);
    }

    public function update(Request $request, $id)
    {
        try {
            $player = Player::findOrFail($id);

            $this->validate($request, Player::rules(), Player::feedback());

            $player->update($request->all());

            return response()->json($player);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar o jogador.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $player = Player::findOrFail($id);
            
            $player->delete();

            return response()->json(['message' => 'Jogador removido com sucesso.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao remover o jogador.'], 500);
        }
    }
}

