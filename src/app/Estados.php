<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    protected $table = 'estados';

    public function get_estados(){
        /*retorna os nomes dos estados que contém no mínimo uma vaga*/
        $query = "select nome from estados where id = any (select distinct estado_id from vagas)";
        $estados = $this->raw($query)->orderBy('nome')->get();
        return $estados;
    }

    public function get_random_state(){
        $estado = $this->select('nome')->inRandomOrder()->first();
        return $estado['nome'];
    }

    public function isValid($id){
        return $this->select('id')->where('id', '=', $id)->value('id');
    }

    public function get_estados_like($local){
        $local = '%' . $local . '%';
        return $this->select('id')
        ->where('nome', 'like', $local)
        ->orWhere('uf', 'like', $local)
        ->pluck('id')->all();
    }

}
