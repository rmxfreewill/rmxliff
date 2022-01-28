<?php

session_start();

error_reporting(E_ALL & ~E_NOTICE);
include("rmxLineFunction.php");
include("function/rmx_liff_function.php");

header('Access-Control-Allow-Origin: *');

$conn = mysqli_connect(HEROKU_HOST, HEROKU_USER, HEROKU_PASS, HEROKU_DB, PORT);
if ($conn) {
    echo "Connect";
} else {
    rmxhi();
}

echo 'HIHI';