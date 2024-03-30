<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\AccessLevel;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request){
      $credentials = $request->only('email', 'password');
      
      try {
        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciais inválidas'], 401);
        }
      } catch (JWTException $e) {
          return response()->json(['error' => 'Não foi possível criar o token'], 500);
      }
  
      $user = Auth::user();
  
      return response()->json([
          'token' => $token,
          'user' => $user
      ]);
    }
    
    public function register(Request $request)
    {
        $data = $request->all();
        $defaultAccessLevelId = AccessLevel::getAccessLevelIdByName('Usuário');

        // Verifica se o campo access_level_id não foi enviado
        if (!isset($data['access_level_id'])) {
            $data['access_level_id'] = $defaultAccessLevelId;
        }

        // Verifica se o access_level_id é igual ao ID do nível de acesso de "usuário"
        if ($data['access_level_id'] == $defaultAccessLevelId) {
            $user = new User([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'nick' => $data['nick'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'access_level_id' => $data['access_level_id']
            ]);

            $rules = $user->rules();
            $rules['access_level_id'] = 'sometimes|' . $rules['access_level_id'];

            $request->validate($rules, $user->feedback());
            $user->save();

            return response()->json([
                'msg' => 'User created successfully',
                'user' => $user
            ], 201);
        } else {
            // implemented register user others permissions 
            return response()->json(['error' => 'Unauthorized access.'], 403);
        }
    }

    public function logout(){
        try {
            Auth::logout();
            return response()->json(['message' => 'Logout realizado com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro ao tentar realizar o logout'], 500);
        }
    }

    public function refresh(Request $request)
    {
        try {
            $token = JWTAuth::parseToken()->refresh();
            return response()->json(['token' => $token]);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Não foi possível atualizar o token'], 500);
        }
    }

    public function me(){
        return response()->json( auth()->user() );
    }
}
