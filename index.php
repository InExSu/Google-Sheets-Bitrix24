<?php
// адапитировал код из
// https://pocketadmin.tech/ru/%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B0-%D1%81-4-%D0%B2%D0%B5%D1%80%D1%81%D0%B8%D0%B5%D0%B9-api-google-%D1%82%D0%B0%D0%B1%D0%BB%D0%B8%D1%86%D1%8B-%D0%BD%D0%B0-php/
// код размещён на
// https://restzg.ru/phpb24/googleSheetsAPI/
// адрес почты для прудоставления доступа
// service-account-01@popov-php-bitrix24-zg-20220603.iam.gserviceaccount.com

// Connect the Google Sheets API client
//require_once __DIR__ . '/vendor/autoload.php';
//require_once 'Google.php';l

bitrix24_Leads_from_Array(
    gss_Range_2_Array2D(
        gss_Range('адрес',
            gss_Sheet("Имя",
                gss_Spread('ID')))),
    bitrix24('вебхук'),
);

function bitrix24_Leads_from_Array($array2d, $bitrix24)
{

}

function gss_Range_2_Array2D($gss_Range)
{

}

function gss_Range($address, $gss_Sheet)
{

}

function gss_Sheet($name, $gss_Spread)
{

}

function gss_Spread($id)
{

}

function bitrix24($webHook)
{

}