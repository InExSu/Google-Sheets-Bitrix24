<?php

class GoogleService
{
    public Google_Client $client;
    public Google_Service_Sheets $service;
    public Google\Service\Sheets\Spreadsheet $spreadSheet;
    public string $googleCredentialsFilePath;
    public string $spreadSheetId;

    public function __construct(string $googleCredentialsFilePath, string $spreadSheetId)
    {
        $this->googleCredentialsFilePath = $googleCredentialsFilePath;
        $this->spreadSheetId = $spreadSheetId;
    }

    public function spreadSheet(): Google\Service\Sheets\Spreadsheet
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $this->googleCredentialsFilePath);
        $this->client = new Google_Client;
        $this->client->useApplicationDefaultCredentials();
        // Adding an access area for reading, editing, creating and deleting tables
        $this->client->addScope('https://www.googleapis.com/auth/spreadsheets');
        $this->service = new Google_Service_Sheets($this->client);
        return $this->service->spreadsheets->get($this->spreadSheetId);
    }
}