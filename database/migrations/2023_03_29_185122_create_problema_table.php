<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problema_aereo', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_problema');
            $table->string('descricao');
            $table->string('companhia_aerea');
            $table->dateTime('data_ocorrido', 0);	
            $table->dateTime('data_criacao', 0);	
            $table->dateTime('data_atualizacao', 0);
            $table->foreignId('user_id');			

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problema_aereo');
    }
}
