<?php

include_once("define_rmxApi.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$bearer_token = BEARER_TOKEN;
$header_token = $_SERVER['HTTP_AUTHORIZATION'];

$api_query = $_SERVER['QUERY_STRING'];
$api_menu = $api_query['menu'];



// echo $bearer_token . '==' . $header_token;

// print_r( $header_token);

 echo $api_menu;