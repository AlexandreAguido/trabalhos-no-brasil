<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cidades;
class CidadesController extends Controller
{
    protected $table = 'cidades';
    public function get_cidades($id){
        $cidades_model = new Cidades;
        $cidades = $cidades_model->get_cidades($id);
        return view('components/cidades_list', ['cidades' => $cidades, 'id' => 0]);
    }
}
