<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vagas;
use App\Estados;
use App\Cidades;

class VagasController extends Controller
{

    public function __construct(){
       $this->vagas = new Vagas;
       $this->estados = new Estados;
       $this->cidades = new Cidades;
       $this->limit = env('RESULTS_PER_PAGE', 15);
       
    }


    private function search_from_index(Request $request){
        $vaga = $request->input('vaga_home');
        $local = $request->input('local');
        $data = ['vaga' => $vaga];
        // get estado ou cidade similares ao local
        if($local !== null){
            $data['cidades'] = $this->cidades->get_cidades_like($local);
            $data['estados'] = $this->estados->get_estados_like($local);
        }
        $result = $this->vagas->general_search($data, $this->limit);
        return $result;
    }

    private function search_from_menu(Request $request){
        $search_term = $request->input('search_term');
        $days_diff = get_date_diff($request->input('d'));
        $data = [
            'vaga' => $search_term,
            'estados' => $this->estados->get_estados_like($search_term),
            'cidades' => $this->cidades->get_cidades_like($search_term)
        ];
        if($days_diff !== null){$data['days_diff'] = $days_diff;}
        $result = $this->vagas->general_search($data, $this->limit);
        return $result;        
    }

    private function filter_vagas(Request $request){

        $data = [
            'vaga' => $request->input('vaga_hidden', ''),
            'estado' => $request->input('e'),
            'cidade' => $request->input('c')
        ];
        $days_diff = get_date_diff($request->input('d'));
        if($days_diff !== null){$data['days_diff'] = $days_diff;}
        $result = $this->vagas->filtered_search($data, $this->limit);
        return $result;
    }

    public function search(Request $request){
        // busca feita a partir da home page
        $keyword = $request->input('vaga_home');
        if($keyword != null || $request->input('local') != null ){
           $result = $this->search_from_index($request);
           
        }

        // busca feita pelo menu do topo
        else if($request->input('search_term')){
            $result = $this->search_from_menu($request);
            $keyword = $request->input('search_term');
        }

        // busca feita pelo sidebar
        //else if($request->input('vaga_hidden')){
        else{
            $result = $this->filter_vagas($request);
            $keyword = $request->input('vaga_hidden');
            
        }
        if($result->isEmpty()){
            session()->put('empty_search', true);
            return redirect('/vagas');
        }
        return $this->show_vagas($request, $result, $keyword);
    }

    public function index(Request $request){
        $mobile_request = is_mobile_request($request);
        $rand_vaga_nome = $this->vagas->get_random_vaga_nome() ;
        $rand_estado = $this->estados->get_random_state();
        $data = [
            'rand_estado' =>  empty($rand_estado) ? '' : 'Ex: ' . $rand_estado,
            'rand_vaga_nome' => empty($rand_vaga_nome) ? '' : 'Ex: ' . $rand_vaga_nome
        ];
        $mobile_request = is_mobile_request($request);
        //personalizar conforme o  dispositivo
        if($mobile_request){
            $data['assets_css'] = [asset('css/mobile/index.css'), asset('css/mobile/modal.css')];
            $data['scripts'] = [asset('js/mobile/modal.js')];
            $view = 'mobile/index';
        }
        else{
            $ultimas_vagas = $this->vagas->get_last_vagas();
            $data['ultimas_vagas'] = $ultimas_vagas;
            $data['assets_css']  = [asset('css/index.css')];
            $view = 'index';
        }
        return view($view, $data);
    }

    public function vaga($vaga, $id, Request $request){
        $data = [];
        $vaga = urldecode($vaga);
        $mobile_request = is_mobile_request($request);
        if($mobile_request){
            $data['assets_css'] = [asset('css/mobile/vaga.css'), asset('css/mobile/modal.css')];
            $data['scripts'] = [asset('js/mobile/modal.js')];
            $view = 'mobile/vaga';
        }
        else{
            $data['assets_css'] = [asset('css/vaga.css')];
            $view = 'vaga';
        }
        $data ['vaga'] = $this->vagas->single($vaga, $id);
        if(!$data['vaga']){return redirect("/vagas")->with($show_warning = true);}
        return view($view, $data);
    }

    public function show_vagas(Request $request, $vagas = null, $keyword = null){
        $mobile_request = is_mobile_request($request);
        $empty_search = session()->pull('empty_search', false);
        if($empty_search || $vagas == null){
            $result = $this->vagas->get_vagas($this->limit);
        }
        else{
            $result = $vagas;
        }
        $data = [
            'keyword' => empty($keyword) ? '' : $keyword,
            'vagas' => $result,
            'estados' => $this->estados->get_estados(),
            'scripts' => [asset('js/vagas.js')],
            'cidade_id' => $request->input('c', 0),
            'periodo' => $request->input('d'),
            'rand_vaga_nome' => $this->vagas->get_random_vaga_nome(),
            'show_warning' => $empty_search
            ];

        if($data['cidade_id'] != 0){
            if($request->input('e') != null){$data['estado_id'] = $request->input('e');}
            else{$data['estado_id'] = $this->cidades->get_estado_id($data['cidade_id']);}
        }
        else{
            $data['estado_id'] = $request->input('e', 0);
        }

        if(!empty($request->input('e')) && $request->input('e') != 0
           && $this->estados->isValid($request->input('e')) ){
            $data['cidades'] = $this->cidades->get_cidades($request->input('e'));
        }

        // decidir view
        if($mobile_request){
            $data['assets_css'] = [asset('css/mobile/vagas.css'), asset('css/mobile/modal.css')];
            $data['scripts'] = [asset('js/mobile/modal.js')];
            $view = 'mobile/vagas';
        }
        else{
            $data['assets_css'] = [asset('css/vagas.css')];
            $view = 'vagas';
        }
        return view($view, $data);
    }
}
