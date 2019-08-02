<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Libraries\Geonames;
use App\Libraries\GoogleDriveWrapper;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    private function get_empresa_id($empresa, $email){
        // cria uma entrada no banco caso a empresa nao exista no banco
        // e retorna o seu id
        if(!isset($empresa)){$empresa = '';}
        $id = DB::table('empresas')->where('nome', $empresa)->value('id');
        if(empty($id)){
            $data = ['nome' => $empresa];
            if(isset($email)){$data['email'] = $email;}
            $id = DB::table('empresas')->insertGetId($data);
        }
        return $id;
    }

    private function get_locale_ids($cidade){
        $geoname = new Geonames;
        $cidade_id = DB::table('cidades')->where('nome', $cidade)->value('id');
        if( !isset( $cidade_id ) ){
            $estado = $geoname->get_state_name_from_city($cidade) ;
            if(!$estado){return false;}
            // criar estado se nao existir
            $estado_id = DB::table('estados')->where('nome', $estado)->value('id');
            if( !isset( $estado_id ) ){
                $uf = $geoname->get_uf_from_city($cidade);
                $estado_id = DB::table('estados')->insertGetId( [
                    'nome' => $estado,
                    'uf' => $uf
                    ] );
            }
            // criar cidade
            $data = [
                'nome' => $cidade, 
                'estado_id' => $estado_id
            ];
            $cidade_id = DB::table('cidades')->insertGetId($data);
        }
        $locale_data = DB::table('cidades')->select('id', 'estado_id')->where('nome', $cidade)->first();
        return ['estado' => $locale_data->estado_id, 'cidade' => $locale_data->id];
    }

    private function store_data($vagas_assoc){
        foreach ($vagas_assoc as $vaga) {
            // verificar existencia da vaga
            if( $vaga['cidade'] == "Não Informado" || DB::table('vagas')->where('vaga_url', $vaga['url'])->exists()){continue;}

            $data = [];
            $locale_ids = $this->get_locale_ids($vaga['cidade']);
            if(!$locale_ids){continue;} // vaga fora do brasil
            $data['titulo'] = $vaga['titulo'];
            $data['vaga_url'] = $vaga['url'];
            $data['descricao'] = $vaga['descricao'];
            $data['cidade_id'] = $locale_ids['cidade'];
            $data['estado_id'] = $locale_ids['estado'];
            $email = isset($vaga['empresa_email']) ? $vaga['empresa_email'] : "";
            $data['empresa_id'] = $this->get_empresa_id($vaga['empresa'], $email);

            // variaveis opcionais
            $vaga['salario'] == -1 ? $data['salario'] = 0 : $data['salario'] = $vaga['salario'];
            if( isset( $vaga['quantidade'] ) ){ $data['quantidade']  = $vaga['quantidade']; }
            if( isset( $vaga['pdc'] ) ){ $data['pdc'] = $vaga['pdc'] == 'null' ? 0 : 1;}
            DB::table('vagas')->insert($data);
            
        }
        

    }


    public function run()
    {   
        $path = dirname( __FILE__ ) . '/../../storage/vagas/';
        /* download file*/
        $drive = new GoogleDriveWrapper;
        $drive->download_file($path);
        
        $has_vagas = DB::table('vagas')->exists();
        $files = scandir($path);
        foreach($files as $f_name){
            if($f_name == 'sample.json' && $has_vagas){continue;} // debug scrapper
            $strings = explode('.', $f_name);
            $file_extension = end($strings);
            if($file_extension != 'json'){continue;}
            $f_name = $path . $f_name;
            $file = fopen($f_name, 'r');
            $data  = json_decode(fgets($file), true);
            $this->store_data($data);
            if($f_name != 'sample.json') {unlink($f_name);}
        }
        
        $drive->delete_file();
    }
}
