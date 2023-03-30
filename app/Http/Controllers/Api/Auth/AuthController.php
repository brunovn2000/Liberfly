<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function login(Request $request){

        Validator::make($request->all(),[
            'email' => 'required|string',
            'password' => 'required|string',
        ])->validate();


        $credentials = $request->all(['email','password']);

        if(!$token = auth('api')->attempt($credentials)){
            
            return response()->json(['error'=>'não autorizado'],401);
        }

        return response()->json([
            'token' =>$token
        ],200);

    }


    public function logout(){

        try {

            auth('api')->logout();
            return response()->json([
                'response' => [
                    'msg' => 'logout feito com sucesso'
                ]
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'response' => [
                    'msg' => $th->getMessage()
                ]
            ], 422);
        }
    }


    public function refresh(){

        try {

            $token = auth('api')->refresh();

            return response()->json([
                'token' =>$token
            ],200);

        } catch (\Throwable $th) {

            return response()->json([
                'response' => [
                    'msg' => $th->getMessage()
                ]
            ], 422);
        }


    }

}
