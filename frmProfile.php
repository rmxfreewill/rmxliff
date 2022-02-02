<?php
/*    include_once("index.html"); */

session_start();

error_reporting(E_ALL & ~E_NOTICE);
include_once("rmxLineFunction.php");
include_once("rmxLiffFunction/rmxProfileLiff.php");

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
$sTitle = 'Profile';
$sShowMsg = '';

$nameText = '';
$mobileText = '';
$emailText = '';
$LineId = '';
if (isset($_POST['LineId']))
    $LineId = $_POST['LineId'];
if (isset($_GET['LineId']))
    $LineId = $_GET['LineId'];

$getDataProfile = rmxGetProfileLiff('profile', $LineId);
$getDataProfileObj = json_decode($getDataProfile);
$nameText = $getDataProfileObj->name . ' ' . $getDataProfileObj->surname;
$mobileText = $getDataProfileObj->mobile;
$emailText = $getDataProfileObj->email;



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
    <title>Profile</title>
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
    <div class="container mt-5">
        <div class="card border-success">
            <div class="card text-white">
                <h4 class="card-header bg-success text-uppercase font-weight-bold">user profile</h4>
                <div class="card-body text-dark" style="background-color:#ebf7f0;">
                    <h5>
                        <div class="row card-text">
                            <div class="col-5 text-uppercase font-weight-bold">
                                name
                            </div>
                            <div class="col-7 font-weight-normal">
                                <?php
                                echo $nameText;
                                ?>
                            </div>
                        </div>
                        <div class="row card-text mt-3">
                            <div class="col-5 text-uppercase font-weight-bold">
                                mobile no
                            </div>
                            <div class="col-7 font-weight-normal">
                                <?php
                                echo $mobileText;
                                ?>
                            </div>
                        </div>
                        <div class="row card-text mt-3">
                            <div class="col-5 text-uppercase font-weight-bold">
                                email
                            </div>
                            <div class="col-7 font-weight-normal">
                                <?php
                                echo $emailText;
                                ?>
                            </div>
                        </div>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</body>

</html>