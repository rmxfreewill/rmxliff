<?php

include_once("define_rmxApi.php");

error_reporting(-1);
ini_set('display_errors', 'On');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$bearer_token = 'Bearer ' . BEARER_TOKEN;
$header_token = trim($_SERVER['HTTP_AUTHORIZATION'], 'Bearer ');

$requestMethod = $_SERVER["REQUEST_METHOD"] == 'POST';

$json = file_get_contents('php://input');
$data = json_decode($json);

// echo $bearer_token . '==' . $header_token;

// print_r( $header_token);

print_r($data);
