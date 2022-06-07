<?php
// https://pocketadmin.tech/ru/%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B0-%D1%81-4-%D0%B2%D0%B5%D1%80%D1%81%D0%B8%D0%B5%D0%B9-api-google-%D1%82%D0%B0%D0%B1%D0%BB%D0%B8%D1%86%D1%8B-%D0%BD%D0%B0-php/
// https://restzg.ru/phpb24/googleSheetsAPI/
// Connect the Google Sheets API client
require_once __DIR__ . '/vendor/autoload.php';
require_once 'GoogleService.php';

// Our service account access key
$googleAccountKeyFilePath = __DIR__ . '/popov-php-bitrix24-zg-20220603-a1df757bd724.json';
putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $googleAccountKeyFilePath);
// Create new client
$client = new Google_Client();
// Set credentials
$client->useApplicationDefaultCredentials();
// Adding an access area for reading, editing, creating and deleting tables
$client->addScope('https://www.googleapis.com/auth/spreadsheets');
$service = new Google_Service_Sheets($client);

// you spreadsheet ID
$spreadsheetId = '19SvdLfCv-OM9yBSG5ojbDc3UdZA-VqGH1ULtqZgB1AY';

//$response =  $service->spreadsheets->get($spreadsheetId);

$googleService = new GoogleService($googleAccountKeyFilePath, $spreadsheetId);
$spreadSheet = $googleService->spreadSheet();

// Получение свойств таблицы
$spreadSheetProperties = $spreadSheet->getProperties();

// Имя таблицы
var_dump($spreadSheetProperties->title);

// Обход всех листов
foreach ($spreadSheet->getSheets() as $sheet) {

    // Получаем свойства листа
    $sheetProperties = $sheet->getProperties();
    // Идентификатор листа
    var_dump($sheetProperties->index);
    // Имя листа
    var_dump($sheetProperties->title);
}

