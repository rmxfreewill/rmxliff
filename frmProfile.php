<?php

session_start();

error_reporting(E_ALL & ~E_NOTICE);
include_once("rmxLineFunction.php");

$CompanyUrl = COMPANY_URL;
$CompanyCode = COMPANY_CODE;
$LiffId = LIFF_ID;
$sURL = sURL;

if (isset($_POST['menu']))
    $menu = $_POST['menu'];
if (isset($_GET['menu']))
    $menu = $_GET['menu'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-language" content="en-th">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="expires" content="0">
    <meta http-equiv="pragma" content="no-cache">
    <title>Line</title>

    <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/versions/2.3.0/sdk.js"></script>
    <script charset="utf-8" src="js/rmx_liff_function.js"></script>
</head>

<body>
    
</body>

</html>