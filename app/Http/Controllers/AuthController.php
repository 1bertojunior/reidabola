<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
