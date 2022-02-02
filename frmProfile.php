<?php
/*    include_once("index.html"); */

session_start();

error_reporting(E_ALL & ~E_NOTICE);
include_once("rmxLineFunction.php");

$CompanyUrl = COMPANY_URL;
$RegisterUrl = REGISTER_URL;
$CompanyCode = COMPANY_CODE;
$LiffId = LIFF_ID;
$sURL = sURL;


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

$TableTitle = 'Query Result';
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
$sFlag = '0';
$sTitle = 'Search';
$sShowMsg = '';

if ($LinkCode == 'SEARCH') {

    $RetCommand = send_query($CompanyUrl, $LineId, $CompanyCode, $CmdCommand);
    if ($RetCommand) {
    }
    $sFlag = '5';
} else if ($LinkCode == 'CHECK') {

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


            $sShowMsg = '0';
            if ($sFlag != '0') $sTitle = 'Search';
        }
    }
}

function ticketSearchScreen($LineId, $arrRet)
{
    $aa = '
        <label><b>LINE ID: </b>' . $LineId . '</label><p>
    <label><b>SoldToCode: </b>' . $arrRet[5] . '</label><p>
    <label><b>SoldToName: </b>' . $arrRet[6] . '</label><p>
    <label><b>Tel: </b>' . $arrRet[4] . '</label><p>
    <label><b>EMail: </b>' . $arrRet[3] . '</label><p>
    ';

    $res = '
    <div class="login_container">
        <div class="login_container">
            <label for="txtFirst"><b>Start Date</b></label>
            <input type="date" dateformat="d M y" id="txtFirst">
            <label for="txtLast"><b>End Date</b></label>
            <input type="date" id="txtLast" dateformat="d M y">
            <label for="txtTicketNo"><b>Ticket No</b></label>
            <input type="text" id="txtTicketNo" value="">
            <input type="hidden" id="txtRet" value="<?php echo $RetCommand; ?>">
            <button type="button" id="btnSearch" onclick="SearchClick()">SEARCH</button>
        </div>

    </div>
    ';

    echo $res;
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
    <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/versions/2.18.1/sdk.js"></script>
    <script charset="utf-8" src="js/rmx_liff_function.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/search_style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>


</body>

</html>