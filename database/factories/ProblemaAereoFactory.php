<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProblemaAereo;
use Faker\Generator as Faker;

$factory->define(ProblemaAereo::class, function (Faker $faker) {
    return [
        //
        'descricao' => $faker->text  ,
        'user_id'=> $faker->numberBetween($min = 1, $max = 70) ,
        'data_ocorrido'=>  $faker->dateTimeThisDecade    ,
        'tipo_problema'=>$faker->catchPhrase   ,
        'data_criacao'=>   now()  ,
        'data_atualizacao'=> now()    ,
        'companhia_aerea'=>$faker->state
    ];
});
