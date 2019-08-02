<?php

namespace App\Libraries;

require_once __DIR__ . '/../../vendor/autoload.php';

use Google_Client;
use Google_Service_Drive;
use Requests;
class GoogleDriveWrapper
{
    private $drive;
    private $client;
    private $last_downloaded_file;

    public function __construct()
    {
        $credentials_path = __DIR__ . '/credentials.json';
        $env_var = 'GOOGLE_APPLICATION_CREDENTIALS';
        getenv($env_var) or putenv($env_var.'='.$credentials_path);
        $this->client = new Google_Client();
        $this->client->useApplicationDefaultCredentials();
        $this->client->addScope("https://www.googleapis.com/auth/drive.appdata");
        $this->drive = new Google_Service_Drive($this->client); 
    }

    private function set_last_downloaded_file($arr){
        $this->last_downloaded_file = $arr;
    }

    public function get_last_downloaded_file(){
        return $this->last_downloaded_file;
    }

    public function test_credentials()
    {
        /**
         * Make a simple request to test the credentials file
         * @return true 
         */
        $params = array('fields' => 'kind');
        try{
            $result = $this->drive->about->get($params);
            return true;
        }
        catch(Exception $e){
            echo $e->message . PHP_EOL;
            throw($e);
        }
        
    }

    private function list_files(){
        $opts = array(
            'spaces' => 'appDataFolder',
            'pageSize' => '10',
            'q' => "mimeType='application/json'"
        );
        return $files = $this->drive->files->listFiles($opts)->getFiles();
    }

    public function download_file($abs_path = './')
    {
        $file = $this->list_files()[0];
        $file_id = $file['id'];
        $file_name = $file['name'];
        $abs_path .= $file['name'];
        $fp = fopen($abs_path, 'w');
        $result = $this->drive->files->get($file_id, ['alt' => 'media']);
        fwrite($fp, $result->getBody()->getContents());
        $this->set_last_downloaded_file(['name'=> $abs_path, 'id' => $file_id]);
        return True;
    }

    public function delete_file()
    {
        $file_id = $this->get_last_downloaded_file()['id'];
        $this->drive->files->delete($file_id);
    }

}