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
echo json_encode('getDataFromUrl: ' . $getDataFromUrl);
if ($status == 'init') {
    $getData = getDataFromDatabase($GLOBALS['COMPANY_URL'], $getDataFromUrl);
    
    // echo json_encode($getData);

    // $sFlag = $getData->sFlag;

    // getTicketFromDatabase($getDataFromUrl);
}

?>

<!DOCTYPE HTML>
<html>

<head>
    <title>RMX LINE OFFICIAL</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-language" content="en-th">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">

    <script charset="utf-8" src="../js/jquery.js"></script>
    <script charset="utf-8" src="../js/lineSdk_2_18_1.js"></script>
    <script charset="utf-8" src="../js/rmx_liff_function.js"></script>
</head>

<body>

    <script>
        var urlS = new URL(document.URL);
    </script>
</body>

</html>