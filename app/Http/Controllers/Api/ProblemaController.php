<?php

namespace App\Http\Controllers\Api;

use App\ProblemaAereo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProblemaController extends Controller
{
    //
    public function __construct(ProblemaAereo $problema){
        
        $this->problema = $problema;

    }


        /** @OA\Get(
        * path="/api/v1/problema",
        * summary="retornar problema",
        * description="retornar problema ",
        * operationId="listproblem",
        * tags={"ProblemaAereo"},
        * security={ {"bearer": {} }},
        * @OA\Response(
        *    response=200,
        *    description="Success",
        *    @OA\JsonContent(
        *       @OA\Property(property="data", type="object", example="problema")
        *        )
        *     ),
        * )
        */
    public function listarTodos(){

        try {
            $problema = $this->problema->all();
            return response()->json([
                'response' => [
                    'data' => $problema
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
        * path="/api/v1/problema/{id}",
        * summary="retornar unico problema",
        * description="retornar unico problema com informações de sewu usuario",
        * operationId="listproblemUnique",
        * tags={"ProblemaAereo"},
        * security={ {"bearer": {} }},
        * @OA\Response(
        *    response=200,
        *    description="Success",
        *    @OA\JsonContent(
        *       @OA\Property(property="data", type="object", example="problema")
        *        )
        *     ),
        * )
        */
    public function listar($id){


        Validator::make(['id'=> $id], [
            'id' => 'required|numeric'
        ])->validate();


        try {
            $problema = $this->problema->findOrFail($id);
            $problema['user'] = $problema->User;

            return response()->json([
                'response' => [
                    'data' => $problema
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
