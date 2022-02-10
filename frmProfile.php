<?php
/*    include_once("index.html"); */

//   session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("rmxLineFunction.php");
include_once("rmxLiffFunction.php");

$CompanyUrl = COMPANY_URL;
$RegisterUrl = REGISTER_URL;
$CompanyCode = COMPANY_CODE;
$LiffId = LIFF_ID;

/*
  if (isset($_POST['CompanyCode']))
      $CompanyCode = $_POST['CompanyCode'];
  if (isset($_GET['CompanyCode']))
      $CompanyCode = $_GET['CompanyCode'];
  */

$LinkCode = '';
if (isset($_POST['LinkCode']))
    $LinkCode = $_POST['LinkCode'];
if (isset($_GET['LinkCode']))
    $LinkCode = $_GET['LinkCode'];

$LineId = '';
if (isset($_POST['LineId']))
    $LineId = $_POST['LineId'];
if (isset($_GET['LineId']))
    $LineId = $_GET['LineId'];

$CmdCommand = '';
if (isset($_POST['CmdCommand']))
    $CmdCommand = $_POST['CmdCommand'];
if (isset($_GET['CmdCommand']))
    $CmdCommand = $_GET['CmdCommand'];

$RetCommand = '';
$Ret = '';

$UserName = '';
$EMail = '';
$Tel = '';
$SoldToCode = '';
$SoldToName = '';
$ShipToCode = '';
$ShipToName = '';
$sFlagMsg = '';
$sFlag = '0';
$sTitle = 'Register';
$sShowMsg = '';


if ($LinkCode == 'CHECK') {

    $RetCommand = send_command($CompanyUrl, '', '', $CmdCommand);
    if ($RetCommand) {
        //select $sFlagMsg,$nFlag,$sTUserName,$sTEMail,$sTMobileNo;
        $ASRet = [];
        $ASRet = explode("^c", $RetCommand);
        if (count($ASRet) >= 2) {
            $sFlagMsg = $ASRet[0];
            $sFlag = $ASRet[1];

            $UserName = $ASRet[2];
            $EMail = $ASRet[3];
            $Tel = $ASRet[4];
            $SoldToCode = $ASRet[5];
            $SoldToName = $ASRet[6];

            $ShipToCode = $ASRet[7];
            $ShipToName = $ASRet[8];

            $sShowMsg = '0';
            if ($sFlag != '0') {
                $sTitle = 'View Register Info';
            }
        }
    }
    /*
    } else  {        

        $RetCommand =send_command($CompanyUrl,'','',$CmdCommand);        
        if ($RetCommand) {
            //select $sFlagMsg,$nFlag,$sTUserName,$sTEMail,$sTMobileNo;
            $ASRet = [];
            $ASRet = explode("^c", $RetCommand);        
            if (count($ASRet) >=2) {
                $sFlagMsg=$ASRet[0];
                $sFlag=$ASRet[1];     
               
            }
        }

        $Ret =put_request($CompanyUrl,$LineId,$CompanyCode,$LinkCode,$CmdCommand);
        */
}





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


    <title><?php echo $sTitle; ?></title>

    <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/versions/2.3.0/sdk.js"></script>

    <link rel="stylesheet" href="style.css">

</head>

<body>

Hi

</body>

</html>