<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Repositories\PlayerRepository;

class PlayerController extends Controller
{

    protected $player;

    public function __construct(Player $player){
        $this->player = $player;
    }

    public function index(Request $request)
    {
        try{
            $playerRepository = new PlayerRepository($this->player);

            $playerRepository
                ->selectAttributesRelated([
                    'position',
                    'city'
                ]);

            if ($request->has('filter')) {
                $playerRepository->filter($request->filter);                
            }

            if($request->has('att')){
                $playerRepository->selectAttributes($request->att);
            }

            $result  = $playerRepository->getResult();
            return response()->json( $result, 200 );
        }catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }
    }
    
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

