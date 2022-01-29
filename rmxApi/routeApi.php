<?php

include("define_rmxApi.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$bearer_token = BEARER_TOKEN;
$header_token = $_SERVER['HTTP_AUTHORIZATION']['Bearer'];

// echo $uri;

// echo "<br>";

echo $bearer_token == $header_token ? 'true' : 'false';

// echo "<br>";

// print_r($_SERVER['HTTP_AUTHORIZATION']);