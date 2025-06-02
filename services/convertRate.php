<?php
/**
 * Obtiene el cambio de moneda a partir de la moneda.
 */
function getConvertRate(string $moneda)
{
    // set Access key
    $access_key = trim(file_get_contents('../.env'));

    $from = 'EUR';

    // initialize CURL:
    $ch = curl_init('https://api.exchangerate.host/convert?access_key=' . $access_key . '&from=' . $from . '&to=' . $moneda . '&amount=1');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // get the (still encoded) JSON data:
    $json = curl_exec($ch);
    curl_close($ch);

    // Decode JSON response:
    $conversionResult = json_decode($json, true);

    // access the conversion result
    return $conversionResult['result'];
}