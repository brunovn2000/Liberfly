<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ProblemaAereo extends Model
{
    //
    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_atualizacao';
    protected $table='problema_aereo';

    protected $fillable = [
        'id',
        'descricao',
        'user_id',
        'data_ocorrido',
        'tipo_problema',
        'data_criacao',
        'data_atualizacao',
        'companhia_aerea'
    ];



    public function User()
    {
        return $this->hasOne(User::class, 'id');

    }

}