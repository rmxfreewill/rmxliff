<?php

error_reporting(-1);
ini_set('display_errors', 'On');

// include($_SERVER['DOCUMENT_ROOT'] . "/define_Global.php");
include("zMenuFunction.php");

$CompanyUrl = COMPANY_URL;
$RegisterUrl = REGISTER_URL;
$CompanyCode = COMPANY_CODE;
$LiffId = LIFF_ID;

$regisType = false;

function regisForm($type)
{
    $arr[0] = '';
    $arr[1] = '';
    if ($type == true) {
        $regisForm = '
        <label for="psw"><b>EMail: </b></label>' . $arr[0] . '
        <p><label for="psw"><b>Mobile: </b></label>' . $arr[1] . '
        <p><button type="button"  name="btnLogin" id="btnLogin" onclick="closeClick()">
            CLOSE
        </button>
        ';
    } else {
        $regisForm = '
        <label for="psw"><b>EMail</b></label>
        <input type="email"
            id="txtEMail" 
            name="txtEMail"
            placeholder="Enter EMail"
            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
            maxlength="40"
        required>
        <label for="psw"><b>Mobile</b></label>
        <input type="tel" 
            placeholder="Enter Mobile" 
            name="txtTel" id="txtTel" 
            pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" 
            maxlength="10"
        required>
        <button type="button"  name="btnLogin" id="btnLogin" onclick="registerCheck()">
            REGISTER
        </button>
        ';
    }
    return $regisForm;
}

$objDataFromRoute = getDataFromRoute();
if ($objDataFromRoute->route == 'MENU') {
    $getData = getDataFromDatabase($objDataFromRoute);
} else if ($objData->route == 'CHECKDATA') {
    $getData = registerDataToDatabase($objDataFromRoute);
}

if ($getData->sFlag == '0') {
    $regisType = true;
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
    <?php
    echo regisForm($regisType);
    ?>
    <script>
       
    </script>
</body>

</html>