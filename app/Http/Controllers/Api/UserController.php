<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    //
    public function __construct(User $user)
    {

        $this->user = $user;

    }




    /**
     * @OA\Post(
     * path="/api/v1/user",
     * summary="criar usuario",
     * description="criação de usuarios",
     * operationId="criar",
     * tags={"User"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Credenciais do usuario",
     *    @OA\JsonContent(
     *       required={"name","email","password"},
     *       @OA\Property(property="name", type="string", format="name", example="bruno"),
     *       @OA\Property(property="email", type="string", format="email", example="bruno@gmail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="123456"),
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="msg", type="string", example="erro ao criar usuario")
     *        )
     *     ),
    * @OA\Response(
     *    response=200,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="msg", type="string", example=" msg:  usuario criado com sucesso")
     *        )
     *     )
     * )
     */
    public function criar(Request $request)
    {

        $dados = $request->all();
        Validator::make($dados, [
            'email' => 'required|unique:users|email',
            'name' => 'required|min:3',
            'password' => 'required|min:5',
        ])->validate();

        try {

            $dados['password'] = bcrypt($dados['password']);
            $this->user->create($dados);

            return response()->json([
                'response' => [
                    'msg' => 'Usuário cadastrado com sucesso'
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
        * path="/api/v1/user",
        * summary="retornar todos os usuarios",
        * description="retornar todos os usuarios",
        * operationId="listUsers",
        * tags={"User"},
        * security={ {"bearer": {} }},
        * @OA\Response(
        *    response=200,
        *    description="Success",
        *    @OA\JsonContent(
        *       @OA\Property(property="data", type="object", example="user")
        *        )
        *     ),
        * )
        */
       

    public function listarTodos()
    {

        try {
            $user = $this->user->all();
            return response()->json([
                'response' => [
                    'data' => $user
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
        * path="/api/v1/user/{id}",
        * summary="retornar usuario",
        * description="retornar usuarios com seus problemas aereos",
        * operationId="listUsersUnique",
        * tags={"User"},
        * security={ {"bearer": {} }},
        * @OA\Response(
        *    response=200,
        *    description="Success",
        *    @OA\JsonContent(
        *       @OA\Property(property="data", type="object", example="user")
        *        )
        *     ),
        * )
        */
    public function listar($id)
    {
        Validator::make(['id'=> $id], [
            'id' => 'required|numeric'
        ])->validate();


        try {
            $user = $this->user->findOrFail($id);
            $user['problema'] = $user->Problema;

            return response()->json([
                'response' => [
                    'data' => $user
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


        /** @OA\Delete(
        * path="/api/v1/user/{id}",
        * summary="deletar usuario",
        * description="deletar usuarios",
        * operationId="deleteUsers",
        * tags={"User"},
        * security={ {"bearer": {} }},
        * @OA\Response(
        *    response=200,
        *    description="Success",
        *    @OA\JsonContent(
        *       @OA\Property(property="data", type="object", example="user")
        *        )
        *     ),
        * )
        */
    public function deletar( $id)
    {

        Validator::make(['id'=> $id], [
            'id' => 'required|numeric'
        ])->validate();

        try {

            $user = $this->user->findOrFail($id);
            $user->delete();

            return response()->json([
                'response' => [
                    'msg' => 'Usuario apagado com sucesso'
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




}