<?php

error_reporting(-1);
ini_set('display_errors', 'On');

header('Access-Control-Allow-Origin: *');

include("rmxLiffFunction/rmxProfileLiff.php");

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
$sTitle = 'Profile';
$sShowMsg = '';

// if ($LinkCode == 'SEARCH') {

//     $RetCommand = send_query($CompanyUrl, $LineId, $CompanyCode, $CmdCommand);
//     if ($RetCommand) {
//     }
//     $sFlag = '5';
// } else if ($LinkCode == 'CHECK') {

//     $RetCommand = send_command($CompanyUrl, '', '', $CmdCommand);
//     if ($RetCommand) {
//         //select $sFlagMsg,$nFlag,$sTUserName,$sTEMail,$sTMobileNo;
//         $ASRet = [];
//         $ASRet = explode("^c", $RetCommand);
//         if (count($ASRet) >= 2) {
//             $sFlagMsg = $ASRet[0];
//             $sFlag = $ASRet[1];

//             $UserName = $ASRet[2];
//             $EMail = $ASRet[3];
//             $Tel = $ASRet[4];
//             $SoldToCode = $ASRet[5];
//             $SoldToName = $ASRet[6];


//             $sShowMsg = '0';
//             if ($sFlag != '0') $sTitle = 'Search';
//         }
//     }
// }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <title>Profile</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-language" content="en-th">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="pragma" content="no-cache">

    <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/versions/2.18.1/sdk.js"></script>
    <script charset="utf-8" src="js/rmx_liff_function.js"></script>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <div class="container">
        <div class="row jumbotron text-center">
            <h3>USER PROFILE</h3>
        </div>
        <div class="row text-center">
            <div class="col-12">
                Name:
            </div>
        </div>
        <div>
            <?php

            try {
                $getDataProfile = rmxGetProfileLiff($LineId);
                $getDataProfileObj = json_decode($getDataProfile);
                $nameText = $getDataProfileObj->name . ' ' . $getDataProfileObj->surname;
                $mobileText = $getDataProfileObj->mobile;
                // echo "<b>LINEID: </b>" . $LineId;
                // echo "<p>";
                echo "<b>Name:</b><p>";
                echo $nameText;
                echo "<p>";
                echo "<b>Mobile No.</b><p>";
                echo $mobileText;
            } catch (\Throwable $th) {
                echo $th;
            }

            ?>
        </div>
</body>

</html>