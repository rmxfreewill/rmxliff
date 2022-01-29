<?php

include_once("define_rmxApi.php");

error_reporting(-1);
ini_set('display_errors', 'On');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$bearer_token = BEARER_TOKEN;
$header_token = $_SERVER['HTTP_AUTHORIZATION'];

$requestMethod = $_SERVER["REQUEST_METHOD"] == 'POST';

$api_query = $_SERVER['REQUEST_URI'];




// echo $bearer_token . '==' . $header_token;

// print_r( $header_token);

 print_r($api_query);
