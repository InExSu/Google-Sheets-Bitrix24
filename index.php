<?php
// адаптировал код из
// https://pocketadmin.tech/ru/%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B0-%D1%81-4-%D0%B2%D0%B5%D1%80%D1%81%D0%B8%D0%B5%D0%B9-api-google-%D1%82%D0%B0%D0%B1%D0%BB%D0%B8%D1%86%D1%8B-%D0%BD%D0%B0-php/
// код размещён на
// https://restzg.ru/phpb24/googleSheetsAPI/
// адрес почты для прудоставления доступа
// service-account-01@popov-php-bitrix24-zg-20220603.iam.gserviceaccount.com

// Connect the Google Sheets API client
use Google\Service\Sheets\ValueRange;
require_once __DIR__ . '/vendor/autoload.php';
require_once 'Google.php';

$file_Credentials = __DIR__ . '/popov-php-bitrix24-zg-20220603-a1df757bd724.json';
$gss_Range_Address = "2021 год"; // весь диапазон листа
$gss_Spread_ID = '18B7ifEIqg0GHyET5AX-RM0ZVv1Sm9phJWJNRbNaH0SM'; // Контакты с выставки

echo 'function bitrix24_Leads_from_Array';
bitrix24_Leads_from_Array(
    gss_Range_2_Array($gss_Range_Address, $gss_Spread_ID, $file_Credentials),
    bitrix24('вебхук'));

function bitrix24_Leads_from_Array($object, $bitrix24)
{ // создать лиды из массива
    $values = $object->getValues();
    if (empty($values)) {
        print "No data found.n";
    } else {
        print "A, B:n";
        foreach ($values as $row) {
            // Print columns A and B, which correspond to indices 0 and 1.
            printf("%s, %s<br>", $row[0], $row[1]);
        }
    }
}

function gss_Range_2_Array($gss_Range_Address, $gss_spreadSheets_ID, $file_Credentials): ValueRange
{ // диапазон гугтаблицы в массив
    $google = new Google($file_Credentials, $gss_spreadSheets_ID);
    $googleService = $google->service_Sheets();
    echo 'function gss_Range_2_Array';
    return $googleService->spreadsheets_values->get($gss_spreadSheets_ID, $gss_Range_Address);
}

function bitrix24($webHook)
{

}