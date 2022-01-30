<?php

error_reporting(-1);
ini_set('display_errors', 'On');

header('Access-Control-Allow-Origin: *');

include("rmxLiffFunction/rmxProfileLiff.php");

$nameText = '';
$mobileText = '';
$LineId = '';
if (isset($_POST['LineId']))
    $LineId = $_POST['LineId'];
if (isset($_GET['LineId']))
    $LineId = $_GET['LineId'];

try {
    $getDataProfile = rmxGetProfileLiff($LineId);
    $getDataProfileObj = json_decode($getDataProfile);
    $nameText = $getDataProfileObj->name . ' ' . $getDataProfileObj->surname;
    $mobileText = $getDataProfileObj->mobile;
    // echo "<b>LINEID: </b>" . $LineId;
    // echo "<p>";
    // echo "<b>Name:</b><p>";
    // echo $nameText;
    // echo "<p>";
    // echo "<b>Mobile No.</b><p>";
    // echo $mobileText;
} catch (\Throwable $th) {
    // echo $th;
}

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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="container">
        <div class="card rounded">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title text-center">USER PROFILE</h5>
                    <p class="card-text">Name:</p>
                    <p class="card-text">
                        <?php
                        echo $nameText;
                        ?></p>
                    <p class="card-text">Mobile No:</p>
                    <p class="card-text">
                        <?php
                        echo $mobileText;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <a class="btn btn-primary" onclick="liff.closeWindow()">Close</a>
    </div>

</body>

</html>