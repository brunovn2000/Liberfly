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