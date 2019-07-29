<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateVagasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vagas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vaga_url')->unique();
            $table->string('titulo');
            $table->text('descricao');
            $table->unsignedInteger('estado_id');
            $table->unsignedInteger('empresa_id');
            $table->float('salario', 8, 2)->defaults(0);
            $table->string('sub_titulo')->nullable();
            $table->unsignedInteger('cidade_id')->nullable();
            $table->integer('quantidade')->nullable();
            $table->string('escolaridade')->nullable();
            $table->boolean('pdc', 1)->default(0);
            $table->timestamp('criado_em')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreign('cidade_id')->references('id')->on('cidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vagas');
    }
}
