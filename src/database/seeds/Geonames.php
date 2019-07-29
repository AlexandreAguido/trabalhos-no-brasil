<?php

require( __DIR__ . '/../../vendor/rmccue/requests/library/Requests.php');
Requests::register_autoloader();

class Geonames{
    private $base_url;
    private $username;

    public function __construct(){
        $this->base_url = 'http://api.geonames.org/search?';
        $this->username = getenv('GEONAME_USER') or
        die('Please define GEONAME_USER environment variable');

    }
    private function search($q){
        $params = [
            'username' => $this->username,
            'q' => $q,
            'maxRows' => 5,
            'country' => 'br',
            'featureClass' => 'P',
            'type' => 'json'
        ];

        $url = $this->base_url;
        foreach ($params as $key => $value) {
            $url = $url . $key . '=' . $value . "&";
        }

        $resp = Requests::get($url);
        return json_decode($resp->body, true);
    }
    
    public function get_state_name_from_city($city){
        $data = $this->search($city);
        try{
            $estado = $data['geonames'][0]['adminName1'];
        }
        catch(Exception $e){
            return null;
        }
        return $estado == 'Federal District' ? "Brasília" : $estado;
    }

    public function get_uf_from_city($city){
        $data = $this->search($city);
        $uf = $data['geonames'][0]['adminCodes1']['ISO3166_2'];
        return $uf;
    }


}

$geo = new Geonames;