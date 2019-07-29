<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidades extends Model
{
    protected $table = 'cidades';

    public function get_cidades($id){
        $cidades = $this->select('nome', 'id')->where('estado_id', '=', $id)
        ->orderBy('nome')->get();
        return $cidades;
    }

    public function get_estado_id($cidade_id){
        return $this->select('estado_id')->where('id', '=', $cidade_id)->value('estado_id');
    }

    public function get_cidades_like($search_term){
        $search_term = '%' . ucfirst($search_term) . "%";
        return $this->select('*')
        ->where('nome', 'like', $search_term)
        ->orderBy('id')
        ->pluck('id')->all();
    }
}