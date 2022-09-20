<?php
// адаптировал код из
// https://pocketadmin.tech/ru/%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B0-%D1%81-4-%D0%B2%D0%B5%D1%80%D1%81%D0%B8%D0%B5%D0%B9-api-google-%D1%82%D0%B0%D0%B1%D0%BB%D0%B8%D1%86%D1%8B-%D0%BD%D0%B0-php/
// код размещён на
// https://restzg.ru/phpb24/googleSheetsAPI/
// адрес почты для прудоставления доступа
// service-account-01@popov-php-bitrix24-zg-20220603.iam.gserviceaccount.com

// Connect the Google Sheets API client
use Google\Service\Sheets\ClearValuesResponse;
use Google\Service\Sheets\UpdateValuesResponse;
use Google\Service\Sheets\ValueRange;

require_once __DIR__ . '/vendor/autoload.php';
require_once 'Google.php';

$File_Credentials          = __DIR__ . '/popov-php-bitrix24-zg-20220603-a1df757bd724.json';
$googleSheet_Range_Address = "2021 год"; // весь диапазон листа
$googleSheet_Spread_ID     = '18B7ifEIqg0GHyET5AX-RM0ZVv1Sm9phJWJNRbNaH0SM'; // Контакты с выставки

function bitrix24_Leads_from_Array($object,
                                   $bitrix24)
{ // создать лиды из массива
    $values = $object->getValues();
    if (empty($values)) {
        print "No data found.n";
    } else {
        print "A, B:n";
        foreach ($values as $row) {
            // Print columns A and B, which correspond to indices 0 and 1.
            printf("%s, %s<br>",
                   $row[0],
                   $row[1]);
        }
    }
}

/** диапазон гугтаблицы в массив */
function googleSheet_Range_2_Array(string $googleSheet_Range_Address,
                                   string $googleSheet_spreadSheets_ID,
                                   string $file_Credentials): ValueRange
{
    $google        = new Google($file_Credentials,
                                $googleSheet_spreadSheets_ID);
    $googleService = $google->service_Sheets();
    return $googleService->spreadsheets_values->get($googleSheet_spreadSheets_ID,
                                                    $googleSheet_Range_Address);
}

/** диапазон гугл таблицы очистить */
function googleSheet_Range_Clear(string $range_Address,
                                 string $spreadSheet_ID,
                                 string $file_Credentials): ClearValuesResponse
{
    $google        = new Google($file_Credentials,
                                $spreadSheet_ID);
    $googleService = $google->service_Sheets();
    $requestBody   = new Google_Service_Sheets_ClearValuesRequest();

    return $googleService->spreadsheets_values->clear($spreadSheet_ID,
                                                      $range_Address,
                                                      $requestBody);
}

/** массив в гуглтаблицу */
function array_2_Google_Sheet(array $array,
                              string $googleSheet_Range_Address,
                              string $googleSheet_spreadSheets_ID,
                              string $file_Credentials,
                              array $arr_Options = ['valueInputOption' => 'RAW']): UpdateValuesResponse
{
    $google = new Google($file_Credentials,
                         $googleSheet_spreadSheets_ID);

    $googleService = $google->service_Sheets();
    $body          = new Google_Service_Sheets_ValueRange(['values' => $array]);

    return $googleService->spreadsheets_values->update($googleSheet_spreadSheets_ID,
                                                       $googleSheet_Range_Address,
                                                       $body,
                                                       $arr_Options);
}

/** массив Php в массив для диапазона гугл таблицы */
function array_Php_2_Array_Sheet($arr_Php): array
{
// Todo ошибка: Invalid JSON payload received. Unknown name \"1\" at 'data.values': Cannot find field.\


    $max = count($arr_Php);

    $arr_Sheet = [];

    for ($row = 1; $row < $max; $row++) {

        foreach ($arr_Php[$row] as $key => $elem) {
            if (is_array($elem)) {
                $stop = true;
                if (isset($elem['downloadUrl'])) {
                    $arr_Sheet[$row][] = $elem['downloadUrl'];
                } else {
                    // todo где проскакивает вложенный массив
                }

            } else {
                $arr_Sheet[$row][] = ($arr_Php[$row][$key] == null) ? '' : $arr_Php[$row][$key];
            }
        }
    }
    return $arr_Sheet;
}