<?php

session_start();

// error_reporting(E_ALL & ~E_NOTICE);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("rmxLineFunction.php");
include("rmxApi/define_Api_Global.php");

header('Access-Control-Allow-Origin: *');

$conn = mysqli_connect(HEROKU_HOST, HEROKU_USER, HEROKU_PASS, HEROKU_DB, PORT);
if ($conn) {
    echo "Connect";
} else {
    rmxhi();
}

echo 'dd'