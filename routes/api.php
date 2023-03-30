<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->namespace('Api')->group(function(){


    Route::prefix('user')->name('userCadastro')->group( function(){
        Route::post('/', 'UserController@criar')->name('criarUsuario');
        Route::post('/login','Auth\\AuthController@login')->name('login');
        Route::get('/logout','Auth\\AuthController@logout')->name('logout');
        Route::get('/refresh','Auth\\AuthController@refresh')->name('refresh');
        
    });
    Route::group(['middleware'=> ['jwt.auth']], function(){ 

            Route::prefix('problema')->name('problema')->group( function(){
                Route::get('/', 'ProblemaController@listarTodos')->name('index');
                Route::get('/{id}', 'ProblemaController@listar')->name('listar');
    
            });
        
            Route::prefix('user')->name('user')->group( function(){
                Route::get('/', 'UserController@listarTodos')->name('listarTodos');
                Route::delete('/{id}', 'UserController@deletar')->name('apagarUsuario');
                Route::get('/{id}', 'UserController@listar')->name('listarUnicoUsuario');
                
            });

    });




});

