<?php

include_once("define_rmxApi.php");

error_reporting(-1);
ini_set('display_errors', 'On');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

function getDataUrl()
{
    $get_string = $_SERVER['QUERY_STRING'];
    parse_str($get_string, $get_array);
    return  $get_array;
}
$requestMethod = $_SERVER["REQUEST_METHOD"] == 'POST';

$bearer_token = BEARER_TOKEN;
$header_token = trim($_SERVER['HTTP_AUTHORIZATION'], 'Bearer ');
$isToken = $bearer_token == $header_token;
echo $isToken;

if ($requestMethod) {
    $a = getDataUrl();
    echo $a;
}
