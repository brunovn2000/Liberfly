<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    

    /**
     * @OA\Post(
     * path="/api/v1/user/login",
     * summary="login no sistema",
     * description="Login por email, password",
     * operationId="authLogin",
     * tags={"Auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Credenciais do usuario",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="bruno@gmail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="123456"),
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="msg", type="string", example="não autorizado")
     *        )
     *     ),
    * @OA\Response(
     *    response=200,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="msg", type="string", example=" token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ")
     *        )
     *     )
     * )
     */
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


        /** @OA\Get(
        * path="/api/v1/user/logout",
        * summary="logout no sitema",
        * description="logout no sitema",
        * operationId="logout",
        * tags={"Auth"},
        * security={ {"bearer": {} }},
        * @OA\Response(
        *    response=200,
        *    description="Success",
        *    @OA\JsonContent(
        *       @OA\Property(property="data", type="object", example="logout")
        *        )
        *     ),
        * )
        */
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


        /** @OA\Get(
        * path="/api/v1/user/refresh",
        * summary="refresh token no sitema",
        * description="refresh toke no sitema",
        * operationId="refresh",
        * tags={"Auth"},
        * security={ {"bearer": {} }},
        * @OA\Response(
        *    response=200,
        *    description="Success",
        *    @OA\JsonContent(
        *       @OA\Property(property="data", type="object", example="logout")
        *        )
        *     ),
        * )
        */
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
