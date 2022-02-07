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

$sFlag = '0';
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

$getDataFromUrl = getDataFromUrl($GLOBALS['COMPANY_CODE'], $GLOBALS['REGISTER_URL']);
$status = $getDataFromUrl->status;


echo $status;

if ($status == 'check') {
    registerDataToDatabase($getDataFromUrl);
} else if ($status == 'init') {
    $getData = getDataFromDatabase($GLOBALS['COMPANY_URL'], $getDataFromUrl);
    $sFlag = $getData->sFlag;
}

if ($sFlag == '4') {
    $LINEID = $getDataFromUrl->LineId;
    rmxChangeMemberRichMenu('Member', $LINEID);
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
        var urlS = new URL(document.URL);
        // alert('urlS: ' + urlS);

        function registerCheck() {
            var sUserName = 'rmxadmin';
            var sLineDisplay = 'rmxadmin';
            //
            var sCompanyCode = "<?php echo $GLOBALS['COMPANY_CODE']; ?>";
            var sEMail = document.getElementById('txtEMail').value;
            //
            var sTel = document.getElementById('txtTel').value;
            if (sTel == '') {
                alert("Input Telephone / Mobile");
            } else if (sEMail == '') {
                alert("Input Email");
            } else {
                if (sTel.length < 8) {
                    alert("Telephone / Mobile must be at least 8 digits long");
                } else {
                    var toMenu = 'register';
                    var toStatus = 'check';
                    const sUrl = "<? echo sURL; ?>";
                    const userIdProfile = "<? echo  $getDataFromUrl->LineId; ?>";
                    var sCmd = sLineDisplay + "^c" + sUserName + "^c" + sTel + "^c" + sEMail;
                    var urlSelectMenu = rmxSelectMenu(sUrl, toMenu, userIdProfile, sCmd, toStatus);
                    var param = urlSelectMenu.paramS;


                    var url = window.location.pathname;
                    var filename = url.substring(url.lastIndexOf('/') + 1);
                    alert('filename: '+filename);

                    menuUrl = "menu/registerMenu.php" + param;
                    $("#rmxLiFFLayout").load(menuUrl);

                }
            }


        }

        var sFlag = "<?php echo $sFlag; ?>";
        if (sFlag == 4) {
            rmxCloseWindow();
        }
    </script>
</body>

</html>

<!-- 


`sp_comp_reqister_user`(
    IN $sLineId VARCHAR(50) CHARACTER SET UTF8 COLLATE utf8_unicode_ci
    ,IN $sCompanyCode VARCHAR(50) CHARACTER SET UTF8 COLLATE utf8_unicode_ci
    ,IN $sUserName VARCHAR(300) CHARACTER SET UTF8 COLLATE utf8_unicode_ci
    ,IN $sSoldToCode VARCHAR(100) CHARACTER SET UTF8 COLLATE utf8_unicode_ci
    ,IN $sSoldToName VARCHAR(300) CHARACTER SET UTF8 COLLATE utf8_unicode_ci
    ,IN $sShipToCode VARCHAR(100) CHARACTER SET UTF8 COLLATE utf8_unicode_ci
    ,IN $sShipToName VARCHAR(300) CHARACTER SET UTF8 COLLATE utf8_unicode_ci
    ,IN $sMobileNo VARCHAR(100) CHARACTER SET UTF8 COLLATE utf8_unicode_ci
    ,IN $sEMail VARCHAR(100) CHARACTER SET UTF8 COLLATE utf8_unicode_ci
 -->