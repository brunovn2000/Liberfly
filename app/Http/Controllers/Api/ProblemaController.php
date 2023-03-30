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
