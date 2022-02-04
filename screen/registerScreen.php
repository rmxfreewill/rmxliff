<?php

include_once("zScreenFunction.php");

error_reporting(-1);
ini_set('display_errors', 'On');

$CompanyUrl = COMPANY_URL;
$RegisterUrl = REGISTER_URL;
$CompanyCode = COMPANY_CODE;
$LiffId = LIFF_ID;

getDataFromRoute();

if ($route == 'MENU') {
    echo $route;
} else if ($route == 'CHECKDATA') {
    echo $route;
}
