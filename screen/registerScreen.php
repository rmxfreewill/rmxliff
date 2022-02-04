<?php

error_reporting(-1);
ini_set('display_errors', 'On');

include($_SERVER['DOCUMENT_ROOT'] . "/define_Global.php");
include("zScreenFunction.php");

$CompanyUrl = COMPANY_URL;
$RegisterUrl = REGISTER_URL;
$CompanyCode = COMPANY_CODE;
$LiffId = LIFF_ID;

$objData = getDataFromRoute();

if ($objData->route == 'MENU') {
    echo $route;
} else if ($objData->route == 'CHECKDATA') {
    echo $route;
}
