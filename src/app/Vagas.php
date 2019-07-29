<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vagas extends Model
{
    //table name
    protected $table = 'vagas';
    const CREATED_AT = 'criado_em';

    
    public function single($vaga, $vaga_id){
        $vaga_titulo = ucfirst(str_replace('_', ' ', $vaga));
        $vaga = $this->join('estados', 'estados.id' , '=', 'vagas.estado_id')
        ->join('cidades', 'cidades.id', '=', 'vagas.cidade_id')
        ->join('empresas', 'vagas.empresa_id', '=', 'empresas.id')
        ->select('vagas.*', 'cidades.nome as cidade', 'estados.nome as estado', 
                'empresas.nome as empresa', 'estados.uf as uf')
        ->where([
            ['vagas.id' ,$vaga_id],
            ['vagas.titulo', $vaga_titulo]
            ])->first();
        return $vaga;
    }

    public function get_last_vagas($limit=15){
        $vaga = $this->select('titulo', 'id')->latest()
        ->paginate($limit);
        return $vaga;
    }

    public function get_random_vaga_nome(){
        return $this->select('titulo')->inRandomOrder()->first()['titulo'];
    }

    public function get_vagas($limit = 15){
        $result = $this->join('estados', 'estados.id', '=', 'vagas.estado_id')
        ->join('cidades', 'cidades.id', '=', 'vagas.cidade_id')
        ->join('empresas', 'empresas.id', '=', 'vagas.empresa_id')
        ->select('vagas.*', 'estados.nome as estado', 'estados.uf as uf', 'cidades.nome as cidade', 'empresas.nome as empresa')
        ->latest()
        ->paginate($limit);
        return $result;
    }
    
    public function general_search($data, $limit = 15){
        // interpreta o termo digitado pelo usuario como nome da cidade, estado
        // ou titulo da vaga
        $result = $this->join('estados', 'estados.id', '=', 'vagas.estado_id')
        ->join('cidades', 'cidades.id', '=', 'vagas.cidade_id')
        ->join('empresas', 'empresas.id', '=', 'vagas.empresa_id')
        ->select('vagas.*', 'estados.nome as estado', 'estados.uf as uf', 'cidades.nome as cidade', 'empresas.nome as empresa');
        //data
        if(!empty($data['days_diff'])){$result->where(DB::raw('DATEDIFF(NOW(), vagas.criado_em)'), '<=', $data['days_diff']);}
        if(!empty($data['vaga'])){$result->where('vagas.titulo', 'like', '%' . $data['vaga'] . '%');}
        if(!empty($data['cidades'])){$result->orWhereIn('vagas.cidade_id', $data['cidades']);}
        if(!empty($data['estados'])){$result->orWhereIn('vagas.estado_id', $data['estados']);}
        return $result->latest()->paginate($limit);
    }

    public function filtered_search($data, $limit = 15){
        // busca com cidade e estado definido pelo usuario
        $result = $this->join('estados', 'estados.id', '=', 'vagas.estado_id')
        ->join('cidades', 'cidades.id', '=', 'vagas.cidade_id')
        ->join('empresas', 'empresas.id', '=', 'vagas.empresa_id')
        ->select('vagas.*', 'estados.nome as estado', 'estados.uf as uf', 'cidades.nome as cidade', 'empresas.nome as empresa');
        
        //dados da query
        if(isset($data['days_diff'])){$result->where(DB::raw('DATEDIFF(NOW(), vagas.criado_em)'), '<=', $data['days_diff']);}
        if(!empty($data['vaga'])){$result->where('vagas.titulo', 'like', '%' . $data['vaga'] . '%');}
        if(!empty($data['estado'])){$result->where('vagas.estado_id', $data['estado']);}
        if(!empty($data['cidade'])){$result->where('vagas.cidade_id', $data['cidade']);}
        return $result->latest()->paginate($limit);
    }

    public function search($data, $limit = 15){
        // interpreta o termo digitado pelo usuario como nome da cidade, estado
        // ou titulo da vaga
        $result = $this->join('estados', 'estados.id', '=', 'vagas.estado_id')
        ->join('cidades', 'cidades.id', '=', 'vagas.cidade_id')
        ->join('empresas', 'empresas.id', '=', 'vagas.empresa_id')
        ->select('vagas.*', 'estados.nome as estado', 'estados.uf as uf', 'cidades.nome as cidade', 'empresas.nome as empresa');
        //data
        if(!empty($data['days_diff'])){$result->where(DB::raw('DATEDIFF(NOW(), vagas.criado_em)'), '<=', $data['days_diff']);}
        if(!empty($data['vaga'])){$result->where('vagas.titulo', 'like', '%' . $data['vaga'] . '%');}
        if(!empty($data['cidades'])){$result->orWhereIn('vagas.cidade_id', $data['cidades']);}
        if(!empty($data['estados'])){$result->orWhereIn('vagas.estado_id', $data['estados']);}
        return $result->latest()->paginate($limit);
    }

}
