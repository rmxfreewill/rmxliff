<?php

error_reporting(-1);
ini_set('display_errors', 'On');

include("zMenuFunction.php");
include("zApiFunction.php");

$GLOBALS['COMPANY_URL'] =  COMPANY_URL;
$GLOBALS['REGISTER_URL'] =   REGISTER_URL;
$GLOBALS['COMPANY_CODE'] =   COMPANY_CODE;
$GLOBALS['LIFF_ID'] =   LIFF_ID;
$GLOBALS['sURL'] =   sURL;

$TableTitle = 'View Ticket';
if (isset($_POST['TableTitle']))
    $TableTitle = $_POST['TableTitle'];
if (isset($_GET['TableTitle']))
    $TableTitle = $_GET['TableTitle'];

$RetCommand = '';
$Ret = '';

$UserName = '';
$EMail = '';
$Tel = '';
$SoldToCode = '';
$SoldToName = '';
$sFlagMsg = '';
$sFlag = '5';
$sShowMsg = '';

$getDataFromUrl = getDataFromUrl($GLOBALS['COMPANY_CODE'], $GLOBALS['COMPANY_URL'], $GLOBALS['REGISTER_URL']);
$status = $getDataFromUrl->status;
if ($status == 'init') {
    $getData = getDataFromDatabase($GLOBALS['COMPANY_URL'], $getDataFromUrl);
    $sFlag = $getData->sFlag;
}

?>