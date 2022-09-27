<?php

require_once 'index.php';

function bitrix24_Leads_from_Array_Test()
{
    $googleSheet_Range_Address = 'список'; // весь диапазон листа
    $googleSheet_Spread_ID     = '18B7ifEIqg0GHyET5AX-RM0ZVv1Sm9phJWJNRbNaH0SM'; // Контакты с выставки
    global $File_Credentials;

    bitrix24_Leads_from_Array(
        googleSheet_Range_2_Array($googleSheet_Range_Address,
                                  $googleSheet_Spread_ID,
                                  $File_Credentials),
        bitrix24('вебхук'));
}

function googleSheet_Range_2_Array_Test()
{
    $googleSheet_Range_Address = 'список'; // весь диапазон листа
    $googleSheet_Spread_ID     = '18B7ifEIqg0GHyET5AX-RM0ZVv1Sm9phJWJNRbNaH0SM'; // Контакты с выставки
    global $File_Credentials;

    $arr_Result = googleSheet_Range_2_Array($googleSheet_Range_Address,
                                            $googleSheet_Spread_ID,
                                            $File_Credentials);
    assert(isset($arr_Result['values']));
}

function array_2_Google_Sheet_Test()
{

    global $File_Credentials;

    $array = [
        ['2016-02-12', '5453 543543'],
        ['2017-02-12', '5453 543543'],
        ['2018-02-12', '5453 543543'],
    ];

    $googleSheet_Range_Address   = 'Лист1!A1';
    $googleSheet_spreadSheets_ID = '1DBXDXoZvfOYl5h-ufEjKHiOgBzjfTFY9U_xvNfl9MyY';
    $arr_Options                 = ['valueInputOption' => 'RAW'];

    $result = array_2_Google_Sheet($array,
                                   $googleSheet_Range_Address,
                                   $googleSheet_spreadSheets_ID,
                                   $File_Credentials,
                                   $arr_Options);
    assert($result['updatedCells'] == 6);
}

function array_Php_2_Array_Sheet_Order_Test()
{
    $arr_Php    = [
        'V' => 'v',
        'A' => 'a',
        'Z' => 'z',];
    $arr_Fields = [
        0 => 'Z',
        1 => 'A',
        2 => 'V',
    ];

    $res = array_Php_2_Array_Sheet_Order($arr_Php,
                                         $arr_Fields);
//    var_dump($res);
    foreach ($res as $key => $value) {
        var_dump($key . " => " . $value);
    }
}

//array_2_Google_Sheet_Test();
//googleSheet_Range_2_Array_Test();
//array_Php_2_Array_Sheet_Order_Test();
