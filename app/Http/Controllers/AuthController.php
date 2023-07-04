<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class AuthController extends Controller
{
    public function login(Request $request){
        $data = $request->all( ['email', 'password'] );
        
        // auth (by email and password)
        $token = auth('api')->attempt($data);
        
        if( $token ){
            $result = [ 
                'msg' => ['token' => $token],
                'status' => 200
             ];
        }else{
            $result = [ 
                'msg' => ['token' => null],
                'status' => 403
             ];
        }

        // return JWT
        return response()->json( $result['msg'], $result['status'] );
    }

    public function register(Request $request){
        $data = $request->all();

        $user = new User([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'nick' => $data['password'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        
        $request->validate($user->rules(), $user->feedback());
        $user->save();
        
        return response()->json([
            'msg' => 'User created successfully',
            'user' => $user
        ], 201);
    }

    public function logout(){
        auth('api')->logout();
        return response()->json([
            'msg' => 'Logout realziado com sucesso',
        ]);
    }

    public function refresh(){
        $token = auth('api')->refresh();

        return response()->json( [
            'token' => $token,
        ] );
    }

    public function me(){
        return response()->json( auth()->user() );
    }
}
