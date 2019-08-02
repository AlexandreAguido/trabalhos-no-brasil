<?php

namespace Tests\Unit;
use Tests\TestCase;
use App\Libraries\GoogleDriveWrapper;

class GoogleDriveWrapperTest extends TestCase
{

    private $drive;

    protected function setUp()
    {
        $this->drive = new GoogleDriveWrapper;
    }

    public function testCredentialsAreCorrect()
    {
         
        $this->assertTrue($this->drive->test_credentials());
    }

    public function testSuccessOnDownloadFile()
    {
        $file_path = __DIR__ . '/sample.txt';
        echo $file_path;
        fclose(fopen($file_path, 'w'));
        $this->drive->download_file($file_path);
        unlink($file_path);
    }
    
}
