<?php
namespace App\Service;

use Google_Client;
use Google_Service_Drive;
use Google_Service_Sheets;

class GoogleDriveService
{
    protected $client;
    protected $service;

    public function __construct()
    {

        $this->client = new Google_Client();
        $this->client->setAuthConfig(config('google-drive.service_account_json'));
        $this->client->addScope([Google_Service_Drive::DRIVE]);

        $this->service = new Google_Service_Drive($this->client);
    }

    public function uploadFile($filePath, $fileName)
    {
        $fileMetadata = new \Google_Service_Drive_DriveFile([
            'name' => $fileName
        ]);

        $content = file_get_contents($filePath);

        $file = $this->service->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => mime_content_type($filePath),
            'uploadType' => 'multipart',
            'fields' => 'id',
        ]);

        return $file->id;
    }

    public function getFile($fileId)
    {
        $response =  $this->service->files->export($fileId, 'text/csv', [
            'alt' => 'media'
        ]);
        return $response->getBody()->getContents();
    }

    public function listFiles($query = '')
    {
        $response = $this->service->files->listFiles([
            'q' => $query,
            'spaces' => 'drive',
            'fields' => 'files(id, name)',
        ]);

        return $response->files;
    }
}
