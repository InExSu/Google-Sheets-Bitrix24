<?php
// адаптировал код из
// https://pocketadmin.tech/ru/%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B0-%D1%81-4-%D0%B2%D0%B5%D1%80%D1%81%D0%B8%D0%B5%D0%B9-api-google-%D1%82%D0%B0%D0%B1%D0%BB%D0%B8%D1%86%D1%8B-%D0%BD%D0%B0-php/
// код размещён в
// https://restzg.ru/phpb24/googleSheetsAPI/index99.php
// адрес почты для прудоставления доступа
// service-account-01@popov-php-bitrix24-zg-20220603.iam.gserviceaccount.com
// OAuth 2.0 для доступа к API Google
// https://developers.google.com/identity/protocols/oauth2/service-account

// Connect the Google Sheets API client
require_once __DIR__ . '/vendor/autoload.php';
require_once 'Google.php';

// Our service account access key
$googleAccountKeyFilePath = __DIR__ . '/popov-php-bitrix24-zg-20220603-a1df757bd724.json';
//putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $googleAccountKeyFilePath);
//// Create new client
//$client = new Google_Client();
//// Set credentials
//$client->useApplicationDefaultCredentials();
//// Adding an access area for reading, editing, creating and deleting tables
//$client->addScope('https://www.googleapis.com/auth/spreadsheets');
//$service = new Google_Service_Sheets($client);

// Контакты с выставки spreadsheet ID
//$spreadsheetId = '19SvdLfCv-OM9yBSG5ojbDc3UdZA-VqGH1ULtqZgB1AY';
// Гугл таблица для тестов, экспериментов
$spreadSheetId = '1AyQgdT7OH0htFn06K_3DskDh5huS9BdN2OIdQLmgCEs';

//$response =  $service->spreadsheets->get($spreadsheetId);

$google = new Google($googleAccountKeyFilePath, $spreadSheetId);
$googleService = $google->service_Sheets();
$spreadSheet = $googleService->spreadsheets->get($spreadSheetId);

// Получение свойств таблицы
$spreadSheetProperties = $spreadSheet->getProperties();

$range = 'Лист1!A1:D2';
$response = $googleService->spreadsheets_values->get($spreadSheetId, $range);
var_dump($response);

/**
 * Обновление диапазона ячеек
 */

// Данные для обновления
$values = [
    ["2022-06-07", "33"],
];

// Объект - диапазон значений
$ValueRange = new Google_Service_Sheets_ValueRange();
// Устанавливаем наши данные
$ValueRange->setValues($values);
// Указываем в опциях обрабатывать пользовательские данные
$options = ['valueInputOption' => 'USER_ENTERED'];
// Делаем запрос с указанием во втором параметре названия листа и начальную ячейку для заполнения
$googleService->spreadsheets_values->update($spreadSheetId, 'Лист1!C2', $ValueRange, $options);


// Имя таблицы
//var_dump($spreadSheetProperties->title);

// Обход всех листов
//foreach ($spreadSheet->getSheets() as $sheet) {
//
//    // Получаем свойства листа
//    $sheetProperties = $sheet->getProperties();
//    // Идентификатор листа
//    var_dump($sheetProperties->index);
//    // Имя листа
//    var_dump($sheetProperties->title);
//}
